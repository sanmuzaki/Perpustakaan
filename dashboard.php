<?php
session_start();

// Cek apakah sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Perpustakaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: #f1f5f9;
        }
        .navbar {
            background-color: #0077b6;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }
        .container {
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }
        .btn {
            background-color: #0096c7;
            color: white;
            padding: 14px 25px;
            text-decoration: none;
            font-size: 18px;
            border-radius: 8px;
            transition: background 0.3s;
            width: 300px;
            text-align: center;
        }
        .btn:hover {
            background-color: #005f73;
        }
        .logout {
            margin-top: 40px;
            background-color: #ef233c;
        }
        .logout:hover {
            background-color: #d90429;
        }
    </style>
</head>
<body>

<div class="navbar">
    Dashboard Perpustakaan
</div>

<div class="container">
    <a href="daftar_buku.php" class="btn">📚 Lihat Daftar Buku</a>
    <a href="peminjaman_aktif.php" class="btn">📖 Lihat Peminjaman Aktif</a>
    <a href="tambah_buku.php" class="btn">➕ Tambah Buku Baru</a>
    <a href="kelola_anggota.php" class="btn">👥 Kelola Anggota</a>
    <a href="logout.php" class="btn logout">🚪 Logout</a>
</div>

</body>
</html>
