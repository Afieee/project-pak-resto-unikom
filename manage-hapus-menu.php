<?php
include 'connection.php';

if (isset($_GET['id_menu'])) {
    $id_menu = intval($_GET['id_menu']);
    $query = "DELETE FROM menu WHERE id_menu = $id_menu";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('Menu berhasil dihapus.'); window.location.href = 'manage-menu.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data: " . mysqli_error($conn) . "'); window.location.href = 'manage-menu.php';</script>";
    }

    mysqli_close($conn);
} else {
    echo "<script>alert('ID menu tidak ditemukan.'); window.location.href = 'manage-menu.php';</script>";
}
?>
