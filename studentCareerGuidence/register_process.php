<?php
// 1. Database connection include చేయడం
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 2. Form నుండి డేటాను తీసుకోవడం
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // 3. Validation: పాస్‌వర్డ్‌లు మ్యాచ్ అయ్యాయో లేదో చెక్ చేయడం
    if ($password !== $cpassword) {
        echo "<script>
                alert('Passwords do not match!'); 
                window.location.href='register.html';
              </script>";
        exit();
    }

    // 4. Validation: ఈమెయిల్ ఆల్రెడీ రిజిస్టర్ అయి ఉందో లేదో చెక్ చేయడం
    $check_email = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $check_email);
    
    if (mysqli_num_rows($result) > 0) {
        echo "<script>
                alert('Email already registered!'); 
                window.location.href='register.html';
              </script>";
        exit();
    }

    // 5. Password Hashing (భద్రత కోసం)
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // 6. Data ని database లోకి Insert చేయడం
    $sql = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$hashed_password')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Registration Successful! Please Login.'); 
                window.location.href='login.html';
              </script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>