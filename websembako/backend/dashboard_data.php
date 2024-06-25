<?php
require_once('db.php');

session_start();
$user_id = $_SESSION['user_id'];

$totalQueuesQuery = "SELECT COUNT(*) AS total FROM queues WHERE queue_number > 0";
$totalQueuesResult = $conn->query($totalQueuesQuery);
$totalQueuesRow = $totalQueuesResult->fetch_assoc();
$totalQueues = $totalQueuesRow['total'];

$yourQueueQuery = "SELECT queue_number FROM queues WHERE user_id = ? ORDER BY id DESC LIMIT 1";
$stmt = $conn->prepare($yourQueueQuery);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$yourQueueResult = $stmt->get_result();
$yourQueueRow = $yourQueueResult->fetch_assoc();
$yourQueue = $yourQueueRow ? $yourQueueRow['queue_number'] : null;

$response = [
    'totalQueues' => $totalQueues,
    'yourQueue' => $yourQueue
];

header('Content-Type: application/json');
echo json_encode($response);
?>
