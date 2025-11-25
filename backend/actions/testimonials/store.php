<?php
include '../../../config/connection.php';
include '../../../config/escapeString.php';
session_start();

if (isset($_POST['tombol'])) {
    // Ambil data dari form
    $name    = escapeString($_POST['name']);
    $status  = escapeString($_POST['status']);
    $message = escapeString($_POST['message']);
    $rating  = escapeString($_POST['rating']);

    // Handle upload image
    $imageTmp  = $_FILES['image']['tmp_name'];
    $ext       = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $imageName = time() . "_testimonial." . $ext;

    $storages = "../../../storages/testimonials/";

    // Upload file image
    if (move_uploaded_file($imageTmp, $storages . $imageName)) {
        // Simpan data ke database
        $query = "INSERT INTO testimonials (image, name, rating, status, message) 
                  VALUES ('$imageName', '$name', '$rating', '$status', '$message')";
        mysqli_query($connect, $query) or die(mysqli_error($connect));

        // Ambil ID terakhir untuk log
        $last_id = mysqli_insert_id($connect);

        // --- Log aktivitas user ---
        $user_id = $_SESSION['user_id'] ?? 0;
        $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        $descLog = "Data baru: image='$imageName', name='$name', rating='$rating', status='$status', message='$message'";

        $qLog = "INSERT INTO user_activities 
                    (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
                 VALUES
                    ('$user_id', 'create', 'testimonials', '$last_id', '" . mysqli_real_escape_string($connect, $descLog) . "', '$ip', '$agent', NOW())";
        mysqli_query($connect, $qLog);

        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location.href = '../../pages/testimonials/index.php';
              </script>";
    } else {
        echo "<script>
                alert('Upload gambar gagal');
                window.location.href = '../../pages/testimonials/create.php';
              </script>";
    }
}
?>
