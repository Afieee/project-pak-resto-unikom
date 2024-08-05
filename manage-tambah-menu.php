<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        .login-container img {
            width: 100px;
            margin-bottom: 20px;
        }
        .login-container h3 {
            margin-bottom: 20px;
            color: #333;
        }
        .login-container table {
            width: 100%;
            margin: 0 auto;
        }
        .login-container input[type="text"],
        .login-container input[type="number"],
        .login-container select,
        .login-container input[type="file"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .button-container button {
            width: 48%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
        }
        .button-container button.submit-btn {
            background-color: #28a745;
            color: #fff;
        }
        .button-container button.back-btn {
            background-color: #dc3545;
            color: #fff;
        }
        .button-container button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="images/logo-unikom.png" alt="Resto Unikom">
        <h3>Tambah Menu</h3>
        <form action="manage-tambah-menu.php" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><input type="text" name="menu" placeholder="Nama Menu" required></td>
                </tr>
                <tr>
                    <td>
                        <select name="tipe" required>
                            <option value="makanan">Makanan</option>
                            <option value="minuman">Minuman</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><input type="number" name="harga" placeholder="Harga" required></td>
                </tr>
                <tr>
                    <td><input type="file" name="gambar" accept="image/*" required></td>
                </tr>
            </table>
            <div class="button-container">
                <button type="submit" class="submit-btn">Tambah</button>
                <button type="button" class="back-btn" onclick="window.location.href = 'view-manager.php'">Kembali</button>
            </div>
        </form>
    </div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connection.php';

    $menu = $_POST['menu'];
    $tipe = $_POST['tipe'];
    $harga = $_POST['harga'];
    $gambar = ''; // Initialize $gambar

    // File upload handling
    $target_dir = "GambarMenu/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        $gambar = $target_file; // Simpan path file gambar ke dalam variabel
    } else {
        echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
    }
    
    // Prepare and bind SQL statement
    $query = "INSERT INTO `menu`(`menu`, `tipe`, `harga`, `gambar`) VALUES ('$menu','$tipe','$harga','$gambar')";
    mysqli_query($conn, $query);
    echo "<script>window.location.href = 'view-manager.php';</script>";
}
?>
