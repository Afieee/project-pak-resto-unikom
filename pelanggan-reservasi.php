<?php 
session_start();
if (isset($_SESSION['id_pelanggan']) && isset($_SESSION['nama_pelanggan']) && isset($_SESSION['email_pelanggan']) && isset($_SESSION['no_handphone']) ) {
    $id_pelanggan = $_SESSION['id_pelanggan'];
    $nama_pelanggan = $_SESSION['nama_pelanggan'];
    $email_pelanggan = $_SESSION['email_pelanggan'];
    $no_handphone = $_SESSION['no_handphone'];
    $status = 'menunggu';
} 

// Database connection
$servername = "localhost"; // Ganti dengan nama server Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "restaurant"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengambil data no_meja dari tabel meja
$sql = "SELECT id_meja, no_meja FROM meja";
$result = $conn->query($sql);

// Menyimpan hasil dalam sebuah array
$meja_data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $meja_data[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {    
            background-color: #ffffff;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 700px;
            max-width: 1000px;
        }
        h1 {
            text-align: center;
            color: #333333;
        }
        table {
            width: 100%;
            margin-top: 20px;
        }
        td {
            padding: 10px 0;
        }
        select, input[type="time"], input[type="date"], input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #cccccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .form-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .form-row > * {
            flex: 1;
        }
        .form-row > *:not(:last-child) {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Reservasi Meja</h1>
        <form action="pelanggan-reservasi-confirm.php" method="POST">
            <input type="hidden" name="id_pelanggan" value="<?php echo $id_pelanggan; ?>">
            <input type="hidden" name="nama_pelanggan" value="<?php echo $nama_pelanggan; ?>">
            <input type="hidden" name="email_pelanggan" value="<?php echo $email_pelanggan; ?>">
            <input type="hidden" name="no_handphone" value="<?php echo $no_handphone; ?>">
            <input type="hidden" name="status" value="<?php echo $status; ?>">

            <table>
                <tr>
                    <td>Jumlah Kursi</td>
                    <td>:</td>
                    <td>
                        <select name="jumlah_kursi" required>
                            <option value="">Pilih Jumlah Kursi</option>
                            <?php for ($i = 1; $i <= 8; $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Pilih Meja</td>
                    <td>:</td>
                    <td>
                        <select name="no_meja" id="meja" required>
                            <option value="">Pilih Meja</option>
                            <?php foreach ($meja_data as $meja): ?>
                                <option value="<?php echo $meja['no_meja']; ?>"><?php echo $meja['no_meja']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Pilih Jam</td>
                    <td>:</td>
                    <td>
                        <input type="time" name="jam" required>
                    </td>
                </tr>
                <tr>
                    <td>Pilih Tanggal</td>
                    <td>:</td>
                    <td>
                        <input type="date" id="tanggal" name="tanggal" required>
                    </td>
                </tr>
            </table>

            <button type="submit">Pesan Meja Sekarang</button>
        </form>
    </div>
</body>
</html>
<?php
$conn->close();
?>
