<?php
session_start();
include '../../../config/connection.php';

$id = $_GET['id'];
$user = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM users WHERE id='$id'"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Detail User</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">

<h2>Detail User</h2>

<ul class="list-group">
  <li class="list-group-item"><strong>ID:</strong> <?= $user['id'] ?></li>
  <li class="list-group-item"><strong>Nama:</strong> <?= $user['name'] ?></li>
  <li class="list-group-item"><strong>Email:</strong> <?= $user['email'] ?></li>
  <li class="list-group-item"><strong>Role:</strong> <?= $user['role'] ?></li>
</ul>

<a href="index.php" class="btn btn-secondary mt-3">Kembali</a>

</body>
</html>
