<?php
include 'connection.php';

function formatRupiah($angka) {
    if (!is_numeric($angka)) {
        $angka = 0; // Berikan nilai default jika bukan angka
    }
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
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
        img {
            max-width: 100px;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        button {
            padding: 10px 20px;
            width: 100%;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
            align-self: center;
        }
        button.edit {
            background-color: #ffc107; /* Warna kuning */
        }
        button.edit:hover {
            background-color: #e0a800; /* Warna kuning lebih gelap saat hover */
        }
        button.delete {
            background-color: #dc3545; /* Warna merah */
        }
        button.delete:hover {
            background-color: #c82333; /* Warna merah lebih gelap saat hover */
        }
        .back-button-container {
            margin-top: auto;
            text-align: center;
        }
        .back-button {
            background-color: green;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            display: inline-block;
            margin-top: 20px;
        }
        .back-button:hover {
            background-color: #c82333; /* Warna merah lebih gelap saat hover */
        }
    </style>
    <script>
        function confirmDelete(url) {
            if (confirm("Apakah Anda yakin ingin menghapus menu ini?")) {
                window.location.href = url;
            }
        }
    </script>
</head>
<body>
    <h1>Daftar Pengaturan Menu</h1>
    <table>
        <tr>
            <th>Gambar</th>
            <th>Nama Makanan</th>
            <th>Tipe Makanan</th>
            <th>Harga</th>
            <th>Ketersediaan</th>
            <th colspan="2">Aksi</th>
        </tr>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM menu");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td><img src='" . $row['gambar'] . "' alt='" . $row['menu'] . "'></td>";
            echo "<td>" . $row['menu'] . "</td>";
            echo "<td>" . $row['tipe'] . "</td>";
            echo "<td>" . formatRupiah($row['harga']) . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td><button class='edit' onclick=\"window.location.href='manage-edit-menu.php?id_menu=" . $row["id_menu"] . "'\">Edit</button></td>";
            echo "<td><button class='delete' onclick=\"confirmDelete('manage-hapus-menu.php?id_menu=" . $row["id_menu"] . "')\">Hapus</button></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <div class="back-button-container">
        <a href="view-manager.php" class="back-button">Kembali</a>
    </div>
</body>
</html>
<?php
mysqli_close($conn);
?>
