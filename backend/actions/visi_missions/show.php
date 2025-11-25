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

$qSelect = "SELECT * FROM visi_missions WHERE id='$id' LIMIT 1";
$result = mysqli_query($connect, $qSelect) or die(mysqli_error($connect));

$visi_misi = mysqli_fetch_object($result);
if (!$visi_misi) {
    echo "<script>
            alert('Data tidak ditemukan');
            window.location.href = '../../pages/visi_missions/index.php';
          </script>";
    exit;
}
?>