
<!DOCTYPE html>

<html>
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
            font-family: 'Poppins', sans-serif;
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
        .login-container input[type="password"] {
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
            font-family: 'Poppins', sans-serif;
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
    </style>
<head>
    <title>Login</title>
</head>
<body>
    <center>
        <div class="login-container">
        <img src="images/logo-unikom.png" alt="Resto Unikom">
        <h2>Resto Unikom</h2>
        <h3>Login Pelanggan</h3>
        <form action="" method="POST">
        <table>
            <tr>
                <input type="email" name="email_pelanggan" placeholder="Email" required>
            </tr>
            <tr>
                <input type="password" name="password" placeholder="Password" required>
            </tr>
            <tr>
                <button type="submit">Login</button>
            </tr>
            </table>
        </form>
        <button onclick="window.location.href='register-pelanggan.php'">Register</button>
        <button onclick="window.location.href='login-pegawai.php'">Login Pegawai</button>
        </div>
    </center>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connection.php';

    $email_pelanggan = $_POST['email_pelanggan'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM pelanggan WHERE email_pelanggan = ? AND password = ?");
    $stmt->bind_param("ss", $email_pelanggan, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        session_start();
        while ($row = $result->fetch_assoc()) {
            $_SESSION['id_pelanggan'] = $row['id_pelanggan']; 
            $_SESSION['nama_pelanggan'] = $row['nama_pelanggan'];
            $_SESSION['email_pelanggan'] = $row['email_pelanggan'];
            $_SESSION['no_handphone'] = $row['no_handphone']; 

            echo "<script>alert('Selamat Datang, " . $_SESSION['nama_pelanggan'] . "'); window.location.href = 'pelanggan-profile.php';</script>";
        }
    } else {
        echo "<script>alert('Username atau Password Salah'); window.location.href='login-pelanggan.php'</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
