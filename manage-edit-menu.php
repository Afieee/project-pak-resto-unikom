<?php
include 'connection.php';

if (!isset($_GET['id_menu'])) {
    echo "Parameter id_menu tidak ditemukan.";
    exit;
}

$id_menu = $_GET['id_menu'];
$query = "SELECT * FROM menu WHERE id_menu = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $id_menu);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $menu = $_POST['menu'];
        $tipe = $_POST['tipe'];
        $harga = $_POST['harga'];
        $status = $_POST['status']; // Get the status from the form
        
        // Debugging status value
        var_dump($status);

        $gambar = $row['gambar']; // Default to existing image

        if (!empty($_FILES['gambar']['name'])) {
            $target_dir = "GambarMenu/";
            $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
            $check = getimagesize($_FILES["gambar"]["tmp_name"]);
            if ($check !== false) {
                if ($_FILES["gambar"]["size"] > 5000000) {
                    echo "Sorry, your file is too large.";
                    exit;
                } else {
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        exit;
                    } else {
                        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                            $gambar = $target_file;
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                            exit;
                        }
                    }
                }
            } else {
                echo "File is not an image.";
                exit;
            }
        }

        if (!empty($_FILES['gambar']['name'])) {
            $update_query = "UPDATE menu SET menu = ?, tipe = ?, harga = ?, gambar = ?, status = ? WHERE id_menu = ?";
            $update_stmt = mysqli_prepare($conn, $update_query);
            mysqli_stmt_bind_param($update_stmt, 'ssdssi', $menu, $tipe, $harga, $gambar, $status, $id_menu);
        } else {
            $update_query = "UPDATE menu SET menu = ?, tipe = ?, harga = ?, status = ? WHERE id_menu = ?";
            $update_stmt = mysqli_prepare($conn, $update_query);
            mysqli_stmt_bind_param($update_stmt, 'ssdis', $menu, $tipe, $harga, $status, $id_menu);
        }

        if (mysqli_stmt_execute($update_stmt)) {
            echo "<script>window.location.href = 'view-manager.php';</script>";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
} else {
    echo "No menu item found with the provided id.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Menu</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

        body {
            background-color: #f0f0f0;
            font-family: 'Poppins', sans-serif;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px #aaa;
            text-align: center;
            width: 100%;
            max-width: 400px; /* Optional: Limit width for better readability */
        }

        .login-container img {
            width: 100px;
            margin-bottom: 20px;
        }

        .login-container h3 {
            margin: 0;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .login-container input,
        .login-container select {
            width: calc(100% - 20px);
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            color: #333;
            font-size: 16px;
            box-sizing: border-box;
        }

        .login-container input[type='file'] {
            padding: 10px;
        }

        .login-container button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 10px;
            transition: background-color 0.3s ease;
        }

        .login-container button:hover {
            background-color: #0056b3;
        }

        .login-container .btn-back {
            display: inline-block;
            text-decoration: none;
            background-color: #dc3545; /* Warna merah */
            color: #fff;
            padding: 12px 20px;
            border-radius: 5px;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .login-container .btn-back:hover {
            background-color: #c82333; /* Warna merah lebih gelap saat hover */
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="images/logo-unikom.png" alt="Resto Unikom">
        <h3>Edit Menu</h3>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="menu" value="<?php echo htmlspecialchars($row['menu']); ?>" placeholder="Nama Menu" required>
            <select name="tipe" required>
                <option value="makanan" <?php if($row['tipe'] == 'makanan') echo 'selected'; ?>>Makanan</option>
                <option value="minuman" <?php if($row['tipe'] == 'minuman') echo 'selected'; ?>>Minuman</option>
            </select>
            <input type="number" name="harga" value="<?php echo htmlspecialchars($row['harga']); ?>" placeholder="Harga" required>
            <select name="status" required>
                <option value="tersedia" <?php if($row['status'] == 'tersedia') echo 'selected'; ?>>Tersedia</option>
                <option value="tidak tersedia" <?php if($row['status'] == 'tidak tersedia') echo 'selected'; ?>>Tidak Tersedia</option>
            </select>
            <input type="file" name="gambar" accept="image/*">
            <button type="submit">Simpan Perubahan</button>
        </form>
        <a href="view-manager.php" class="btn-back">Kembali</a>
    </div>
</body>
</html>