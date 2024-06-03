<?php
// Mulai sesi
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Tindakan jika pengguna belum login, misalnya, arahkan pengguna ke halaman login
    header("Location: login.php");
    exit; // Pastikan untuk keluar setelah mengarahkan pengguna
}

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
                    <!-- awal form search -->
                    <form method="GET" action="hasilpencarian.php" class="relative flex items-center">
                        <div class="flex ml-2">
                            <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only">Your Email</label>
                            <button id="dropdown-button2" data-dropdown-toggle="dropdown2" class="flex-shrink-0 z-10 inline-flex items-center font-normal py-2.5 px-4 text-base text-center text-gray-400 bg-white border border-gray-300 rounded-s-lg hover:bg-sky-400 hover:text-white" type="button">
                                Kategori
                                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <div id="dropdown2" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdown-button2">
                                    <li>
                                        <a href="Fashion.php"><button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Fashion</button>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="elektronik.php"> <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Elekronik</button></a>

                                    </li>
                                    <li>
                                        <a href="prabot.php"><button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Perabot</button></a>

                                    </li>
                                    <li>
                                        <a href="otomotif.php"> <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Otomotif</button></a>

                                    </li>
                                </ul>
                            </div>
                            <div class="relative w-full">

                                <input type="text" name="keyword" id="search-dropdown" class="block p-2.5 w-full h-14 text-start text-base font-normal text-black bg-white rounded-l-lg border-gray-300 focus:ring-sky-400 focus:border-sky-400" style="width: 350px" placeholder="Kata Kunci..." required />
                                <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-sky-400 bg-sky-400 rounded-r-lg border border-sky-400 hover:text-white hover:bg-sky-400 focus:ring-4 focus:outline-none focus:ring-sky-400">
                                    <svg class="w-6 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                    <span class="sr-only">Search</span>
                                </button>
                    </form>


                </div>
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

                     <a href="myproduct.php" class="text-black hover:text-blue-600 p-2 rounded-full focus:outline-none relative group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-6" fill="currentColor" class="bi bi-wallet" viewBox="0 0 16 16">
                        <path d="M0 3a2 2 0 0 1 2-2h13.5a.5.5 0 0 1 0 1H15v2a1 1 0 0 1 1 1v8.5a1.5 1.5 0 0 1-1.5 1.5h-12A2.5 2.5 0 0 1 0 12.5zm1 1.732V12.5A1.5 1.5 0 0 0 2.5 14h12a.5.5 0 0 0 .5-.5V5H2a2 2 0 0 1-1-.268M1 3a1 1 0 0 0 1 1h12V2H2a1 1 0 0 0-1 1" />
                    </svg>
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
