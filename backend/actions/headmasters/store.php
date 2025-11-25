<?php
include '../../../config/connection.php';
include '../../../config/escapeString.php';
session_start();

if (isset($_POST['tombol'])) {
    // Ambil data dari form
    $headmaster_name        = escapeString($_POST['headmaster_name']);
    $headmaster_description = escapeString($_POST['headmaster_description']);

    // Handle upload photo
    $photoTmp = $_FILES['headmaster_photo']['tmp_name'];
    $ext      = pathinfo($_FILES['headmaster_photo']['name'], PATHINFO_EXTENSION);
    $photoName = time() . "_headmaster." . $ext;

    $storages = "../../../storages/headmasters/";

    // Upload file photo
    $uploadPhoto = move_uploaded_file($photoTmp, $storages . $photoName);

    if ($uploadPhoto) {
        $qInsert = "
            INSERT INTO headmasters (headmaster_name, headmaster_description, headmaster_photo) 
            VALUES ('$headmaster_name', '$headmaster_description', '$photoName')
        ";

        mysqli_query($connect, $qInsert) or die(mysqli_error($connect));

        // --- Log aktivitas user ---
        $user_id = $_SESSION['user_id'] ?? 0;
        $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        $last_id = mysqli_insert_id($connect);
        $logDesc = "headmaster_name: $headmaster_name, headmaster_description: $headmaster_description, headmaster_photo: $photoName";

        $qLog = "INSERT INTO user_activities 
                    (user_id, activity, table_name, record_id, description, ip_address, user_agent, created_at)
                 VALUES
                    ('$user_id', 'create', 'headmasters', '$last_id', '" . mysqli_real_escape_string($connect, $logDesc) . "', '$ip', '$agent', NOW())";
        mysqli_query($connect, $qLog);

        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location.href = '../../pages/headmasters/index.php';
              </script>";
    } else {
        echo "<script>
                alert('Upload foto gagal');
                window.location.href = '../../pages/headmasters/create.php';
              </script>";
    }
}
?>
