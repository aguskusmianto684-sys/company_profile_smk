<?php
include '../../app.php';  // Include file app untuk koneksi

// Validasi parameter ID
if(!isset($_GET['id'])){
    echo "<script>alert('Tidak Bisa memilih ID ini'); window.location.href = '../../pages/social_media/index.php';</script>";
    exit;
}

$id = $_GET['id'];
// Query untuk mengambil data social media berdasarkan ID
$qSelect = "SELECT * FROM social_media WHERE id='$id'";
$result = mysqli_query($connect, $qSelect) or die(mysqli_error($connect));
$social_media = $result->fetch_object();

// Validasi jika data tidak ditemukan
if(!$social_media){
    echo "<script>alert('Data tidak ditemukan'); window.location.href = '../../pages/social_media/index.php';</script>";
    exit;
}
?>