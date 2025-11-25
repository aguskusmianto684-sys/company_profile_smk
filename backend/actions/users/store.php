<?php
session_start();
include '../../../config/connection.php';

if ($_SESSION['user_role'] !== 'admin') {
    echo "<script>alert('Tidak punya akses!'); window.location='../../pages/users/index.php';</script>";
    exit();
}

$name     = mysqli_real_escape_string($connect, $_POST['name']);
$email    = mysqli_real_escape_string($connect, $_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role     = mysqli_real_escape_string($connect, $_POST['role']);

// 🔎 Cek apakah email sudah ada
$check = mysqli_query($connect, "SELECT id FROM users WHERE email = '$email' LIMIT 1");
if (mysqli_num_rows($check) > 0) {
    echo "<script>
        alert('Email sudah terdaftar! Gunakan email lain.');
        window.location='../../pages/users/create.php';
    </script>";
    exit();
}

// Insert data user
$query = "INSERT INTO users (name, email, password, role, created_at, updated_at) 
          VALUES ('$name', '$email', '$password', '$role', NOW(), NOW())";

if (mysqli_query($connect, $query)) {
    // --- Log aktivitas tambah user ---
    $user_id = $_SESSION['user_id'] ?? 0;
    $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
    $newUserId = mysqli_insert_id($connect);
    $descLog = "name='$name', email='$email', role='$role'";

    $qLog = "INSERT INTO user_activities
                (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
             VALUES
                ('$user_id', 'create', 'users', '$newUserId', '" . mysqli_real_escape_string($connect, $descLog) . "', '$ip', '$agent', NOW())";
    mysqli_query($connect, $qLog);

    echo "<script>alert('User berhasil ditambahkan!'); window.location='../../pages/users/index.php';</script>";
} else {
    echo "<script>alert('Gagal tambah user!'); window.location='../../pages/users/create.php';</script>";
}
?>
