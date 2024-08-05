<?php
include 'connection.php';
session_start();

// Memeriksa apakah session telah diset dengan benar
if (isset($_SESSION['id_pelanggan'])) {
    $id_pelanggan = $_SESSION['id_pelanggan'];

    // Query data pelanggan berdasarkan id_pelanggan dari session
    $result = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");
    
    // Memeriksa apakah query berhasil dieksekusi
    if ($result) {
        // Memeriksa apakah ada data yang dikembalikan
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Data Pelanggan</title>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMUQNFvpuak7BfRJ7lK9efVX5DZzEd8ukLTQ6i4" crossorigin="anonymous">
                <style>
                    body {
                        font-family: 'Helvetica Neue', Arial, sans-serif;
                        background-color: #f4f4f9;
                        padding: 20px;
                        margin: 0;
                    }
                    .container {
                        max-width: 800px;
                        margin: 0 auto;
                        background: #fff;
                        padding: 20px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        border-radius: 8px;
                    }
                    .profile-header {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        margin-bottom: 20px;
                    }
                    .profile-header svg {
                        margin-right: 10px;
                    }
                    h2 {
                        margin: 0;
                        color: #333;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 20px;
                    }
                    th, td {
                        padding: 15px;
                        text-align: left;
                        border: 1px solid #ddd;
                    }
                    th {
                        background-color: #f7f7f7;
                    }
                    tr:nth-child(even) {
                        background-color: #f9f9f9;
                    }
                    tr:hover {
                        background-color: #f1f1f1;
                    }
                    td:first-child {
                        font-weight: bold;
                        color: #555;
                    }
                    .toggle-btn {
                        background: none;
                        border: none;
                        color: #007bff;
                        cursor: pointer;
                        font-size: 16px;
                        margin-left: 10px;
                    }
                    .toggle-btn:focus {
                        outline: none;
                    }
                    .edit-btn {
                        background-color: #ffc107;
                        color: #fff;
                        border: none;
                        padding: 10px 15px;
                        cursor: pointer;
                        font-size: 16px;
                        border-radius: 5px;
                    }
                    .edit-btn:hover {
                        background-color: #e0a800;
                    }
                    .save-btn {
                        background-color: #28a745;
                        color: #fff;
                        border: none;
                        padding: 10px 15px;
                        cursor: pointer;
                        font-size: 16px;
                        border-radius: 5px;
                    }
                    .save-btn:hover {
                        background-color: #218838;
                    }
                    input[type="text"], input[type="email"], input[type="password"] {
                        width: 100%;
                        padding: 10px;
                        border: 1px solid #ccc;
                        border-radius: 5px;
                        box-sizing: border-box;
                        font-size: 16px;
                        margin-top: 5px;
                        margin-bottom: 15px;
                        transition: border-color 0.3s;
                    }
                    input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus {
                        border-color: #007bff;
                        outline: none;
                    }
                    .input-group {
                        position: relative;
                    }
                    .input-group .toggle-btn {
                        position: absolute;
                        top: 50%;
                        right: 10px;
                        transform: translateY(-50%);
                    }
                </style>
                <script>
                    function togglePasswordVisibility() {
                        var passwordField = document.getElementById("password");
                        var passwordValue = passwordField.value;
                        var toggleIcon = document.getElementById("toggle-icon");
                        if (passwordField.type === "password") {
                            passwordField.type = "text";
                            toggleIcon.classList.remove('fa-eye');
                            toggleIcon.classList.add('fa-eye-slash');
                        } else {
                            passwordField.type = "password";
                            toggleIcon.classList.remove('fa-eye-slash');
                            toggleIcon.classList.add('fa-eye');
                        }
                    }

                    function enableEditing() {
                        var inputs = document.querySelectorAll('.editable');
                        inputs.forEach(input => {
                            input.removeAttribute('disabled');
                        });
                        document.getElementById('save-btn').style.display = 'inline-block';
                    }
                </script>
            </head>
            <body>
                <div class="container">
                    <div class="profile-header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                        </svg>
                        <h2>Profile</h2>
                    </div>
                    <form method="post" action="update-profile.php">
                        <table>
                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td><input type="text" name="nama_pelanggan" value="<?php echo $row['nama_pelanggan']; ?>" class="editable" disabled></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><input type="email" name="email_pelanggan" value="<?php echo $row['email_pelanggan']; ?>" class="editable" disabled></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td>
                                        <div class="input-group">
                                            <input type="password" id="password" name="password" value="<?php echo $row['password']; ?>" class="editable" disabled>
                                            <button type="button" class="toggle-btn" onclick="togglePasswordVisibility()"><i id="toggle-icon" class="fas fa-eye"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>No Handphone</td>
                                    <td><input type="text" name="no_handphone" value="<?php echo $row['no_handphone']; ?>" class="editable" disabled></td>
                                </tr>
                            </tbody>
                        </table>
                        <style>
                            .edit-btn{
                                color: black;
                                margin-top: 10px;
                            }
                            .save-btn{
                                margin-top: 10px;
                            }
                        </style>
                        <center>
                        <button type="button" class="edit-btn" onclick="enableEditing()"> <b>Ubah Profile</b></button>
                        <button type="submit" id="save-btn" class="save-btn" style="display: none;"><b> Save </b></button>
                        </center>
                    </form>
                </div>
            </body>
            </html>
            <?php
        } else {
            echo "Data pelanggan tidak ditemukan.";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Menutup koneksi database
    mysqli_close($conn);
} else {
    // Jika session belum ter-set dengan benar, arahkan kembali ke halaman login
    echo "<script>alert('Anda belum login, mohon login kembali'); window.location.href='login-pelanggan.php'</script>";
    exit;
}
?>
