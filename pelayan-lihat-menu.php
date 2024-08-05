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
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group select, .form-group input {
            padding: 8px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px; /* Increased font size for select */
            box-sizing: border-box;
        }
        .quantity {
            justify-content: center;
            align-items: center;
        }
        .quantity input {
            width: 50px;
            text-align: center;
            margin: 0 5px;
            padding: 8px;
        }
        .quantity button {
            width: 40px;
            padding: 6px;
            margin: 0 5px;
            border: none;
            border-radius: 3px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            align-content: center;
        }
        .quantity .minus {
            background-color: #dc3545;
            color: white;
            height: 40px;
        }
        .quantity .plus {
            background-color: #28a745;
            color: white;
            height: 40px;

        }
        button[type="submit"] {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }
        button[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h1>Daftar Menu</h1>
    <form action="proses-pesan.php" method="post">
        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Makanan</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'connection.php';

                function formatRupiah($angka){
                    return 'Rp ' . number_format($angka, 0, ',', '.') . '.00';
                }

                $result = mysqli_query($conn, "SELECT * FROM menu ORDER BY status = 'tersedia' DESC, status");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td><img src='" . $row['gambar'] . "' alt='" . $row['menu'] . "'></td>";
                    echo "<td>" . $row['menu'] . "</td>";
                    echo "<td>" . formatRupiah($row['harga']) . "</td>";
                    if ($row['status'] == 'tersedia') {
                        echo "<td class='quantity'>";
                        echo "<button type='button' class='minus' onclick='decrementValue(\"jumlah" . $row['id_menu'] . "\")'>-</button>";
                        echo "<input type='number' id='jumlah" . $row['id_menu'] . "' name='jumlah[" . $row['id_menu'] . "]' min='0' value='0'>";
                        echo "<button type='button' class='plus' onclick='incrementValue(\"jumlah" . $row['id_menu'] . "\")'>+</button>";
                        echo "</td>";
                    } else {
                        echo "<td><input type='text' value='Tidak Tersedia' disabled></td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        
        <div class="form-group">
            <label for="no_meja">Pilih No Meja:</label>
            <select name="no_meja" id="no_meja">
                <?php
                $result = mysqli_query($conn, "SELECT no_meja FROM meja");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['no_meja'] . "'>" . $row['no_meja'] . "</option>";
                }
                mysqli_close($conn);
                ?>
            </select>
        </div>

        <button type="submit">Pesan</button>
    </form>

    <script>
        function incrementValue(id) {
            var input = document.getElementById(id);
            var value = parseInt(input.value, 10);
            input.value = isNaN(value) ? 0 : value + 1;
        }

        function decrementValue(id) {
            var input = document.getElementById(id);
            var value = parseInt(input.value, 10);
            if (!isNaN(value) && value > 0) {
                input.value = value - 1;
            }
        }
    </script>
</body>
</html>
