<?php
// Mulai sesi yang sudah ada
session_start();

// Hapus semua variabel sesi
$_SESSION = array();

// Hapus sesi
session_destroy();

// Redirect ke halaman index.html setelah logout
header("Location: ../index.html");
exit;
?>
