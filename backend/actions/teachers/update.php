<?php
include '../../../config/connection.php';
include '../../../config/escapeString.php';
session_start();

$id = (int) $_GET['id'];

// Ambil data lama
$qSelect = "SELECT * FROM teachers WHERE id='$id'";
$resSelect = mysqli_query($connect, $qSelect);
$teacher = mysqli_fetch_object($resSelect);

if (!$teacher) {
    echo "<script>
            alert('Data tidak ditemukan');
            window.location.href='../../pages/teachers/index.php';
          </script>";
    exit;
}

// Ambil data baru dari form
$new_name  = escapeString($_POST['teachers_name']);
$new_jk    = escapeString($_POST['jk']);
$new_major = escapeString($_POST['teachers_major']);
$new_photo = $teacher->teachers_photo; // default pakai lama

// Kalau ada file photo baru
if (!empty($_FILES['teachers_photo']['name'])) {
    $ext = pathinfo($_FILES['teachers_photo']['name'], PATHINFO_EXTENSION);
    $newFileName = time() . "_teacher." . $ext;
    $photoTmp = $_FILES['teachers_photo']['tmp_name'];

    // Hapus photo lama jika ada
    $oldPath = "../../../storages/teachers/" . $teacher->teachers_photo;
    if (!empty($teacher->teachers_photo) && file_exists($oldPath)) {
        unlink($oldPath);
    }

    move_uploaded_file($photoTmp, "../../../storages/teachers/" . $newFileName);
    $new_photo = $newFileName;
}

// Cek perubahan untuk log
$changes = [];
if ($teacher->teachers_name != $new_name) $changes[] = "teachers_name: '{$teacher->teachers_name}' → '$new_name'";
if ($teacher->jk != $new_jk)             $changes[] = "jk: '{$teacher->jk}' → '$new_jk'";
if ($teacher->teachers_major != $new_major) $changes[] = "teachers_major: '{$teacher->teachers_major}' → '$new_major'";
if ($teacher->teachers_photo != $new_photo) $changes[] = "teachers_photo: '{$teacher->teachers_photo}' → '$new_photo'";
$descLog = !empty($changes) ? implode("; ", $changes) : "Tidak ada perubahan";

// Update query
$qUpdate = "UPDATE teachers SET 
                teachers_name='$new_name',
                jk='$new_jk',
                teachers_major='$new_major',
                teachers_photo='$new_photo'
            WHERE id='$id'";
$result = mysqli_query($connect, $qUpdate);

if ($result) {
    // --- Log aktivitas user hanya jika ada perubahan ---
    if (!empty($changes)) {
        $user_id = $_SESSION['user_id'] ?? 0;
        $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

        $qLog = "INSERT INTO user_activities 
                    (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
                 VALUES
                    ('$user_id', 'update', 'teachers', '$id', '" . mysqli_real_escape_string($connect, $descLog) . "', '$ip', '$agent', NOW())";
        mysqli_query($connect, $qLog);
    }

    echo "<script>
            alert('Data berhasil diedit');
            window.location.href='../../pages/teachers/index.php';
          </script>";
} else {
    echo "<script>
            alert('Data gagal diedit: " . mysqli_error($connect) . "');
            window.location.href='../../pages/teachers/edit.php?id=$id';
          </script>";
}
?>
