<?php
// 1. Session ని స్టార్ట్ చేయడం
session_start();

// 2. Security Check: యూజర్ లాగిన్ అవ్వకపోతే లాగిన్ పేజీకి పంపడం
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - CareerGuide</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="dashboard-body">

    <aside class="sidebar">
        <div class="sidebar-logo">
            <h2>CareerGuide</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="dashboard.php" class="active">📊 Dashboard</a></li>
            <li><a href="profile.html">👤 My Profile</a></li>
            <li><a href="assessment.html">📝 Career Test</a></li>
            <li><a href="php/logout.php">🚪 Logout</a></li> </ul>
    </aside>

    <div class="dashboard-main">
        <header class="topbar">
            <div class="welcome-msg">
                <h3>Welcome back, <span id="student-name" style="color: #D4AF37;"><?php echo $_SESSION['user_name']; ?>!</span></h3>
            </div>
        </header>

        <main class="dash-content">
            <div class="dash-cards">
                <div class="dash-card">
                    <h4>Test Status</h4>
                    <p class="status pending">Not Taken Yet</p>
                    <a href="assessment.html" class="dash-link">Take Test Now →</a>
                </div>
                <div class="dash-card">
                    <h4>Recommended Paths</h4>
                    <p class="dash-num">0</p>
                    <p>Complete test to view paths</p>
                </div>
                <div class="dash-card">
                    <h4>Profile Completion</h4>
                    <p class="dash-num">40%</p>
                    <a href="profile.html" class="dash-link">Update Profile</a>
                </div>
            </div>
        </main>
    </div>

</body>
</html>