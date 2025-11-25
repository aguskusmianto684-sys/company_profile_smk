<?php
// actions/extracurriculars/show.php
include __DIR__ . '/../../../config/connection.php';

if (!isset($_GET['id'])) {
    echo "<script>
            alert('Tidak bisa memilih ID ini');
            window.location.href = '../../pages/extracurriculars/index.php';
          </script>";
    exit;
}

$id = (int) $_GET['id'];

$qSelect = "SELECT * FROM extracurriculars WHERE id='$id' LIMIT 1";
$result = mysqli_query($connect, $qSelect) or die(mysqli_error($connect));

$extracurricular = mysqli_fetch_object($result);
if (!$extracurricular) {
    die("Data tidak ditemukan");
}
?>
