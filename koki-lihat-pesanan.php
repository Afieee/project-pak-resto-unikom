<?php
include 'connection.php';

session_start();
if (isset($_SESSION['id_pegawai']) && isset($_SESSION['nama_pegawai']) && isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])) {
  $id_pegawai = $_SESSION['id_pegawai'];
  $nama_pegawai = $_SESSION['nama_pegawai'];
  $username = $_SESSION['username'];
  $password = $_SESSION['password'];
  $role = $_SESSION['role'];
} else {
  echo "<script>alert('Anda belum login, mohon login kembali'); window.location.href='login-pegawai.php'</script>";
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['table_id']) && isset($_POST['new_status'])) {
        $table_id = $_POST['table_id'];
        $new_status = $_POST['new_status'];
        
        // Use prepared statement to avoid SQL injection
        $stmt = $conn->prepare("UPDATE pesanan SET status = ? WHERE no_meja = ?");
        $stmt->bind_param("ss", $new_status, $table_id);

        if ($stmt->execute()) {
            echo "<script>alert('Status pesanan berhasil diperbarui'); window.location.href=window.location.href;</script>";
        } else {
            echo "<script>alert('Gagal mengupdate status');</script>";
        }

        $stmt->close();
    }
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
            font-family: 'Roboto', sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
            font-size: 32px;
            margin-bottom: 20px;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            width: 320px;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            border-radius: 15px;
            animation: fadeIn 0.5s ease-in-out;
            position: relative;
            display: flex;
            flex-direction: column;
        }
        .card h2 {
            margin: 0 0 15px 0;
            font-size: 24px;
            color: #007bff;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        .card p {
            margin: 5px 0;
            font-size: 18px;
            color: #555;
        }
        .card .menu-label {
            font-weight: bold;
            color: #333;
            display: inline-block;
            width: 80px;
        }
        .card button {
            margin-top: auto;
            padding: 14px 0;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            font-size: 18px;
            transition: background-color 0.3s ease;
            width: 100%;
            text-align: center;
            position: relative;
        }
        .card button:hover {
            background-color: #218838;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <h1>Daftar Pesanan Pelanggan</h1>
    <div class="card-container">
        <?php
        // Fetch all orders except those with status "selesai" and "selesai dimasak"
        $result = mysqli_query($conn, "SELECT * FROM pesanan WHERE status NOT IN ('selesai', 'selesai dimasak')");

        // Store orders in an associative array grouped by table number
        $orders = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $orders[$row['no_meja']][] = $row;
        }

        // Loop through grouped orders
        foreach ($orders as $no_meja => $menu_items) {
            echo "<div class='card'>";
            echo "<h2>Meja $no_meja</h2>";
            $menu_count = 1;
            foreach ($menu_items as $item) {
                echo "<p><span class='menu-label'>Menu $menu_count:</span> " . $item['menu'] . "</p>";
                echo "<p><span class='menu-label'>Jumlah:</span> " . $item['jumlah'] . "</p>";
                $menu_count++;
            }
            $status = $menu_items[0]['status'];
            $buttonText = ($status == 'dimasak') ? 'Selesai Dimasak' : 'Selesai';
            $newStatus = ($status == 'dimasak') ? 'selesai dimasak' : 'selesai';
            echo "<form method='POST'>";
            echo "<input type='hidden' name='table_id' value='$no_meja'>";
            echo "<input type='hidden' name='new_status' value='$newStatus'>";
            echo "<button type='submit'>$buttonText</button>";
            echo "</form>";
            echo "</div>";
        }
        ?>
    </div>

    <?php
    mysqli_close($conn);
    ?>
</body>
</html>
