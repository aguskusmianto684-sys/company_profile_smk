<?php
include '../../../config/connection.php';
include './show.php';
session_start(); // pastikan session aktif

$storages = "../../../storages/majors/";

// Ambil data lama untuk log
$majorName = $major->majors_name;
$majorHead = $major->head;
$majorImage = $major->majors_image;

// hapus gambar lama jika ada
if(!empty($majorImage) && file_exists($storages . $majorImage)) {
    unlink($storages . $majorImage);
}

// hapus data
$qDelete = "DELETE FROM majors WHERE id='$major->id'";
$result = mysqli_query($connect, $qDelete) or die(mysqli_error($connect));

// Catat aktivitas user jika berhasil dihapus
if($result) {
    $user_id = $_SESSION['user_id'] ?? 0;
    $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

    $descParts = [];
    $descParts[] = "Nama jurusan: '$majorName'";
    $descParts[] = "Kepala jurusan: '$majorHead'";
    $descParts[] = !empty($majorImage) ? "Gambar ada" : "Tidak ada gambar";

    $desc = "Menghapus jurusan → " . implode(", ", $descParts);

    $qLog = "INSERT INTO user_activities
                (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
             VALUES
                ('$user_id', 'delete', 'majors', '$major->id', '" . mysqli_real_escape_string($connect, $desc) . "', '$ip', '$agent', NOW())";

    mysqli_query($connect, $qLog);

    echo "<script>
            alert('Data berhasil dihapus');
            window.location.href = '../../pages/majors/index.php';
          </script>";
} else {
    echo "<script>
            alert('Data gagal dihapus');
            window.location.href = '../../pages/majors/index.php';
          </script>";
}
?>
