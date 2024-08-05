<?php
include 'connection.php';
require('fpdf186/fpdf.php');

session_start();
if (isset($_SESSION['id_pegawai']) && isset($_SESSION['nama_pegawai']) && isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])) {
    $id_pegawai = $_SESSION['id_pegawai'];
    $nama_pegawai = $_SESSION['nama_pegawai'];
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $role = $_SESSION['role'];
} else {
    echo "<script>alert('Anda belum login, mohon login kembali'); window.location.href='login-pelanggan.php'</script>";
    exit;
}

if (!isset($_GET['id_pesanan'])) {
    echo "<p>Transaksi ID tidak tersedia.</p>";
    exit;
}

$id_pesanan = $_GET['id_pesanan'];

$query_items = "SELECT ti.*, m.menu, m.gambar FROM transaksi_items ti 
                JOIN menu m ON ti.id_menu = m.id_menu 
                WHERE ti.id_pesanan = $id_pesanan";
$result_items = mysqli_query($conn, $query_items);
if (!$result_items) {
    die("Error: " . mysqli_error($conn));
}

function formatRupiah($angka)
{
    return 'Rp ' . number_format($angka, 0, ',', '.') . '.00';
}

// Initialize $status_pembayaran
$status_pembayaran = '';

// Handle form submission to update status pembayaran
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pesanan = $_POST['id_pesanan'];
    $status_pembayaran = $_POST['status_pembayaran'];

    $update_query = "UPDATE transaksi_items SET status_pembayaran = '$status_pembayaran' WHERE id_pesanan = $id_pesanan";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        // Jika status pembayaran menjadi 'dibayar', redirect ke halaman view-kasir.php
        if ($status_pembayaran == 'dibayar') {
            echo "<script>alert('Status pembayaran berhasil diupdate'); window.location.href='view-kasir.php';</script>";
            exit;
        } else {
            echo "<script>alert('Status pembayaran berhasil diupdate');</script>";
        }
    } else {
        echo "<script>alert('Gagal mengupdate status pembayaran: " . mysqli_error($conn) . "');</script>";
    }
}

// Handle PDF generation
if (isset($_GET['action']) && $_GET['action'] == 'pdf') {
    class PDF extends FPDF
    {
        function Header()
        {
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(0, 10, 'Detail Pesanan', 0, 1, 'C');
            $this->Ln(10);
        }

        function Footer()
        {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
        }

        function FancyTable($header, $data, $total_harga)
        {
            $this->SetFont('Arial', '', 12);
            $w = array(80, 40, 30, 40); // Adjust column widths

            // Table header
            $this->SetFillColor(200, 200, 200);
            $this->SetTextColor(0);
            $this->SetDrawColor(0, 0, 0);
            $this->SetLineWidth(.3);
            foreach ($header as $i => $col) {
                $this->Cell($w[$i], 10, $col, 1, 0, 'C', true);
            }
            $this->Ln();

            // Table body
            $this->SetFillColor(240, 240, 240);
            $this->SetTextColor(0);
            $fill = false;
            foreach ($data as $row) {
                $this->Cell($w[0], 10, $row[0], 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 10, $row[1], 'LR', 0, 'R', $fill);
                $this->Cell($w[2], 10, $row[2], 'LR', 0, 'C', $fill);
                $this->Cell($w[3], 10, $row[3], 'LR', 0, 'R', $fill);
                $this->Ln();
                $fill = !$fill;
            }
            $this->Cell(array_sum($w), 0, '', 'T');
            $this->Ln();

            // Total
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(array_sum($w) - $w[3], 10, 'Total Harga', 1, 0, 'R', true);
            $this->Cell($w[3], 10, formatRupiah($total_harga), 1, 0, 'R', true);
        }
    }

    $pdf = new PDF();
    $pdf->SetFont('Arial', '', 12);
    $pdf->AddPage();

    $header = array('Nama Item', 'Harga', 'Jumlah', 'Total'); // Updated header (without Gambar)
    $data = array();
    $total_harga = 0;

    if ($result_items && mysqli_num_rows($result_items) > 0) {
        while ($item = mysqli_fetch_assoc($result_items)) {
            $total_item = $item['harga'] * $item['jumlah'];
            $total_harga += $total_item;
            $data[] = array($item['menu'], formatRupiah($item['harga']), $item['jumlah'], formatRupiah($total_item)); // Updated data (without Gambar)
        }
    }

    $pdf->FancyTable($header, $data, $total_harga);
    $pdf->Output();
    exit;
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Lihat Pesanan</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .receipt-container {
            width: 700px;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: none;
        }

        th, td {
            padding: 5px;
            text-align: left;
        }

        th {
            font-weight: bold;
        }

        .menu-img {
            width: 50px;
            height: auto;
        }

        .total {
            font-weight: bold;
        }

        .back-button, .pdf-button {
            width: 100%;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 0;
            text-align: center;
            text-decoration: none;
            display: block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }

        .back-button:hover, .pdf-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <table>
            <input type="hidden" value="<?php echo $id_pesanan; ?>">
            <tr>
                <th>Gambar</th>
                <th>Nama Item</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Tanggal</th> <!-- Tambahkan header Tanggal -->
                <th>Total</th>
            </tr>
            <?php
            $total_harga = 0;
            if ($result_items && mysqli_num_rows($result_items) > 0) {
                while ($item = mysqli_fetch_assoc($result_items)) {
                    $total_item = $item['harga'] * $item['jumlah'];
                    $total_harga += $total_item;
                    echo "<tr>
                            <td><img src='{$item['gambar']}' alt='{$item['menu']}' class='menu-img'></td>
                            <td>{$item['menu']}</td>
                            <td>" . formatRupiah($item['harga']) . "</td>
                            <td>{$item['jumlah']}</td>
                            <td>{$item['tanggal']}</td> <!-- Tampilkan tanggal -->
                            <td>" . formatRupiah($total_item) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Tidak ada item pesanan untuk ditampilkan.</td></tr>";
            }
            ?>
            <tr>
                <td colspan="5" class="total">Total Harga</td>
                <td class="total"><?php echo formatRupiah($total_harga); ?></td>
            </tr>
        </table>
        <button class="back-button" onclick='window.location.href="view-manager.php"'>Kembali</button>
        <button class="pdf-button" onclick='window.location.href="manage-lihat-id-bon.php?id_pesanan=<?php echo $id_pesanan; ?>&action=pdf"'>Print PDF</button>
    </div>
</body>

</html>
<?php
mysqli_close($conn);
?>