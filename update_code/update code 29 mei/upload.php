<?php
session_start();
require_once 'koneksi.php';

// Periksa apakah pengguna telah login atau belum
if (!isset($_SESSION['username'])) {
    // Jika belum login, redirect ke halaman login
    header('Location: login.php');
    exit;
}

// Setel variabel sesi dan kategori untuk pengguna
$username = $_SESSION['username'];
$category = "default"; // Ganti dengan kategori yang sesuai

// Periksa apakah ada file yang diunggah
if (isset($_FILES['image'])) {
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_error = $_FILES['image']['error'];
    $file_size = $_FILES['image']['size'];

    // Tentukan lokasi penyimpanan file yang diunggah
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($file_name);

    // Periksa apakah file yang diunggah adalah gambar
    $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
    if (in_array($file_type, $allowed_types)) {
        // Periksa ukuran file yang diunggah
        if ($file_size <= 5000000) { // Maksimum 5MB
            // Pindahkan file yang diunggah ke folder tujuan
            if (move_uploaded_file($file_tmp, $target_file)) {
                // Jika berhasil diunggah, simpan informasi ke database
                $description = $_POST['description'];
                $query = "INSERT INTO items (image_path, description, category, uploaded_by ) VALUES ('$target_file', '$description', '$category', '$username')";
                if ($connection->query($query) === TRUE) {
                    echo "Gambar berhasil diunggah.";
                } else {
                    echo "Error: " . $query . "<br>" . $connection->error;
                }
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file.";
            }
        } else {
            echo "Maaf, ukuran file terlalu besar. Maksimum 5MB.";
        }
    } else {
        echo "Maaf, hanya file gambar JPEG, PNG, dan GIF yang diizinkan.";
    }
}

$connection->close();
