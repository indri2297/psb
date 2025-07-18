<?php
require('fpdf/fpdf.php');


$nama = $_GET['nama'] ?? 'Nama Peserta';
$nisn = $_GET['nisn'] ?? '0000000000';
$asal = $_GET['asal'] ?? 'SMP Asal';
$no_pendaftaran = 'PSB-' . rand(1000, 9999);


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

$pdf->Cell(0,10,'Kartu Pendaftaran Siswa Baru',0,1,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','',12);
$pdf->Cell(50,10,'No. Pendaftaran',0,0);
$pdf->Cell(0,10,': ' . $no_pendaftaran,0,1);
$pdf->Cell(50,10,'Nama Lengkap',0,0);
$pdf->Cell(0,10,': ' . $nama,0,1);
$pdf->Cell(50,10,'NISN',0,0);
$pdf->Cell(0,10,': ' . $nisn,0,1);
$pdf->Cell(50,10,'Asal Sekolah',0,0);
$pdf->Cell(0,10,': ' . $asal,0,1);

$pdf->Ln(20);
$pdf->Cell(0,10,'Harap simpan kartu ini sebagai bukti pendaftaran.',0,1);

$pdf->Output('I', 'kartu-pendaftaran.pdf');
?>
