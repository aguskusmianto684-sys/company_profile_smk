<?php
include '../../app.php';
include './show.php';
session_start();

if (isset($_POST['tombol'])) {
    $changes = [];

    // Periksa masing-masing field apakah berubah
    if ($social_media->icon !== $_POST['icon']) {
        $changes[] = "icon: '{$social_media->icon}' → '{$_POST['icon']}'";
    }

    if ($social_media->title !== $_POST['title']) {
        $changes[] = "title: '{$social_media->title}' → '{$_POST['title']}'";
    }

    if ($social_media->link_url !== $_POST['link_url']) {
        $changes[] = "link_url: '{$social_media->link_url}' → '{$_POST['link_url']}'";
    }

    // Ambil data baru dari form (untuk update)
    $new_icon     = escapeString($_POST['icon']);
    $new_title    = escapeString($_POST['title']);
    $new_link_url = escapeString($_POST['link_url']);

    // Update data di database
    $qUpdate = "UPDATE social_media 
                SET icon='$new_icon', title='$new_title', link_url='$new_link_url' 
                WHERE id='$social_media->id'";
    $result  = mysqli_query($connect, $qUpdate) or die(mysqli_error($connect));

    if ($result) {
        if (!empty($changes)) {
            // --- Log aktivitas hanya field yang berubah ---
            $user_id = $_SESSION['user_id'] ?? 0;
            $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
            $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
            $logDesc = implode("; ", $changes);

            $qLog = "INSERT INTO user_activities 
                        (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
                     VALUES
                        ('$user_id', 'update', 'social_media', '$social_media->id', '" . mysqli_real_escape_string($connect, $logDesc) . "', '$ip', '$agent', NOW())";
            mysqli_query($connect, $qLog);
        }

        echo "<script>
                alert('Data berhasil diupdate');
                window.location.href='../../pages/social_media/index.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal diupdate');
                window.location.href='../../pages/social_media/edit.php?id=$social_media->id';
              </script>";
    }
}
?>
