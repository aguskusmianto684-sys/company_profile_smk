<?php
// dari actions/teachers => naik 2 folder => backend => config/connection.php
include __DIR__ . '/../../../config/connection.php';

if (!isset($_GET['id'])) {
    echo "<script>
            alert('Tidak Bisa memilih ID ini');
            window.location.href = '../../pages/teachers/index.php';
          </script>";
    exit;
}

$id = (int) $_GET['id'];

$qSelect = "SELECT * FROM teachers WHERE id='$id' LIMIT 1";
$result = mysqli_query($connect, $qSelect) or die(mysqli_error($connect));

$teacher = mysqli_fetch_object($result);
if (!$teacher) {
    die("Data tidak ditemukan");
}
?>