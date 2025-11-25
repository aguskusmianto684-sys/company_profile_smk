<?php
session_start();
include '../../../config/connection.php';

// pastikan hanya superadmin yang boleh hapus
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    echo "<script>
        alert('Anda tidak punya akses!');
        window.location.href='../../pages/aktivitas/index.php';
    </script>";
    exit();
}

// ambil id dari query string
if (!isset($_GET['id'])) {
    echo "<script>
        alert('ID aktivitas tidak ditemukan!');
        window.location.href='../../pages/aktivitas/index.php';
    </script>";
    exit();
}

$id = intval($_GET['id']);

// hapus dari tabel user_activities
$qDelete = "DELETE FROM user_activities WHERE id='$id'";
$result = mysqli_query($connect, $qDelete) or die(mysqli_error($connect));

if ($result) {
    echo "<script>
        alert('Aktivitas berhasil dihapus!');
        window.location.href='../../pages/aktivitas/index.php';
    </script>";
} else {
    echo "<script>
        alert('Aktivitas gagal dihapus!');
        window.location.href='../../pages/aktivitas/index.php';
    </script>";
}
?>
