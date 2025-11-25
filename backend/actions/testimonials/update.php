<?php
include '../../../config/connection.php';
include '../../../config/escapeString.php';
session_start();

$id = (int) $_GET['id'];

// Ambil data lama
$qSelect = "SELECT * FROM testimonials WHERE id='$id'";
$resSelect = mysqli_query($connect, $qSelect);
$testimonial = mysqli_fetch_object($resSelect);

if (!$testimonial) {
    echo "<script>
            alert('Data tidak ditemukan');
            window.location.href='../../pages/testimonials/index.php';
          </script>";
    exit;
}

// Data lama sebelum update
$old_name    = $testimonial->name;
$old_status  = $testimonial->status;
$old_message = $testimonial->message;
$old_rating  = $testimonial->rating;
$old_image   = $testimonial->image;

// Data baru dari form
$new_name    = escapeString($_POST['name']);
$new_status  = escapeString($_POST['status']);
$new_message = escapeString($_POST['message']);
$new_rating  = escapeString($_POST['rating']);
$new_image   = $old_image;

// Kalau ada file image baru
if (!empty($_FILES['image']['name'])) {
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $newFileName = time() . "_testimonial." . $ext;
    $imageTmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($imageTmp, "../../../storages/testimonials/" . $newFileName);
    $new_image = $newFileName;
}

// Update query
$qUpdate = "UPDATE testimonials 
            SET image='$new_image', 
                name='$new_name', 
                rating='$new_rating', 
                status='$new_status', 
                message='$new_message' 
            WHERE id='$id'";
$result = mysqli_query($connect, $qUpdate);

if ($result) {
    // --- Log aktivitas user ---
    $user_id = $_SESSION['user_id'] ?? 0;
    $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

    $descLog = "Sebelum update: name='$old_name', status='$old_status', message='$old_message', rating='$old_rating', image='$old_image'; "
             . "Sesudah update: name='$new_name', status='$new_status', message='$new_message', rating='$new_rating', image='$new_image'";

    $qLog = "INSERT INTO user_activities 
                (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
             VALUES
                ('$user_id', 'update', 'testimonials', '$id', '" . mysqli_real_escape_string($connect, $descLog) . "', '$ip', '$agent', NOW())";
    mysqli_query($connect, $qLog);

    echo "<script>
            alert('Data berhasil diedit');
            window.location.href='../../pages/testimonials/index.php';
          </script>";
} else {
    echo "<script>
            alert('Data gagal diedit: " . mysqli_error($connect) . "');
            window.location.href='../../pages/testimonials/edit.php?id=$id';
          </script>";
}
?>
