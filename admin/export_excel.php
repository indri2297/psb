<?php

require_once 'config.php';
$koneksi = $conn;

// Header untuk download file Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_pendaftar.xls");

// Ambil data dan urutkan berdasarkan nilai
$sql = "SELECT * FROM pendaftar ORDER BY nilai_akhir DESC";
$result = $koneksi->query($sql);

$kuota = 5;
$no = 1;

echo "<table border='1'>";
echo "<tr>
        <th>No</th>
        <th>Nama</th>
        <th>NISN</th>
        <th>Nilai Akhir</th>
        <th>Jenis Kelamin</th>
        <th>Tanggal Lahir</th>
        <th>Asal Sekolah</th>
        <th>Email</th>
        <th>Status Kelulusan</th>
      </tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $status = ($no <= $kuota) ? "Lulus" : "Tidak Lulus";

        echo "<tr>
                <td>{$no}</td>
                <td>" . htmlspecialchars($row['nama']) . "</td>
                <td>" . htmlspecialchars($row['nisn']) . "</td>
                <td>" . htmlspecialchars($row['nilai_akhir']) . "</td>
                <td>" . htmlspecialchars($row['jenis_kelamin']) . "</td>
                <td>" . htmlspecialchars($row['tanggal_lahir']) . "</td>
                <td>" . htmlspecialchars($row['asal_sekolah']) . "</td>
                <td>" . htmlspecialchars($row['email']) . "</td>
                <td>{$status}</td>
              </tr>";
        $no++;
    }
} else {
    echo "<tr><td colspan='7'>Tidak ada data pendaftar.</td></tr>";
}
echo "</table>";
?>
