<?php
require_once 'koneksi.php'; // Mengimpor file koneksi.php yang berisi informasi tentang koneksi ke database

// Periksa apakah ID produk telah diberikan sebagai parameter GET
if (!isset($_GET['id'])) {
    echo "ID produk tidak ditemukan.";
    exit;
}

// Ambil ID produk dari parameter GET
$product_id = intval($_GET['id']);

// Query SQL untuk mengambil detail produk berdasarkan ID
$query = "SELECT id, username, nama_barang, harga_barang, nomor_telepon, kondisi, deskripsi_barang, link_maps, gambar_barang_1, gambar_barang_2, gambar_barang_3, gambar_barang_4, tanggal_masuk, jumlah_like FROM detail_barang WHERE id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param('i', $product_id);
$stmt->execute();
$result = $stmt->get_result();

// Periksa apakah produk ditemukan
if ($result->num_rows == 0) {
    echo "Produk tidak ditemukan.";
    exit;
}

// Ambil detail produk
$product = $result->fetch_assoc();
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>6SECOND</title>
    <link rel="stylesheet" href="assets/app.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/your-embed-code.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  </head>
  <body>
<!-- awal main -->
<main>
    <div id="content" class="content">
        <!-- awal detail produk -->
        <section class="py-8 mt-14 bg-white md:py-16 antialiased">
            <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
                <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                    <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
                        <img id="mainImage" class="w-[700px] h-[450px] object-cover" src="<?php echo htmlspecialchars($product['gambar_barang_1']); ?>" alt="" />

                        <div class="grid grid-cols-4 gap-4 mt-4">
                            <a href="#" onclick="changeMainImage(event, '<?php echo htmlspecialchars($product['gambar_barang_1']); ?>')">
                                <img class="w-full h-auto object-cover max-w-[96px] max-h-[86px]" src="<?php echo htmlspecialchars($product['gambar_barang_1']); ?>" alt="" />
                            </a>
                            <a href="#" onclick="changeMainImage(event, '<?php echo htmlspecialchars($product['gambar_barang_2']); ?>')">
                                <img class="w-full h-auto object-cover max-w-[96px] max-h-[86px]" src="<?php echo htmlspecialchars($product['gambar_barang_2']); ?>" alt="" />
                            </a>
                            <a href="#" onclick="changeMainImage(event, '<?php echo htmlspecialchars($product['gambar_barang_3']); ?>')">
                                <img class="w-full h-auto object-cover max-w-[96px] max-h-[86px]" src="<?php echo htmlspecialchars($product['gambar_barang_3']); ?>" alt="" />
                            </a>
                            <a href="#" onclick="changeMainImage(event, '<?php echo htmlspecialchars($product['gambar_barang_4']); ?>')">
                                <img class="w-full h-auto object-cover max-w-[96px] max-h-[86px]" src="<?php echo htmlspecialchars($product['gambar_barang_4']); ?>" alt="" />
                            </a>
                        </div>
                    </div>

                    <div class="mt-6 sm:mt-8 lg:mt-0">
                        <h1 class="text-xl font-medium text-gray-900 sm:text-2xl"><?php echo htmlspecialchars($product['nama_barang']); ?></h1>
                        <div class="sm:items-center sm:gap-4">
                            <div class="flex items-center gap-2 my-2">
                                                    <div class="flex items-center gap-1">
                      <div class="flex items-center">
                        <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                          <path
                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                        </svg>
                        <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                          <path
                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                        </svg>
                        <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                          <path
                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                        </svg>
                        <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                          <path
                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                        </svg>
                        <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                          <path
                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                        </svg>
                      </div>
                    </div>
                    <p class="text-sm font-medium leading-none text-gray-500">(4.0)</p>
                    <a href="#" class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline">345 Reviews</a>
                            </div>
                            <!-- ini buat default dulu -->
                            <!-- Ini adalah bagian yang menampilkan jumlah review dan bintang rating -->
                            <!-- Di sini Anda dapat menampilkan jumlah review dan bintang rating berdasarkan data yang ada di database -->
                            <p class="text-sm font-medium leading-none text-gray-500">(4.0)</p>
                            <a href="#" class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline">345 Reviews</a>
                        </div>
                        <!-- Ini adalah bagian yang menampilkan harga -->
<p class="text-2xl font-semibold text-gray-900 sm:text-3xl">Rp <?php echo htmlspecialchars($product['harga_barang']); ?></p>


                        <!-- Ini adalah bagian yang menampilkan informasi ketersediaan produk, tanggal masuk, dan kondisi -->
                        <div class="my-10 flex flex-col gap-y-2">
                            <p class="text-gray-400 font-medium text-base">Availability : <span class="text-sky-500">In Stock</span></p>
                            <p class="text-gray-400 font-medium text-base">Posted : <span class="text-sky-500"><?php echo htmlspecialchars($product['tanggal_masuk']); ?></span></p>
                            <p class="text-gray-400 font-medium text-base">Kondisi : <span class="text-sky-500"><?php echo htmlspecialchars($product['kondisi']); ?></span></p>
                        </div>

                        <!-- Ini adalah bagian yang menampilkan tombol untuk melakukan pembelian atau penawaran -->
                        <div>
                            <hr class="border-t border-gray-300 font-semibold w-full my-4" />
                            <div class="mt-6 sm:my-4 md:gap-4 items-center flex justify-center flex-wrap">
<a href="#" class="py-4 px-16 text-sm font-normal text-black bg-white rounded-md border-2 border-sky-400 hover:bg-sky-400 hover:text-white border-t border-b sm:mr-4 sm:mb-0 mb-4" role="button">
    Rp <?php echo htmlspecialchars(number_format($product['harga_barang'], 2)); ?>
</a>


                                <a href="https://api.whatsapp.com/send?phone=<?php echo htmlspecialchars($product['nomor_telepon']); ?>"class="py-4 px-16 text-white bg-sky-400 hover:bg-sky-500 font-normal rounded-md text-sm border
-2 border-gray-300 border-b" role="button">Buat Tawaran</a>
                            </div>
                            <hr class="border-t border-gray-300 font-semibold w-full my-4" />
                        </div>

                        <!-- Ini adalah bagian yang menampilkan tombol untuk menghubungi penjual, jumlah like, lokasi, dan jumlah views -->
                        <div class="flex items-center gap-x-4 my-10">
                            <a href="https://api.whatsapp.com/send?phone=<?php echo htmlspecialchars($product['nomor_telepon']); ?>" class="rounded-lg border bg-sky-400 hover:bg-sky-500 text-white py-3 px-6">Hubungi Sekarang</a>
                            <a href="#" id="likeButton" class="text-gray-700 font-medium py-2 px-4 rounded-full border border-gray-400 hover:border-sky-400 hover:bg-sky-400 hover:text-white">
                                <svg id="likeIcon" class="w-4 h-4 inline-block mr-1 text-red-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path id="heartFilled" fill-rule="evenodd" d="M10 18l-1.45-1.316C4.357 13.56 2 11.367 2 8.5 2 6.019 4.019 4 6.5 4c1.543 0 2.914.793 3.5 2  .586-1.207 1.957-2 3.5-2 2.481 0 4.5 2.019 4.5 4.5 0 2.867-2.357 5.06-6.55 8.184L10 18z" clip-rule="evenodd"></path>
                                    <path id="heartOutline" fill-rule="evenodd" d="M10 18l-1.45-1.316C4.357 13.56 2 11.367 2 8.5 2 6.019 4.019 4 6.5 4c1.543 0 2.914.793 3.5 2  .586-1.207 1.957-2 3.5-2 2.481 0 4.5 2.019 4.5 4.5 0 2.867-2.357 5.06-6.55 8.184L10 18z" clip-rule="evenodd"></path>
                                </svg>
                                <span id="likeText"><?php echo htmlspecialchars($product['jumlah_like']); ?></span>
                            </a>
                            <a href="<?php echo htmlspecialchars($product['link_maps']); ?>" target="_blank" rel="noopener noreferrer" class="text-gray-700 flex items-center gap-1 rounded-full border border-gray-400 hover:border-sky-400 hover:bg-sky-400 hover:text-white py-2 px-4">
                                <i class="fa-solid fa-location-dot"></i>
                                <span>Yogyakarta</span>
                            </a>
                            <div class="flex items-center gap-1 text-gray-700 rounded-full border border-gray-400 py-2 px-4">
                                <i class="fa-solid fa-eye text-gray-700"></i>
                                <span>100</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ini adalah bagian yang menampilkan deskripsi produk -->
                <div class="flex flex-col mx-10 gap-y-10 mt-10">
                    <h1 class="font-semibold text-3xl text-left">Deskrisi produk</h1>
                    <div class="mx-3 font-light text-base text-gray-400 text-left">
                        <p class="mb-10"><?php echo htmlspecialchars($product['deskripsi_barang']); ?></p>
                    </div>
                </div>
            </div>
        </section>

        <script>
            function changeMainImage(event, imageUrl) {
                event.preventDefault();
                document.getElementById("mainImage").src = imageUrl;
            }
        </script>
        <!-- akhir detail produk -->
    </div>
</main>
<!-- akhir  main -->
    <!-- akhir  main -->

    <!-- cdn flowbite -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  </body>
</html>