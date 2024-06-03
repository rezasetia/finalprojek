<?php
session_start();
require_once 'koneksi.php';

// Periksa apakah pengguna telah login atau belum
if (!isset($_SESSION['username'])) {
    // Jika belum login, redirect ke halaman login
    header('Location: login.php');
    exit;
}

// Ambil username pengguna yang sedang login
$username = $_SESSION['username'];

// Query untuk mengambil daftar barang yang diunggah oleh pengguna
$query = "SELECT id, username, nama_barang, harga_barang, gambar_barang_1 FROM detail_barang WHERE username LIKE '%$username%'";

$result = $connection->query($query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang Unggahan</title>
    <link href="./output.css" rel="stylesheet">
</head>

<body class="">
    <div class="">


        <div class="px-12">
            <p class="text-blue font-semibold text-3xl mt-10 mb-4 ml-8 px-12">Daftar Barang Unggahan</p>

            <?php
            if ($result->num_rows > 0) {
                echo '<table class="border-collapse border border-gray-400 w-full">';
                echo '<tr class="bg-gray-200">';
                echo '<th class="border border-gray-400 px-4 py-2">ID</th>';
                echo '<th class="border border-gray-400 px-4 py-2">Nama Barang</th>';
                echo '<th class="border border-gray-400 px-4 py-2">Harga</th>';
                echo '<th class="border border-gray-400 px-4 py-2">Gambar</th>';
                echo '</tr>';

                // Tampilkan data barang
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td class="border border-gray-400 px-4 py-2">' . $row['id'] . '</td>';
                    echo '<td class="border border-gray-400 px-4 py-2">' . $row['nama_barang'] . '</td>';
                    echo '<td class="border border-gray-400 px-4 py-2">' . $row['harga_barang'] . '</td>';
                    echo '<td class="border border-gray-400 px-4 py-2"><img src="' . $row['gambar_barang_1'] . '" alt="' . $row['nama_barang'] . '" style="max-width: 100px;"></td>';
                    echo '</tr>';
                }

                echo '</table>';
            } else {
                echo "<p class='text-gray-500'>Belum ada barang yang diunggah.</p>";
            }
            ?>

        </div>

        <div class="mt-4">
            <button id="logoutButton" class="fixed bottom-0 right-0 m-4 px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-red active:bg-red-800">
                Logout
            </button>

            <script>
                document.getElementById('logoutButton').addEventListener('click', function() {
                    var confirmLogout = confirm('Apakah Anda yakin ingin logout?');
                    if (confirmLogout) {
                        window.location.href = 'fungsiLogout.php';
                    }
                });
            </script>
        </div>
    </div>
</body>

</html>
