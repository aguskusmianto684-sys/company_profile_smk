<?php
include '../../app.php';  // koneksi & helper
session_start();

if (isset($_POST['tombol'])) {
    // Ambil data dari form dan escape
    $icon     = escapeString($_POST['icon']);
    $title    = escapeString($_POST['title']);
    $link_url = escapeString($_POST['link_url']);

    // Simpan ke database
    $qInsert = "INSERT INTO social_media (icon, title, link_url) VALUES ('$icon', '$title', '$link_url')";
    $result  = mysqli_query($connect, $qInsert) or die(mysqli_error($connect));

    if ($result) {
        // --- Log aktivitas ---
        $user_id = $_SESSION['user_id'] ?? 0;
        $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        $last_id = mysqli_insert_id($connect);
        $logDesc = "icon: $icon, title: $title, link_url: $link_url";

        $qLog = "INSERT INTO user_activities 
                    (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
                 VALUES
                    ('$user_id', 'create', 'social_media', '$last_id', '" . mysqli_real_escape_string($connect, $logDesc) . "', '$ip', '$agent', NOW())";
        mysqli_query($connect, $qLog);

        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location.href='../../pages/social_media/index.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal ditambah');
                window.location.href='../../pages/social_media/create.php';
              </script>";
    }
}
?>
