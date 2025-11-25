<?php
session_start();
include '../../../config/connection.php';

// Cek role superadmin
if ($_SESSION['user_role'] !== 'superadmin') {
    echo "<script>alert('Tidak punya akses!'); window.location='../../pages/aktivitas/index.php';</script>";
    exit();
}

// Ambil semua data aktivitas (untuk log)
$qAll = "SELECT * FROM user_activities";
$resAll = mysqli_query($connect, $qAll);
$activities = [];
while ($row = mysqli_fetch_assoc($resAll)) {
    $activities[] = $row;
}

// Hapus semua
$qDelete = "DELETE FROM user_activities";
$result = mysqli_query($connect, $qDelete);

if ($result) {
    // --- Log setiap aktivitas yang dihapus ---
    $user_id = $_SESSION['user_id'] ?? 0;
    $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

    foreach ($activities as $act) {
        $descLog = "Menghapus aktivitas: user_id={$act['user_id']}, activity={$act['activity']}, table={$act['table_name']}, deskripsi={$act['description']}";
        $qLog = "INSERT INTO user_activities 
                    (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
                 VALUES
                    ('$user_id', 'delete', 'user_activities', '{$act['id']}', '" . mysqli_real_escape_string($connect, $descLog) . "', '$ip', '$agent', NOW())";
        mysqli_query($connect, $qLog);
    }

    echo "<script>alert('Semua aktivitas berhasil dihapus'); window.location='../../pages/aktivitas/index.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus semua aktivitas'); window.location='../../pages/aktivitas/index.php';</script>";
}
?>
