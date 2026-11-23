<?php

require_once "koneksi.php";

$versi_server = mysqli_get_server_info($koneksi);
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Koneksi Database</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        h1 {
            color: #1f3864;
        }
        .sukses {
            color: green;
            font-weight: bold;
        }
        table {
            margin-top: 16px;
            border-collapse: collaps;
        }
        td {
            padding: 4px 8px;
        }
    </style>
</head>
<body>
    <h1>Test Koneksi Database</h1>
    <p class= "sukses">Koneksi ke database berhasil!</p>

    <table>
        <tr>
            <td>Host:</td>
            <td><?php echo htmlspecialchars($host); ?></td>
        </tr>
        <tr>
            <td>Database:</td>
            <td><?php echo htmlspecialchars($database); ?></td>
        </tr>
        <tr>
            <td>Versi Server:</td>
            <td><?php echo htmlspecialchars($versi_server); ?></td>
        </tr>
    </table>
</body>
</html>