<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once 'db.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); 
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $phone    = mysqli_real_escape_string($conn, $_POST['phone']);
    $college  = mysqli_real_escape_string($conn, $_POST['college'] ?? '');
    $branch   = mysqli_real_escape_string($conn, $_POST['branch'] ?? '');
    
    $sql = "UPDATE users SET 
            fullname = '$fullname', 
            phone = '$phone', 
            college = '$college', 
            branch = '$branch' 
            WHERE id = '$user_id'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['user_name'] = $fullname;
        
        echo "<script>
                alert('Profile Updated Successfully!'); 
                window.location.href='dashboard.php';
              </script>";
        exit();
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>