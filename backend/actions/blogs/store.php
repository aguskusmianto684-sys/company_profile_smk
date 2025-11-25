<?php
include '../../../config/connection.php';
include '../../../config/escapeString.php';
session_start(); // pastikan session aktif

if (isset($_POST['tombol'])) {
    // Ambil data dari form
    $title   = escapeString($_POST['title']);
    $date    = escapeString($_POST['date']);
    $author  = escapeString($_POST['author']);
    $content = escapeString($_POST['content']);

    // Validasi format tanggal (YYYY-MM-DD)
    if (!DateTime::createFromFormat('Y-m-d', $date)) {
        echo "<script>
                alert('Format tanggal tidak valid! Gunakan YYYY-MM-DD');
                window.location.href = '../../pages/blog/create.php';
              </script>";
        exit;
    }

    // Handle upload image
    $imageTmp = $_FILES['image']['tmp_name'];
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . "_blog." . $ext;
        $storages = "../../../storages/blogs/";

        if (!is_dir($storages)) {
            mkdir($storages, 0777, true);
        }

        $uploadImage = move_uploaded_file($imageTmp, $storages . $imageName);

        if (!$uploadImage) {
            echo "<script>
                    alert('Upload gambar gagal!');
                    window.location.href = '../../pages/blog/create.php';
                  </script>";
            exit;
        }
    } else {
        $imageName = "default.png"; // default jika tidak upload gambar
    }

    // Insert data
    $qInsert = "
        INSERT INTO blogs (title, date, author, content, image) 
        VALUES ('$title', '$date', '$author', '$content', '$imageName')
    ";

    if (mysqli_query($connect, $qInsert)) {
        // Catat aktivitas user
        $user_id = $_SESSION['user_id'] ?? 0;
        $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        $blog_id = mysqli_insert_id($connect); // ambil ID terakhir

        $desc = "Menambahkan blog baru: '$title' oleh '$author' pada tanggal '$date'";

        $qLog = "INSERT INTO user_activities 
                    (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at) 
                 VALUES
                    ('$user_id', 'create', 'blogs', '$blog_id', '" . mysqli_real_escape_string($connect, $desc) . "', '$ip', '$agent', NOW())";
        mysqli_query($connect, $qLog);

        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location.href = '../../pages/blog/index.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan data: " . mysqli_error($connect) . "');
                window.location.href = '../../pages/blog/create.php';
              </script>";
    }
}
?>
