<?php
// config.php
$host = $_ENV['DB_HOST'] ?? 'localhost';
$user = 'root';
$pass = '';
$db   = 'psb_tunasbangsa';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}
?>
