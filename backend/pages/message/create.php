<?php
// File ini biasanya berada di folder frontend, bukan admin
// Contoh: /frontend/contact.php
$page = "message"; // Menandai halaman aktif di sidebar

include '../config/connection.php';  // Koneksi database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil dan membersihkan data dari form
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $subjek = mysqli_real_escape_string($connect, $_POST['subjek']);
    $no_telepon = mysqli_real_escape_string($connect, $_POST['no_telepon']);
    $message = mysqli_real_escape_string($connect, $_POST['message']);

    // Query untuk menyimpan data ke database
    $qInsert = "INSERT INTO message (name, email, subjek, no_telepon, message) VALUES ('$name', '$email', '$subjek', '$no_telepon', '$message')";
    $result = mysqli_query($connect, $qInsert);

    if ($result) {
        echo "<script>alert('Pesan berhasil dikirim'); window.location.href = 'message.php';</script>";
    } else {
        echo "<script>alert('Pesan gagal dikirim'); window.location.href = 'message.php';</script>";
    }
}
?>

<!-- Form HTML untuk pengunjung website -->
<form method="POST" action="">
    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control" name="name" id="name" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" required>
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">Pesan</label>
        <textarea class="form-control" name="message" id="message" rows="5" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary" name="tombol">Kirim Pesan</button>
</form>