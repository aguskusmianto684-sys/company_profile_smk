<?php
include '../../app.php';              // biarkan kalau app.php memang load koneksi dsb
session_start();

// pastikan helper tersedia: ubah path jika file helper ada di tempat lain
require_once __DIR__ . '/../../../config/logActivity.php';

// Kalau ingin mencegah error bila helper belum ada, bisa cek:
// if (!function_exists('logActivity')) { /* beri pesan error */ }

if (isset($_SESSION['user_id'])) {
    // panggil helper (satu-satunya pencatatan, jangan dobel)
    logActivity($connect, $_SESSION['user_id'], 'logout', null, null, 'User logout dari sistem');
}

// Hapus session dan redirect
session_unset();
session_destroy();

echo "<script>
        alert('Anda telah keluar!');
        window.location.href='../../pages/user/login.php';
    </script>";
exit;
