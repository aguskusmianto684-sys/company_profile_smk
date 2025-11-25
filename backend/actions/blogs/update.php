<?php
include '../../../config/connection.php';
include '../../../config/escapeString.php';
session_start();

$id = (int) $_GET['id'];

// Ambil data lama
$qSelect = "SELECT * FROM blogs WHERE id='$id'";
$resSelect = mysqli_query($connect, $qSelect);
$blog = mysqli_fetch_assoc($resSelect); // pakai array supaya mudah

// Data dari form
$title   = escapeString($_POST['title']);
$date    = escapeString($_POST['date']);
$author  = escapeString($_POST['author']);
$content = escapeString($_POST['content']);

// Default pakai gambar lama
$image = $blog['image'];

// Kalau ada file image baru
if (!empty($_FILES['image']['name'])) {
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $newFileName = time() . "_blog." . $ext;
    $imageTmp = $_FILES['image']['tmp_name'];

    $storages = "../../../storages/blogs/";
    if (!is_dir($storages)) mkdir($storages, 0777, true);

    if (move_uploaded_file($imageTmp, $storages . $newFileName)) {
        // Hapus file lama
        if (!empty($blog['image']) && file_exists($storages . $blog['image'])) {
            unlink($storages . $blog['image']);
        }
        $image = $newFileName;
    }
}

// Siapkan deskripsi perubahan
$changes = [];
if ($blog['title'] != $title)   $changes[] = "title: '{$blog['title']}' → '$title'";
if ($blog['date'] != $date)     $changes[] = "date: '{$blog['date']}' → '$date'";
if ($blog['author'] != $author) $changes[] = "author: '{$blog['author']}' → '$author'";
if ($blog['content'] != $content) $changes[] = "content diubah";
if ($blog['image'] != $image)   $changes[] = "image diganti";

$desc = !empty($changes) ? implode(", ", $changes) : "Tidak ada perubahan";

// Update query
$qUpdate = "UPDATE blogs SET 
                title='" . mysqli_real_escape_string($connect, $title) . "',
                date='" . mysqli_real_escape_string($connect, $date) . "',
                author='" . mysqli_real_escape_string($connect, $author) . "',
                content='" . mysqli_real_escape_string($connect, $content) . "',
                image='" . mysqli_real_escape_string($connect, $image) . "'
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
                ('$user_id', 'update', 'blogs', '$id', '" . mysqli_real_escape_string($connect, $desc) . "', '$ip', '$agent', NOW())";
    mysqli_query($connect, $qLog);

    echo "<script>
            alert('Data berhasil diedit');
            window.location.href='../../pages/blog/index.php';
          </script>";
} else {
    echo "<script>
            alert('Data gagal diedit: " . mysqli_error($connect) . "');
            window.location.href='../../pages/blog/edit.php?id=$id';
          </script>";
}
?>
