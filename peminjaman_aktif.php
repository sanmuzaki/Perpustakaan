<?php
include 'config.php';

// Jika tombol selesai ditekan
if (isset($_GET['selesai'])) {
    $id_peminjaman = $_GET['selesai'];

    // Ambil ID bukunya dulu
    $query = mysqli_query($conn, "SELECT id_buku FROM peminjaman WHERE id_peminjaman = $id_peminjaman");
    $data = mysqli_fetch_assoc($query);
    $id_buku = $data['id_buku'];

    // Tambah stok buku
    mysqli_query($conn, "UPDATE buku SET stok = stok + 1 WHERE id_buku = $id_buku");

    // Update status menjadi 'selesai', tidak hapus data
    mysqli_query($conn, "UPDATE peminjaman SET status = 'selesai' WHERE id_peminjaman = $id_peminjaman");

    echo "<script>alert('Buku berhasil dikembalikan!'); window.location='peminjaman_aktif.php';</script>";
}

// Ambil data peminjaman aktif (yang masih dipinjam)
$result = mysqli_query($conn, "
    SELECT p.id_peminjaman, b.judul, p.nama_peminjam, p.alamat_peminjam, p.telepon_peminjam, p.tanggal_pinjam, p.tanggal_kembali
    FROM peminjaman p
    JOIN buku b ON p.id_buku = b.id_buku
    WHERE p.status = 'dipinjam'
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Peminjaman Aktif</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            padding: 40px;
        }
        .container {
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #0077b6;
            margin-bottom: 40px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #0077b6;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .btn-selesai {
            background-color: #38b000;
            color: white;
            padding: 8px 14px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .btn-selesai:hover {
            background-color: #70e000;
        }
        .btn-back {
            background-color: #0077b6;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
            display: inline-block;
            margin-bottom: 20px;
        }
        .btn-back:hover {
            background-color: #005f8a;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Tombol Kembali -->
    <a href="dashboard.php" class="btn-back">⬅️ Kembali ke Dashboard</a>

    <h2>📋 Daftar Buku yang Sedang Dipinjam</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Nama Peminjam</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>{$no}</td>
                <td>{$row['judul']}</td>
                <td>{$row['nama_peminjam']}</td>
                <td>{$row['alamat_peminjam']}</td>
                <td>{$row['telepon_peminjam']}</td>
                <td>{$row['tanggal_pinjam']}</td>
                <td>{$row['tanggal_kembali']}</td>
                <td><a class='btn-selesai' href='peminjaman_aktif.php?selesai={$row['id_peminjaman']}'>Selesai</a></td>
            </tr>";
            $no++;
        }
        ?>
    </table>
</div>

</body>
</html>
