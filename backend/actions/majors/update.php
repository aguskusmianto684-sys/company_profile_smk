<?php
include '../../../config/connection.php';
include '../../../config/escapeString.php';
session_start();

$id = (int) $_GET['id'];

// Ambil data lama
$qSelect = "SELECT * FROM majors WHERE id='$id'";
$resSelect = mysqli_query($connect, $qSelect);
if (!$resSelect || mysqli_num_rows($resSelect) == 0) {
    die("Data jurusan tidak ditemukan.");
}
$major = mysqli_fetch_assoc($resSelect); // pakai array supaya gampang

// Data dari form
$majors_name = escapeString($_POST['majors_name']);
$head = escapeString($_POST['head']);
$majors_description = escapeString($_POST['majors_description']);

// Default pakai lama
$majors_image = $major['majors_image'];

// Kalau ada file image baru
if (!empty($_FILES['majors_image']['name'])) {
    $ext = pathinfo($_FILES['majors_image']['name'], PATHINFO_EXTENSION);
    $newFileName = time() . "_major." . $ext;
    $imageTmp = $_FILES['majors_image']['tmp_name'];
    move_uploaded_file($imageTmp, "../../../storages/majors/" . $newFileName);
    $majors_image = $newFileName;
}

// Siapkan deskripsi perubahan
$changes = [];
if ($major['majors_name'] != $majors_name) $changes[] = "majors_name: '{$major['majors_name']}' → '$majors_name'";
if ($major['head'] != $head) $changes[] = "head: '{$major['head']}' → '$head'";
if ($major['majors_description'] != $majors_description) $changes[] = "majors_description: '{$major['majors_description']}' → '$majors_description'";
if ($major['majors_image'] != $majors_image) $changes[] = "majors_image: '{$major['majors_image']}' → '$majors_image'";
$desc = !empty($changes) ? implode(", ", $changes) : "Tidak ada perubahan";

// Mulai transaksi
mysqli_begin_transaction($connect);

try {
    // Update query
    $qUpdate = "UPDATE majors SET 
                    majors_name='" . mysqli_real_escape_string($connect, $majors_name) . "',
                    head='" . mysqli_real_escape_string($connect, $head) . "',
                    majors_description='" . mysqli_real_escape_string($connect, $majors_description) . "',
                    majors_image='" . mysqli_real_escape_string($connect, $majors_image) . "'
                WHERE id='$id'";
    mysqli_query($connect, $qUpdate);

    // Catat aktivitas user
    $user_id = $_SESSION['user_id'] ?? 0;
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $agent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

    $qLog = "INSERT INTO user_activities 
                (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at) 
             VALUES 
                ('$user_id', 'update', 'majors', '$id', '" . mysqli_real_escape_string($connect, $desc) . "', '$ip', '$agent', NOW())";
    mysqli_query($connect, $qLog);

    mysqli_commit($connect);

    echo "<script>
            alert('Data berhasil diedit');
            window.location.href='../../pages/majors/index.php';
          </script>";
} catch (Exception $e) {
    mysqli_rollback($connect);
    echo "<script>
            alert('Terjadi kesalahan: " . $e->getMessage() . "');
            window.location.href='../../pages/majors/edit.php?id=$id';
          </script>";
}
