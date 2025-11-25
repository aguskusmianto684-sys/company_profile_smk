<?php
session_start();
include '../../../config/connection.php';

$id       = $_GET['id'];
$name     = mysqli_real_escape_string($connect, $_POST['name']);
$email    = mysqli_real_escape_string($connect, $_POST['email']);
$role     = mysqli_real_escape_string($connect, $_POST['role']);
$password = $_POST['password'];

// Ambil data lama sebelum update
$qSelect = "SELECT * FROM users WHERE id='$id'";
$res      = mysqli_query($connect, $qSelect);
$userOld  = mysqli_fetch_object($res);

$changes = [];

// Cek perubahan tiap field
if ($userOld->name != $name) $changes[] = "name: '{$userOld->name}' → '$name'";
if ($userOld->email != $email) $changes[] = "email: '{$userOld->email}' → '$email'";
if ($userOld->role != $role) $changes[] = "role: '{$userOld->role}' → '$role'";
if (!empty($password)) $changes[] = "password: (diubah)";

$descLog = !empty($changes) ? implode(", ", $changes) : "Tidak ada perubahan";

// Update query
if (empty($password)) {
    $query = "UPDATE users SET name='$name', email='$email', role='$role', updated_at=NOW() WHERE id='$id'";
} else {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE users SET name='$name', email='$email', password='$hashedPassword', role='$role', updated_at=NOW() WHERE id='$id'";
}

if (mysqli_query($connect, $query)) {
    // --- Log aktivitas user ---
    $user_id = $_SESSION['user_id'] ?? 0;
    $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
    $qLog = "INSERT INTO user_activities
                (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
             VALUES
                ('$user_id', 'update', 'users', '$id', '" . mysqli_real_escape_string($connect, $descLog) . "', '$ip', '$agent', NOW())";
    mysqli_query($connect, $qLog);

    echo "<script>alert('User berhasil diupdate!'); window.location='../../pages/users/index.php';</script>";
} else {
    echo "<script>alert('Gagal update user!'); window.location='../../pages/users/edit.php?id=$id';</script>";
}
?>
