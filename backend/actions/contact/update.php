<?php
// actions/contact/update.php
include '../../app.php';
include './show.php';
session_start(); // pastikan session aktif

if (isset($_POST['tombol'])) {
    $id = (int) $_GET['id'];

    // Ambil data lama untuk log
    $qSelect = "SELECT * FROM contacts WHERE id='$id'";
    $resSelect = mysqli_query($connect, $qSelect);
    $old = mysqli_fetch_assoc($resSelect);

    // Ambil data dari form
    $contact_text = escapeString($_POST['contact']);
    $email        = escapeString($_POST['email']);
    $icon         = escapeString($_POST['icon']);
    $link_url     = escapeString($_POST['link_url']);

    // Update query
    $qUpdate = "UPDATE contacts SET 
                    contact = '$contact_text', 
                    email = '$email', 
                    icon = '$icon', 
                    link_url = '$link_url' 
                WHERE id = '$id'";

    if (mysqli_query($connect, $qUpdate)) {
        // Catat aktivitas user dengan detail perubahan
        $user_id = $_SESSION['user_id'] ?? 0;
        $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

        $changes = [];
        if ($old['contact'] != $contact_text) $changes[] = "contact: '{$old['contact']}' → '$contact_text'";
        if ($old['email']   != $email)        $changes[] = "email: '{$old['email']}' → '$email'";
        if ($old['icon']    != $icon)         $changes[] = "icon: '{$old['icon']}' → '$icon'";
        if ($old['link_url']!= $link_url)     $changes[] = "link_url: '{$old['link_url']}' → '$link_url'";

        $desc = !empty($changes) ? implode(", ", $changes) : "Tidak ada perubahan";

        $qLog = "INSERT INTO user_activities 
                    (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
                 VALUES
                    ('$user_id', 'update', 'contacts', '$id', '" . mysqli_real_escape_string($connect, $desc) . "', '$ip', '$agent', NOW())";
        mysqli_query($connect, $qLog);

        echo "<script>
                alert('Data berhasil diupdate');
                window.location.href = '../../pages/contact/index.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal diupdate: " . addslashes(mysqli_error($connect)) . "');
                window.location.href = '../../pages/contact/edit.php?id=$id';
              </script>";
    }
}
?>
