<?php
// actions/contact/store.php
include '../../app.php';
session_start(); // pastikan session aktif

if (isset($_POST['tombol'])) {
    // Ambil data dari form
    $contact_text = escapeString($_POST['contact']);
    $email        = escapeString($_POST['email']);
    $icon         = escapeString($_POST['icon']);
    $link_url     = escapeString($_POST['link_url']);

    // Insert ke DB
    $qInsert = "INSERT INTO contacts (contact, email, icon, link_url) 
                VALUES ('$contact_text', '$email', '$icon', '$link_url')";

    if (mysqli_query($connect, $qInsert)) {
        // Ambil ID record yang baru
        $record_id = mysqli_insert_id($connect);

        // Catat aktivitas user
        $user_id = $_SESSION['user_id'] ?? 0;
        $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        $desc    = "Menambahkan contact: '$contact_text', email: '$email', icon: '$icon', link_url: '$link_url'";

        $qLog = "INSERT INTO user_activities 
                    (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
                 VALUES
                    ('$user_id', 'create', 'contacts', '$record_id', '" . mysqli_real_escape_string($connect, $desc) . "', '$ip', '$agent', NOW())";
        mysqli_query($connect, $qLog);

        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location.href = '../../pages/contact/index.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal ditambahkan: " . addslashes(mysqli_error($connect)) . "');
                window.location.href = '../../pages/contact/create.php';
              </script>";
    }
}
?>
