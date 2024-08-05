<?php
include 'connection.php';

session_start();
if (isset($_SESSION['id_pegawai']) && isset($_SESSION['nama_pegawai']) && isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role']) ) {
  $id_pegawai = $_SESSION['id_pegawai'];
  $nama_pegawai = $_SESSION['nama_pegawai'];
  $username = $_SESSION['username'];
  $password = $_SESSION['password'];
  $role = $_SESSION['role'];
} 
else {
  echo "<script>alert('Anda belum login, mohon login kembali'); window.location.href='login-pegawai.php'</script>";
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['menu_id']) && isset($_POST['new_status'])) {
        $menu_id = $_POST['menu_id'];
        $new_status = $_POST['new_status'];
        
        $update_query = "UPDATE menu SET status = '$new_status' WHERE id_menu = $menu_id";
        mysqli_query($conn, $update_query);
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
            margin-top: 20px;
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
    <h1>Daftar Menu</h1>
    <table>
        <tr>
            <th>Status</th>
            <th>Gambar</th>
            <th>Nama Makanan</th>
            <th>Tipe Makanan</th>
            <th>Aksi</th>
        </tr>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM menu ORDER BY status = 'tersedia' DESC, status");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td><img src='" . $row['gambar'] . "' alt='" . $row['menu'] . "'></td>";
            echo "<td>" . $row['menu'] . "</td>";
            echo "<td>" . $row['tipe'] . "</td>";
            echo "<td>";
            if ($row['status'] == 'tersedia') {
                echo "<form method='POST'>";
                echo "<input type='hidden' name='menu_id' value='" . $row['id_menu'] . "'>";
                echo "<input type='hidden' name='new_status' value='tidak tersedia'>";
                echo "<button type='submit'>Jadikan Tidak Tersedia</button>";
                echo "</form>";
            } else {
                echo "<form method='POST'>";
                echo "<input type='hidden' name='menu_id' value='" . $row['id_menu'] . "'>";
                echo "<input type='hidden' name='new_status' value='tersedia'>";
                echo "<button type='submit'>Jadikan Tersedia</button>";
                echo "</form>";
            }
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <?php
    mysqli_close($conn);
    ?>
</body>
</html>