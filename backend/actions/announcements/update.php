<?php
include '../../../config/connection.php';
include '../../../config/escapeString.php';
session_start(); // pastikan session aktif

$id = (int) $_GET['id'];

// Ambil data lama
$qSelect = "SELECT * FROM announcements WHERE id='$id'";
$resSelect = mysqli_query($connect, $qSelect) or die(mysqli_error($connect));
$announcement = mysqli_fetch_assoc($resSelect); // pakai array supaya mudah

// Data dari form
$announcements_title = escapeString($_POST['announcements_title']);
$date = escapeString($_POST['date']);
$announcements_description = escapeString($_POST['announcements_description']);

// Default: pakai gambar lama
$announcements_image = $announcement['announcements_image'];

// Kalau ada file image baru
if (!empty($_FILES['announcements_image']['name'])) {
    $ext = pathinfo($_FILES['announcements_image']['name'], PATHINFO_EXTENSION);
    $newFileName = time() . "_announcement." . $ext;
    $imageTmp = $_FILES['announcements_image']['tmp_name'];

    if (move_uploaded_file($imageTmp, "../../../storages/announcements/" . $newFileName)) {
        // hapus gambar lama
        if (!empty($announcement['announcements_image']) && file_exists("../../../storages/announcements/" . $announcement['announcements_image'])) {
            unlink("../../../storages/announcements/" . $announcement['announcements_image']);
        }
        $announcements_image = $newFileName;
    }
}

// Siapkan deskripsi perubahan
$changes = [];
if ($announcement['announcements_title'] != $announcements_title) {
    $changes[] = "Judul: '{$announcement['announcements_title']}' → '$announcements_title'";
}
if ($announcement['date'] != $date) {
    $changes[] = "Tanggal: '{$announcement['date']}' → '$date'";
}
if ($announcement['announcements_description'] != $announcements_description) {
    $changes[] = "Deskripsi: diubah";
}
if ($announcement['announcements_image'] != $announcements_image) {
    $changes[] = "Gambar: diubah";
}
$desc = !empty($changes) ? implode(", ", $changes) : "Tidak ada perubahan";

// Update query
$qUpdate = "UPDATE announcements SET 
                announcements_title='" . mysqli_real_escape_string($connect, $announcements_title) . "',
                date='" . mysqli_real_escape_string($connect, $date) . "',
                announcements_description='" . mysqli_real_escape_string($connect, $announcements_description) . "',
                announcements_image='" . mysqli_real_escape_string($connect, $announcements_image) . "'
            WHERE id='$id'";

$result = mysqli_query($connect, $qUpdate);

if ($result) {
    // Catat aktivitas user
    $user_id = $_SESSION['user_id'] ?? 0;
    $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

    $qLog = "INSERT INTO user_activities
                (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
             VALUES
                ('$user_id', 'update', 'announcements', '$id', '" . mysqli_real_escape_string($connect, $desc) . "', '$ip', '$agent', NOW())";

    mysqli_query($connect, $qLog);

    echo "<script>
            alert('Data berhasil diedit');
            window.location.href='../../pages/announcements/index.php';
          </script>";
} else {
    echo "<script>
            alert('Data gagal diedit: " . mysqli_error($connect) . "');
            window.location.href='../../pages/announcements/edit.php?id=$id';
          </script>";
}
?>
