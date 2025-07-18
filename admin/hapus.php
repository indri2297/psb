<?php

require_once 'config.php';

$id = $_GET['id'];
$conn->query("DELETE FROM pendaftar WHERE id=$id");
$conn->close();

header("Location: admin.php");
exit;
?>
