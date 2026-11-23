<?php

require_once "koneksi.php";

$sql= "SELECT * FROM anggota ORDER BY id DESC";
$hasil= mysqli_query($koneksi, $sql);
$jumlah_data= mysqli_num_rows($hasil);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #1f381f;
        }
        table {
            width: 100%;
            background-color: #f9f9f9;
        }
        th {
            background-color: #1f3864;
            color: #ffffff;
            padding: 10px;
            text-align: left;
            border-bottom: 2px solid #f9f9f9;
        }
        td {
            padding: 10px;
            border-bottom: 2px solid #f9f9f9;
            font-size: 20px;
            background-color: #f9f9f9;
        }
        .pesan-koneksi {
            background-color: #f9f9f9;
            border-left: 6px solid #1f3854;
            color: green;
            padding: 15px;
            width: 330px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Data Anggota</h1>
    <table border>
        <tr>
            <th>Nomor Anggota</th>
            <th>Nama Anggota</th>
            <th>Alamat Email</th>
            <th>Nomor Telepon Seluler</th>
            <th>Jenis Anggota</th>
            <th>Alamat Anggota</th>
            <th>Aksi</th>
        </tr>
        <?php 
        $no = 1; 
        while ($baris = mysqli_fetch_assoc($hasil)) {?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($baris["nama_lengkap"]); ?></td>
            <td><?php echo htmlspecialchars($baris["email"]); ?></td>
            <td><?php echo htmlspecialchars($baris["no_hp"]); ?></td>
            <td><?php echo htmlspecialchars($baris["jenis_anggota"]); ?></td>
            <td><?php echo htmlspecialchars($baris["alamat"]); ?></td>
            
            <td>
                <a href="detail.php?id=<?php echo (int) $baris["id"]; ?>">Detail</a>
                <form class="inline" action="hapus.php" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                    <input type="hidden" name="id" value="<?php echo (int) $baris["id"]; ?>">
                    <button type ="submit">Hapus</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
    
</body>
</html>