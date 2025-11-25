<?php
// actions/extracurriculars/destroy.php
include '../../app.php';
include './show.php';
session_start();

$storages = "../../../storages/extracurriculars/";

// Track nama/identitas yang dihapus
$recordName = $extracurricular->name;

// Hapus gambar lama jika ada
if (!empty($extracurricular->image) && file_exists($storages . $extracurricular->image)) {
    unlink($storages . $extracurricular->image);
}

// Hapus data dari database
$qDelete = "DELETE FROM extracurriculars WHERE id='$extracurricular->id'";
$result = mysqli_query($connect, $qDelete);

if ($result) {
    // Catat aktivitas user
    $user_id = $_SESSION['user_id'] ?? 0;
    $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
    $desc    = "Menghapus extracurricular: $recordName";

    $qLog = "INSERT INTO user_activities 
                (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
             VALUES
                ('$user_id', 'delete', 'extracurriculars', '{$extracurricular->id}', '" . mysqli_real_escape_string($connect, $desc) . "', '$ip', '$agent', NOW())";
    mysqli_query($connect, $qLog);

    echo "<script>
            alert('Data berhasil dihapus');
            window.location.href='../../pages/extracurriculars/index.php';
          </script>";
} else {
    echo "<script>
            alert('Data gagal dihapus');
            window.location.href='../../pages/extracurriculars/index.php';
          </script>";
}
?>
