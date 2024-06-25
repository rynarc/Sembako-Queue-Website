<?php
require_once('db.php');
session_start();

// Ambil data dari POST
$data = json_decode(file_get_contents('php://input'));
$username = $data->username;
$password = $data->password;

// Cek apakah username dan password cocok
$sql = "SELECT id, password FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $userId = $row['id'];

        // Dapatkan nomor antrian terakhir
        $lastQueueSql = "SELECT queue_number FROM queues ORDER BY queue_number DESC LIMIT 1";
        $lastQueueResult = $conn->query($lastQueueSql);
        if ($lastQueueResult->num_rows > 0) {
            $lastQueueRow = $lastQueueResult->fetch_assoc();
            $lastQueueNumber = $lastQueueRow['queue_number'];
            $newQueueNumber = $lastQueueNumber + 1;
        } else {
            $newQueueNumber = 1; // Antrian pertama
        }

        // Masukkan nomor antrian baru ke database
        $insertQueueSql = "INSERT INTO queues (user_id, queue_number, status) VALUES (?, ?, 'queued')";
        $stmtInsert = $conn->prepare($insertQueueSql);
        $stmtInsert->bind_param("ii", $userId, $newQueueNumber);

        if ($stmtInsert->execute()) {
            echo json_encode(['success' => true, 'queueNumber' => $newQueueNumber, 'status' => 'queued']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save queue number']);
        }

        $stmtInsert->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
}

$stmt->close();
$conn->close();
?>
