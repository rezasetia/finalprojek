<?php
session_start();
require_once 'koneksi.php'; // Mengimpor file koneksi.php yang berisi informasi tentang koneksi ke database
// Periksa apakah pengguna telah login atau belum
if (!isset($_SESSION['username'])) {
    // Jika belum login, redirect ke halaman login
    header('Location: login.php');
    exit;
}

// Periksa apakah koneksi berhasil
if ($connection->connect_error) {
    die("Koneksi database gagal: " . $connection->connect_error);
}

// Periksa apakah ada kata kunci pencarian yang dikirim dari formulir
if (isset($_GET['keyword'])) {
    // Tangkap kata kunci dari formulir
    $keyword = $_GET['keyword'];

    // Query SQL untuk mencari produk berdasarkan nama barang yang cocok dengan kata kunci
    $query = "SELECT id, username, nama_barang, harga_barang, gambar_barang_1 FROM detail_barang WHERE nama_barang LIKE '%$keyword%'";

    // Jalankan query
    $result = $connection->query($query);

    // Periksa apakah query berhasil dieksekusi
    if ($result) {
        // Periksa apakah ada hasil yang ditemukan
        if ($result->num_rows > 0) {
            // Fetch all rows into an array
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            ?>

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <!-- Tambahkan bagian head seperti CSS, title, dll. -->
            </head>
            <body>

                <!-- Tambahkan bagian tampilan hasil pencarian di sini -->
                <h1>Hasil Pencarian</h1>
                <div class="grid grid-cols-5 my-10 justify-center gap-x-10 md:mx-16">
                    <?php foreach ($rows as $row): ?>
                        <!-- Tampilkan informasi produk sesuai dengan kebutuhan -->
                        <div class="group flex my-7 justify-center md:col-span-1 max-w-screen-xl md:max-w-xs flex-col overflow-hidden bg-card-ec hover:shadow-xl">
                            <!-- Tambahkan tautan ke halaman detail produk -->
                            <a href="tampil_detail_product.php?id=<?php echo $row['id']; ?>" class="relative flex h-72 overflow-hidden justify-center">
                                <!-- Tampilkan gambar produk dan detail lainnya -->
                                <img class="card-image absolute w-full top-0 right-0 object-cover" src="<?php echo $row['gambar_barang_1']; ?>" alt="product image" />
                                <!-- Tampilkan informasi produk -->
                                <div class="absolute bottom-0 mb-6 flex w-full justify-center space-x-4">
                                    <!-- Nama barang -->
                                    <h3><?php echo $row['nama_barang']; ?></h3>
                                    <!-- Upload by -->
                                    <p>Upload by: <?php echo $row['username']; ?></p>
                                    <!-- Harga -->
                                    <p>Harga: Rp <?php echo number_format($row['harga_barang'], 0, '', '.'); ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>

            </body>
            </html>

            <?php
        } else {
            // Jika tidak ada hasil yang ditemukan, tampilkan pesan
            echo "Tidak ada data yang ditemukan.";
        }
    } else {
        // Jika query gagal dieksekusi, tampilkan pesan error
        echo "Query gagal dieksekusi: " . $connection->error;
    }
} else {
    // Jika tidak ada kata kunci pencarian, tampilkan pesan
    echo "Masukkan kata kunci untuk melakukan pencarian.";
}

// Tutup koneksi database
$connection->close();
?>
