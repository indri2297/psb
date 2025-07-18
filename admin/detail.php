<?php

require_once 'config.php';

$id = $_GET['id'] ?? 0;
$kuota = 5; // Jumlah yang diterima

// Ambil semua data peserta untuk menentukan ranking
$sql = "SELECT id, nama, nisn, nilai_akhir FROM pendaftar ORDER BY nilai_akhir DESC";
$result = $conn->query($sql);

$ranking = 1;
$status_kelulusan = 'Tidak Ditemukan';
$data_peserta = null;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['id'] == $id) {
            $data_peserta = $row;
            $status_kelulusan = ($ranking <= $kuota) ? 'Lulus' : 'Tidak Lulus';
            break;
        }
        $ranking++;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Pendaftar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f8fb;
            padding: 40px;
        }

        .card {
            width: 500px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #003366;
        }

        table {
            width: 100%;
            font-size: 16px;
        }

        td {
            padding: 8px 0;
        }

        .label {
            font-weight: bold;
            width: 40%;
        }

        .back {
            text-align: center;
            margin-top: 30px;
        }

        .back a {
            background-color: #003366;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 6px;
        }

        .status-lulus {
            color: green;
            font-weight: bold;
        }

        .status-tidak {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Detail Pendaftar</h2>

        <?php if ($data_peserta): ?>
            <table>
                <tr>
                    <td class="label">Nama</td>
                    <td><?= htmlspecialchars($data_peserta['nama']) ?></td>
                </tr>
                <tr>
                    <td class="label">NISN</td>
                    <td><?= htmlspecialchars($data_peserta['nisn']) ?></td>
                </tr>
                <tr>
                    <td class="label">Nilai Akhir</td>
                    <td><?= htmlspecialchars($data_peserta['nilai_akhir']) ?></td>
                </tr>
                <tr>
                    <td class="label">Ranking</td>
                    <td><?= $ranking ?></td>
                </tr>
                <tr>
                    <td class="label">Status Kelulusan</td>
                    <td>
                        <?php if ($status_kelulusan == 'Lulus'): ?>
                            <span class="status-lulus"><?= $status_kelulusan ?></span>
                        <?php else: ?>
                            <span class="status-tidak"><?= $status_kelulusan ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        <?php else: ?>
            <p>Data tidak ditemukan atau ID tidak valid.</p>
        <?php endif; ?>

        <div class="back">
            <a href="admin.php">← Kembali ke Daftar</a>
        </div>
    </div>
</body>
</html>
