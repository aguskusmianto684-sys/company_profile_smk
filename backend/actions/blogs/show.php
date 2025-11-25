<?php
include __DIR__ . '/../../../config/connection.php';

if (!isset($_GET['id'])) {
    echo "<script>
            alert('ID tidak ditemukan');
            window.location.href = '../../pages/blog/index.php';
          </script>";
    exit;
}

$id = (int) $_GET['id'];

$qSelect = "SELECT * FROM blogs WHERE id='$id' LIMIT 1";
$result = mysqli_query($connect, $qSelect) or die(mysqli_error($connect));

$blog = mysqli_fetch_object($result);
if (!$blog) {
    die("Data tidak ditemukan");
}
