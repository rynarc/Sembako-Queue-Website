<?php
require_once 'db.php'; // Sisipkan file db.php yang berisi koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menerima input dari form
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $phonenumber = $_POST['phonenumber'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    // Validasi password dan confirm password
    if ($password !== $confirmpassword) {
        echo "Password dan Confirm Password tidak cocok.";
        exit();
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk memasukkan data ke dalam tabel users
    $sql = "INSERT INTO users (fullname, username, phonenumber, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $fullname, $username, $phonenumber, $hashed_password);

    // Eksekusi query
    if ($stmt->execute()) {
        // Jika berhasil mendaftar, tambahkan ke tabel queues
        // Ambil ID pengguna yang baru saja didaftarkan
        $user_id = $stmt->insert_id;

        // Query untuk memasukkan data ke dalam tabel queues
        $queue_number = 0; // Atau bisa disesuaikan dengan logika antrian Anda
        $status = "Pending"; // Status awal antrian
        $sql = "INSERT INTO queues (user_id, queue_number, status) VALUES (?, ?, ?)";
        $stmt2 = $conn->prepare($sql);
        $stmt2->bind_param("iis", $user_id, $queue_number, $status);

        // Eksekusi query
        if ($stmt2->execute()) {
            // Jika berhasil masukkan, redirect ke halaman login
            header("Location: ../login.html");
            exit();
        } else {
            // Jika gagal masukkan, echo pesan gagal
            echo "Failed to insert into queues table. Please try again later.";
        }
        $stmt2->close();
    } else {
        // Jika gagal daftar, echo pesan gagal
        echo "Failed to register. Please try again later.";
    }
    // Tutup statement
    $stmt->close();
}
// Tutup koneksi
$conn->close();
?>
