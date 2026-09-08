<?php
session_start();
include 'db.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit();
}

$user_id = $_SESSION['user_id'];
$action = $_GET['action'] ?? '';

// 15 Dynamic Quiz Questions Bank
$quizQuestions = [
    'Computer Science (CSE)' => [
        ['id' => 1, 'q' => 'Which structure works on LIFO?', 'o' => ['Stack', 'Queue', 'Array', 'List'], 'a' => 'Stack'],
        ['id' => 2, 'q' => 'Average complexity of Quick Sort?', 'o' => ['O(n)', 'O(n log n)', 'O(n²)', 'O(1)'], 'a' => 'O(n log n)'],
        ['id' => 3, 'q' => 'What does HTML stand for?', 'o' => ['HyperText Markup Language', 'HighText Machine Language', 'HyperTabular Model Logic', 'None'], 'a' => 'HyperText Markup Language'],
        ['id' => 4, 'q' => 'Which language is used for Artificial Intelligence primarily?', 'o' => ['C', 'Python', 'HTML', 'CSS'], 'a' => 'Python'],
        ['id' => 5, 'q' => 'Database language to query data?', 'o' => ['SQL', 'HTML', 'PHP', 'C++'], 'a' => 'SQL'],
        ['id' => 6, 'q' => 'What is the primary key used for?', 'o' => ['Unique identification', 'Duplicate entries', 'Sorting only', 'Encryption'], 'a' => 'Unique identification'],
        ['id' => 7, 'q' => 'Which protocol is secure for websites?', 'o' => ['HTTP', 'HTTPS', 'FTP', 'SMTP'], 'a' => 'HTTPS'],
        ['id' => 8, 'q' => 'Full form of RAM?', 'o' => ['Random Access Memory', 'Read Active Media', 'Run Auto Machine', 'None'], 'a' => 'Random Access Memory'],
        ['id' => 9, 'q' => 'Which engine runs JavaScript inside Google Chrome?', 'o' => ['V8', 'SpiderMonkey', 'Chakra', 'Gecko'], 'a' => 'V8'],
        ['id' => 10, 'q' => 'Git is a system for what?', 'o' => ['Version Control', 'Database Management', 'Design Wireframes', 'Hosting Services'], 'a' => 'Version Control'],
        ['id' => 11, 'q' => 'Which HTML tag is used for images?', 'o' => ['<img>', '<image>', '<src>', '<pic>'], 'a' => '<img>'],
        ['id' => 12, 'q' => 'CSS stands for?', 'o' => ['Cascading Style Sheets', 'Computer Style System', 'Creative Sheet Style', 'None'], 'a' => 'Cascading Style Sheets'],
        ['id' => 13, 'q' => 'What is an array?', 'o' => ['Collection of similar elements', 'Non-linear list', 'Key-value pair only', 'Dynamic pointer'], 'a' => 'Collection of similar elements'],
        ['id' => 14, 'q' => 'HTTP status code for Not Found?', 'o' => ['200', '404', '500', '302'], 'a' => '404'],
        ['id' => 15, 'q' => 'Which cloud provider owns AWS?', 'o' => ['Google', 'Microsoft', 'Amazon', 'IBM'], 'a' => 'Amazon']
    ]
    // వేరే బ్రాంచ్‌లకి కూడా ఇదే విధంగా 15 ప్రశ్నలు రాసుకోవచ్చు
];

// 1. క్విజ్ ప్రశ్నలు పంపడం
if ($action === 'fetch_quiz') {
    // యూజర్ ఎంచుకున్న బ్రాంచ్ లేకపోతే CSE డిఫాల్ట్ గా ఇస్తాం
    $branchQuery = mysqli_query($conn, "SELECT branch FROM users WHERE id='$user_id'");
    $userData = mysqli_fetch_assoc($branchQuery);
    $branch = $userData['branch'] ?? 'Computer Science (CSE)';
    
    $questions = $quizQuestions[$branch] ?? $quizQuestions['Computer Science (CSE)'];
    echo json_encode(['status' => 'success', 'questions' => $questions]);
    exit();
}

// 2. క్విజ్ ఆన్సర్స్ సబ్మిట్ చేయడం & డేటాబేస్ అప్‌డేట్
if ($action === 'submit_quiz') {
    $data = json_decode(file_get_contents('php://input'), true);
    $answers = $data['answers'] ?? [];
    
    $branchQuery = mysqli_query($conn, "SELECT branch FROM users WHERE id='$user_id'");
    $userData = mysqli_fetch_assoc($branchQuery);
    $branch = $userData['branch'] ?? 'Computer Science (CSE)';
    $questions = $quizQuestions[$branch] ?? $quizQuestions['Computer Science (CSE)'];
    
    $score = 0;
    foreach ($questions as $index => $q) {
        if (isset($answers[$index]) && $answers[$index] === $q['a']) {
            $score++;
        }
    }
    
    // స్కోర్ ని బట్టి రికమండేషన్ కౌంట్ డిసైడ్ అవుతుంది
    $recommended_paths = 2; // కనీసం 2 ఆప్షన్స్
    if ($score > 12) {
        $recommended_paths = 5;
    } elseif ($score > 7) {
        $recommended_paths = 4;
    }
    
    // 🎯 డేటాబేస్ లోకి స్టోర్ చేయడం
    $updateQuery = "UPDATE users SET test_status='Completed', recommended_paths='$recommended_paths' WHERE id='$user_id'";
    
    if (mysqli_query($conn, $updateQuery)) {
        echo json_encode(['status' => 'success', 'score' => $score, 'paths' => $recommended_paths]);
    } else {
        echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
    }
    exit();
}
?>