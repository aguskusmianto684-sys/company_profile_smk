<?php
include '../../../config/connection.php';
include '../../../config/escapeString.php';
session_start(); // pastikan session aktif

$id = (int) $_GET['id'];

// Ambil data lama
$qSelect = "SELECT * FROM abouts WHERE id='$id'";
$resSelect = mysqli_query($connect, $qSelect);
if (!$resSelect || mysqli_num_rows($resSelect) == 0) {
    die("Data tidak ditemukan.");
}
$school = mysqli_fetch_assoc($resSelect);

// Data dari form
$school_name        = escapeString($_POST['school_name']);
$school_tagline     = escapeString($_POST['school_tagline']);
$since              = escapeString($_POST['since']);
$alamat             = escapeString($_POST['alamat']);
$school_description = escapeString($_POST['school_description']);

// Default pakai lama
$school_logo   = $school['school_logo'];
$school_banner = $school['school_banner'];

// Kalau ada file logo baru
if (!empty($_FILES['school_logo']['name'])) {
    $ext = pathinfo($_FILES['school_logo']['name'], PATHINFO_EXTENSION);
    $newFileName = time() . "_logo." . $ext;
    $logoTmp = $_FILES['school_logo']['tmp_name'];
    move_uploaded_file($logoTmp, "../../../storages/about/" . $newFileName);
    $school_logo = $newFileName;
}

// Kalau ada file banner baru
if (!empty($_FILES['school_banner']['name'])) {
    $ext = pathinfo($_FILES['school_banner']['name'], PATHINFO_EXTENSION);
    $newFileName = time() . "_banner." . $ext;
    $bannerTmp = $_FILES['school_banner']['tmp_name'];
    move_uploaded_file($bannerTmp, "../../../storages/about/" . $newFileName);
    $school_banner = $newFileName;
}

// Siapkan deskripsi perubahan
$changes = [];
if ($school['school_name'] != $school_name) $changes[] = "Nama sekolah: '{$school['school_name']}' → '$school_name'";
if ($school['school_tagline'] != $school_tagline) $changes[] = "Tagline: '{$school['school_tagline']}' → '$school_tagline'";
if ($school['since'] != $since) $changes[] = "Sejak: '{$school['since']}' → '$since'";
if ($school['alamat'] != $alamat) $changes[] = "Alamat: '{$school['alamat']}' → '$alamat'";
if ($school['school_description'] != $school_description) $changes[] = "Deskripsi: diubah";
if ($school['school_logo'] != $school_logo) $changes[] = "Logo: diganti";
if ($school['school_banner'] != $school_banner) $changes[] = "Banner: diganti";

$desc = !empty($changes) ? implode(", ", $changes) : "Tidak ada perubahan";

// Update query
$qUpdate = "UPDATE abouts SET 
                school_name='$school_name',
                school_tagline='$school_tagline',
                since='$since',
                alamat='$alamat',
                school_description='$school_description',
                school_logo='$school_logo',
                school_banner='$school_banner'
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
                ('$user_id', 'update', 'abouts', '$id', '" . mysqli_real_escape_string($connect, $desc) . "', '$ip', '$agent', NOW())";

    mysqli_query($connect, $qLog);

    echo "<script>
            alert('Data berhasil diedit');
            window.location.href='../../pages/about/index.php';
          </script>";
} else {
    echo "<script>
            alert('Data gagal diedit: " . mysqli_error($connect) . "');
            window.location.href='../../pages/about/edit.php?id=$id';
          </script>";
}
?>
