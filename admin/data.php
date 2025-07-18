<?php

require_once 'config.php';

$kuota = 5; // Ubah sesuai jumlah peserta yang diterima

// Ambil semua data pendaftar dan urutkan berdasarkan nilai akhir
$sql = "SELECT * FROM pendaftar ORDER BY nilai_akhir DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pendaftar Lengkap dengan Status Kelulusan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f5fa;
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: #003366;
        }

        table {
            width: 95%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px #ccc;
        }

        th, td {
            padding: 10px;
            border: 1px solid #bbb;
            text-align: center;
        }

        th {
            background-color: #003366;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f4f9fd;
        }

        .lulus {
            color: green;
            font-weight: bold;
        }

        .tidak-lulus {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2>Data Lengkap Pendaftar Beserta Status Kelulusan</h2>

<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NISN</th>
        <th>Jenis Kelamin</th>
        <th>Tanggal Lahir</th>
        <th>Alamat</th>
        <th>Asal Sekolah</th>
        <th>No HP</th>
        <th>Nilai Akhir</th>
        <th>Status</th>
    </tr>

    <?php
    $no = 1;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $status = ($no <= $kuota) ? "<span class='lulus'>Lulus</span>" : "<span class='tidak-lulus'>Tidak Lulus</span>";

            echo "<tr>
                    <td>{$no}</td>
                    <td>" . htmlspecialchars($row['nama']) . "</td>
                    <td>" . htmlspecialchars($row['nisn']) . "</td>
                    <td>" . htmlspecialchars($row['jenis_kelamin']) . "</td>
                    <td>" . htmlspecialchars($row['tanggal_lahir']) . "</td>
                    <td>" . htmlspecialchars($row['alamat']) . "</td>
                    <td>" . htmlspecialchars($row['asal_sekolah']) . "</td>
                    <td>" . htmlspecialchars($row['no_hp']) . "</td>
                    <td>" . htmlspecialchars($row['nilai_akhir']) . "</td>
                    <td>$status</td>
                </tr>";
            $no++;
        }
    } else {
        echo "<tr><td colspan='10'>Belum ada data pendaftar.</td></tr>";
    }
    ?>
</table>

</body>
</html>
