<?php
session_start();
include 'db.php'; // పైన ఉన్న db.php కనెక్ట్ అవుతుంది

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // SQL Prepared Statement
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Password Verification
            if (password_verify($password, $row['password'])) {
                
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['fullname'];
                $_SESSION['user_email'] = $row['email'];

                // Dashboard కి వెళ్తుంది
                header("Location: ../dashboard.php");
                exit();

            } else {
                echo "<script>alert('Incorrect Password!'); window.location.href='../login.html';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Email not registered!'); window.location.href='../login.html';</script>";
            exit();
        }
        mysqli_stmt_close($stmt);
    } else {
        // Query లో లేదా టేబుల్ పేర్లలో తప్పు ఉంటే ఇక్కడ చూపిస్తుంది
        die("Database Query Failed: " . mysqli_error($conn));
    }
}
?>