<?php
include 'connection.php';

session_start();
if (isset($_SESSION['id_pelanggan']) && isset($_SESSION['nama_pelanggan']) && isset($_SESSION['email_pelanggan']) && isset($_SESSION['no_handphone'])) {
    $id_pelanggan = $_SESSION['id_pelanggan'];
    $nama_pelanggan = $_SESSION['nama_pelanggan'];
    $email_pelanggan = $_SESSION['email_pelanggan'];
    $no_handphone = $_SESSION['no_handphone'];
} else {
    echo "<script>alert('Anda belum login, mohon login kembali'); window.location.href='login-pelanggan.php'</script>";
    exit;
}

function formatRupiah($angka){
    return 'Rp ' . number_format($angka, 0, ',', '.') . '.00';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Restoran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 40px;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s;
            width: 300px;
            margin: 10px;
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .card-content {
            padding: 20px;
        }
        .card-content h3 {
            margin: 0;
            color: #007bff;
            font-size: 20px;
        }
        .card-content p {
            margin: 10px 0;
            color: #666;
        }
        .status {
            padding: 5px 10px;
            border-radius: 20px;
            background-color: #28a745;
            color: white;
            display: inline-block;
            margin-bottom: 15px;
        }
        .status.not-available {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <h1>Katalog Menu Kami</h1>
    <div class="container">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM menu ORDER BY status = 'tersedia' DESC, status");
        while ($row = mysqli_fetch_assoc($result)) {
            $statusClass = $row['status'] == 'tersedia' ? 'status' : 'status not-available';
            echo "<div class='card'>";
            echo "<img src='" . $row['gambar'] . "' alt='" . $row['menu'] . "'>";
            echo "<div class='card-content'>";
            echo "<div class='{$statusClass}'>" . $row['status'] . "</div>";
            echo "<h3>" . $row['menu'] . "</h3>";
            echo "<p>Tipe: " . $row['tipe'] . "</p>";
            echo "<p>Harga: " . formatRupiah($row['harga']) . "</p>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
<?php
mysqli_close($conn);
?>
