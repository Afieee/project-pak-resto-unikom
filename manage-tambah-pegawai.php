<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pegawai</title>
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
            width: 700px;
            max-width: 1000px;
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

        .login-container input[type="text"],
        .login-container input[type="password"],
        .login-container select[name="role"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            color: #333;
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }

        .login-container .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .login-container .button-container button {
            width: calc(50% - 5px);
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .login-container .button-container button:nth-child(1) {
            background-color: #28a745;
            color: #fff;
            border: 1px solid #28a745;
        }

        .login-container .button-container button:nth-child(2) {
            background-color: #dc3545;
            color: #fff;
            border: 1px solid #dc3545;
        }

        .login-container button:hover {
            opacity: 0.8;
        }

        .login-container .back-button {
            margin-top: 20px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        .login-container .back-button:hover {
            opacity: 0.8;
        }

        .note {
            font-size: 12px;
            color: #777;
        }

        @media (max-width: 600px) {
            .login-container {
                padding: 10px;
            }
        }
    </style>
    <script>
        function validateForm() {
            const phoneInput = document.getElementById('notelepon');
            const phonePattern = /^08\d{12,}$/;
            if (!phonePattern.test(phoneInput.value)) {
                alert('Nomor telepon harus dimulai dengan "08" dan hanya terdiri dari angka.');
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <center>
        <div class="login-container">
            <img src="images/logo-unikom.png" alt="Resto Unikom">
            <h3>Tambah Pegawai</h3>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                include "connection.php";

                $nama_pegawai = $_POST['nama_pegawai'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $role = $_POST['role'];

                // Validate inputs
                if (!empty($nama_pegawai) && !empty($username) && !empty($password) && !empty($role)) {
                    // Prepare and execute the insert query
                    $query = "INSERT INTO pegawai (nama_pegawai, username, password, role) VALUES (?, ?, ?, ?)";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("ssss", $nama_pegawai, $username, $password, $role);

                    if ($stmt->execute()) {
                        echo "<script>alert('Pegawai berhasil ditambahkan.'); window.location.href = 'view-manager.php';</script>";
                    } else {
                        echo "<script>alert('Terjadi kesalahan saat menambahkan pegawai.');</script>";
                    }

                    $stmt->close();
                } else {
                    echo "<script>alert('Mohon lengkapi semua data.');</script>";
                }

                $conn->close();
            }
            ?>
            <form action="manage-tambah-pegawai.php" method="POST" onsubmit="return validateForm()">
                <table style="margin: 0 auto;">
                    <tr>
                        <td><input type="text" name="nama_pegawai" placeholder="Nama Pegawai" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="username" placeholder="Username" required></td>
                    </tr>
                    <tr>
                        <td><input type="password" name="password" placeholder="Password" required></td>
                    </tr>
                    <tr>
                        <td>
                            <select name="role" id="role">
                                <option value="pelayan">Pelayan</option>
                                <option value="koki">Koki</option>
                                <option value="kasir">Kasir</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="button-container">
                            <button type="submit">Tambah</button>
                            <button type="button" onclick="window.location.href = 'view-manager.php'">Kembali</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </center>
</body>
</html>
