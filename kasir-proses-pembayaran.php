<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pesanan = $_POST['id_pesanan'];
    $status_pembayaran = $_POST['status_pembayaran'];

    $update_query = "UPDATE transaksi_items SET status_pembayaran = '$status_pembayaran' WHERE id = $id_pesanan";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        echo "<script>alert('Status pembayaran berhasil diupdate');</script>";
    } else {
        echo "<script>alert('Gagal mengupdate status pembayaran: " . mysqli_error($conn) . "');</script>";
    }
}
mysqli_close($conn);

?>