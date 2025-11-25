<?php
include '../../../config/connection.php';
include '../../../config/escapeString.php';
session_start(); // pastikan session aktif

if (isset($_POST['tombol'])) {
    // Ambil data dari form
    $majors_name        = escapeString($_POST['majors_name']);
    $head               = escapeString($_POST['head']);
    $majors_description = escapeString($_POST['majors_description']);

    $storages = "../../../storages/majors/";

    // === Upload gambar jurusan ===
    $imageName = null;
    if (!empty($_FILES['majors_image']['name'])) {
        $ext       = pathinfo($_FILES['majors_image']['name'], PATHINFO_EXTENSION);
        $imageName = time() . "_major." . $ext;
        $imageTmp  = $_FILES['majors_image']['tmp_name'];

        // Upload file
        if (!move_uploaded_file($imageTmp, $storages . $imageName)) {
            echo "<script>
                    alert('Upload gambar gagal');
                    window.location.href = '../../pages/majors/create.php';
                  </script>";
            exit;
        }
    }

    // === Insert ke DB ===
    $qInsert = "
        INSERT INTO majors (majors_name, head, majors_description, majors_image) 
        VALUES ('$majors_name', '$head', '$majors_description', '$imageName')
    ";

    if (mysqli_query($connect, $qInsert)) {
        // Ambil ID jurusan yang baru dibuat
        $newId = mysqli_insert_id($connect);

        // === Catat aktivitas user ===
        $user_id = $_SESSION['user_id'] ?? 0;
        $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

        // Ringkas data untuk log
        $descParts = [];
        $descParts[] = "Nama jurusan: '$majors_name'";
        $descParts[] = "Kepala jurusan: '$head'";
        if (!empty($majors_description)) $descParts[] = "Deskripsi: diisi";
        if (!empty($imageName)) $descParts[] = "Gambar: diupload";

        $desc = "Menambah jurusan baru → " . implode(", ", $descParts);

        $qLog = "INSERT INTO user_activities
                    (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
                 VALUES
                    ('$user_id', 'create', 'majors', '$newId', '" . mysqli_real_escape_string($connect, $desc) . "', '$ip', '$agent', NOW())";

        mysqli_query($connect, $qLog);

        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location.href = '../../pages/majors/index.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal ditambahkan: " . mysqli_error($connect) . "');
                window.location.href = '../../pages/majors/create.php';
              </script>";
    }
}
?>
