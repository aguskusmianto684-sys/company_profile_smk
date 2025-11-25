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

// Ambil data lama untuk memastikan data ada
$qSelect = "SELECT * FROM visi_missions WHERE id='$id'";
$result = mysqli_query($connect, $qSelect);

if (mysqli_num_rows($result) == 0) {
    echo "<script>
            alert('Data tidak ditemukan');
            window.location.href = '../../pages/visi_missions/index.php';
          </script>";
    exit;
}

// Data dari form
$category = mysqli_real_escape_string($connect, $_POST['category']);
$text = mysqli_real_escape_string($connect, $_POST['text']);

// Update query
$qUpdate = "UPDATE visi_missions SET 
                category='$category',
                text='$text'
            WHERE id='$id'";

if (mysqli_query($connect, $qUpdate)) {
    echo "<script>
            alert('Data berhasil diedit');
            window.location.href='../../pages/visi_missions/index.php';
          </script>";
} else {
    echo "<script>
            alert('Data gagal diedit: " . mysqli_error($connect) . "');
            window.location.href='../../pages/visi_missions/edit.php?id=$id';
          </script>";
}