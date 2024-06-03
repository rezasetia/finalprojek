<?php
require_once 'koneksi.php'; // Mengimpor file koneksi.php yang berisi informasi tentang koneksi ke database

// Memulai sesi jika belum dimulai
session_start();

// Periksa apakah request merupakan POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Periksa apakah product_id telah diberikan sebagai parameter POST
    if (!isset($_POST['product_id'])) {
        echo "Product ID not provided.";
        exit;
    }

    // Ambil product_id dari parameter POST
    $product_id = intval($_POST['product_id']);

    // Periksa apakah user sudah memberikan like pada produk tersebut sebelumnya
    // Anda perlu mengganti $_SESSION['username'] dengan cara Anda untuk mendapatkan username
    $username = $_SESSION['username'];

    $query = "SELECT * FROM user_likes WHERE username = ? AND product_id = ?";
    $stmt = $connection->prepare($query);

    if (!$stmt) {
        echo "Failed to prepare query: " . $connection->error;
        exit;
    }

    $stmt->bind_param('si', $username, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika user belum memberikan like sebelumnya, tambahkan like baru
    if ($result->num_rows == 0) {
        $insert_query = "INSERT INTO user_likes (username, product_id, like_time) VALUES (?, ?, NOW())";
        $insert_stmt = $connection->prepare($insert_query);

        if (!$insert_stmt) {
            echo "Failed to prepare insert query: " . $connection->error;
            exit;
        }

        $insert_stmt->bind_param('si', $username, $product_id);

        if ($insert_stmt->execute()) {
            // Update jumlah like di tabel detail_barang
            $update_query = "UPDATE detail_barang SET jumlah_like = jumlah_like + 1 WHERE id = ?";
            $update_stmt = $connection->prepare($update_query);

            if (!$update_stmt) {
                echo "Failed to prepare update query: " . $connection->error;
                exit;
            }

            $update_stmt->bind_param('i', $product_id);

            if ($update_stmt->execute()) {
                // Redirect kembali ke halaman detail produk setelah sukses mengupdate jumlah like
                header("Location: tampil_detail_product.php?id=" . $product_id);
                exit;
            } else {
                echo "Failed to execute update query: " . $update_stmt->error;
            }
        } else {
            echo "Failed to execute insert query: " . $insert_stmt->error;
        }
    } else {
        // Jika user sudah memberikan like sebelumnya, kurangi jumlah like dan hapus entri like dari database
        $delete_query = "DELETE FROM user_likes WHERE username = ? AND product_id = ?";
        $delete_stmt = $connection->prepare($delete_query);

        if (!$delete_stmt) {
            echo "Failed to prepare delete query: " . $connection->error;
            exit;
        }

        $delete_stmt->bind_param('si', $username, $product_id);

        if ($delete_stmt->execute()) {
            // Update jumlah like di tabel detail_barang
            $update_query = "UPDATE detail_barang SET jumlah_like = jumlah_like - 1 WHERE id = ?";
            $update_stmt = $connection->prepare($update_query);

            if (!$update_stmt) {
                echo "Failed to prepare update query: " . $connection->error;
                exit;
            }

            $update_stmt->bind_param('i', $product_id);

            if ($update_stmt->execute()) {
                // Redirect kembali ke halaman detail produk setelah sukses mengupdate jumlah like
                header("Location: tampil_detail_product.php?id=" . $product_id);
                exit;
            } else {
                echo "Failed to execute update query: " . $update_stmt->error;
            }
        } else {
            echo "Failed to execute delete query: " . $delete_stmt->error;
        }
    }
} else {
    echo "Invalid request method";
}
?>
