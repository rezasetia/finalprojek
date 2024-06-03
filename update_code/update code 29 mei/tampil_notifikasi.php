<?php
// Koneksi ke database
require_once 'koneksi.php';

// Periksa jika sesi belum dimulai sebelumnya
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil username pengguna saat ini dari sesi
if (!isset($_SESSION['username'])) {
    echo "Tidak ada pengguna yang terautentikasi.";
    exit;
}
$username = $_SESSION['username'];

// Query untuk mengambil notifikasi "user menyukai barang Anda" dari database
$query = "SELECT ul.like_time, db.nama_barang, ul.username, u.profile_picture 
          FROM user_likes ul 
          JOIN detail_barang db ON ul.product_id = db.id 
          JOIN users u ON ul.username = u.username
          WHERE ul.username != ? AND db.username = ?";

$stmt = $connection->prepare($query);
$stmt->bind_param('ss', $username, $username);
$stmt->execute();
$result = $stmt->get_result();

// Menghasilkan notifikasi ke dalam array
$notifications = [];
while ($row = $result->fetch_assoc()) {
    // Tentukan foto profil default
    $default_profile_picture = 'assets/img/new/Pro max pfp.jpg';

    // Tentukan foto profil yang akan digunakan
    $profile_picture = isset($row['profile_picture']) ? $row['profile_picture'] : $default_profile_picture;

    $notifications[] = [
        'time' => $row['like_time'],
        'message' => $row['username'] . ' menyukai barang Anda: ' . $row['nama_barang'],
        'profile_picture' => $profile_picture, // Foto profil dari tabel users atau default
        // Anda mungkin perlu menambahkan informasi tambahan sesuai kebutuhan
    ];
}

// Tutup koneksi database
$stmt->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notifikasi</title>
  <!-- Masukkan CSS yang diperlukan di sini -->
  <link rel="stylesheet" href="output.css">
      <link rel="stylesheet" href="assets/app.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/your-embed-code.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<body>

<!-- header -->
<header>
            <?php require_once 'header.php'; ?>
</header>

  <!-- Konten notifikasi -->
<main>
    <div id="content" class="content">
        <article class="my-20 md:mx-32">
            <div class="bg-white shadow-lg px-10 py-2 rounded-lg">
                <div class="font-medium text-5xl text-sky-400 text-left flex gap-x-2">
                    <h1>Notifikasi</h1>
                    <i class="fa-solid fa-bell"></i>
                </div>
                <div>
  <div>
              <button type="button" class="text-black hover:bg-sky-400 hover:text-white focus:bg-opacity-70 focus:text-blue-600 focus:bg-sky-200 font-medium rounded-lg text-sm px-3 py-1 my-4 selected">Semua</button>
              <button type="button" class="text-black hover:bg-sky-400 hover:text-white focus:bg-opacity-70 focus:text-blue-600 focus:bg-sky-200 font-medium rounded-lg text-sm px-3 py-1 my-4">Belum Dibaca</button>
            </div>
                </div>
                <h1 class="text-left font-normal my-4">Baru</h1>
                <div>
                    <!-- Container untuk notifikasi -->
                    <?php if (!empty($notifications)): ?>
                        <?php foreach ($notifications as $index => $notification): ?>
                            <div id="alert-<?php echo $index + 1; ?>" class="notification-item flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 cursor-pointer relative transition-colors duration-300 ease-in-out hover:bg-blue-100">
                                <img class="flex-shrink-0 w-8 h-8 rounded-full" src="<?php echo $notification['profile_picture']; ?>" alt="Avatar" />
                                <div class="ms-3">
                                    <p class="text-base font-normal text-black"><?php echo $notification['message']; ?></p>
                                    <p class="text-sm font-normal text-blue-500"><?php echo date('Y-m-d H:i:s', strtotime($notification['time'])); ?></p>
                                </div>
                                <span class="absolute top-50 right-3 h-3 w-3 bg-blue-600 rounded-full"></span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Tidak ada notifikasi baru.</p>
                    <?php endif; ?>
                </div>
            </div>
        </article>
    </div>
</main>



  <!-- Masukkan JavaScript yang diperlukan di sini -->
  <script>
                const notificationItems = document.querySelectorAll(".notification-item");

                notificationItems.forEach((item) => {
                  item.addEventListener("click", () => {
                    // Tandai pesan sebagai sudah dibaca
                    item.setAttribute("data-read", "true");

                    // Hilangkan ikon titik
                    const dotIcon = item.querySelector(".bg-blue-600");
                    if (dotIcon) {
                      dotIcon.style.display = "none";
                    }

                    // Hilangkan background
                    item.classList.remove("bg-blue-50");
                    item.classList.add("bg-white");

                    // Di sini Anda bisa menambahkan logika lain, misalnya mengirim permintaan ke server untuk menandai pesan sebagai sudah dibaca
                  });
                });
  </script>
</body>
</html>