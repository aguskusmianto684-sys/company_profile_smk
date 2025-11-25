<?php
session_start();
include '../../../config/connection.php';

$id = (int) $_GET['id'];

// Ambil data user sebelum dihapus (untuk log)
$qSelect = "SELECT * FROM users WHERE id='$id'";
$resSelect = mysqli_query($connect, $qSelect);
$user = mysqli_fetch_object($resSelect);

if (!$user) {
    echo "<script>alert('User tidak ditemukan!'); window.location='../../pages/users/index.php';</script>";
    exit();
}

// Hapus user
$query = "DELETE FROM users WHERE id='$id'";
$result = mysqli_query($connect, $query);

if ($result) {
    // --- Log aktivitas hapus user ---
    $user_id = $_SESSION['user_id'] ?? 0;
    $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
    $descLog = "Menghapus user: name='$user->name', email='$user->email', role='$user->role'";

    $qLog = "INSERT INTO user_activities 
                (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
             VALUES
                ('$user_id', 'delete', 'users', '$id', '" . mysqli_real_escape_string($connect, $descLog) . "', '$ip', '$agent', NOW())";
    mysqli_query($connect, $qLog);

    echo "<script>alert('User berhasil dihapus!'); window.location='../../pages/users/index.php';</script>";
} else {
    echo "<script>alert('Gagal hapus user!'); window.location='../../pages/users/index.php';</script>";
}
?>
