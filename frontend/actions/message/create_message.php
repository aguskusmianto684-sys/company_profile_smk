<?php
include '../../../config/connection.php';
include '../../../config/escapeString.php';

if (isset($_POST['submit'])) {
    $name = escapeString(text: $_POST['name']);
    $email = escapeString(text: $_POST['email']);
    $subjek = escapeString(text: $_POST['subjek']);
    $telepon = escapeString(text: $_POST['telepon']);
    $message = escapeString(text: $_POST['message']);


    $qInsert = "INSERT INTO message(name, email, subjek, telepon, message) VALUES('$name', '$email', '$subjek', '$telepon', '$message')";

    if (mysqli_query( $connect,  $qInsert)) {
        echo "
        <script>alert('Pesan berhasil dikirim');
         window.location.href = '../../index.php#message';
         </script>
         ";
    }else{
        echo "
        <script>alert('Pesan gagal dikirim'): " . mysqli_error($connect) . "');
         window.location.href = '../../index.php#message';
         </script>
         ";
    }
}
?>