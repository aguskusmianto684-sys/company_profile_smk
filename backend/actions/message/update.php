<?php
include '../../../config/connection.php';
include '../../../config/escapeString.php';

$id = (int) $_GET['id'];

// Ambil data lama
$qSelect = "SELECT * FROM abouts WHERE id='$id'";
$resSelect = mysqli_query($connect, $qSelect);
$school = mysqli_fetch_object($resSelect);

// Data dari form
$school_name        = escapeString($_POST['school_name']);
$school_tagline     = escapeString($_POST['school_tagline']);
$since              = escapeString($_POST['since']);
$alamat             = escapeString($_POST['alamat']);
$school_description = escapeString($_POST['school_description']);

// Default pakai lama
$school_logo   = $school->school_logo;
$school_banner = $school->school_banner;

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
