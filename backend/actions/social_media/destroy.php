<?php
include '../../app.php';  // koneksi & helper
include './show.php';      // ambil data social_media lama
session_start();

// Validasi data social_media
if (!isset($social_media) || !$social_media) {
    echo "<script>
            alert('Data tidak ditemukan');
            window.location.href='../../pages/social_media/index.php';
          </script>";
    exit;
}

// Hapus data dari database
$qDelete = "DELETE FROM social_media WHERE id='$social_media->id'";
$result  = mysqli_query($connect, $qDelete) or die(mysqli_error($connect));

if ($result) {
    // --- Log aktivitas ---
    $user_id = $_SESSION['user_id'] ?? 0;
    $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
    $logDesc = "icon: $social_media->icon, title: $social_media->title, link_url: $social_media->link_url";

    $qLog = "INSERT INTO user_activities 
                (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
             VALUES
                ('$user_id', 'delete', 'social_media', '$social_media->id', '" . mysqli_real_escape_string($connect, $logDesc) . "', '$ip', '$agent', NOW())";
    mysqli_query($connect, $qLog);

    echo "<script>
            alert('Data berhasil dihapus');
            window.location.href='../../pages/social_media/index.php';
          </script>";
} else {
    echo "<script>
            alert('Data gagal dihapus');
            window.location.href='../../pages/social_media/index.php';
          </script>";
}
?>
