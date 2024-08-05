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
        $stmt = $conn->prepare("UPDATE pesanan SET status_pengantaran = ? WHERE no_meja = ?");
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
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            background-color: #fff;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        form {
            display: inline-block;
        }
        button {
            margin: 0;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #218838;
        }
        input[type='hidden'] {
            display: none;
        }
        .kembali {
            margin-top: 10px;
            background-color: #007bff;
        }
    </style>
</head>
<body>
    <h1>Pesanan Yang Siap Diantar</h1>
    <table>
        <tr>
            <th>No Meja</th>
            <th>Nama Menu</th>
            <th>Jumlah</th>
            <th>Status</th>
        </tr>
        <?php
        // Fetch all orders with status "selesai dimasak" and "belum diantar"
        $query = "SELECT * FROM pesanan WHERE status = 'selesai dimasak' AND status_pengantaran = 'belum diantar'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) > 0) {
            // Store orders in an associative array grouped by table number
            $orders = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $orders[$row['no_meja']][] = $row;
            }

            // Loop through grouped orders
            foreach ($orders as $no_meja => $menu_items) {
                foreach ($menu_items as $index => $item) {
                    echo "<tr>";
                    if ($index === 0) { // Display table number and status button only once per table
                        echo "<td rowspan='" . count($menu_items) . "'>" . $item['no_meja'] . "</td>";
                    }
                    echo "<td>" . $item['menu'] . "</td>";
                    echo "<td>" . $item['jumlah'] . "</td>";
                    if ($index === 0) { // Display status button only once per table
                        $status = $item['status_pengantaran'];
                        $buttonText = ($status == 'belum diantar') ? 'Selesai Diantar' : 'Selesai';
                        $newStatus = ($status == 'belum diantar') ? 'sudah diantar' : 'belum diantar';
                        echo "<td rowspan='" . count($menu_items) . "'>";
                        echo "<form method='POST'>";
                        echo "<input type='hidden' name='table_id' value='$no_meja'>";
                        echo "<input type='hidden' name='new_status' value='$newStatus'>";
                        echo "<button type='submit'>$buttonText</button>";
                        echo "</form>";
                        echo "</td>";
                    }
                    echo "</tr>";
                }
            }
        } else {
            echo "<tr><td colspan='4' style='text-align: center;'>Tidak ada pesanan yang siap diantar.</td></tr>";
        }
        ?>
    </table>
    <?php
    mysqli_close($conn);
    ?>
</body>
</html>
