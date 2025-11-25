<?php
include '../../../config/connection.php';
include './show.php';
session_start(); // supaya bisa ambil user_id

$storages = "../../../storages/teachers/";

// Validasi data teacher
if (!isset($teacher) || !$teacher) {
    echo "<script>
            alert('Data tidak ditemukan');
            window.location.href='../../pages/teachers/index.php';
          </script>";
    exit;
}

// Hapus gambar lama jika ada
if (!empty($teacher->teachers_photo) && file_exists($storages . $teacher->teachers_photo)) {
    unlink($storages . $teacher->teachers_photo);
}

// Siapkan log aktivitas sebelum dihapus
$user_id = $_SESSION['user_id'] ?? 0;
$ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
$agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
$descLog = "teachers_name='{$teacher->teachers_name}', jk='{$teacher->jk}', teachers_major='{$teacher->teachers_major}', teachers_photo='{$teacher->teachers_photo}'";

// Hapus data dari database
$qDelete = "DELETE FROM teachers WHERE id='$teacher->id'";
$result  = mysqli_query($connect, $qDelete) or die(mysqli_error($connect));

if ($result) {
    // Masukkan log aktivitas
    $qLog = "INSERT INTO user_activities 
                (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
             VALUES
                ('$user_id', 'delete', 'teachers', '$teacher->id', '" . mysqli_real_escape_string($connect, $descLog) . "', '$ip', '$agent', NOW())";
    mysqli_query($connect, $qLog);

    echo "<script>
            alert('Data berhasil dihapus');
            window.location.href='../../pages/teachers/index.php';
          </script>";
} else {
    echo "<script>
            alert('Data gagal dihapus');
            window.location.href='../../pages/teachers/index.php';
          </script>";
}
?>
