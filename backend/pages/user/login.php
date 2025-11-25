<?php
session_start();
if (isset($_SESSION['admin_logged_in'])) {
    // Kalau belum login, redirect ke halaman login
    echo "<script>
        alert('Silakan login terlebih dahulu!');
        window.location.href='../../pages/dashboard/index.php';
    </script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin</title>
    <link rel="stylesheet" href="../../template-admin/template/src/assets/css/styles.min.css">
    <link rel="shortcut icon" href="../../template-admin/template/src/assets/images/profile/user-1.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="text-white d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card shadow" style="width: 400px;">
        <div class="card-body">
            <h4 class="text-center mb-4">Login</h4>
            <form action="../../actions/auth/login_proses.php" method="POST">
                <div class="mb-3">
                    <label for="nameInput" class="form-label">Usernaame</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter username" required />
                    </div>
                </div>

                <div class="mb-3">
                    <label for="passwordInput" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required />
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="bi bi-eye-slash" id="iconEye"></i>
                        </button>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary w-100 mt-3">
                    <i class="bi bi-box-arrow-in-right me-1"></i>Login
                </button>
            </form>
            <!-- <p class="text-center mt-3">Belum punya akun? <a href="register.php"><u>Registerasi di sini</u></a></p> -->
        </div>
    </div>

    <script>
        const toggle = document.getElementById("togglePassword");
        const password = document.getElementById("password");
        const icon = document.getElementById("iconEye");

        toggle.addEventListener("click", () => {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            icon.classList.toggle("bi-eye");
            icon.classList.toggle("bi-eye-slash");
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>