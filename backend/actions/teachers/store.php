<?php
include '../../../config/connection.php';
include '../../../config/escapeString.php';
session_start(); // untuk ambil user_id

if (isset($_POST['tombol'])) {
    // Ambil data dari form
    $teachers_name  = escapeString($_POST['teachers_name']);
    $jk             = escapeString($_POST['jk']);
    $teachers_major = escapeString($_POST['teachers_major']);

    // Handle upload photo
    $photoTmp = $_FILES['teachers_photo']['tmp_name'];
    $ext      = pathinfo($_FILES['teachers_photo']['name'], PATHINFO_EXTENSION);
    $photoName = time() . "_teacher." . $ext;

    $storages = "../../../storages/teachers/";

    // Upload file photo
    $uploadPhoto = move_uploaded_file($photoTmp, $storages . $photoName);

    if ($uploadPhoto) {
        $qInsert = "
            INSERT INTO teachers (teachers_name, jk, teachers_major, teachers_photo) 
            VALUES ('$teachers_name', '$jk', '$teachers_major', '$photoName')
        ";
        mysqli_query($connect, $qInsert) or die(mysqli_error($connect));

        // --- Log aktivitas ---
        $user_id = $_SESSION['user_id'] ?? 0;
        $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        $descLog = "teachers_name='$teachers_name', jk='$jk', teachers_major='$teachers_major', teachers_photo='$photoName'";

        $qLog = "INSERT INTO user_activities 
                    (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
                 VALUES
                    ('$user_id', 'create', 'teachers', LAST_INSERT_ID(), '" . mysqli_real_escape_string($connect, $descLog) . "', '$ip', '$agent', NOW())";
        mysqli_query($connect, $qLog);

        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location.href = '../../pages/teachers/index.php';
              </script>";
    } else {
        echo "<script>
                alert('Upload foto gagal');
                window.location.href = '../../pages/teachers/create.php';
              </script>";
    }
}
?>
