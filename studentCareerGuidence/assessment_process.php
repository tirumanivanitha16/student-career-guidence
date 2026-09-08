<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Score counters for 4 categories
    $scores = [
        'tech' => 0,
        'medical' => 0,
        'creative' => 0,
        'business' => 0
    ];

    // Calculate score based on all 15 answers
    for ($i = 1; $i <= 15; $i++) {
        if (isset($_POST["q$i"])) {
            $selected = $_POST["q$i"];
            if (array_key_exists($selected, $scores)) {
                $scores[$selected]++;
            }
        }
    }

    // Find highest score category
    arsort($scores);
    $top_category = key($scores);

    // Career recommendation mapping
    $recommendations = [
        'tech' => 'Technology & IT (Software Engineer, Data Scientist, Cyber Security)',
        'medical' => 'Healthcare & Life Sciences (Medical Officer, Pharmacist, Clinical Researcher)',
        'creative' => 'Creative Arts & Design (UI/UX Designer, Graphic Artist, Content Creator)',
        'business' => 'Business & Management (Financial Analyst, Product Manager, Entrepreneur)'
    ];

    $recommended_career = $recommendations[$top_category];

    // Save result to Database if user logged in
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        
        $update_sql = "UPDATE users SET test_status = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $update_sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "si", $recommended_career, $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    // Render exact UI from Screenshot (46)
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Career Assessment Result - CareerGuide</title>
        <style>
            body { 
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
                background-color: #f4f6f9; 
                display: flex; 
                justify-content: center; 
                align-items: center; 
                min-height: 100vh; 
                margin: 0; 
            }
            .result-card { 
                background: #fff; 
                padding: 40px; 
                border-radius: 8px; 
                border: 1px solid #e2b714; 
                text-align: center; 
                max-width: 600px; 
                width: 90%;
                box-shadow: 0 4px 10px rgba(0,0,0,0.05); 
            }
            .result-card h2 { 
                color: #0f2137; 
                font-size: 24px; 
                margin-bottom: 20px; 
            }
            .result-card p { 
                color: #4a5568; 
                font-size: 15px; 
                margin-bottom: 15px; 
            }
            .career-title { 
                font-size: 20px; 
                color: #d69e2e; 
                font-weight: bold; 
                margin-bottom: 30px; 
                line-height: 1.4;
            }
            .btn-dashboard { 
                padding: 10px 20px; 
                background: #0f2137; 
                color: #fff; 
                text-decoration: none; 
                border-radius: 4px; 
                font-weight: 600; 
                display: inline-block;
                transition: background 0.3s;
            }
            .btn-dashboard:hover { 
                background: #1a365d; 
            }
        </style>
    </head>
    <body>

        <div class="result-card">
            <h2>Your Career Assessment Result</h2>
            <p>Based on your responses, your dominant interest lies in:</p>
            
            <div class="career-title">
                <?php echo $recommended_career; ?>
            </div>

            <a href="../dashboard.php" class="btn-dashboard">Back to Dashboard</a>
        </div>

    </body>
    </html>
    <?php
} else {
    header("Location: ../assessment.html");
    exit();
}
?>