<?php
// 1. Session ని మరియు Database connection ని స్టార్ట్ చేయడం
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Form నుండి డేటాను తీసుకోవడం
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // 2. Prepared Statements వాడటం (సెక్యూరిటీ కోసం చాలా ముఖ్యం)
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) === 1) {
            // యూజర్ దొరికాడు
            $row = mysqli_fetch_assoc($result);
            
            // 3. Password Verification
            if (password_verify($password, $row['password'])) {
                
                // Session వేరియబుల్స్ సెట్ చేయడం
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['fullname'];
                $_SESSION['user_email'] = $row['email'];

                // డాష్‌బోర్డ్‌కి పంపడం
                header("Location: ../studentCareerGuidence/dashboard.php");
                exit();

            } else {
                // పాస్‌వర్డ్ తప్పు అయితే
                echo "<script>alert('Incorrect Password!'); window.location.href='../login.html';</script>";
                exit();
            }
        } else {
            // ఈమెయిల్ డేటాబేస్ లో లేకపోతే
            echo "<script>alert('Email not registered!'); window.location.href='../login.html';</script>";
            exit();
        }
    }
}
?>