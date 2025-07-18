<?php
$koneksi = new mysqli($_ENV['DB_HOST'], "root", "", "psb_tunasbangsa");

$id = intval($_POST['id']);
$nilai = intval($_POST['nilai']);
$status = ($nilai >= 75) ? 'Lulus' : 'Tidak Lulus';

$query = "UPDATE pendaftar SET nilai = $nilai, status_kelulusan = '$status' WHERE id = $id";
if ($koneksi->query($query)) {
    header("Location: admin.php");
} else {
    echo "Gagal update nilai.";
}
?>
