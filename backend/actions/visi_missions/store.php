<?php
include __DIR__ . '/../../../config/connection.php';

if (isset($_POST['tombol'])) {
    // Ambil data dari form
    $category = mysqli_real_escape_string($connect, $_POST['category']);
    $text = mysqli_real_escape_string($connect, $_POST['text']);

    $qInsert = "INSERT INTO visi_missions (category, text) VALUES ('$category', '$text')";

    if (mysqli_query($connect, $qInsert)) {
        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location.href = '../../pages/visi_missions/index.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal ditambahkan: " . mysqli_error($connect) . "');
                window.location.href = '../../pages/visi_missions/create.php';
              </script>";
    }
}
?>