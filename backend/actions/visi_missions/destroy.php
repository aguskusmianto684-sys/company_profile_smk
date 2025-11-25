<?php
include __DIR__ . '/../../../config/connection.php';

if (!isset($_GET['id'])) {
    echo "<script>
            alert('ID tidak valid');
            window.location.href = '../../pages/visi_missions/index.php';
          </script>";
    exit;
}

$id = (int) $_GET['id'];

// Ambil data untuk memastikan data ada
$qSelect = "SELECT * FROM visi_missions WHERE id='$id'";
$result = mysqli_query($connect, $qSelect);

if (mysqli_num_rows($result) == 0) {
    echo "<script>
            alert('Data tidak ditemukan');
            window.location.href = '../../pages/visi_missions/index.php';
          </script>";
    exit;
}

// hapus data
$qDelete = "DELETE FROM visi_missions WHERE id='$id'";
$result = mysqli_query($connect, $qDelete) or die(mysqli_error($connect));

// cek apakah data berhasil dihapus atau tidak
if($result) {
    echo "<script>
            alert('Data berhasil dihapus');
            window.location.href = '../../pages/visi_missions/index.php';
          </script>";
} else {
    echo "<script>
            alert('Data gagal dihapus');
            window.location.href = '../../pages/visi_missions/index.php';
          </script>";
}
?>