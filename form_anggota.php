<?php

$status = isset($_GET['status']) ? $_GET['status']: '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Anggota</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        h1 {
            color: #1f3864;
        }
        label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
        }
        label.pilihan {
            display: block;
            margin-top: 12px;
            font-weight: normal;
            margin-right: 16px;
        }
        input {
            [type="text"], select, textarea {
                width: 320px;
                padding: 6px;
            }
        }
        button {
            margin-top: 16px;
            padding: 8px 20px;
        }
        .sukses {
            background-color: #e6f4ea;
            border-left: 5px solid #2e7d32;
            padding: 10px;
            width: 320px;
        }
    </style>
</head>
<body>
    <h1>Form Pendaftaran Anggota Perpustakaan</h1>

    <?php if ($status === 'success') { ?>
        <p class= "sukses">Data berhasil disimpan ke database.</p>
    <?php } ?>

    <form action="proses_anggota.php" method="POST">
        <label for="no_anggota">Nomor Anggota:</label>
            <input type="text" name="no_anggota" id="no_anggota">
        
        <label for="nama_lengkap">Nama Anggota:</label>
            <input type="text" name="nama_lengkap" id="nama_lengkap">
        
        <label for="email">Alamat Email:</label>
            <input type="text" name="email" id="email">
        
        <label for="no_hp">Nomor Telepon Seluler:</label>
            <input type="text" name="no_hp" id="no_hp">
        
        <label>Jenis Anggota:</label>
            <select name="jenis_anggota" id="jenis_anggota">
                <option value="">-- Pilih Jenis Anggota --</option>
                <option value="Mahasiswa">Mahasiswa</option>
                <option value="Dosen">Dosen</option>
                <option value="Tenaga Kependidikan">Tenaga Kependidikan</option>
        </select>

        <label for="alamat">Alamat anggota:</label>
            <textarea name="alamat" id="alamat" rows="4"></textarea>

            <button type="submit">Daftar</button>
    </form>
</body>
</html>