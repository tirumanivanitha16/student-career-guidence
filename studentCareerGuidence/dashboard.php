<?php
session_start();
include 'db.php'; 

// సెక్యూరిటీ చెక్: లాగిన్ అవ్వకపోతే వెనక్కి పంపేస్తుంది
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

// 1. డేటాబేస్ నుండి స్టూడెంట్ వివరాలన్నీ లాగుతున్నాం
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

$display_name = !empty($user['fullname']) ? $user['fullname'] : $_SESSION['user_name'];

// 2. Enhanced Dynamic Profile Completion Logic
$total_fields = 9; // మొత్తం ఫీల్డ్స్ సంఖ్య
$filled_fields = 0;

if (!empty($user['fullname'])) $filled_fields++;
if (!empty($user['email'])) $filled_fields++;
if (!empty($user['phone'])) $filled_fields++;
if (!empty($user['branch'])) $filled_fields++;
if (!empty($user['college'])) $filled_fields++;
if (!empty($user['skills'])) $filled_fields++;
if (!empty($user['cgpa'])) $filled_fields++;
if (!empty($user['pass_year'])) $filled_fields++;
if (!empty($user['linkedin'])) $filled_fields++;

// పర్సంటేజ్ కాలిక్యులేషన్ (రౌండ్ ఫిగర్ కోసం)
$completion = round(($filled_fields / $total_fields) * 100);

// 3. Dynamic Test Result Parsing
$test_status = isset($user['test_status']) ? $user['test_status'] : 'Pending';
$recommended_string = !empty($user['recommended_paths']) ? trim($user['recommended_paths']) : '';

// ఒకవేళ డేటాబేస్ లో కామాలతో పాత్‌లు ఉంటే అర్రే లా మారుస్తాం, లేదంటే డిఫాల్ట్ పాత్‌లు ఇస్తాం
$recommended_array = [];
$is_dynamic = false;

if (!empty($recommended_string) && !is_numeric($recommended_string)) {
    $recommended_array = explode(',', $recommended_string);
    $recommendations_count = count($recommended_array);
    $is_dynamic = true;
} else {
    // డిఫాల్ట్ పాత్‌లు (ఒకవేళ యూజర్ ఇంకా టెస్ట్ రాయకపోతే ఇవి కనిపిస్తాయి)
    $recommended_array = ['cs-fullstack', 'cs-aiml', 'eng-ece-vlsi', 'arts-civil-servant'];
    $recommendations_count = is_numeric($recommended_string) ? (int)$recommended_string : 0;
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
    <style>
        /* --- Dashboard Dynamic Paths UI Styling --- */
        .paths-container {
            margin-top: 35px;
            background: #FFFFFF;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            border: 1px solid #E2E8F0;
        }
        .section-heading {
            color: #0F2038;
            font-size: 18px;
            font-weight: 700;
            margin-top: 0;
            margin-bottom: 20px;
            border-left: 4px solid #D4AF37;
            padding-left: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-alert-box {
            background: #FFFBEB;
            border: 1px solid #FCD34D;
            color: #B45309;
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 13.5px;
            margin-bottom: 20px;
            font-weight: 500;
        }
        .paths-grid {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 25px;
        }
        .paths-sidebar-box {
            background: #F8FAFC;
            padding: 15px;
            border-radius: 10px;
            border: 1px solid #E2E8F0;
            height: fit-content;
        }
        .paths-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .path-tab-btn {
            background: #FFFFFF;
            border: 1px solid #CBD5E1;
            color: #334155;
            padding: 12px 15px;
            text-align: left;
            font-size: 13.5px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            width: 100%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }
        .path-tab-btn:hover, .path-tab-btn.active {
            background: #0F2038;
            color: #FFFFFF;
            border-color: #0F2038;
        }
        .roadmap-display-card {
            background: #F8FAFC;
            padding: 25px;
            border-radius: 10px;
            border: 1px solid #E2E8F0;
            min-height: 300px;
        }
        .meta-title { color: #0F2038; font-size: 20px; margin: 0 0 8px 0; font-weight: 700; }
        .meta-desc { color: #64748B; font-size: 13.5px; margin: 0 0 25px 0; line-height: 1.6; }
        
        /* --- Timeline Engine --- */
        .timeline-engine { position: relative; padding-left: 30px; }
        .timeline-engine::before {
            content: ''; position: absolute; left: 10px; top: 0; bottom: 0;
            width: 3px; background: #0F2038; border-radius: 2px;
        }
        .timeline-node { position: relative; margin-bottom: 20px; }
        .timeline-node::before {
            content: ''; position: absolute; left: -26px; top: 4px;
            width: 14px; height: 14px;
            background: #D4AF37; border: 3px solid #FFFFFF;
            border-radius: 50%; box-shadow: 0 0 0 2px #0F2038;
        }
        .node-body { background: #FFFFFF; padding: 15px; border-radius: 6px; border-left: 4px solid #D4AF37; box-shadow: 0 2px 5px rgba(0,0,0,0.02); }
        .node-body h5 { color: #0F2038; margin: 0 0 5px 0; font-size: 14.5px; font-weight: 600; }
        .node-body p { color: #475569; margin: 0; font-size: 13px; line-height: 1.5; }
        .tag-badge { display: inline-block; background: #E2E8F0; color: #1E293B; padding: 2px 6px; border-radius: 4px; font-size: 11px; font-weight: 600; margin-top: 6px; }
    </style>
</head>
<body class="dashboard-body">

    <aside class="sidebar">
        <div class="sidebar-logo">
            <h2>CareerGuide</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="dashboard.php" class="active">📊 Dashboard</a></li>
            <li><a href="profile.php">👤 My Profile</a></li> 
            <li><a href="assessment.html">📝 Career Test</a></li>
            <li><a href="php/logout.php">🚪 Logout</a></li> 
        </ul>
    </aside>

    <div class="dashboard-main">
        <header class="topbar">
            <div class="welcome-msg">
                <h3>Welcome back, <span id="student-name" style="color: #D4AF37;"><?php echo htmlspecialchars($display_name); ?>!</span></h3>
            </div>
        </header>

        <main class="dash-content">
            <div class="dash-cards">
                                
                <!-- Profile Completion Card -->
                <div class="dash-card">
                    <h4>Profile Completion</h4>
                    <p class="dash-num" style="font-size: 32px; font-weight: bold; margin: 5px 0;"><?php echo $completion; ?>%</p>
                    <div style="background: #E2E8F0; border-radius: 10px; height: 8px; width: 100%; margin: 10px 0; overflow: hidden;">
                        <div style="background: #D4AF37; height: 100%; width: <?php echo $completion; ?>%; transition: width 0.5s;"></div>
                    </div>
                    <a href="profile.php" class="dash-link">Update Profile</a>
                </div>

            </div>

            <!-- CAREER PATHS & ROADMAPS INTEGRATION PANEL -->
            <div class="paths-container">
                <?php if ($is_dynamic): ?>
                    <h3 class="section-heading">Your Personalized Recommended Paths</h3>
                <?php else: ?>
                    <h3 class="section-heading">Trending Career Tracks (Take test to unlock personalized paths)</h3>
                    <div class="status-alert-box">
                        📢 <strong>Notice:</strong> You haven't completed the Career Test yet. Showing generic trending domains below. Complete your <a href="assessment.html" style="color: #B45309; font-weight: 700; text-decoration: underline;">Career Test here</a> to get customized AI recommendations.
                    </div>
                <?php endif; ?>

                <div class="paths-grid">
                    
                    <!-- Left Sidebar Buttons -->
                    <div class="paths-sidebar-box">
                        <div class="paths-list">
                            <?php foreach ($recommended_array as $index => $path_key): 
                                $path_key = trim($path_key);
                            ?>
                                <button class="path-tab-btn <?php echo $index === 0 ? 'active' : ''; ?>" 
                                        onclick="showRoadmap('<?php echo htmlspecialchars($path_key); ?>', this)">
                                    🎯 Loading Path...
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Right Sidebar Roadmap Viewer -->
                    <div id="roadmap-display-panel" class="roadmap-display-card">
                        <!-- JavaScript will render the timeline structure dynamically here -->
                    </div>

                </div>
            </div>
        </main>
    </div>

    <!-- MASTER CAREER ENGINE DATABASE -->
    <script>
        const careerDatabase = {
            'cs-fullstack': {
                title: "Full-Stack Enterprise Software Architect",
                desc: "Design, build, deploy, and maintain robust client-side interfaces and scalable distributed cloud databases.",
                steps: [
                    { title: "Step 1: Client-Side UI Mastery", desc: "Master reactive design architectures, DOM paradigms, and asynchronous programming logic.", tags: "HTML5, CSS3, Modern JavaScript, React.js" },
                    { title: "Step 2: Server-Side Logic Foundations", desc: "Build highly concurrent APIs, handle asynchronous event execution loops, and manage server micro-frameworks.", tags: "Node.js, Express, Python Django" },
                    { title: "Step 3: Database Administration & Systems Design", desc: "Structure high-availability relational schemas and distributed non-relational storage clusters.", tags: "MySQL, PostgreSQL, MongoDB" },
                    { title: "Step 4: DevOps Pipelines & Cloud Infrastructure", desc: "Automate delivery systems and coordinate containers within enterprise public clouds.", tags: "Git, Docker, Kubernetes, AWS Cloud" }
                ]
            },
            'cs-aiml': {
                title: "Artificial Intelligence & Machine Learning Engineer",
                desc: "Develop advanced statistical algorithms, neural network models, and autonomous intelligent workflows.",
                steps: [
                    { title: "Step 1: Advanced Mathematical Prerequisites", desc: "Establish deep mathematical proficiencies in multi-variable data computation frameworks.", tags: "Linear Algebra, Multivariate Calculus" },
                    { title: "Step 2: Data Manipulation Engines", desc: "Master structural analytical programming pipelines for feature engineering tasks.", tags: "Python, NumPy Arrays, Pandas Dataframes" },
                    { title: "Step 3: Predictive Modeling & Deep Architectures", desc: "Train complex machine learning algorithms and deep neural layer systems.", tags: "Scikit-Learn, TensorFlow, PyTorch" }
                ]
            },
            'cs-datasci': {
                title: "Big Data & Infrastructure Analytics Engineer",
                desc: "Process massive-scale unstructured streaming data pipelines to fuel predictive corporate intelligence.",
                steps: [
                    { title: "Step 1: Distributed Storage Ecosystems", desc: "Manage high-throughput filesystem networks designed for petabyte-scale data components.", tags: "Hadoop Architecture, HDFS Clusters" },
                    { title: "Step 2: Stream Processing Engines", desc: "Write highly optimized data transformation routines operating on live computational messaging systems.", tags: "Apache Spark, Apache Kafka, Scala" }
                ]
            },
            'cs-cyber': {
                title: "Cyber Security & Enterprise Penetration Architect",
                desc: "Harden corporate network infrastructure and execute continuous defensive/offensive security operations.",
                steps: [
                    { title: "Step 1: Networking Foundations & Shell Scripting", desc: "Understand TCP/IP architectures, subnet routing policies, and secure Linux server environments.", tags: "CCNA Concepts, Linux Bash, Python" },
                    { title: "Step 2: Vulnerability Analysis & Incident Response", desc: "Perform penetration testing across web apps, decrypt cryptographic configurations, and manage patches.", tags: "Burp Suite, Wireshark, CEH" }
                ]
            },
            'eng-ece-vlsi': {
                title: "VLSI Circuit Design & Silicon Microchip Engineer",
                desc: "Design and verify highly dense Integrated Circuits (ICs) driving modern computation technologies.",
                steps: [
                    { title: "Step 1: Hardware Description Languages", desc: "Code abstract behavioral logic systems into precise physical transistor placement instructions.", tags: "Verilog, SystemVerilog, VHDL" },
                    { title: "Step 2: Verification & Simulation Suites", desc: "Synthesize code structures and run layout timing tests to eliminate manufacturing anomalies.", tags: "Xilinx Vivado, Cadence Virtuoso" }
                ]
            },
            'eng-eee-power': {
                title: "Electrical Vehicle (EV) Grid & Power Systems Engineer",
                desc: "Architect modern micro-grids, automated power infrastructure, and advanced EV powertrain systems.",
                steps: [
                    { title: "Step 1: Power Electronics Mastery", desc: "Understand power conversion architectures, invertor mechanics, and battery management models.", tags: "MATLAB, Simulink Platforms" },
                    { title: "Step 2: Smart Grid Integration", desc: "Implement IoT frameworks for power grid load balancing and charging topologies.", tags: "SCADA & Distribution Networks" }
                ]
            },
            'arts-ca': {
                title: "Chartered Accountant (CA Qualification)",
                desc: "The elite professional standard governing corporate accounting, audit protocols, and financial strategies in India.",
                steps: [
                    { title: "Step 1: Establish Foundation", desc: "Register with the central institute and clear the baseline accounting entrance test.", tags: "ICAI CA Foundation Exam" },
                    { title: "Step 2: Intermediate Tier Success", desc: "Qualify across multi-subject groups spanning complex corporate law structures and audit methodologies.", tags: "CA Intermediate Certification" }
                ]
            },
            'arts-civil-servant': {
                title: "Civil Services Career Track (IAS / IPS Officers)",
                desc: "Govern public administration infrastructure, policy implementation, and law enforcement frameworks across India.",
                steps: [
                    { title: "Step 1: Preliminary Filtering Test", desc: "Attempt the objective-type nationwide screening exam checking general awareness and analytical skills.", tags: "UPSC Prelims (GS & CSAT)" },
                    { title: "Step 2: Descriptive Main Examination", desc: "Write comprehensive academic essays and deep-dive subject evaluations across multiple specialized areas.", tags: "UPSC Mains Papers" }
                ]
            }
        };

        // UI Initialization & Button Labels Sync Engine
        document.addEventListener("DOMContentLoaded", () => {
            const tabs = document.querySelectorAll('.path-tab-btn');
            tabs.forEach((tab, index) => {
                const matchKey = tab.getAttribute('onclick').match(/'([^']+)'/)[1];
                if (careerDatabase[matchKey]) {
                    tab.innerText = "🎯 " + careerDatabase[matchKey].title;
                } else {
                    tab.innerText = "🎯 " + matchKey.replace('-', ' ').toUpperCase();
                }
                
                // Active trigger first element by default
                if (index === 0) {
                    tab.click();
                }
            });
        });

        // Dynamic Roadmap Presenter Engine
        function showRoadmap(pathKey, btnElement) {
            const viewContainer = document.getElementById('roadmap-display-panel');
            
            // Toggle Tab Active Classes
            document.querySelectorAll('.path-tab-btn').forEach(btn => btn.classList.remove('active'));
            if(btnElement) btnElement.classList.add('active');

            const data = careerDatabase[pathKey];

            if (!data) {
                viewContainer.innerHTML = `
                    <h3 class="meta-title">Detailed Roadmap In Preparation</h3>
                    <p class="meta-desc">The timeline layout for configuration key "${pathKey}" is currently being indexed. Select another operational track above.</p>
                `;
                return;
            }

            // Synthesize Content Modules
            let timelineHTML = `
                <h3 class="meta-title">${data.title}</h3>
                <p class="meta-desc">${data.desc}</p>
                <div class="timeline-engine">
            `;

            data.steps.forEach(step => {
                timelineHTML += `
                    <div class="timeline-node">
                        <div class="node-body">
                            <h5>${step.title}</h5>
                            <p>${step.desc}</p>
                            <span class="tag-badge">${step.tags}</span>
                        </div>
                    </div>
                `;
            });

            timelineHTML += `</div>`;
            viewContainer.innerHTML = timelineHTML;
        }
    </script>
</body>
</html>