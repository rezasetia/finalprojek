<?php
$host = 'localhost';
$db = 'market2';
$user = 'market2';
$pass = 'market2pass';

$connection = new mysqli($host, $user, $pass, $db);

if ($connection->connect_error) {
    die("Koneksi ke database gagal: " . $connection->connect_error);
}
