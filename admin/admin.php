<?php

require_once 'config.php';
$koneksi = $conn;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin PPDB - SMA Tunas Bangsa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f8fc;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #003366;
            color: white;
            padding: 20px;
            text-align: center;
        }

        nav {
            background-color: #0055aa;
            padding: 10px;
            display: flex;
            justify-content: space-around;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        section {
            padding: 20px;
        }

        .dashboard-box {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .box {
            flex: 1;
            min-width: 200px;
            background: white;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        table, th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        th {
            background-color: #003366;
            color: white;
        }

        .btn {
            padding: 6px 12px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Panel PPDB - SMA Tunas Bangsa</h1>
    </header>

    <nav>
        <a href="#dashboard">Dashboard</a>
        <a href="data.php">Data Pendaftar</a>
        <a href="export_excel.php">Export Excel</a>
        <a href="cetak_laporan.php">Cetak PDF</a>
        <a href="logout.php">Logout</a>
    </nav>

    <section id="dashboard">
        <h2>📊 Dashboard</h2>
        <div class="dashboard-box">
            <div class="box">
                <h3>Total Pendaftar</h3>
                <p><strong>
                    <?php
                    $res = $koneksi->query("SELECT COUNT(*) as total FROM pendaftar");
                    $data = $res->fetch_assoc();
                    echo $data['total'];
                    ?> siswa</strong></p>
            </div>
            <div class="box">
                <h3>Pendaftar Hari Ini</h3>
                <p><strong>
                    <?php
                    $today = date('Y-m-d');
                    $res = $koneksi->query("SELECT COUNT(*) as total FROM pendaftar WHERE DATE(created_at) = '$today'");
                    $data = $res->fetch_assoc();
                    echo $data['total'];
                    ?> siswa</strong></p>
            </div>
        </div>
    </section>
    <section id="data">
        <h2>📋 Data Pendaftar</h2>
        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NISN</th>
                <th>Nilai Akhir</th>
                <th>Asal Sekolah</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            $result = $koneksi->query("SELECT * FROM pendaftar ORDER BY created_at DESC");
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nisn']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['asal_sekolah']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>
                            <a class='btn' href='detail.php?id=" . $row['id'] . "'>Detail</a>
                            <a class='btn' href='hapus.php?id=" . $row['id'] . "' onclick=\"return confirm('Yakin ingin menghapus?');\">Hapus</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Belum ada data pendaftar.</td></tr>";
            }
            ?>
        </table>
    </section>
</body>
</html>
<?php $koneksi->close(); ?>