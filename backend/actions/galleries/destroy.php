<?php
// actions/galleries/destroy.php
include '../../app.php';
include './show.php';
session_start();

$storages = "../../../storages/galleries/";

// Hapus gambar lama jika ada
if (!empty($gallery->image) && file_exists($storages . $gallery->image)) {
    unlink($storages . $gallery->image);
}

// Simpan data lama untuk log
$oldData = "image: {$gallery->image}, author: {$gallery->author}, date: {$gallery->date}, description: {$gallery->description}";

// Hapus data
$qDelete = "DELETE FROM galleries WHERE id='$gallery->id'";
$result = mysqli_query($connect, $qDelete);

if ($result) {
    // --- Log aktivitas user ---
    $user_id = $_SESSION['user_id'] ?? 0;
    $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

    $qLog = "INSERT INTO user_activities 
                (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
             VALUES
                ('$user_id', 'delete', 'galleries', '{$gallery->id}', '" . mysqli_real_escape_string($connect, $oldData) . "', '$ip', '$agent', NOW())";
    mysqli_query($connect, $qLog);

    echo "<script>
        alert('Data berhasil dihapus');
        window.location.href = '../../pages/galleries/index.php';
    </script>";
} else {
    echo "<script>
        alert('Data gagal dihapus');
        window.location.href = '../../pages/galleries/index.php';
    </script>";
}
?>
