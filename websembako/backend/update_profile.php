<?php
require_once 'db.php'; // Sisipkan file db.php yang berisi koneksi ke database

// Sisipkan session_start() di awal untuk memastikan session berfungsi
session_start();

// Cek jika metode yang digunakan adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menerima input dari form menggunakan $_POST atau $_FILES jika menggunakan FormData
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $phonenumber = $_POST['phonenumber'];
    $password = $_POST['password'];

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk memperbarui data pengguna
    $sql = "UPDATE users SET fullname = ?, username = ?, phonenumber = ?, password = ? WHERE id = ?";

    // Persiapan statement
    $stmt = $conn->prepare($sql);

    // Bind parameter ke statement
    $stmt->bind_param("ssssi", $fullname, $username, $phonenumber, $hashed_password, $user_id);

    // ID pengguna yang diambil dari sesi atau form
    $user_id = $_SESSION['user_id']; // Sesuaikan dengan cara Anda mendapatkan ID pengguna

    // Eksekusi statement
    if ($stmt->execute()) {
        // Jika berhasil update, kirimkan respons JSON
        $response = [
            'success' => true,
            'message' => 'Profile updated successfully.'
        ];
    } else {
        // Jika gagal update, kirimkan respons JSON dengan pesan error
        $response = [
            'success' => false,
            'message' => 'Failed to update profile. Please try again later.'
        ];
    }

    // Tutup statement
    $stmt->close();

    // Mengirimkan respons JSON ke JavaScript
    header('Content-Type: application/json');
    echo json_encode($response);
    exit; // Keluar dari skrip PHP setelah mengirim respons JSON
}

// Tutup koneksi
$conn->close();
?>
