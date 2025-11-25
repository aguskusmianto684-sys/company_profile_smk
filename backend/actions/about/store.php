<?php
include '../../app.php';
session_start(); // pastikan session aktif

if (isset($_POST['tombol'])) {
    // Ambil data dari form
    $school_name        = escapeString($_POST['school_name']);
    $school_tagline     = escapeString($_POST['school_tagline']);
    $school_description = escapeString($_POST['school_description']);
    $since              = escapeString($_POST['since']);
    $alamat             = escapeString($_POST['alamat']);

    // Handle upload logo
    $logoTmp  = $_FILES['school_logo']['tmp_name'];
    $logoName = time() . "_logo.png";

    // Handle upload banner
    $bannerTmp  = $_FILES['school_banner']['tmp_name'];
    $bannerName = time() . "_banner.png";

    $storages = "../../../storages/about/";

    // Upload file logo & banner
    $uploadLogo   = move_uploaded_file($logoTmp, $storages . $logoName);
    $uploadBanner = move_uploaded_file($bannerTmp, $storages . $bannerName);

    if ($uploadLogo && $uploadBanner) {
        $qInsert = "
            INSERT INTO abouts (school_name, school_logo, school_banner, school_tagline, school_description, since, alamat) 
            VALUES ('$school_name', '$logoName', '$bannerName', '$school_tagline', '$school_description', '$since', '$alamat')
        ";

        if (mysqli_query($connect, $qInsert)) {
            // Ambil ID record baru
            $newId = mysqli_insert_id($connect);

            // Catat aktivitas user
            $user_id = $_SESSION['user_id'] ?? 0;
            $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
            $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

            // Ringkas data untuk log
            $descParts = [];
            $descParts[] = "Nama sekolah: '$school_name'";
            if (!empty($school_tagline)) $descParts[] = "Tagline: diisi";
            if (!empty($school_description)) $descParts[] = "Deskripsi: diisi";
            $descParts[] = "Logo: diupload";
            $descParts[] = "Banner: diupload";

            $desc = "Menambah info sekolah → " . implode(", ", $descParts);

            $qLog = "INSERT INTO user_activities
                        (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
                     VALUES
                        ('$user_id', 'create', 'abouts', '$newId', '" . mysqli_real_escape_string($connect, $desc) . "', '$ip', '$agent', NOW())";

            mysqli_query($connect, $qLog);

            echo "<script>
                    alert('Data berhasil ditambahkan');
                    window.location.href = '../../pages/about/index.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Data gagal ditambahkan: " . mysqli_error($connect) . "');
                    window.location.href = '../../pages/about/create.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Upload logo/banner gagal');
                window.location.href = '../../pages/about/create.php';
              </script>";
    }
}
?>
