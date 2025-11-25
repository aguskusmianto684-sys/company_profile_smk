<?php
include '../../../config/connection.php';
include './show.php';
session_start();

$storages = "../../../storages/testimonials/";

// Validasi testimonial
if (!isset($testimonial) || !$testimonial) {
    echo "<script>alert('Data tidak ditemukan'); window.location.href='../../pages/testimonials/index.php';</script>";
    exit;
}

// Ambil data sebelum dihapus untuk log
$oldData = "image='{$testimonial->image}', name='{$testimonial->name}', rating='{$testimonial->rating}', status='{$testimonial->status}', message='{$testimonial->message}'";

// Hapus gambar lama jika ada
if(!empty($testimonial->image) && file_exists($storages . $testimonial->image)) {
    unlink($storages . $testimonial->image);
}

// Hapus data dari database
$qDelete = "DELETE FROM testimonials WHERE id='$testimonial->id'";
$result = mysqli_query($connect, $qDelete);

if($result) {
    // --- Log aktivitas user ---
    $user_id = $_SESSION['user_id'] ?? 0;
    $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
    $qLog = "INSERT INTO user_activities 
                (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
             VALUES
                ('$user_id', 'delete', 'testimonials', '$testimonial->id', '" . mysqli_real_escape_string($connect, $oldData) . "', '$ip', '$agent', NOW())";
    mysqli_query($connect, $qLog);

    echo "<script>
    alert('Data berhasil dihapus');
    window.location.href='../../pages/testimonials/index.php';
    </script>";
} else {
    echo "<script>
    alert('Data gagal dihapus');
    window.location.href='../../pages/testimonials/index.php';
    </script>";
}
?>
