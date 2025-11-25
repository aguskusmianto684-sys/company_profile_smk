<?php
// actions/contact/destroy.php
include '../../app.php';
include './show.php';
session_start(); // pastikan session aktif

$storages = "../../../storages/contact/";

// Hapus gambar jika bukan default
if (!empty($contact->img) && $contact->img != 'default.png' && file_exists($storages . $contact->img)) {
    unlink($storages . $contact->img);
}

// Hapus data dari database
$qDelete = "DELETE FROM contacts WHERE id='$contact->id'";
$result = mysqli_query($connect, $qDelete);

if ($result) {
    // Catat aktivitas user
    $user_id = $_SESSION['user_id'] ?? 0;
    $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

    $desc = "Menghapus contact: '{$contact->contact}' dengan email '{$contact->email}'";

    $qLog = "INSERT INTO user_activities 
                (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
             VALUES
                ('$user_id', 'delete', 'contacts', '{$contact->id}', '" . mysqli_real_escape_string($connect, $desc) . "', '$ip', '$agent', NOW())";
    mysqli_query($connect, $qLog);

    echo "<script>
            alert('Data berhasil dihapus');
            window.location.href = '../../pages/contact/index.php';
          </script>";
} else {
    echo "<script>
            alert('Data gagal dihapus: " . addslashes(mysqli_error($connect)) . "');
            window.location.href = '../../pages/contact/index.php';
          </script>";
}
?>
