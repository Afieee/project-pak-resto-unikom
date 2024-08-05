<?php
session_start();
if (isset($_SESSION['id_pelanggan']) && isset($_SESSION['nama_pelanggan']) && isset($_SESSION['email_pelanggan']) && isset($_SESSION['no_handphone']) ) {
    $id_pelanggan = $_SESSION['id_pelanggan'];
    $nama_pelanggan = $_SESSION['nama_pelanggan'];
    $email_pelanggan = $_SESSION['email_pelanggan'];
    $no_handphone = $_SESSION['no_handphone'];
} else {
    echo "<script>alert('Anda belum login, mohon login kembali'); window.location.href='login-pelanggan.php'</script>";
    exit;
}

include 'connection.php';

if (!$conn) {
    die("Failed to connect to database: " . mysqli_connect_error());
}

// Prepare and execute the query
$query = "SELECT * FROM reservasi WHERE id_pelanggan = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $id_pelanggan);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .table-container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f7f7f7;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .status-diterima {
            background-color: #d4edda;
            color: #155724;
            padding: 4px 8px;
            border-radius: 4px;
            display: inline-block;
        }
        .status-ditolak {
            background-color: #f8d7da;
            color: #721c24;
            padding: 4px 8px;
            border-radius: 4px;
            display: inline-block;
        }
        .status-menunggu {
            background-color: #fff3cd;
            color: #856404;
            padding: 4px 8px;
            border-radius: 4px;
            display: inline-block;
        }
    </style>
</head>
<body>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Meja</th>
                    <th>Jumlah Kursi</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['jam']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['no_meja']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['jumlah_kursi']) . "</td>";


                    echo "<td>";
                    if ($row['status'] == 'diterima') {
                        echo "<span class='status-diterima'>" . htmlspecialchars($row['status']) . "</span>";
                    } elseif ($row['status'] == 'ditolak') {
                        echo "<span class='status-ditolak'>" . htmlspecialchars($row['status']) . "</span>";
                    } else {
                        echo "<span class='status-menunggu'>" . htmlspecialchars($row['status']) . "</span>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
