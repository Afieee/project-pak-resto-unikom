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
        }
        button {
            padding: 10px 20px;
            width: 100%;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
            align-self: center;
        }
        button.edit {
            background-color: #ffc107; /* Warna kuning untuk tombol Edit */
            color: #333;
        }
        button.edit:hover {
            background-color: #e0a800; /* Warna hover untuk tombol Edit */
        }
        button.delete {
            background-color: #dc3545; /* Warna merah untuk tombol Hapus */
            color: white;
        }
        button.delete:hover {
            background-color: #c82333; /* Warna hover untuk tombol Hapus */
        }
        input[type='number'] {
            padding: 8px;
            width: 60px; /* Sesuaikan lebar input sesuai kebutuhan */
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box; /* Pastikan padding tidak menambah lebar input */
        }

        input[type='text'][disabled] {
            background-color: #f2f2f2;
            color: #888;
            cursor: not-allowed;
            border: 1px solid #ddd;
            padding: 8px;
            width: 150px; /* Sesuaikan lebar input sesuai kebutuhan */
            box-sizing: border-box;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
        }

    </style>
</head>
<body>
    <h1>Daftar Pegawai</h1>
    <table>
        <tr>
            <th>Nama Pegawai</th>
            <th>Username</th>
            <th>Password</th>
            <th>Role</th>
            <th colspan="2">Aksi</th>
        </tr>
        <?php
        include 'connection.php';
            $result = mysqli_query($conn, "SELECT * FROM pegawai WHERE role != 'manager'");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr id='pegawai-" . $row['id_pegawai'] . "'>";
                echo "<td>" . $row['nama_pegawai'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
                echo "<td>" . $row['role'] . "</td>";
                echo "<td><button class='edit' onclick=\"window.location.href='manage-edit-pegawai.php?id_pegawai=" . $row["id_pegawai"] . "'\">Edit</button></td>";
                echo "<td><button class='delete' onclick=\"window.location.href='manage-hapus-pegawai.php?id_pegawai=" . $row["id_pegawai"] . "'\">Hapus</button></td>";
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>
