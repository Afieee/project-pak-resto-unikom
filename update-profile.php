<?php
include 'connection.php';
session_start();

// Memeriksa apakah session telah diset dengan benar
if (isset($_SESSION['id_pelanggan'])) {
    $id_pelanggan = $_SESSION['id_pelanggan'];

    // Ambil data dari form
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $email_pelanggan = $_POST['email_pelanggan'];
    $password = $_POST['password'];
    $no_handphone = $_POST['no_handphone'];

    // Update data pelanggan
    $query = "UPDATE pelanggan SET nama_pelanggan='$nama_pelanggan', email_pelanggan='$email_pelanggan', password='$password', no_handphone='$no_handphone' WHERE id_pelanggan='$id_pelanggan'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Profil berhasil diperbarui'); window.location.href='pelanggan-profile.php'</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Menutup koneksi database
    mysqli_close($conn);
} else {
    // Jika session belum ter-set dengan benar, arahkan kembali ke halaman login
    echo "<script>alert('Anda belum login, mohon login kembali'); window.location.href='login-pelanggan.php'</script>";
    exit;
}
?>
