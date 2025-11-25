<?php
include '../../../config/connection.php';
include './show.php';
session_start(); // pastikan session aktif

$storages = "../../../storages/achievements/";

// Simpan data lama untuk log
$oldData = [
    'title'       => $achievement->title,
    'author'      => $achievement->author,
    'date'        => $achievement->date,
    'description' => $achievement->description,
    'image'       => $achievement->image
];

// hapus gambar lama jika ada
if(!empty($achievement->image) && file_exists($storages . $achievement->image)) {
    unlink($storages . $achievement->image);
}

// hapus data
$qDelete = "DELETE FROM achievements WHERE id='$achievement->id'";
$result = mysqli_query($connect, $qDelete) or die(mysqli_error($connect));

// Catat aktivitas user jika berhasil dihapus
if($result) {
    $user_id = $_SESSION['user_id'] ?? 0;
    $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

    // Ringkas data untuk log
    $descParts = [];
    $descParts[] = "Judul: '{$oldData['title']}'";
    $descParts[] = "Penulis: '{$oldData['author']}'";
    $descParts[] = "Tanggal: '{$oldData['date']}'";
    $descParts[] = "Gambar: ada";

    $desc = "Menghapus prestasi → " . implode(", ", $descParts);

    $qLog = "INSERT INTO user_activities
                (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
             VALUES
                ('$user_id', 'delete', 'achievements', '{$achievement->id}', '" . mysqli_real_escape_string($connect, $desc) . "', '$ip', '$agent', NOW())";

    mysqli_query($connect, $qLog);

    echo "<script>
    alert('Data berhasil dihapus');
    window.location.href = '../../pages/achievements/index.php';
    </script>";
} else {
    echo "<script>
    alert('Data gagal dihapus');
    window.location.href = '../../pages/achievements/index.php';
    </script>";
}
?>
