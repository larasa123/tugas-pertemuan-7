<?php
require_once '../../config/database.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    header("Location: index.php?error=ID tidak valid");
    exit();
}

$conn->query("DELETE FROM anggota WHERE id_anggota=$id");

header("Location: index.php?success=Data berhasil dihapus");
?>