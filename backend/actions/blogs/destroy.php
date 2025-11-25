<?php
include '../../../config/connection.php';
include './show.php';
session_start();

$storages = "../../../storages/blogs/";

// Hapus gambar lama jika ada
if(!empty($blog->image) && file_exists($storages . $blog->image)) {
    unlink($storages . $blog->image);
}

// Hapus data
$qDelete = "DELETE FROM blogs WHERE id='$blog->id'";
$result = mysqli_query($connect, $qDelete) or die(mysqli_error($connect));

if($result) {
    // Catat aktivitas user
    $user_id = $_SESSION['user_id'] ?? 0;
    $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
    $desc    = "Blog dengan ID {$blog->id} dan title '{$blog->title}' dihapus";

    $qLog = "INSERT INTO user_activities 
                (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
             VALUES
                ('$user_id', 'delete', 'blogs', '{$blog->id}', '" . mysqli_real_escape_string($connect, $desc) . "', '$ip', '$agent', NOW())";
    mysqli_query($connect, $qLog);

    echo "<script>
        alert('Data berhasil dihapus');
        window.location.href = '../../pages/blog/index.php';
    </script>";
} else {
    echo "<script>
        alert('Data gagal dihapus');
        window.location.href = '../../pages/blog/index.php';
    </script>";
}
?>
