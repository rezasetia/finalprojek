<?php
session_start();
require_once 'koneksi.php';

// Periksa apakah pengguna telah login atau belum
if (!isset($_SESSION['username'])) {
    // Jika belum login, redirect ke halaman login
    header('Location: login.php');
    exit;
}

// Ambil data gambar dari database
$sql = "SELECT * FROM items"; // Misalnya kita ingin menampilkan hanya gambar yang diunggah oleh pengguna yang sedang login
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace</title>
    <link href="./output.css" rel="stylesheet">
</head>
<body class="">
    <div class="">
        <?php
        require_once 'header.php';
        ?>

        <div class="px-12">
            <p class="text-blue font-semibold text-3xl mt-10 mb-4 ml-8 px-8">Katalog Fashion</p>
            <?php
            if ($result->num_rows > 0) {
                echo '<div class="flex flex-wrap -mx-4">'; // Menambahkan class -mx-4 untuk membuat margin negatif agar ada ruang di sisi kiri dan kanan
                // Menampilkan gambar satu per satu
                $count = 0;
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="sm:w-1/4 mb-8 px-20">'; // Mengubah lebar kolom menjadi 1/4 (4 gambar per baris) dan menambahkan padding
                    // Tambahkan tautan ke setiap gambar
                    echo '<a href="detailProduct.php?id=' . $row['id'] . '">';
                    echo '<img src="' . $row['image_path'] . '" alt="' . $row['description'] . '" style="width: 270px;">'; // Mengubah lebar gambar menjadi 100%
                    echo '</a>';
                    echo '<p class="text-gray-700 text-base">Deskripsi: ' . $row['description'] . '</p>';
                    echo '<p class="text-gray-700 text-base">Uploaded by: ' . $row['uploaded_by'] . '</p>';
                    // echo '<p class="text-gray-700 text-base">Kategori: ' . $row['category'] . '</p>';
                    echo '</div>';
                    $count++;
                    if ($count % 4 == 0) { // Menambahkan baris baru setiap 4 gambar
                        echo '</div><div class="flex flex-wrap -mx-4">'; // Menambahkan class -mx-4 untuk membuat margin negatif agar ada ruang di sisi kiri dan kanan
                    }
                }
                echo '</div>';
            } else {
                echo "Tidak ada gambar yang diunggah.";
            }
            ?>
        </div>

        <?php
        $connection->close();
        ?>

        <!-- Item 2 -->

        <!-- You can add more items here -->

        <!-- Logout, View Profile, and Upload Buttons -->

    </div>

    <div class="mt-4">
        <button id="logoutButton" class="fixed bottom-0 right-0 m-4 px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-red active:bg-red-800">
            Logout
        </button>

        <script>
            document.getElementById('logoutButton').addEventListener('click', function() {
                var confirmLogout = confirm('Apakah Anda yakin ingin logout?');

                if (confirmLogout) {
                    // Redirect to the logout.php page
                    window.location.href = 'fungsiLogout.php';
                }
            });
        </script>
    </div>
</body>
</html>
