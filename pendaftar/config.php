<?php
// config.php untuk folder pendaftar
$host = 'host.docker.internal';
$user = 'root';
$pass = '';
$db   = 'psb_tunasbangsa';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}
?>
