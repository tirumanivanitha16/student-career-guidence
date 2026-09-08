<?php
session_start();
include 'db.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

$display_name = !empty($user['fullname']) ? $user['fullname'] : $_SESSION['user_name'];
$test_status = isset($user['test_status']) ? $user['test_status'] : 'Pending';
$recommendations_count = isset($user['recommended_paths']) ? $user['recommended_paths'] : 0;

// Dynamic Profile Completion
$completion = 0;
if (!empty($user['fullname'])) $completion += 20;
if (!empty($user['email'])) $completion += 20;
if (!empty($user['phone'])) $completion += 20;
if (!empty($user['branch'])) $completion += 20;
if (!empty($user['college'])) $completion += 20;
?>