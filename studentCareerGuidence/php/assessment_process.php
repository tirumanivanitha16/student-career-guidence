<?php
// 1. Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 2. Get the answers from the form safely
    $q1 = $_POST['q1'];
    $q2 = $_POST['q2'];

    // 3. Initialize scores for each domain
    $tech_score = 0;
    $medical_score = 0;
    $arts_score = 0;

    // 4. Calculate score for Question 1
    if ($q1 == 'tech') { $tech_score++; }
    elseif ($q1 == 'medical') { $medical_score++; }
    elseif ($q1 == 'arts') { $arts_score++; }

    // 5. Calculate score for Question 2
    if ($q2 == 'tech') { $tech_score++; }
    elseif ($q2 == 'medical') { $medical_score++; }
    elseif ($q2 == 'arts') { $arts_score++; }

    // 6. Determine the highest score (Recommendation Logic)
    $recommended_career = "";
    
    if ($tech_score >= $medical_score && $tech_score >= $arts_score) {
        $recommended_career = "Technology & IT (Software Engineer, Data Scientist, Cyber Security)";
    } elseif ($medical_score >= $tech_score && $medical_score >= $arts_score) {
        $recommended_career = "Healthcare & Medical (Doctor, Nurse, Pharmacist, Biotechnologist)";
    } else {
        $recommended_career = "Creative Arts & Media (Graphic Designer, Animator, Journalist)";
    }

    // 7. Display the result to the student
    echo "<div style='max-width:600px; margin:50px auto; padding:30px; border:2px solid #D4AF37; font-family:sans-serif; text-align:center; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1);'>";
    echo "<h2 style='color:#1E3A5F;'>Your Career Assessment Result</h2>";
    echo "<p style='font-size:18px;'>Based on your responses, your dominant interest lies in:</p>";
    echo "<h3 style='color:#D4AF37; font-size:24px;'>$recommended_career</h3>";
    echo "<br><a href='../dashboard.html' style='padding:10px 20px; background:#1E3A5F; color:white; text-decoration:none; border-radius:5px;'>Back to Dashboard</a>";
    echo "</div>";
}
?>