<?php
include 'config.php';

// Ambil semua nama peminjam unik
$result = mysqli_query($conn, "SELECT DISTINCT nama_peminjam FROM peminjaman");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Anggota</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4f4f4; padding: 40px; }
        .container { max-width: 800px; margin: auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 6px 20px rgba(0,0,0,0.1);}
        h2 { text-align: center; color: #0077b6; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: center; border-bottom: 1px solid #ddd; }
        th { background: #0077b6; color: white; }
        .btn-lihat {
            background-color: #0077b6;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 6px;
            transition: 0.3s;
        }
        .btn-lihat:hover {
            background-color: #005f8a;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="dashboard.php" style="display:inline-block; margin-bottom:20px; background:#0077b6; color:white; padding:10px 20px; border-radius:8px; text-decoration:none;">⬅️ Kembali ke Dashboard</a>

    <h2>👥 Kelola Anggota</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Anggota</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $nama = htmlspecialchars($row['nama_peminjam']);
            echo "<tr>
                    <td>{$no}</td>
                    <td>{$nama}</td>
                    <td><a class='btn-lihat' href='lihat_peminjaman.php?nama=".urlencode($row['nama_peminjam'])."'>Lihat Riwayat</a></td>
                  </tr>";
            $no++;
        }
        ?>
    </table>
</div>

</body>
</html>
        