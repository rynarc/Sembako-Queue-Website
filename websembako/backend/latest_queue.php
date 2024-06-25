<?php
require_once('db.php');

// Query untuk mengambil semua data antrian
$latestQueueSql = "SELECT u.fullname, q.queue_number, q.status FROM queues q JOIN users u ON q.user_id = u.id WHERE q.queue_number > 0 ORDER BY q.id DESC";
$latestQueueResult = $conn->query($latestQueueSql);

$data = [];
while ($row = $latestQueueResult->fetch_assoc()) {
    $data[] = [
        'fullname' => $row['fullname'],
        'queue_number' => $row['queue_number'],
        'status' => $row['status']
    ];
}

// Mengirimkan response JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
