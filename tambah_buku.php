<?php
session_start();
include 'config.php';

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Cek saat tombol submit ditekan
if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $stok = $_POST['stok'];

    // Masukkan data ke database
    $query = "INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, stok) 
              VALUES ('$judul', '$penulis', '$penerbit', '$tahun_terbit', '$stok')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Buku berhasil ditambahkan!'); window.location='daftar_buku.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan buku.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku Baru</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f1f5f9;
            margin: 0;
            padding: 40px;
        }
        .container {
            max-width: 500px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #0077b6;
        }
        form {
            margin-top: 20px;
        }
        input, button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        button {
            background-color: #0077b6;
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background-color: #005f73;
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

<div class="container">
    <h2>Tambah Buku Baru</h2>

    <form method="POST" action="">
        <input type="text" name="judul" placeholder="Judul Buku" required>
        <input type="text" name="penulis" placeholder="Penulis" required>
        <input type="text" name="penerbit" placeholder="Penerbit" required>
        <input type="number" name="tahun_terbit" placeholder="Tahun Terbit" required>
        <input type="number" name="stok" placeholder="Jumlah Stok" required>
        <button type="submit" name="submit">Tambah Buku</button>
    </form>
</div>

</body>
</html>
