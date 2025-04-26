<?php
include 'config.php';

$query = "SELECT * FROM buku";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Buku</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #f8f9fa, #e0e0e0);
            padding: 40px;
        }
        .container {
            max-width: 1000px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #0077b6;
            margin-bottom: 25px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 12px;
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
        .btn-pinjam {
            background-color: #00b4d8;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .btn-pinjam:hover {
            background-color: #0096c7;
            transform: scale(1.05);
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
    <h2>📚 Daftar Buku Perpustakaan</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>{$no}</td>
                <td>{$row['judul']}</td>
                <td>{$row['penulis']}</td>
                <td>{$row['penerbit']}</td>
                <td>{$row['tahun_terbit']}</td>
                <td>{$row['stok']}</td>
                <td><a class='btn-pinjam' href='pinjam.php?id={$row['id_buku']}'>Pinjam</a></td>
            </tr>";
            $no++;
        }
        ?>
    </table>
</div>

</body>
</html>
