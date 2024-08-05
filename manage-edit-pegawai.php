<?php
include 'connection.php';
if (!isset($_GET['id_pegawai'])) {
    echo "Parameter id_pegawai tidak ditemukan.";
    exit;
}

$id_pegawai = $_GET['id_pegawai'];
$query = "SELECT * FROM pegawai WHERE id_pegawai = $id_pegawai";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pegawai = $_POST['nama_pegawai'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $update_query = "UPDATE pegawai SET nama_pegawai = '$nama_pegawai', username = '$username', password = '$password', role = '$role' WHERE id_pegawai = $id_pegawai";
    
    if (mysqli_query($conn, $update_query)) {
        echo "<script>window.location.href = 'view-manager.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
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
            }

            .login-container img {
                width: 100px;
                margin-bottom: 20px;
            }

            .login-container h2 {
                margin: 0;
                font-size: 24px;
                margin-bottom: 20px;
            }

            .login-container input[type="email"],
            .login-container input[type="text"],
            .login-container input[type="password"],
            .login-container input[type="tel"] {
                width: calc(100% - 20px);
                padding: 10px;
                margin-bottom: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                background-color: #f9f9f9;
                color: #333;
            }

            .login-container button {
                width: 100%;
                padding: 10px;
                border: none;
                border-radius: 5px;
                background-color: #fff;
                color: #333;
                font-size: 16px;
                cursor: pointer;
                margin-bottom: 10px;
                border: 1px solid #ccc;
            }

            .login-container button:hover {
                background-color: #007bff;
                color: #fff;
            }

            .login-container a {
                display: block;
                margin-top: 10px;
                color: #007bff;
                text-decoration: none;
            }

            .login-container a:hover {
                text-decoration: underline;
            }

            .note {
                font-size: 12px;
                color: #777;
            }

            .login-container select[name="role"] {
                width: 100%;
                padding: 10px;
                margin-bottom: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                background-color: #f9f9f9;
                color: #333;
                font-family: 'Poppins', sans-serif;
            }

            .login-container select[name="role"] option {
                padding: 10px;
                color: #333;
                background-color: #fff;
                font-family: 'Poppins', sans-serif;
            }

        </style>
    </head>
    <body>
        <center>
            <div class="login-container">
                <img src="images/logo-unikom.png" alt="Resto Unikom">
                <h3>Tambah Pegawai</h3>
                <form action="" method="POST" onsubmit="return validateForm()">
                    <table>
                        <tr>
                            <input type="text" name="nama_pegawai" id="nama_pegawai" value="<?php echo $row['nama_pegawai']; ?>" />
                        </tr>
                        <tr>
                            <input type="text" name="username" id="username" value="<?php echo $row['username']; ?>">
                        </tr>
                        <tr>
                            <input type="text" name="password" id="password" value="<?php echo $row['password']; ?>"/>
                        </tr>
                        <tr>
                            <select name="role" id="role">
                            <option value="pelayan" <?php if($row['role'] == 'pelayan') echo 'selected'; ?>>Pelayan</option>
                            <option value="koki" <?php if($row['role'] == 'koki') echo 'selected'; ?>>Koki</option>
                            <option value="kasir" <?php if($row['role'] == 'kasir') echo 'selected'; ?>>Kasir</option>
                            </select>
                        </tr>
                    </table>
                    <tr>
                            <button type="submit">Simpan Perubahan</button>
                    </tr>
                </form>
            </div>
        </center>
    </body>
</html>