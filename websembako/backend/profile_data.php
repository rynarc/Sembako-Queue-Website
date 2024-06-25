<?php
require_once 'db.php'; // Sisipkan file db.php yang berisi koneksi ke database

session_start();
$user_id = $_SESSION['user_id']; // Ambil user_id dari sesi

// Query untuk mengambil data profil pengguna berdasarkan user_id
$sql = "SELECT fullname, username, phonenumber FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Cek jika data ditemukan
if ($result->num_rows > 0) {
    $profile = $result->fetch_assoc();
    echo json_encode($profile);
} else {
    echo json_encode(null); // Kirim null jika profil tidak ditemukan
}

$stmt->close();
$conn->close();
?>
