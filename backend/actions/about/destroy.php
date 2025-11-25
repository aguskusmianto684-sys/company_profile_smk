<?php
include '../../app.php';
include './show.php';
session_start(); // pastikan session aktif

$storages = "../../../storages/about/";

// Simpan data lama untuk log
$oldData = [
    'school_name' => $about->school_name,
    'school_tagline' => $about->school_tagline,
    'school_description' => $about->school_description,
    'since' => $about->since,
    'alamat' => $about->alamat,
    'school_logo' => $about->school_logo,
    'school_banner' => $about->school_banner
];

// hapus gambar lama jika ada
if(!empty($about->school_logo) && file_exists($storages . $about->school_logo)) {
    unlink($storages . $about->school_logo);
}
if(!empty($about->school_banner) && file_exists($storages . $about->school_banner)) {
    unlink($storages . $about->school_banner);
}

// hapus data
$qDelete = "DELETE FROM abouts WHERE id='$about->id'";
$result = mysqli_query($connect, $qDelete) or die(mysqli_error($connect));

// Catat aktivitas user jika berhasil dihapus
if($result) {
    $user_id = $_SESSION['user_id'] ?? 0;
    $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

    // Ringkas data untuk log
    $descParts = [];
    $descParts[] = "Nama sekolah: '{$oldData['school_name']}'";
    if(!empty($oldData['school_tagline'])) $descParts[] = "Tagline: ada";
    if(!empty($oldData['school_description'])) $descParts[] = "Deskripsi: ada";
    $descParts[] = "Logo: ada";
    $descParts[] = "Banner: ada";

    $desc = "Menghapus info sekolah → " . implode(", ", $descParts);

    $qLog = "INSERT INTO user_activities
                (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
             VALUES
                ('$user_id', 'delete', 'abouts', '{$about->id}', '" . mysqli_real_escape_string($connect, $desc) . "', '$ip', '$agent', NOW())";

    mysqli_query($connect, $qLog);

    echo "<script>
    alert('Data berhasil dihapus');
    window.location.href = '../../pages/about/index.php';
    </script>";
} else {
    echo "<script>
    alert('Data gagal dihapus');
    window.location.href = '../../pages/about/index.php';
    </script>";
}
?>
