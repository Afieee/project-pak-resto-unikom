<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pegawai = $_POST['id_pegawai'];
    $nama_pegawai = $_POST['nama_pegawai'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $query = "UPDATE pegawai SET 
              nama_pegawai = '$nama_pegawai', 
              username = '$username', 
              password = '$password', 
              role = '$role'
              WHERE id_pegawai = $id_pegawai";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>window.location.href = 'view-manager.php.php';</script>";
        exit();
    } else {
        echo "Gagal melakukan update data: " . mysqli_error($conn);
    }
} else {
    echo "Metode request tidak diizinkan.";
}
?>
