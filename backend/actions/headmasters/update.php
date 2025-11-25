<?php
include '../../../config/connection.php';
include '../../../config/escapeString.php';
session_start();

$id = (int) $_GET['id'];

// Ambil data lama
$qSelect = "SELECT * FROM headmasters WHERE id='$id'";
$resSelect = mysqli_query($connect, $qSelect);
$headmaster = mysqli_fetch_object($resSelect);

if (!$headmaster) {
    echo "<script>
            alert('Data tidak ditemukan');
            window.location.href='../../pages/headmasters/index.php';
          </script>";
    exit;
}

// Ambil data baru dari form
$new_name        = escapeString($_POST['headmaster_name']);
$new_description = escapeString($_POST['headmaster_description']);
$new_photo       = $headmaster->headmaster_photo; // default pakai lama

// Kalau ada file photo baru
if (!empty($_FILES['headmaster_photo']['name'])) {
    $ext = pathinfo($_FILES['headmaster_photo']['name'], PATHINFO_EXTENSION);
    $newFileName = time() . "_headmaster." . $ext;
    $photoTmp = $_FILES['headmaster_photo']['tmp_name'];

    // Hapus file lama jika ada
    $oldPath = "../../../storages/headmasters/" . $headmaster->headmaster_photo;
    if (!empty($headmaster->headmaster_photo) && file_exists($oldPath)) {
        unlink($oldPath);
    }

    move_uploaded_file($photoTmp, "../../../storages/headmasters/" . $newFileName);
    $new_photo = $newFileName;
}

// --- Cek field yang berubah untuk log ---
$changes = [];
if ($headmaster->headmaster_name !== $new_name) {
    $changes[] = "headmaster_name: '{$headmaster->headmaster_name}' → '$new_name'";
}
if ($headmaster->headmaster_description !== $new_description) {
    $changes[] = "headmaster_description: '{$headmaster->headmaster_description}' → '$new_description'";
}
if ($headmaster->headmaster_photo !== $new_photo) {
    $changes[] = "headmaster_photo: '{$headmaster->headmaster_photo}' → '$new_photo'";
}

// Update query
$qUpdate = "UPDATE headmasters SET 
                headmaster_name='$new_name',
                headmaster_description='$new_description',
                headmaster_photo='$new_photo'
            WHERE id='$id'";
$result = mysqli_query($connect, $qUpdate);

if ($result) {
    // --- Log aktivitas hanya jika ada perubahan ---
    if (!empty($changes)) {
        $user_id = $_SESSION['user_id'] ?? 0;
        $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        $logDesc = implode("; ", $changes);

        $qLog = "INSERT INTO user_activities 
                    (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
                 VALUES
                    ('$user_id', 'update', 'headmasters', '$id', '" . mysqli_real_escape_string($connect, $logDesc) . "', '$ip', '$agent', NOW())";
        mysqli_query($connect, $qLog);
    }

    echo "<script>
            alert('Data berhasil diedit');
            window.location.href='../../pages/headmasters/index.php';
          </script>";
} else {
    echo "<script>
            alert('Data gagal diedit: " . mysqli_error($connect) . "');
            window.location.href='../../pages/headmasters/edit.php?id=$id';
          </script>";
}
?>
