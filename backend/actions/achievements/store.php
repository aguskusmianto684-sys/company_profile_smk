<?php
include '../../../config/connection.php';
include '../../../config/escapeString.php';
session_start(); // pastikan session aktif

if (isset($_POST['tombol'])) {
    // Ambil data dari form
    $title = escapeString($_POST['title']);
    $description = escapeString($_POST['description']);
    $author = escapeString($_POST['author']); // tambahan
    $date = date('Y-m-d'); // otomatis pakai tanggal hari ini

    // Handle upload image
    $imageTmp = $_FILES['image']['tmp_name'];
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $imageName = time() . "_achievement." . $ext;

    $storages = "../../../storages/achievements/";

    // Upload file image
    $uploadImage = move_uploaded_file($imageTmp, $storages . $imageName);

    if ($uploadImage) {
        $qInsert = "
            INSERT INTO achievements (author, date, title, description, image) 
            VALUES ('$author', '$date', '$title', '$description', '$imageName')
        ";

        if (mysqli_query($connect, $qInsert)) {
            // Ambil ID record baru
            $newId = mysqli_insert_id($connect);

            // Catat aktivitas user
            $user_id = $_SESSION['user_id'] ?? 0;
            $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
            $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

            $descParts = [];
            $descParts[] = "Judul: '$title'";
            $descParts[] = "Penulis: '$author'";
            $descParts[] = "Tanggal: '$date'";
            $descParts[] = "Gambar: diupload";

            $desc = "Menambah prestasi → " . implode(", ", $descParts);

            $qLog = "INSERT INTO user_activities
                        (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
                     VALUES
                        ('$user_id', 'create', 'achievements', '$newId', '" . mysqli_real_escape_string($connect, $desc) . "', '$ip', '$agent', NOW())";

            mysqli_query($connect, $qLog);

            echo "<script>
                    alert('Data berhasil ditambahkan');
                    window.location.href = '../../pages/achievements/index.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Data gagal ditambahkan: " . mysqli_error($connect) . "');
                    window.location.href = '../../pages/achievements/create.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Upload gambar gagal');
                window.location.href = '../../pages/achievements/create.php';
              </script>";
    }
}
?>
