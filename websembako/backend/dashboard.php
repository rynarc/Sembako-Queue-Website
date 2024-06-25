<?php
session_start();
require_once('backend/db.php');

// Memeriksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$userID = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Dashboard - Sembako Queue</title>
</head>
<body>
    <?php include('includes/header.php'); ?>

    <main class="container">
        <section class="overview">
            <h2>Overview</h2>
            <div class="cards" id="overviewCards">
                <!-- Cards will be populated by JavaScript -->
            </div>
        </section>
        <section class="latest-queue">
            <h2>Latest Queue Status</h2>
            <div class="queue-list" id="queueList">
                <!-- Queue list will be populated by JavaScript -->
            </div>
        </section>
    </main>

    <?php include('includes/footer.php'); ?>

    <script src="js/scripts.js"></script>
</body>
</html>
