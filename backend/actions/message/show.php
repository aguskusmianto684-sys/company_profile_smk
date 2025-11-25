<?php
include '../../app.php';  // Include file app untuk koneksi

// Validasi parameter ID
if(!isset($_GET['id'])){
    echo "<script>alert('Tidak Bisa memilih ID ini'); window.location.href = '../../pages/message/index.php';</script>";
    exit;
}

$id = $_GET['id'];
// Query untuk mengambil data message berdasarkan ID
$qSelect = "SELECT * FROM message WHERE id='$id'";
$result = mysqli_query($connect, $qSelect) or die(mysqli_error($connect));
$message = $result->fetch_object();

// Validasi jika data tidak ditemukan
if(!$message){
    echo "<script>alert('Data tidak ditemukan'); window.location.href = '../../pages/message/index.php';</script>";
    exit;
}
?>