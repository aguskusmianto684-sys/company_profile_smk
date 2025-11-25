<?php
include '../../../config/connection.php';
include '../../../config/escapeString.php';
session_start(); // pastikan session aktif

$id = (int) $_GET['id'];

// Ambil data lama
$qSelect = "SELECT * FROM achievements WHERE id='$id'";
$resSelect = mysqli_query($connect, $qSelect);
if (!$resSelect || mysqli_num_rows($resSelect) == 0) {
    die("Data prestasi tidak ditemukan.");
}
$achievement = mysqli_fetch_assoc($resSelect);

// Data dari form
$title = escapeString($_POST['title']);
$description = escapeString($_POST['description']);
$author = escapeString($_POST['author']); 
$date = !empty($_POST['date']) ? escapeString($_POST['date']) : $achievement['date'];

// Default pakai lama
$image = $achievement['image'];

// Kalau ada file image baru
if (!empty($_FILES['image']['name'])) {
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $newFileName = time() . "_achievement." . $ext;
    $imageTmp = $_FILES['image']['tmp_name'];

    // simpan file baru
    if (move_uploaded_file($imageTmp, "../../../storages/achievements/" . $newFileName)) {
        $image = $newFileName;

        // hapus file lama kalau ada
        if (!empty($achievement['image']) && file_exists("../../../storages/achievements/" . $achievement['image'])) {
            unlink("../../../storages/achievements/" . $achievement['image']);
        }
    }
}

// Siapkan deskripsi perubahan
$changes = [];
if ($achievement['title'] != $title) $changes[] = "Judul: '{$achievement['title']}' → '$title'";
if ($achievement['description'] != $description) $changes[] = "Deskripsi: diubah";
if ($achievement['author'] != $author) $changes[] = "Penulis: '{$achievement['author']}' → '$author'";
if ($achievement['date'] != $date) $changes[] = "Tanggal: '{$achievement['date']}' → '$date'";
if ($achievement['image'] != $image) $changes[] = "Gambar: diganti";

$desc = !empty($changes) ? implode(", ", $changes) : "Tidak ada perubahan";

// Update query
$qUpdate = "UPDATE achievements SET 
                title='$title',
                description='$description',
                author='$author',
                date='$date',
                image='$image'
            WHERE id='$id'";

$result = mysqli_query($connect, $qUpdate);

if ($result) {
    // Catat aktivitas user
    $user_id = $_SESSION['user_id'] ?? 0;
    $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

    $qLog = "INSERT INTO user_activities
                (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
             VALUES
                ('$user_id', 'update', 'achievements', '$id', '" . mysqli_real_escape_string($connect, $desc) . "', '$ip', '$agent', NOW())";

    mysqli_query($connect, $qLog);

    echo "<script>
            alert('Data berhasil diedit');
            window.location.href='../../pages/achievements/index.php';
          </script>";
} else {
    echo "<script>
            alert('Data gagal diedit: " . mysqli_error($connect) . "');
            window.location.href='../../pages/achievements/edit.php?id=$id';
          </script>";
}
?>
