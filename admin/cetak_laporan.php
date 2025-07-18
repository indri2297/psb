<?php
require('fpdf/fpdf.php');


require_once 'config.php';
$koneksi = $conn;

// Ambil data pendaftar
$sql = "SELECT * FROM pendaftar ORDER BY nilai_akhir DESC";
$result = $koneksi->query($sql);

// Inisialisasi FPDF
$pdf = new FPDF('L', 'mm', 'A4'); // L = Landscape
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Judul
$pdf->Cell(0, 10, 'Laporan Data Pendaftar - SMA Tunas Bangsa', 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Ln(4);

// Header Tabel
$pdf->SetFillColor(200, 220, 255);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 10, 'No', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Nama', 1, 0, 'C', true);
$pdf->Cell(25, 10, 'NISN', 1, 0, 'C', true);
$pdf->Cell(22, 10, 'Nilai Akhir', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Tanggal Lahir', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Jenis Kelamin', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Asal Sekolah', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Email', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Status', 1, 1, 'C', true);

// Isi Tabel
$pdf->SetFont('Arial', '', 10);
$no = 1;
$kuota = 5;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $status = ($no <= $kuota) ? "Lulus" : "Tidak Lulus";

        $pdf->Cell(10, 8, $no, 1);
        $pdf->Cell(40, 8, $row['nama'], 1);
        $pdf->Cell(25, 8, $row['nisn'], 1);
        $pdf->Cell(22, 8, $row['nilai_akhir'], 1);
        $pdf->Cell(30, 8, $row['tanggal_lahir'], 1);
        $pdf->Cell(30, 8, $row['jenis_kelamin'], 1);
        $pdf->Cell(50, 8, $row['asal_sekolah'], 1);
        $pdf->Cell(40, 8, $row['email'], 1);
        $pdf->Cell(30, 8, $status, 1);
        $pdf->Ln();
        $no++;
    }
} else {
    $pdf->Cell(0, 10, 'Tidak ada data.', 1, 1, 'C');
}

$pdf->Output('I', 'Laporan_Pendaftar.pdf'); // I = inline (buka di browser)
?>
