<?php
session_start();
require_once 'koneksi.php';

// Periksa apakah pengguna telah login atau belum
if (!isset($_SESSION['username'])) {
    // Jika belum login, redirect ke halaman login
    header('Location: login.php');
    exit;
}

// Ambil data yang dikirimkan melalui formulir
if (isset($_POST['nbarang'], $_POST['harga'], $_POST['whatsapp'], $_POST['kondisi'], $_POST['deskripsi'])) {
    $username = $_SESSION['username'];
    $nama_barang = $_POST['nbarang'];
    // Hilangkan karakter non-numerik seperti koma atau titik pada harga
    $harga_barang = str_replace(',', '', $_POST['harga']); 
    $nomor_telepon = $_POST['whatsapp'];
    $kondisi = implode(', ', $_POST['kondisi']); // Gabungkan kondisi menjadi satu string
    $deskripsi_barang = $_POST['deskripsi'];

    // Folder penyimpanan gambar
    $upload_directory = "uploads/";

    // Array untuk menyimpan nama file gambar
    $image_paths = [];

    // Proses gambar-gambar yang diunggah
    if (!empty($_FILES['gambar']['name'][0])) {
        $total_files = count($_FILES['gambar']['name']);
        for ($i = 0; $i < $total_files; $i++) {
            $file_name = $_FILES['gambar']['name'][$i];
            $file_tmp = $_FILES['gambar']['tmp_name'][$i];
            $file_type = $_FILES['gambar']['type'][$i];
            $file_error = $_FILES['gambar']['error'][$i];
            $file_size = $_FILES['gambar']['size'][$i];

            // Tentukan lokasi penyimpanan file yang diunggah
            $target_file = $upload_directory . basename($file_name);

            // Pindahkan file yang diunggah ke folder tujuan
            if (move_uploaded_file($file_tmp, $target_file)) {
                $image_paths[] = $target_file; // Simpan lokasi file ke dalam array
            }
        }
    }

    // Query untuk menyimpan data ke dalam tabel detail_barang
    $query = "INSERT INTO detail_barang (username, nama_barang, harga_barang, nomor_telepon, kondisi, deskripsi_barang, gambar_barang_1, gambar_barang_2, gambar_barang_3, gambar_barang_4) 
              VALUES ('$username', '$nama_barang', '$harga_barang', '$nomor_telepon', '$kondisi', '$deskripsi_barang', ";

    // Tambahkan lokasi gambar ke dalam query
    for ($i = 0; $i < 4; $i++) {
        if (isset($image_paths[$i])) {
            $query .= "'{$image_paths[$i]}'";
        } else {
            $query .= "NULL";
        }
        if ($i < 3) {
            $query .= ", "; // Tambahkan koma jika belum gambar terakhir
        }
    }
    $query .= ")";

    // Jalankan query
    if ($connection->query($query) === TRUE) {
        // Jika berhasil, redirect ke halaman dashboard.php
        header('Location: dashboard.php');
        exit; // Pastikan untuk keluar dari skrip setelah melakukan redirect
    } else {
        // Jika terjadi kesalahan, berikan pesan kesalahan
        echo "Error: " . $query . "<br>" . $connection->error;
    }

    // Tutup koneksi database
    $connection->close();
} else {
    echo "Form submission failed. Make sure all required fields are filled.";
}
?>
