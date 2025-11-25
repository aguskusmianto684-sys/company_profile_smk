<?php
// actions/galleries/update.php
include '../../../config/connection.php';
include '../../../config/escapeString.php';
session_start();

$id = (int) $_GET['id'];

// Ambil data lama
$qSelect = "SELECT * FROM galleries WHERE id='$id'";
$resSelect = mysqli_query($connect, $qSelect);
$gallery = mysqli_fetch_object($resSelect);

if (!$gallery) {
    echo "<script>
            alert('Data tidak ditemukan');
            window.location.href='../../pages/galleries/index.php';
          </script>";
    exit;
}

// Data dari form
$description = escapeString($_POST['description']);
$author      = escapeString($_POST['author']);
$date        = !empty($_POST['date']) ? escapeString($_POST['date']) : $gallery->date;

// Default pakai gambar lama
$image = $gallery->image;

// Kalau ada file gambar baru
if (!empty($_FILES['image']['name'])) {
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $newFileName = time() . "_image." . $ext;
    $imageTmp = $_FILES['image']['tmp_name'];

    // Hapus gambar lama jika ada
    $oldPath = "../../../storages/galleries/" . $gallery->image;
    if (!empty($gallery->image) && file_exists($oldPath)) {
        unlink($oldPath);
    }

    move_uploaded_file($imageTmp, "../../../storages/galleries/" . $newFileName);
    $image = $newFileName;
}

// Siapkan deskripsi perubahan untuk log
$changes = [];
if ($gallery->description != $description) $changes[] = "description: '{$gallery->description}' → '$description'";
if ($gallery->author != $author) $changes[] = "author: '{$gallery->author}' → '$author'";
if ($gallery->date != $date) $changes[] = "date: '{$gallery->date}' → '$date'";
if ($gallery->image != $image) $changes[] = "image: '{$gallery->image}' → '$image'";
$descLog = !empty($changes) ? implode(", ", $changes) : "Tidak ada perubahan";

// Update query
$qUpdate = "UPDATE galleries SET 
                image='$image',
                author='$author',
                date='$date',
                description='$description'
            WHERE id='$id'";

$result = mysqli_query($connect, $qUpdate);

if ($result) {
    // --- Log aktivitas user ---
    $user_id = $_SESSION['user_id'] ?? 0;
    $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

    $qLog = "INSERT INTO user_activities 
                (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
             VALUES
                ('$user_id', 'update', 'galleries', '$id', '" . mysqli_real_escape_string($connect, $descLog) . "', '$ip', '$agent', NOW())";
    mysqli_query($connect, $qLog);

    echo "<script>
            alert('Data berhasil diedit');
            window.location.href='../../pages/galleries/index.php';
          </script>";
} else {
    echo "<script>
            alert('Data gagal diedit: " . mysqli_error($connect) . "');
            window.location.href='../../pages/galleries/edit.php?id=$id';
          </script>";
}
?>
