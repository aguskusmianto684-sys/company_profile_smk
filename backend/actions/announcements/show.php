<?php
// dari actions/announcements => naik 2 folder => backend => config/connection.php
include __DIR__ . '/../../../config/connection.php';

if (!isset($_GET['id'])) {
    echo "<script>
            alert('Tidak Bisa memilih ID ini');
            window.location.href = '../../pages/announcements/index.php';
          </script>";
    exit;
}

$id = (int) $_GET['id'];

$qSelect = "SELECT * FROM announcements WHERE id='$id' LIMIT 1";
$result = mysqli_query($connect, $qSelect) or die(mysqli_error($connect));

$announcement = mysqli_fetch_object($result);
if (!$announcement) {
    die("Data tidak ditemukan");
}
?>