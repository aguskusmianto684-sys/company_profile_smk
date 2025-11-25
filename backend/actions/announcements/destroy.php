<?php
include '../../../config/connection.php';
include './show.php';
session_start(); // pastikan session aktif

$storages = "../../../storages/announcements/";

// Simpan data lama untuk log
$oldData = [];
if (!empty($announcement->announcements_title)) {
    $oldData[] = "Judul: " . $announcement->announcements_title;
}
if (!empty($announcement->date)) {
    $oldData[] = "Tanggal: " . $announcement->date;
}
if (!empty($announcement->announcements_description)) {
    $oldData[] = "Deskripsi: ada";
}
if (!empty($announcement->announcements_image)) {
    $oldData[] = "Gambar: ada";
}
$desc = "Hapus pengumuman [" . implode(", ", $oldData) . "]";

// hapus gambar lama jika ada
if(!empty($announcement->announcements_image) && file_exists($storages . $announcement->announcements_image)) {
    unlink($storages . $announcement->announcements_image);
}

// hapus data
$qDelete = "DELETE FROM announcements WHERE id='$announcement->id'";
$result = mysqli_query($connect, $qDelete) or die(mysqli_error($connect));

// Catat aktivitas user
$user_id = $_SESSION['user_id'] ?? 0;
$ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
$agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

$qLog = "INSERT INTO user_activities 
            (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
         VALUES
            ('$user_id', 'delete', 'announcements', '$announcement->id', '" . mysqli_real_escape_string($connect, $desc) . "', '$ip', '$agent', NOW())";

mysqli_query($connect, $qLog);

if($result) {
    echo "<script>
        alert('Data berhasil dihapus');
        window.location.href='../../pages/announcements/index.php';
        </script>";
} else {
    echo "<script>
        alert('Data gagal dihapus');
        window.location.href='../../pages/announcements/index.php';
        </script>";
}
?>
