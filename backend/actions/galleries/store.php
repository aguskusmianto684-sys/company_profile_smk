<?php
// actions/galleries/store.php
include '../../app.php';
session_start();

if (isset($_POST['tombol'])) {
    // Ambil data dari form
    $description = escapeString($_POST['description']);
    $author      = escapeString($_POST['author']);
    $date        = !empty($_POST['date']) ? escapeString($_POST['date']) : date('Y-m-d');

    // Handle upload gambar
    $imageTmp  = $_FILES['image']['tmp_name'];
    $imageName = time() . "_" . $_FILES['image']['name'];
    
    $storages = "../../../storages/galleries/";

    // Buat folder jika belum ada
    if (!is_dir($storages)) {
        mkdir($storages, 0777, true);
    }

    // Upload file gambar
    $uploadImage = move_uploaded_file($imageTmp, $storages . $imageName);

    if ($uploadImage) {
        $qInsert = "INSERT INTO galleries (image, author, date, description) 
                    VALUES ('$imageName', '$author', '$date', '$description')";
        mysqli_query($connect, $qInsert) or die(mysqli_error($connect));

        // --- Log aktivitas user ---
        $insertedId = mysqli_insert_id($connect);
        $user_id = $_SESSION['user_id'] ?? 0;
        $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        $desc    = "Menambahkan gallery: $description";

        $qLog = "INSERT INTO user_activities 
                    (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
                 VALUES
                    ('$user_id', 'create', 'galleries', '$insertedId', '" . mysqli_real_escape_string($connect, $desc) . "', '$ip', '$agent', NOW())";
        mysqli_query($connect, $qLog);

        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location.href = '../../pages/galleries/index.php';
              </script>";
    } else {
        echo "<script>
                alert('Upload gambar gagal');
                window.location.href = '../../pages/galleries/create.php';
              </script>";
    }
}
?>
