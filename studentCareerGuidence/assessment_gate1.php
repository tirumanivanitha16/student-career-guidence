<?php
// ఏవైనా నోటీసులు లేదా వార్నింగ్‌లు వస్తే అవి JSON ని బ్రేక్ చేయకుండా ఉండటానికి డిస్‌ప్లే ఆఫ్ చేస్తున్నాం
error_reporting(0);
ini_set('display_errors', 0);

session_start();
header('Content-Type: application/json');

// 15 English Questions directly inside the handler to prevent file include errors
$habitsQuiz = [
    [
        'id' => 1, 
        'q' => 'How do you usually prefer to spend your free time?', 
        'o' => ['Exploring new tech gadgets or apps', 'Writing stories, scripting, or drawing', 'Thinking of business ideas or managing money', 'Helping people or participating in community discussions'], 
        'a' => ['Tech', 'Creative', 'Business', 'Social']
    ],
    [
        'id' => 2, 
        'q' => 'Which apps do you open most frequently on your phone?', 
        'o' => ['Tech blogs, GitHub, or tech YouTube channels', 'Instagram, Pinterest, or photo/video editing tools', 'Stock market trackers, LinkedIn, or business news', 'Social forums, fitness trackers, or counseling apps'], 
        'a' => ['Tech', 'Creative', 'Business', 'Social']
    ],
    [
        'id' => 3, 
        'q' => 'When buying a new product, what catches your attention first?', 
        'o' => ['The underlying processor, specifications, and technology', 'The aesthetics, visual design, and color themes', 'The pricing, discount value, and ROI (Return on Investment)', 'How environment-friendly or socially impactful it is'], 
        'a' => ['Tech', 'Creative', 'Business', 'Social']
    ],
    [
        'id' => 4, 
        'q' => 'Why do your friends usually approach you for advice?', 
        'o' => ['To fix software glitches, phone settings, or laptop issues', 'To brainstorm video ideas, editing, or creative content', 'For career planning, strategic opinions, or financial advice', 'To share their problems and seek comfort or emotional support'], 
        'a' => ['Tech', 'Creative', 'Business', 'Social']
    ],
    [
        'id' => 5, 
        'q' => 'What kind of puzzles or games excite you the most?', 
        'o' => ['Logic puzzles, coding syntax challenges, or strategy video games', 'Sudoku, mind mapping, or visual design puzzles', 'Chess, business tycoon simulation games, or trading simulators', 'Group trivia, psychological quizzes, or team building games'], 
        'a' => ['Tech', 'Creative', 'Business', 'Social']
    ],
    [
        'id' => 6, 
        'q' => 'When watching a movie, what aspect do you critique the most?', 
        'o' => ['The CGI, VFX technology, and technical execution', 'The storytelling, cinematography, and sound tracks', 'The box-office performance, budget management, and distribution', 'The social message and psychological impact on the audience'], 
        'a' => ['Tech', 'Creative', 'Business', 'Social']
    ],
    [
        'id' => 7, 
        'q' => 'What kind of work environment do you visualize for your future?', 
        'o' => ['Sitting in front of a high-end setup writing code or architecture', 'A flexible freelancing lifestyle creating art or digital content', 'Managing an enterprise team inside a corporate board room', 'Working on the ground driving social welfare or public healthcare'], 
        'a' => ['Tech', 'Creative', 'Business', 'Social']
    ],
    [
        'id' => 8, 
        'q' => 'During your school/college days, which activities did you enjoy?', 
        'o' => ['Science exhibitions, robotics, or computer lab sessions', 'Drawing, cultural stage decorations, or creative writing', 'Event management, handling fest budgets, and team leading', 'NSS campaigns, social service camps, or helping peers'], 
        'a' => ['Tech', 'Creative', 'Business', 'Social']
    ],
    [
        'id' => 9, 
        'q' => 'How do you typically approach a complex problem?', 
        'o' => ['Breaking it down logically into step-by-step algorithms', 'Thinking out-of-the-box and finding a unique creative solution', 'Weighing the cost, profit, and efficiency metrics', 'Talking it out with everyone to reach a mutually satisfactory conclusion'], 
        'a' => ['Tech', 'Creative', 'Business', 'Social']
    ],
    [
        'id' => 10, 
        'q' => 'What genre of books, articles, or documentation do you read?', 
        'o' => ['Sci-Fi novels, coding docs, or future tech insights', 'Fiction, design magazines, or photography journals', 'Biographies of founders, business case studies, or stock trends', 'Psychology journals, motivational books, or human behavior studies'], 
        'a' => ['Tech', 'Creative', 'Business', 'Social']
    ],
    [
        'id' => 11, 
        'q' => 'If you are given $1,000 to spend today, what would you do?', 
        'o' => ['Buy a powerful tech upgrade or gadget', 'Purchase premium design assets, a camera, or art tools', 'Invest it in stocks, crypto, or a micro-business to double it', 'Donate to a cause or sponsor someone\'s education'], 
        'a' => ['Tech', 'Creative', 'Business', 'Social']
    ],
    [
        'id' => 12, 
        'q' => 'What role do you naturally assume during a group project?', 
        'o' => ['The developer/builder who handles the functional architecture', 'The designer who ensures the pitch deck or product looks stunning', 'The leader who delegates roles, manages timeline, and tracks budget', 'The mediator who keeps team harmony and coordinates communication'], 
        'a' => ['Tech', 'Creative', 'Business', 'Social']
    ],
    [
        'id' => 13, 
        'q' => 'Which of the following subjects felt most natural to you?', 
        'o' => ['Mathematics, Computer Applications, or Statistics', 'Fine Arts, Literature, or Design Concepts', 'Economics, Accountancy, or Commerce Systems', 'Social Sciences, Psychology, or Human Resource Foundations'], 
        'a' => ['Tech', 'Creative', 'Business', 'Social']
    ],
    [
        'id' => 14, 
        'q' => 'When browsing a beautifully made website, what do you notice first?', 
        'o' => ['The page loading speed, smooth transitions, and functionality', 'The typography, color schemes, and UI layouts', 'The monetization model, ads placement, and product conversions', 'How user-friendly it is and the accessibility factor for users'], 
        'a' => ['Tech', 'Creative', 'Business', 'Social']
    ],
    [
        'id' => 15, 
        'q' => 'What is your long-term ultimate life vision?', 
        'o' => ['To engineer a groundbreaking software or technical product', 'To craft an artistic masterpiece or memorable media brand', 'To build an enterprise company or a successful startup ecosystem', 'To positively impact and transform thousands of human lives directly'], 
        'a' => ['Tech', 'Creative', 'Business', 'Social']
    ]
];

$action = $_GET['action'] ?? '';

// 1. Get Questions Action
if ($action === 'get_quiz') {
    echo json_encode(['status' => 'success', 'quiz' => $habitsQuiz]);
    exit();
}

// 2. Submit Action
if ($action === 'submit_quiz') {
    $data = json_decode(file_get_contents('php://input'), true);
    $answers = $data['answers'] ?? [];

    $scores = ['Tech' => 0, 'Creative' => 0, 'Business' => 0, 'Social' => 0];

    foreach ($answers as $index => $chosenOptionIndex) {
        if (isset($habitsQuiz[$index])) {
            $category = $habitsQuiz[$index]['a'][$chosenOptionIndex];
            $scores[$category]++;
        }
    }

    arsort($scores);
    $dominantCategory = key($scores);

    $roadmaps = [
        'Tech' => [
            'title' => 'Technology & Software Engineering Domain',
            'desc' => 'Your habits indicate highly strong logical reasoning, structure preference, and technical affinity. Your mind is perfectly calibrated for architecture and digital development.',
            'steps' => [
                ['title' => 'Phase 1: Programming Foundations', 'info' => 'Start with Python or JavaScript. Master core logic building, variables, and data structures.'],
                ['title' => 'Phase 2: Database & Core Web Architecture', 'info' => 'Learn SQL databases and combine them with basic frontend mechanics to build dynamic projects.'],
                ['title' => 'Phase 3: Industry Frameworks & Git Workflow', 'info' => 'Adopt frameworks like React or Node.js. Push your codebases regularly onto GitHub to show progress.'],
                ['title' => 'Phase 4: Open Source & Technical Hiring Systems', 'info' => 'Practice on LeetCode, participate in hackathons, and apply for Software Engineer or Data Roles.']
            ]
        ],
        'Creative' => [
            'title' => 'UI/UX Design, Media & Creative Arts Domain',
            'desc' => 'You prioritize visual layout, emotional depth, and aesthetics in everything. The creative media and design ecosystems are your natural playground.',
            'steps' => [
                ['title' => 'Phase 1: Visual Design Principles', 'info' => 'Study color theory, visual hierarchy, grid systems, and typography frameworks.'],
                ['title' => 'Phase 2: Mastering Industry Standard Tools', 'info' => 'Get hands-on expertise with Figma for UI/UX, or Adobe Creative Suite for media pipelines.'],
                ['title' => 'Phase 3: Portfolio Aggregation', 'info' => 'Design 3 to 5 comprehensive mock case studies and publish them on Behance or Dribbble.'],
                ['title' => 'Phase 4: Freelance Ecosystems or Design Agency Placement', 'info' => 'Start picking up freelance gigs or join modern design agencies as a Product Designer.']
            ]
        ],
        'Business' => [
            'title' => 'Entrepreneurship, Finance & Product Management',
            'desc' => 'You possess core leadership potential, scale metrics understanding, and management traits. You thrive well in strategic business setups.',
            'steps' => [
                ['title' => 'Phase 1: Market Dynamics & Research Foundations', 'info' => 'Study how startups scale, product lifecycles, and how consumer market demands function.'],
                ['title' => 'Phase 2: Financial Literacy & Strategic Planning', 'info' => 'Understand microeconomics, project budgeting, corporate metrics, and sales conversion frameworks.'],
                ['title' => 'Phase 3: Strategic Professional Networking', 'info' => 'Optimize your LinkedIn presence, connect with industry founders, and secure operational positions.'],
                ['title' => 'Phase 4: Scaling Venturing or Product Management', 'info' => 'Acquire a Product Manager role or pitch your startup MVP blueprint to angel investors.']
            ]
        ],
        'Social' => [
            'title' => 'Human Resource (HR), Public Relations & Social Welfare',
            'desc' => 'You showcase exceptional interpersonal empathy, active listening, and people coordination traits. Corporate operations or human development fit you best.',
            'steps' => [
                ['title' => 'Phase 1: Human Psychology & Communication Frameworks', 'info' => 'Develop deep behavioral assessment insights, public speaking, and negotiation competencies.'],
                ['title' => 'Phase 2: Community Operations & Public Relations', 'info' => 'Coordinate community drives, manage campus events, or run public relations initiatives.'],
                ['title' => 'Phase 3: Professional Certifications', 'info' => 'Acquire accredited human resource certifications or global organizational management diplomas.'],
                ['title' => 'Phase 4: Enterprise HR Operations or Institutional Deployment', 'info' => 'Step into corporate houses as an HR Talent Acquisition expert or manage large-scale welfare frameworks.']
            ]
        ]
    ];

    echo json_encode(['status' => 'success', 'result' => $roadmaps[$dominantCategory]]);
    exit();
}
?>