<?php
// actions/contact/show.php
include __DIR__ . '/../../../config/connection.php';

if (!isset($_GET['id'])) {
    echo "<script>
            alert('ID tidak ditemukan');
            window.location.href = '../../pages/contact/index.php';
          </script>";
    exit;
}

$id = (int) $_GET['id'];

$qSelect = "SELECT * FROM contacts WHERE id='$id' LIMIT 1";
$result = mysqli_query($connect, $qSelect);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "<script>
            alert('Data tidak ditemukan');
            window.location.href = '../../pages/contact/index.php';
          </script>";
    exit;
}

$contact = mysqli_fetch_object($result);
?>