<?php
include '../../../config/connection.php';
include './show.php';
session_start();

$storages = "../../../storages/headmasters/";

// Hapus gambar lama jika ada
if (!empty($headmaster->headmaster_photo) && file_exists($storages . $headmaster->headmaster_photo)) {
    unlink($storages . $headmaster->headmaster_photo);
}

// --- Log aktivitas sebelum hapus ---
$user_id = $_SESSION['user_id'] ?? 0;
$ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
$agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
$logDesc = "headmaster_name: $headmaster->headmaster_name, headmaster_description: $headmaster->headmaster_description, headmaster_photo: $headmaster->headmaster_photo";

$qLog = "INSERT INTO user_activities 
            (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
         VALUES
            ('$user_id', 'delete', 'headmasters', '$headmaster->id', '" . mysqli_real_escape_string($connect, $logDesc) . "', '$ip', '$agent', NOW())";
mysqli_query($connect, $qLog);

// Hapus data
$qDelete = "DELETE FROM headmasters WHERE id='$headmaster->id'";
$result  = mysqli_query($connect, $qDelete) or die(mysqli_error($connect));

// Cek apakah data berhasil dihapus atau tidak
if ($result) {
    echo "<script>
            alert('Data berhasil dihapus');
            window.location.href = '../../pages/headmasters/index.php';
          </script>";
} else {
    echo "<script>
            alert('Data gagal dihapus');
            window.location.href = '../../pages/headmasters/index.php';
          </script>";
}
?>
