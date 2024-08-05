<?php
include 'connection.php';
$result = mysqli_query($conn, "SELECT * FROM reservasi");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMUQNFvpuak7BfRJ7lK9efVX5DZzEd8ukLTQ6i4" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
            margin: 0;
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .card {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
            width: 30%;
            min-width: 300px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .card-body {
            padding: 15px;
        }
        .card-footer {
            padding: 15px;
            border-top: 1px solid #ddd;
            background-color: #f8f9fa;
        }
        .card-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }
        .card p {
            margin: 10px 0;
            color: #333;
        }
        select {
            padding: 8px 12px;
            margin-right: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            background-color: #fff;
            transition: border-color 0.3s ease;
        }
        select:focus {
            border-color: #007bff;
            outline: none;
        }
        button {
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
    </style>
</head>
<body>
    <h1>Daftar Reservasi</h1>
    <div class="container">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['status'] != 'diterima' && $row['status'] != 'ditolak') { ?>
                <div class="card">
                    <div class="card-header">
                        Nama Pelanggan : <?php echo $row['nama_pelanggan']; ?>
                    </div>
                    <div class="card-body">
                        <p><strong>Tanggal:</strong> <?php echo $row['tanggal']; ?></p>
                        <p><strong>Jam:</strong> <?php echo $row['jam']; ?></p>
                        <p><strong>Email:</strong> <?php echo $row['email_pelanggan']; ?></p>
                        <p><strong>No Handphone:</strong> <?php echo $row['no_handphone']; ?></p>
                        <p><strong>No Meja:</strong> <?php echo $row['no_meja']; ?></p>
                        <p><strong>Jumlah Kursi:</strong> <?php echo $row['jumlah_kursi']; ?> Kursi</p>
                    </div>
                    <div class="card-footer">
                        <form action="pelayan-reservasi-update.php" method="POST">
                            <select name="status">
                                <option value="menunggu" <?php if ($row['status'] == 'menunggu') echo 'selected'; ?>>Menunggu</option>
                                <option value="diterima" <?php if ($row['status'] == 'diterima') echo 'selected'; ?>>Terima</option>
                                <option value="ditolak" <?php if ($row['status'] == 'ditolak') echo 'selected'; ?>>Tolak</option>
                            </select>
                            <input type="hidden" name="id_reservasi" value="<?php echo $row['id_reservasi']; ?>">
                            <input type="hidden" name="email_pelanggan" value="<?php echo $row['email_pelanggan']; ?>">
                            <button type="submit">Beritahu</button>
                        </form>
                    </div>
                </div>
        <?php }
        } ?>
    </div>
</body>
</html>
<?php mysqli_close($conn); ?>
