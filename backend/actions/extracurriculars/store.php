<?php
// actions/extracurriculars/store.php
include '../../app.php';
include '../../../config/escapeString.php';
session_start(); // pastikan session aktif

if (isset($_POST['tombol'])) {
    // Ambil data dari form
    $name        = escapeString($_POST['name']);
    $description = escapeString($_POST['description']);
    $coach       = escapeString($_POST['coach']);

    // Setup folder penyimpanan
    $storages = "../../../storages/extracurriculars/";
    if (!is_dir($storages)) {
        mkdir($storages, 0777, true);
    }

    // Default gambar
    $imageName = null;

    // Jika ada upload gambar
    if (!empty($_FILES['image']['name'])) {
        $imageTmp  = $_FILES['image']['tmp_name'];
        $original  = basename($_FILES['image']['name']);
        $ext       = strtolower(pathinfo($original, PATHINFO_EXTENSION));

        // Validasi ekstensi
        $allowedExt = ['jpg','jpeg','png','gif','webp'];
        if (!in_array($ext, $allowedExt)) {
            echo "<script>
                    alert('Format gambar tidak didukung! (hanya jpg, jpeg, png, gif, webp)');
                    window.location.href='../../pages/extracurriculars/create.php';
                  </script>";
            exit;
        }

        // Bikin nama unik
        $imageName = time() . "_" . preg_replace("/[^a-zA-Z0-9.]/", "_", $original);

        // Upload file
        if (!move_uploaded_file($imageTmp, $storages . $imageName)) {
            echo "<script>
                    alert('Upload gambar gagal!');
                    window.location.href='../../pages/extracurriculars/create.php';
                  </script>";
            exit;
        }
    }

    // Insert ke database
    $qInsert = "INSERT INTO extracurriculars (name, description, coach, image) 
                VALUES ('$name', '$description', '$coach', '$imageName')";
    $insert  = mysqli_query($connect, $qInsert);

    if ($insert) {
        // Ambil id yang baru saja ditambahkan
        $last_id = mysqli_insert_id($connect);

        // Catat aktivitas user
        $user_id = $_SESSION['user_id'] ?? 0;
        $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        $desc    = "Menambahkan ekstrakurikuler: '$name' dengan pelatih '$coach'";

        $qLog = "INSERT INTO user_activities 
                    (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
                 VALUES
                    ('$user_id', 'create', 'extracurriculars', '$last_id', '" . mysqli_real_escape_string($connect, $desc) . "', '$ip', '$agent', NOW())";
        mysqli_query($connect, $qLog);

        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location.href='../../pages/extracurriculars/index.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menyimpan ke database');
                window.location.href='../../pages/extracurriculars/create.php';
              </script>";
    }
}
?>
