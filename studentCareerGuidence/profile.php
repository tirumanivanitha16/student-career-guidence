<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

// ఫామ్ సబ్మిట్ చేసినప్పుడు డేటాబేస్ అప్‌డేట్ చేసే లాజిక్
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $branch = mysqli_real_escape_string($conn, $_POST['branch']);
    $college = mysqli_real_escape_string($conn, $_POST['college']);
    $skills = mysqli_real_escape_string($conn, $_POST['skills']);
    $cgpa = mysqli_real_escape_string($conn, $_POST['cgpa']);
    $pass_year = mysqli_real_escape_string($conn, $_POST['pass_year']);
    $linkedin = mysqli_real_escape_string($conn, $_POST['linkedin']);

    $update_query = "UPDATE users SET 
                    phone='$phone', branch='$branch', college='$college', 
                    skills='$skills', cgpa='$cgpa', pass_year='$pass_year', linkedin='$linkedin' 
                    WHERE id='$user_id'";

    if (mysqli_query($conn, $update_query)) {
        $message = "<div style='color: #10B981; font-weight: bold; margin-bottom: 15px;'>✓ Profile updated successfully!</div>";
    } else {
        $message = "<div style='color: #EF4444; font-weight: bold; margin-bottom: 15px;'>Error updating profile.</div>";
    }
}

// ప్రస్తుత డేటాను ఫామ్ లో చూపించడం కోసం రీఫెచ్ చేస్తున్నాం
$query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id'");
$user = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile - CareerGuide</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #F8FAFC; margin: 0; padding: 20px; }
        .profile-container { max-width: 600px; margin: 30px auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        h2 { color: #0F2038; margin-bottom: 20px; border-bottom: 2px solid #F1F5F9; padding-bottom: 10px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: 500; margin-bottom: 5px; color: #475569; }
        input, select, textarea { width: 100%; padding: 10px; border: 1px solid #CBD5E1; border-radius: 6px; box-sizing: border-box; font-family: inherit; }
        textarea { resize: vertical; height: 80px; }
        .btn-save { background: #0F2038; color: white; border: none; padding: 12px 20px; border-radius: 6px; cursor: pointer; font-weight: bold; width: 100%; margin-top: 10px; }
        .btn-save:hover { background: #1E3A5F; }
        .back-btn { display: inline-block; margin-bottom: 15px; color: #64748B; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>

<div class="profile-container">
    <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>
    <h2>👤 Educational & Professional Profile</h2>
    
    <?php echo $message; ?>

    <form action="profile.php" method="POST">
        <!-- బేసిక్ వివరాలు (Read-only) -->
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" value="<?php echo htmlspecialchars($user['fullname']); ?>" disabled style="background: #F1F5F9;">
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" value="<?php echo htmlspecialchars($user['email']); ?>" disabled style="background: #F1F5F9;">
        </div>

        <!-- అప్‌డేట్ చేయదగిన కొత్త ఆప్షన్స్ -->
        <div class="form-group">
            <label>Phone Number</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>" placeholder="Enter phone number">
        </div>

        <div class="form-group">
            <label>Academic Branch</label>
            <select name="branch">
                <option value="">Select Branch</option>
                <option value="Computer Science (CSE)" <?php if(($user['branch']??'')=='Computer Science (CSE)') echo 'selected'; ?>>Computer Science (CSE)</option>
                <option value="Information Technology (IT)" <?php if(($user['branch']??'')=='Information Technology (IT)') echo 'selected'; ?>>Information Technology (IT)</option>
                <option value="Electronics (ECE)" <?php if(($user['branch']??'')=='Electronics (ECE)') echo 'selected'; ?>>Electronics (ECE)</option>
                <option value="Mechanical (MECH)" <?php if(($user['branch']??'')=='Mechanical (MECH)') echo 'selected'; ?>>Mechanical (MECH)</option>
            </select>
        </div>

        <div class="form-group">
            <label>College Name</label>
            <input type="text" name="college" value="<?php echo htmlspecialchars($user['college'] ?? ''); ?>" placeholder="Enter your college name">
        </div>

        <div class="form-group">
            <label>CGPA / Percentage</label>
            <input type="text" name="cgpa" value="<?php echo htmlspecialchars($user['cgpa'] ?? ''); ?>" placeholder="e.g. 8.5 or 85%">
        </div>

        <div class="form-group">
            <label>Passed Out Year</label>
            <input type="number" name="pass_year" value="<?php echo htmlspecialchars($user['pass_year'] ?? ''); ?>" placeholder="e.g. 2025">
        </div>

        <div class="form-group">
            <label>Technical Skills (Comma Separated)</label>
            <textarea name="skills" placeholder="e.g. Java, Python, HTML, SQL"><?php echo htmlspecialchars($user['skills'] ?? ''); ?></textarea>
        </div>

        <div class="form-group">
            <label>LinkedIn Profile URL</label>
            <input type="url" name="linkedin" value="<?php echo htmlspecialchars($user['linkedin'] ?? ''); ?>" placeholder="https://linkedin.com/in/username">
        </div>

        <button type="submit" class="btn-save">Save & Update Profile</button>
    </form>
</div>

</body>
</html>