<?php
session_start();
include __DIR__ . '/../../../config/connection.php';
include __DIR__ . '/../../../config/escapeString.php';
include __DIR__ . '/../../../config/logActivity.php'; // pastikan fungsi logActivity ada di sini

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = escapeString($_POST['name']);
    $password = $_POST['password'];

    // Query user berdasarkan name
    $qLogin = "SELECT * FROM users WHERE name='$name' LIMIT 1";
    $result = mysqli_query($connect, $qLogin) or die(mysqli_error($connect));

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Simpan informasi login ke session
            $_SESSION['logged_in']  = true;
            $_SESSION['user_id']    = $user['id'];
            $_SESSION['user_name']  = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role']  = $user['role']; // superadmin/admin

            // ✅ Catat aktivitas login pakai fungsi logActivity
            logActivity($connect, $user['id'], 'login', null, null, 'User login ke sistem');

            // Redirect ke dashboard
            header('Location: ../../pages/dashboard/index.php');
            exit();
        } else {
            echo "<script>
                alert('Password salah!');
                window.location.href='../../pages/user/login.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Nama tidak ditemukan!');
            window.location.href='../../pages/user/login.php';
        </script>";
    }
}
