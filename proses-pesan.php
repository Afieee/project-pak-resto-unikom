<?php
include 'connection.php';
session_start();

if (!isset($_SESSION['id_pegawai']) || !isset($_SESSION['nama_pegawai']) || !isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['role'])) {
    echo "<script>alert('Anda belum login, mohon login kembali'); window.location.href='login-pelanggan.php'</script>";
    exit;
}

$no_meja = $_POST['no_meja'];
$jumlah_items = $_POST['jumlah'];
$status = 'dimasak';
$status_pengantaran = 'belum diantar';

// Query untuk mendapatkan id_meja berdasarkan no_meja yang dipilih
$query_id_meja = "SELECT id_meja FROM meja WHERE no_meja = '$no_meja'";
$result_id_meja = mysqli_query($conn, $query_id_meja);
$id_meja_row = mysqli_fetch_assoc($result_id_meja);
$id_meja = $id_meja_row['id_meja'];

foreach ($jumlah_items as $id_menu => $jumlah) {
    if ($jumlah > 0) {
        $query_menu = "SELECT * FROM menu WHERE id_menu = '$id_menu'";
        $result_menu = mysqli_query($conn, $query_menu);
        $menu = mysqli_fetch_assoc($result_menu);

        $menu_item = $menu['menu'];
        $harga = $menu['harga'];

        $query_pesan = "INSERT INTO pesanan (menu, harga, jumlah, no_meja, id_menu, id_meja, status, status_pengantaran) VALUES ('$menu_item', '$harga', '$jumlah', '$no_meja', '$id_menu', '$id_meja', '$status', '$status_pengantaran')";
        mysqli_query($conn, $query_pesan);
    }
}

$jumlah = $_POST['jumlah'];
$tanggal = date('Y-m-d H:i:s');

$id_pesanan = mysqli_insert_id($conn);

foreach ($jumlah as $menu_id => $qty) {
    if ($qty > 0) {
        $query_harga = "SELECT harga FROM menu WHERE id_menu = $menu_id";
        $result_harga = mysqli_query($conn, $query_harga);
        if (!$result_harga) {
            die("Error: " . mysqli_error($conn));
        }
        $menu = mysqli_fetch_assoc($result_harga);
        if (!$menu) {
            die("Error: Item tidak ditemukan");
        }
        $harga = $menu['harga'];
        $query_item = "INSERT INTO transaksi_items (id_pesanan, id_menu, jumlah, harga) VALUES ($id_pesanan, $menu_id, $qty, $harga)";
        if (!mysqli_query($conn, $query_item)) {
            die("Error: " . mysqli_error($conn));
        }
    }
}

echo "<script>alert('Pesanan Berhasil Dikirim Ke Koki & Ke Kasir'); window.location.href='view-pelayan.php'</script>";

mysqli_close($conn);
?>
