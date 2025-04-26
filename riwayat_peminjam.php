<?php
include 'config.php';

// Jika tombol hapus ditekan
if (isset($_GET['hapus'])) {
    $id_peminjaman = $_GET['hapus'];

    // Hapus riwayat berdasarkan ID
    mysqli_query($conn, "DELETE FROM peminjaman WHERE id_peminjaman = $id_peminjaman");

    echo "<script>alert('Riwayat berhasil dihapus!'); window.location='riwayat_peminjaman.php';</script>";
}

// Ambil data peminjaman yang sudah selesai
$result = mysqli_query($conn, "
    SELECT p.id_peminjaman, b.judul, p.nama_peminjam, p.alamat_peminjam, p.telepon_peminjam, p.tanggal_pinjam, p.tanggal_kembali
    FROM peminjaman p
    JOIN buku b ON p.id_buku = b.id_buku
    WHERE p.status = 'selesai'
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Peminjaman</title>
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
        .btn-hapus {
            background-color: #d90429;
            color: white;
            padding: 8px 14px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .btn-hapus:hover {
            background-color: #ef233c;
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

    <h2>📚 Riwayat Peminjaman Buku</h2>

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
                <td><a class='btn-hapus' href='riwayat_peminjaman.php?hapus={$row['id_peminjaman']}' onclick=\"return confirm('Yakin ingin menghapus riwayat ini?')\">Hapus</a></td>
            </tr>";
            $no++;
        }
        ?>
    </table>
</div>

</body>
</html>
