<?php
include 'connection.php';

$id_pegawai = $_GET['id_pegawai'];
$query = "DELETE FROM pegawai WHERE id_pegawai = $id_pegawai";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "<script>window.location.href = 'view-manager.php';</script>";
} else {
    echo "Gagal menghapus data pegawai: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
