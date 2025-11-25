<?php
// actions/galleries/show.php
include __DIR__ . '/../../../config/connection.php';

if (!isset($_GET['id'])) {
    echo "<script>
            alert('Tidak bisa memilih ID ini');
            window.location.href = '../../pages/galleries/index.php';
          </script>";
    exit;
}

$id = (int) $_GET['id'];

$qSelect = "SELECT * FROM galleries WHERE id='$id' LIMIT 1";
$result = mysqli_query($connect, $qSelect) or die(mysqli_error($connect));

$gallery = mysqli_fetch_object($result);
if (!$gallery) {
    die("Data tidak ditemukan");
}
?>