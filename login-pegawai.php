
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
        .login-container input[type="text"],
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
        <h1>Resto Unikom</h1>
        <h3>Login Pegawai</h3>
        <form action="" method="POST">
        <table>
            <tr>
                <input type="text" name="username" placeholder="Username" required>
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
        <button onclick="window.location.href='login-pelanggan.php'">Login Pelanggan</button>
        </div>
    </center>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connection.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM pegawai WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        session_start();
        while ($row = $result->fetch_assoc()) {
            $_SESSION['id_pegawai'] = $row['id_pegawai']; 
            $_SESSION['nama_pegawai'] = $row['nama_pegawai'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['role'] = $row['role']; 
                        
            switch ($_SESSION['role']) {
                case 'manager':
                    echo "<script>window.location.href='view-manager.php'</script>";
                    break;
                case 'kasir':
                    echo "<script>window.location.href='view-kasir.php'</script>";
                    break;
                case 'pelayan':
                    echo "<script>window.location.href='view-pelayan.php'</script>";
                    break;
                case 'koki':
                    echo "<script>window.location.href='view-koki.php'</script>";
                    break;
            }
        }
    } else {
        echo "<script>alert('Username atau Password Salah'); window.location.href='login-pegawai.php'</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

