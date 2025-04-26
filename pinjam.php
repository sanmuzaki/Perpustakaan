<?php
include 'config.php';

$id_buku = $_GET['id'];
$buku = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM buku WHERE id_buku = $id_buku"));

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $tgl_pinjam = $_POST['tanggal_pinjam'];
    $tgl_kembali = $_POST['tanggal_kembali'];

    mysqli_query($conn, "INSERT INTO peminjaman (id_buku, nama_peminjam, alamat_peminjam, telepon_peminjam, tanggal_pinjam, tanggal_kembali)
        VALUES ('$id_buku', '$nama', '$alamat', '$telepon', '$tgl_pinjam', '$tgl_kembali')");

    // Kurangi stok
    mysqli_query($conn, "UPDATE buku SET stok = stok - 1 WHERE id_buku = $id_buku");

    echo "<script>alert('Buku berhasil dipinjam!'); window.location='daftar_buku.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pinjam Buku</title>
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4f4f4; padding: 50px; }
        .form-box {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input, label {
            display: block;
            width: 100%;
            margin-bottom: 15px;
        }
        input[type="text"], input[type="date"], input[type="tel"] {
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background: #0077b6;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Tombol Kembali -->
    <div style="margin-bottom: 20px;">
        <a href="dashboard.php" style="
            background-color: #0077b6;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
        " onmouseover="this.style.backgroundColor='#005f8a'" onmouseout="this.style.backgroundColor='#0077b6'">
            ⬅️ Kembali ke Dashboard
        </a>
    </div>

<div class="form-box">
    <h2>Form Peminjaman Buku</h2>
    <p><strong>Judul Buku:</strong> <?= $buku['judul'] ?></p>

    <form method="POST">
        <label>Nama Peminjam</label>
        <input type="text" name="nama" required>

        <label>Alamat Peminjam</label>
        <input type="text" name="alamat" required>

        <label>Telepon Peminjam</label>
        <input type="tel" name="telepon" required>

        <label>Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" required>

        <label>Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali" required>

        <input type="submit" name="submit" value="Pinjam Buku">
    </form>
</div>

</body>
</html>
