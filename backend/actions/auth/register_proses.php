<?php
session_start();
include '../../app.php'; //koneksi database

// cek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = escapeString($_POST['email']);
    $name = escapeString($_POST['name']);
    $password = $_POST['password'];

    // cek apakah email dan password sesuai
    $cekQuery = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($connect, $cekQuery);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>
        alert('Email sudah terdaftar');
        window.location.href='../../pages/user/register.php';
        </script>";
        exit();
    }

    // hash password = fungsi konversi password ke sandi encrypt
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    // simpan data pengguna baru
    $insertQuery = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashPassword')";
    if (mysqli_query($connect, $insertQuery)) {
        echo "<script>
        alert('Register berhasil, silakan login!');
        window.location.href='../../pages/user/login.php';
        </script>";
    } else {
        echo "<script>
        alert('Register gagal!');
        window.location.href='../../pages/user/register.php';
        </script>";
    }
}
