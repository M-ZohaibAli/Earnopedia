<?php
include 'db_connection.php'; // Include the database connection script

session_start(); // Start the session if not already started

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    $sql = "SELECT user_balance, jobs_applied, success_jobs, jobs_completed, failed_jobs FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $userData = $result->fetch_assoc();

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Earn O' Pedia</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<header class="bg-dark text-light text-center py-4">
        <h1>Welcome to Earn O' Pedia</h1>
    </header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Job Applications</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="card">
        <div class="card-header">
            User Balance
        </div>
        <div class="card-body">
            <p>Your current balance: $<?php echo $userData['user_balance']; ?></p>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            Job Statistics
        </div>
        <div class="card-body">
            <ul>
                <li>Jobs Applied: <?php echo $userData['jobs_applied']; ?></li>
                <li>Success Jobs: <?php echo $userData['success_jobs']; ?></li>
                <li>Jobs Completed: <?php echo $userData['jobs_completed']; ?></li>
                <li>Failed Jobs: <?php echo $userData['failed_jobs']; ?></li>
            </ul>
        </div>
    </div>
  
    <footer class="bg-dark text-light text-center py-3 mt-5">
        <p>Contact us at <a href="contact.html" style="color: inherit;">Here</a></p>
    </footer>
    
    <!-- Bootstrap JS (optional, for certain components) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
