<?php

require_once 'config.php';

// Ambil data dari form
$nama           = $_POST['nama'];
$nisn           = $_POST['nisn'];
$nilai_akhir    = $_POST['nilai_akhir'];
$tanggal_lahir  = $_POST['tanggal_lahir'];
$jenis_kelamin  = $_POST['jenis_kelamin'];
$asal_sekolah   = $_POST['asal_sekolah'];
$alamat         = $_POST['alamat'];
$no_hp          = $_POST['no_hp'];
$email          = $_POST['email'];

// Query insert
$sql = "INSERT INTO pendaftar (nama, nisn, nilai_akhir, tanggal_lahir, jenis_kelamin, asal_sekolah, alamat, no_hp, email)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Gunakan prepared statement untuk keamanan
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssss", $nama, $nisn, $nilai_akhir, $tanggal_lahir, $jenis_kelamin, $asal_sekolah, $alamat, $no_hp, $email);

if ($stmt->execute()) {
    echo "
    <html>
    <head>
      <meta charset='UTF-8'>
      <title>Pendaftaran Berhasil</title>
      <style>
        body {
          font-family: 'Segoe UI', sans-serif;
          background-color: #e9f6ee;
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
          height: 100vh;
          margin: 0;
        }
        .card {
          background-color: white;
          padding: 40px;
          border-radius: 10px;
          box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
          text-align: center;
        }
        h1 {
          color: #28a745;
        }
        p {
          font-size: 18px;
          color: #333;
        }
        a {
          display: inline-block;
          margin-top: 20px;
          background-color: #007bff;
          color: white;
          padding: 10px 20px;
          text-decoration: none;
          border-radius: 6px;
        }
        a:hover {
          background-color: #0056b3;
        }
      </style>
    </head>
    <body>
      <div class='card'>
        <h1>✅ Pendaftaran Berhasil!</h1>
        <p>Terima kasih telah mendaftar di SMA Tunas Bangsa.</p>
        <a href='index.html'>Kembali ke Beranda</a>
      </div>
    </body>
    </html>";
    echo "<a href='kartu.php?nama=".urlencode($nama)."&nisn=$nisn&asal=".urlencode($asal_sekolah)."' target='_blank'>Cetak Kartu Pendaftaran (PDF)</a>";

}

$stmt->close();
$conn->close();
?>
