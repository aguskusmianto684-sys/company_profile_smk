<?php
include '../../app.php';  // koneksi
include './show.php';      // ambil data message
session_start();

// Validasi data message
if (!isset($message) || !$message) {
    echo "<script>
            alert('Data tidak ditemukan');
            window.location.href='../../pages/message/index.php';
          </script>";
    exit;
}

// --- Log aktivitas sebelum hapus ---
$user_id = $_SESSION['user_id'] ?? 0;
$ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
$agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
$logDesc = "name: $message->name, email: $message->email, subject: $message->subject, message: $message->message";

$qLog = "INSERT INTO user_activities 
            (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
         VALUES
            ('$user_id', 'delete', 'message', '$message->id', '" . mysqli_real_escape_string($connect, $logDesc) . "', '$ip', '$agent', NOW())";
mysqli_query($connect, $qLog);

// Hapus data dari database
$qDelete = "DELETE FROM message WHERE id='$message->id'";
$result  = mysqli_query($connect, $qDelete) or die(mysqli_error($connect));

// Cek apakah berhasil
if ($result) {
    echo "<script>
            alert('Pesan berhasil dihapus');
            window.location.href='../../pages/message/index.php';
          </script>";
} else {
    echo "<script>
            alert('Pesan gagal dihapus');
            window.location.href='../../pages/message/index.php';
          </script>";
}
?>
