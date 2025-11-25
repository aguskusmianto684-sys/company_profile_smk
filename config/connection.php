<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "company_profile";

$connect= mysqli_connect($hostname, $username, $password, $database);

if (!$connect) {
    die("Koneksi gagal: " . mysqli_connect_error());
}


$BASE_URL = "http://localhost/pkl_lauwba/company_profile";
?>