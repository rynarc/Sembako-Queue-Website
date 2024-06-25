<?php
// Sesuaikan dengan logika login Anda
session_start();

require_once 'db.php'; // Sisipkan file db.php yang berisi koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa username dan password
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Password benar, buat sesi
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            header('Location: ../dashboard.html'); // Arahkan ke halaman dashboard
            exit();
        } else {
            // Password salah
            header('Location: ../login.html?error=invalidpassword');
            exit();
        }
    } else {
        // Username tidak ditemukan
        header('Location: ../login.html?error=usernotfound');
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    // Jika akses langsung ke file ini tanpa melalui POST
    header('Location: ../login.html');
    exit();
}
?>
