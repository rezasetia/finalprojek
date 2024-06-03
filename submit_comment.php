<?php
session_start();
require_once 'koneksi.php';

// Periksa apakah data yang diperlukan telah dikirimkan
if (isset($_POST['product_id'], $_POST['comment'])) {
    // Bersihkan input untuk mencegah injeksi SQL
    $product_id = intval($_POST['product_id']);
    $comment = htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8');
    $username = $_SESSION['username']; // Pastikan username tersimpan di sesi
    $parent_id = isset($_POST['parent_id']) ? intval($_POST['parent_id']) : null;

    // Query untuk menyimpan komentar ke database
    $query = $connection->prepare("INSERT INTO comments (product_id, username, comment, parent_id) VALUES (?, ?, ?, ?)");
    $query->bind_param('isss', $product_id, $username, $comment, $parent_id);
    if ($query->execute()) {
        // Ambil pemilik produk dari tabel detail_barang
        $product_owner_query = $connection->prepare("SELECT username FROM detail_barang WHERE id = ?");
        $product_owner_query->bind_param('i', $product_id);
        $product_owner_query->execute();
        $product_owner_query->bind_result($product_owner);
        $product_owner_query->fetch();
        $product_owner_query->close();

        // Tambahkan notifikasi untuk pemilik produk atau pemilik komentar pertama jika itu adalah balasan komentar
        $message = "Ada komentar baru pada produk Anda.";
        if ($parent_id !== null) {
            // Ambil username dari komentar parent untuk balasan komentar
            $parent_comment_query = $connection->prepare("SELECT username FROM comments WHERE id = ?");
            $parent_comment_query->bind_param('i', $parent_id);
            $parent_comment_query->execute();
            $parent_comment_query->bind_result($parent_commenter);
            $parent_comment_query->fetch();
            $parent_comment_query->close();

            // Notifikasi untuk balasan komentar
            $message = "Ada balasan komentar pada produk Anda.";
            $notification_username = $parent_commenter;
        } else {
            // Notifikasi untuk komentar baru
            $notification_username = $product_owner;
        }

        // Tambahkan notifikasi
        $notification_query = $connection->prepare("INSERT INTO notifications (username, product_id, action, parent_id, message) VALUES (?, ?, 'comment', ?, ?)");
        $notification_query->bind_param('siis', $notification_username, $product_id, $parent_id, $message);
        if ($notification_query->execute()) {
             // Redirect ke halaman detail produk
    $url = "tampil_detail_product.php?id=" . $product_id;
    header("Location: $url");
        } else {
            echo "Gagal menambahkan notifikasi.";
        }
        $notification_query->close();
    } else {
        echo "Gagal menambahkan komentar.";
    }
    $query->close();
} else {
    echo "Data yang diperlukan tidak lengkap.";
}

// Tutup koneksi
$connection->close();
?>
