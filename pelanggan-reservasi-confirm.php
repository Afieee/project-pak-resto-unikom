<?php
include 'connection.php';

// Mengambil data dari form
$tanggal = $_POST['tanggal'];
$jam = $_POST['jam'];
$nama_pelanggan = $_POST['nama_pelanggan'];
$email_pelanggan = $_POST['email_pelanggan'];
$no_handphone = $_POST['no_handphone'];
$no_meja = $_POST['no_meja'];
$id_pelanggan = $_POST['id_pelanggan'];
$status = $_POST['status'];
$jumlah_kursi = $_POST['jumlah_kursi'];

// Mengambil id_meja berdasarkan no_meja yang dipilih
$sql = "SELECT id_meja FROM meja WHERE no_meja = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $no_meja);
$stmt->execute();
$stmt->bind_result($id_meja);
$stmt->fetch();
$stmt->close();

if (!$id_meja) {
    echo "Meja tidak ditemukan";
    exit;
}

// Menggunakan prepared statement untuk keamanan
$stmt = $conn->prepare("INSERT INTO `reservasi`(`tanggal`, `jam`, `nama_pelanggan`, `email_pelanggan`, `no_handphone`, `no_meja`, `jumlah_kursi`, `id_pelanggan`, `id_meja`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssiis", $tanggal, $jam, $nama_pelanggan, $email_pelanggan, $no_handphone, $no_meja, $jumlah_kursi, $id_pelanggan, $id_meja, $status);

if ($stmt->execute()) {
    echo "<script>alert('Silahkan Tunggu Konfirmasi Dari Pihak Restaurant'); window.location.href = 'pelanggan-profile.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}

// Menutup statement dan koneksi
$stmt->close();
$conn->close();
?>
