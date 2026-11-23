<?php
// Halaman khusus dibuka melalui pengiriman form (POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: form_anggota.php');
    exit();
}

// 1. Ambil data dan bersihkan spasi kosong di awal dan akhir
$no_anggota = isset($_POST['no_anggota']) ? trim($_POST['no_anggota']) : '';
$nama_lengkap = isset($_POST['nama_lengkap']) ? trim($_POST['nama_lengkap']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$no_hp = isset($_POST['no_hp']) ? trim($_POST['no_hp']) : '';
$jenis_anggota = isset($_POST['jenis_anggota']) ? trim($_POST['jenis_anggota']) : '';
$alamat = isset($_POST['alamat']) ? trim($_POST['alamat']) : '';

// 2. Validasi di sisi server (dilakukan pada setiap data yang diterima)
$daftar_anggota = array (
    'no_anggota' => $no_anggota,
    'nama_lengkap' => $nama_lengkap,
    'email' => $email,
    'no_hp' => $no_hp,
    'jenis_anggota' => $jenis_anggota,
    'alamat' => $alamat
);

if (empty($no_anggota)) {
    $error_message[] = "Nomor anggota tidak boleh kosong.";
} else if(strlen($no_anggota) > 10) {
    $error_message[] = "Nomor anggota tidak boleh lebih dari 10 karakter.";
}

if (empty($nama_lengkap)) {
    $error_message[] = "Nama lengkap tidak boleh kosong.";
} else if(strlen($nama_lengkap) > 50) {
    $error_message[] = "Nama lengkap tidak boleh lebih dari 50 karakter.";
}

if (empty($email)) {
    $error_message[] = "Email tidak boleh kosong.";
} else if(strlen($email) > 50) {
    $error_message[] = "Email tidak boleh lebih dari 50 karakter.";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_message[] = "Format email tidak valid.";
}

if (empty($no_hp)) {
    $error_message[] = "Nomor HP tidak boleh kosong.";
} else if(strlen($no_hp) > 15) {
    $error_message[] = "Nomor HP tidak boleh lebih dari 15 karakter.";
}

if (empty($jenis_anggota)) {
    $error_message[] = "Jenis anggota tidak boleh kosong.";
} else if(strlen($jenis_anggota) > 20) {
    $error_message[] = "Jenis anggota tidak boleh lebih dari 20 karakter.";
}

if (empty($alamat)) {
    $error_message[] = "Alamat tidak boleh kosong.";
} else if(strlen($alamat) > 100) {
    $error_message[] = "Alamat tidak boleh lebih dari 100 karakter.";
}

// 3. Apabila semua data valid, lanjutkan ke proses penyimpanan ke database
$berhasil = false;
$pesan_db = '';
if (empty($error_message)) {
    // Memanggil file koneksi
    require_once "koneksi.php";

    // 4. Menyimpan data ke database
    $sql = "INSERT INTO anggota (no_anggota, nama_lengkap, email, no_hp, jenis_anggota, alamat) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssss", $no_anggota, $nama_lengkap, $email, $no_hp, $jenis_anggota, $alamat);
        if (mysqli_stmt_execute($stmt)) {
            $berhasil = true;
        } else {
            $pesan_db = "Gagal menyimpan data: " . mysqli_error($koneksi);
        }
        mysqli_stmt_close($stmt);
    } else {
        $pesan_db = "Gagal menyiapkan statement: " . mysqli_error($koneksi);
    }
    mysqli_close($koneksi);

    // 4. Apabila berhasil, kembali ke form_anggota.php dengan notifikasi
    if ($berhasil) {
        header("Location: form_anggota.php?status=success");
        exit();
    } else {
        $error_message[] = $pesan_db;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Penyimpanan Data</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 40px; 
        }
        h1 { 
            color: #1f3864; 
        }
        .gagal { 
            background: #fdecea; 
            border-left: 5px solid #c0392b; 
            padding: 10px; 
        }
    </style>
</head>
<body>
    <?php if (!empty($error_message)) { ?>
        <h1>Data Tidak Valid</h1>
        <p class="gagal">Data belum dapat disimpan ke database. Perbaiki kesalahan berikut:</p>
            <ul>
                <?php foreach ($error_message as $pesan) { ?>
                    <li><?php echo htmlspecialchars($pesan); ?></li>
                <?php } ?>
            </ul>

    <?php } else { ?>
        <h1>Data Gagal Disimpan</h1>
        <p class="gagal">Terjadi kesalahan saat menyimpan data ke database.</p>
        <p>Pesan dari MySQL: <?php echo htmlspecialchars($pesan_db); ?></p>

        <?php } ?>
        
    <p><a href="form_anggota.php">Kembali ke Form Pendaftaran Anggota dan Perbaiki Data</a></p>
</body>
</html>