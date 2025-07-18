<?php

require_once 'config.php';

$sql = "SELECT nama, nisn, nilai_akhir FROM pendaftar ORDER BY nilai_akhir DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ranking Siswa</title>
    <style> 
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #d9e4f5, #f1f5fc);
        }

        header {
            background-color: #003366;
            color: white;
            padding: 20px;  
            text-align: center;
        }

        table {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #666;
            text-align: center;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>SMA TUNAS BANGSA</h2>
    <h2>Daftar Ranking Pendaftar Berdasarkan Nilai Akhir</h2>
    <table>
        <tr>
            <th>Ranking</th>
            <th>Nama</th>
            <th>NISN</th>
            <th>Nilai</th>
            <th>Status Kelulusan</th>
        </tr>
        <?php
        $ranking = 1;
        $kuota = 5; 
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $status = ($ranking <= $kuota) ? 'Lulus' : 'Tidak Lulus';
                echo "<tr>
                        <td>" . $ranking . "</td>
                        <td>" . htmlspecialchars($row["nama"]) . "</td>
                        <td>" . htmlspecialchars($row["nisn"]) . "</td>
                        <td>" . htmlspecialchars($row["nilai_akhir"]) . "</td>
                        <td>" . $status . "</td>
                      </tr>";
                $ranking++;
            }
        } else {
            echo "<tr><td colspan='5'>Belum ada data pendaftaran.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
