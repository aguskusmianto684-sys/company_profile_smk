<?php
include '../../app.php';  // Include file app untuk koneksi dan fungsi helper

if (isset($_POST['tombol'])) {
    // Mengambil dan membersihkan data dari form
    $name = escapeString($_POST['name']);
    $email = escapeString($_POST['email']);
    $subjek = escapeString($_POST['subjek']);
    $no_telepon = escapeString($_POST['no_telepon']);
    $message = escapeString($_POST['message']);
    
    // Query untuk menyimpan data ke database
    $qInsert = "INSERT INTO message (name, email, subjek, no_telepon, message) VALUES ('$name', '$email', '$subjek', '$no_telepon', '$message')";
    $result = mysqli_query($connect, $qInsert) or die(mysqli_error($connect));
    
    if ($result) {
        // Redirect jika berhasil
        echo "<script>alert('Pesan berhasil dikirim'); window.location.href = '../../../index.php';</script>";
    } else {
        echo "<script>alert('Pesan gagal dikirim'); window.location.href = '../../../index.php';</script>";
    }
}
?>