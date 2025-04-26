<?php
include 'config.php';

$nama = urldecode($_GET['nama']);

// Ambil semua peminjaman berdasarkan nama_peminjam
$result = mysqli_query($conn, "
    SELECT p.id_peminjaman, b.judul, p.tanggal_pinjam, p.tanggal_kembali
    FROM peminjaman p
    JOIN buku b ON p.id_buku = b.id_buku
    WHERE p.nama_peminjam = '$nama'
");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Peminjaman - <?= htmlspecialchars($nama) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; padding: 40px; }
        .container { max-width: 1000px; margin: auto; background: white; padding: 40px; border-radius: 12px; box-shadow: 0 6px 20px rgba(0,0,0,0.1);}
        h2 { text-align: center; color: #0077b6; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: center; border-bottom: 1px solid #ddd; }
        th { background-color: #0077b6; color: white; }
        tr:hover { background-color: #f1f1f1; }
        .badge-aktif {
            background-color: #38b000;
            color: white;
            padding: 5px 10px;
            border-radius: 8px;
            font-size: 14px;
        }
        .badge-selesai {
            background-color: #6c757d;
            color: white;
            padding: 5px 10px;
            border-radius: 8px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Tombol kembali ke Kelola Anggota -->
    <div style="margin-bottom: 20px;">
        <a href="kelola_anggota.php" style="
            background-color: #0077b6;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
        " onmouseover="this.style.backgroundColor='#005f8a'" onmouseout="this.style.backgroundColor='#0077b6'">
            ⬅️ Kembali ke Kelola Anggota
        </a>
    </div>

    <h2>📖 Riwayat Peminjaman: <?= htmlspecialchars($nama) ?></h2>

    <table>
        <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
        </tr>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            // Cek status aktif atau selesai
            $status = ($row['tanggal_kembali'] >= date('Y-m-d')) ? 
                        "<span class='badge-aktif'>Aktif</span>" : 
                        "<span class='badge-selesai'>Selesai</span>";

            echo "<tr>
                <td>{$no}</td>
                <td>{$row['judul']}</td>
                <td>{$row['tanggal_pinjam']}</td>
                <td>{$row['tanggal_kembali']}</td>
                <td>{$status}</td>
            </tr>";
            $no++;
        }
        ?>
    </table>
</div>

</body>
</html>
