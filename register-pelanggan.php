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
                width: 300px;
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
        </style>
        <script>
            function validateForm() {
                const phoneInput = document.getElementById('notelepon');
                const phonePattern = /^08\d{12,}$/;

                return true;
            }
        </script>
    </head>
    <body>
        <center>
            <div class="login-container">
                <img src="images/logo-unikom.png" alt="Resto Unikom">
                <h2>Resto Unikom</h2>
                <h3>Login Pelanggan</h3>
                <form action="" method="POST" onsubmit="return validateForm()">
                    <table>
                        <tr>
                            <input type="text" name="nama_pelanggan" placeholder="Nama Lengkap" required>
                        </tr>
                        <tr>
                            <input type="email" id="email" name="email_pelanggan" placeholder="Email" required>
                        </tr>
                        <tr>
                            <input type="password" name="password" placeholder="Password" required>
                        </tr>
                        <tr>
                            <input type="tel" id="notelepon" name="no_handphone" placeholder="No Telepon" pattern="^08\d{8,}$" required>
                        </tr>
                        <tr>
                            <span class="note">Format nomor telepon: 08XXXXXXXXXX</span>
                        </tr>
                        <tr>
                            <button type="submit">Register</button>
                        </tr>
                    </table>
                </form>
                <button onclick="window.location.href='login-pelanggan.php'">Kembali</button>
            </div>
        </center>
    </body>
</html>

<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pelanggan  = $_POST['nama_pelanggan'];
    $email_pelanggan = $_POST['email_pelanggan'];
    $password        = $_POST["password"];
    $no_handphone    = $_POST['no_handphone'];

    $query = "INSERT INTO pelanggan (nama_pelanggan, email_pelanggan, password, no_handphone) VALUES ('$nama_pelanggan', '$email_pelanggan', '$password', '$no_handphone')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Anda Berhasil Daftar, Silakan Login'); window.location.href = 'login-pelanggan.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
