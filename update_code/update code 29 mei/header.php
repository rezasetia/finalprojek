<?php
// Mulai sesi
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Tindakan jika pengguna belum login, misalnya, arahkan pengguna ke halaman login
    header("Location: login.php");
    exit; // Pastikan untuk keluar setelah mengarahkan pengguna
}

// Koneksi ke database
// $host = 'localhost';
// $db = 'market1';
// $user = 'root';
// $pass = '';
// $connection = new mysqli($host, $user, $pass, $db);

require_once 'koneksi.php'; // Mengimpor file koneksi.php yang berisi informasi tentang koneksi ke database


if ($connection->connect_error) {
    die("Koneksi ke database gagal: " . $connection->connect_error);
}

// Ambil informasi pengguna dari database berdasarkan username yang disimpan di session
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $connection->query($sql);

// Tentukan foto profil default
$default_profile_picture = 'assets/img/new/Pro max pfp.jpg';

// Periksa apakah data pengguna ditemukan
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Periksa apakah ada foto profil dalam database
    if (!empty($row['profile_picture']) && file_exists($row['profile_picture'])) {
        $profile_picture = $row['profile_picture'];
    } else {
        // Jika tidak ada foto profil atau foto profil tidak valid, gunakan foto profil default
        $profile_picture = $default_profile_picture;
    }
} else {
    // Jika data pengguna tidak ditemukan, gunakan foto profil default
    $profile_picture = $default_profile_picture;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T6</title>
    <!-- <link rel="stylesheet" href="assets/app.css" /> -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/your-embed-code.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<body>
    <header>
        <nav class="navbar bg-white fixed w-full z-50 top-0 start-0 transition-all duration-500">
            <div class="flex max-w-screen-xl flex-wrap items-center justify-between mx-auto p-4">
                <div class="flex items-center space-x-3 rtl:space-x-reverse text-2xl font-semibold">
                    <a href="dashboard.php" class="flex items-center space-x-3 rtl:space-x-reverse text-2xl font-semibold">
                        <img src="assets/img/new/logo.png" class="md:h-16 h-5" alt="Flowbite Logo" style="height: 64px; width: 64px;" />6SECOND
                    </a>
                </div>
                <div class="flex md:order-2 space-x-3 rtl:space-x-reverse">
                    <div>
                        <button
                            data-collapse-toggle="navbar-sticky"
                            type="button"
                            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400"
                            aria-controls="navbar-sticky"
                            aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="flex items-center rtl:space-x-reverse gap-7 md:order-2">
                    <a href="tampilan_form_product.php" class="bg-sky-300 hover:bg-sky-600 py-2 px-7 text-white rounded-lg"> Jual Sekarang </a>
                    
                    <!-- nontifikasi -->
                    <a href="tampil_notifikasi.php" class="text-black hover:text-sky-300 rounded-full focus:outline-none">
                        <i class="fa-solid fa-bell text-2xl"></i>
                    </a>

                    <!-- favorite -->
                    <a href="favorite_product.php" class="text-black hover:text-red-600 rounded-full focus:outline-none relative group">
                        <i class="fa-solid fa-heart text-2xl"></i>
                    </a>

                    <div class="relative">
                        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white focus:outline-none font-medium rounded-lg text-sm py-2.5 text-center inline-flex items-center" type="button">
                            <img src="<?php echo $profile_picture; ?>" alt="Account" class="w-8 h-8 mr-2 rounded-full" />
                            <svg class="w-2.5 h-2.5 ml-1 text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                            <ul class="py-1 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                                <li>
                                    <a href="halamanProfile.php" class="block py-2 px-4 hover:bg-gray-100">Profile</a>
                                </li>
                                <li>
                                    <a href="#" class="block py-2 px-4 hover:bg-gray-100">Settings</a>
                                </li>
                                <li>
                                    <a href="#" id="logoutButton" class="block py-2 px-4 hover:bg-gray-100 hover:text-red-700 text-red-600">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- nav script -->
    <script src="assets/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>


    <!-- log out -->
    <script>
        document.getElementById('logoutButton').addEventListener('click', function () {
            var confirmLogout = confirm('Apakah Anda yakin ingin logout?');
            if (confirmLogout) {
                window.location.href = 'fungsiLogout.php';
            }
        });
    </script>
</body>
</html>
