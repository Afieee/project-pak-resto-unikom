<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_reservasi = $_POST['id_reservasi'];
    $status = $_POST['status'];

    // Menggunakan prepared statement untuk menghindari SQL injection
    $stmt = $conn->prepare("UPDATE reservasi SET status = ? WHERE id_reservasi = ?");
    $stmt->bind_param("si", $status, $id_reservasi);

    if ($stmt->execute()) {
        echo "<script>alert('Status berhasil diperbarui'); window.location.href = 'view-pelayan.php';</script>";
        exit; // Exit untuk menghentikan eksekusi setelah redirect
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
