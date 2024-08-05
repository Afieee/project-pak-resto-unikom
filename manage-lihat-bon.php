<?php
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
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

        img {
            max-width: 100px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        button {
            padding: 10px 20px;
            width: 100%;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
            align-self: center;
        }

        button:hover {
            background-color: #218838;
        }

        input[type='number'] {
            padding: 8px;
            width: 60px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        input[type='text'][disabled] {
            background-color: #f2f2f2;
            color: #888;
            cursor: not-allowed;
            border: 1px solid #ddd;
            padding: 8px;
            width: 150px;
            box-sizing: border-box;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Daftar Bon</h1>
    <table>
        <tr>
            <th>ID Pesanan</th>
            <th>No Meja</th>
            <th>Status Pembayaran</th>
            <th colspan="2">Aksi</th>
        </tr>
        <?php
        $result = mysqli_query($conn, "SELECT transaksi_items.id_pesanan, pesanan.no_meja, transaksi_items.status_pembayaran FROM transaksi_items LEFT JOIN pesanan ON transaksi_items.id_pesanan = pesanan.id_pesanan");

        $previous_no_meja = null;

        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['no_meja'] != $previous_no_meja) {
                $id_pesanan = $row["id_pesanan"];
                $query_pembayaran = "SELECT status_pembayaran FROM transaksi_items WHERE id_pesanan = $id_pesanan LIMIT 1";
                $result_pembayaran = mysqli_query($conn, $query_pembayaran);
                $status_pembayaran = '';

                if ($result_pembayaran && mysqli_num_rows($result_pembayaran) > 0) {
                    $status_pembayaran = mysqli_fetch_assoc($result_pembayaran)['status_pembayaran'];
                }

                $status_display = $status_pembayaran == 'dibayar' ? 'Dibayar' : 'Belum Dibayar';

                echo "<tr id='transaksi-" . $row['no_meja'] . "'>";
                echo "<td>" . $row['id_pesanan'] . "</td>";
                echo "<td>" . $row['no_meja'] . "</td>";
                echo "<td>" . $status_display . "</td>";
                echo "<td><button onclick=\"window.location.href='manage-lihat-id-bon.php?id_pesanan=" . $row["id_pesanan"] . "'\">Lihat</button></td>";
                echo "</tr>";

                $previous_no_meja = $row['no_meja'];
            }
        }
        ?>
    </table>
</body>

</html>
<?php
mysqli_close($conn);
?>
