<?php
include '../../../config/connection.php';
include '../../../config/escapeString.php';
session_start(); // pastikan session aktif

if (isset($_POST['tombol'])) {
    // Ambil data dari form
    $announcements_title = escapeString($_POST['announcements_title']);
    $date = escapeString($_POST['date']);
    $announcements_description = escapeString($_POST['announcements_description']);

    // Handle upload image
    $imageTmp = $_FILES['announcements_image']['tmp_name'];
    $ext = pathinfo($_FILES['announcements_image']['name'], PATHINFO_EXTENSION);
    $imageName = time() . "_announcement." . $ext;

    $storages = "../../../storages/announcements/";

    // Upload file image
    $uploadImage = move_uploaded_file($imageTmp, $storages . $imageName);

    if ($uploadImage) {
        $qInsert = "
            INSERT INTO announcements (announcements_title, date, announcements_description, announcements_image) 
            VALUES ('$announcements_title', '$date', '$announcements_description', '$imageName')
        ";

        mysqli_query($connect, $qInsert) or die(mysqli_error($connect));

        // Ambil ID yang baru dibuat
        $newId = mysqli_insert_id($connect);

        // Catat aktivitas user
        $user_id = $_SESSION['user_id'] ?? 0;
        $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        $desc    = "Menambahkan pengumuman: '$announcements_title' (ID: $newId)";

        $qLog = "INSERT INTO user_activities
                    (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
                 VALUES
                    ('$user_id', 'create', 'announcements', '$newId', '" . mysqli_real_escape_string($connect, $desc) . "', '$ip', '$agent', NOW())";

        mysqli_query($connect, $qLog);

        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location.href = '../../pages/announcements/index.php';
              </script>";
    } else {
        echo "<script>
                alert('Upload gambar gagal');
                window.location.href = '../../pages/announcements/create.php';
              </script>";
    }
}
?>
