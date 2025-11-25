<?php
// dari actions/majors => naik 2 folder => backend => config/connection.php
include __DIR__ . '/../../../config/connection.php';

if (!isset($_GET['id'])) {
    echo "<script>
            alert('Tidak Bisa memilih ID ini');
            window.location.href = '../../pages/majors/index.php';
          </script>";
    exit;
}

$id = (int) $_GET['id'];

$qSelect = "SELECT * FROM majors WHERE id='$id' LIMIT 1";
$result = mysqli_query($connect, $qSelect) or die(mysqli_error($connect));

$major = mysqli_fetch_object($result);
if (!$major) {
    die("Data tidak ditemukan");
}
?>