<?php
session_start();
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
    <title>Ultimate Master Career Directory</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* --- Master Layout Theme --- */
        .directory-container {
            max-width: 1200px;
            margin: 0 auto;
            font-family: 'Poppins', sans-serif;
        }
        .section-card {
            background: #FFFFFF;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            margin-bottom: 25px;
            border: 1px solid #E2E8F0;
        }
        .section-heading {
            color: #0F2038;
            font-size: 18px;
            font-weight: 700;
            margin-top: 0;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-left: 4px solid #D4AF37;
            padding-left: 10px;
        }

        /* --- Horizontal Scrolling Stream Tabs --- */
        .stream-tabs {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding-bottom: 10px;
            scrollbar-width: thin;
        }
        .stream-btn {
            background: #F8FAFC;
            border: 1px solid #CBD5E1;
            color: #334155;
            padding: 10px 18px;
            font-size: 13.5px;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.2s ease;
        }
        .stream-btn.active, .stream-btn:hover {
            background: #0F2038;
            color: #FFFFFF;
            border-color: #0F2038;
        }

        /* --- Two-Column Sub-Options Panels --- */
        .split-panel {
            display: none;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            animation: fadeIn 0.4s ease forwards;
        }
        .split-panel.active { display: grid; }
        
        .sub-box {
            background: #F1F5F9;
            padding: 20px;
            border-radius: 8px;
            border-top: 3px solid #1E3A5F;
        }
        .sub-box h4 {
            color: #1E3A5F;
            margin: 0 0 15px 0;
            font-size: 15px;
            font-weight: 600;
            border-bottom: 2px solid #E2E8F0;
            padding-bottom: 5px;
        }
        .option-list { display: flex; flex-direction: column; gap: 8px; }
        
        .target-btn {
            background: #FFFFFF;
            border: 1px solid #CBD5E1;
            color: #334155;
            padding: 10px 14px;
            text-align: left;
            font-size: 13px;
            font-weight: 500;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .target-btn:hover, .target-btn.active {
            background: #D4AF37;
            color: #0F2038;
            border-color: #D4AF37;
            font-weight: 600;
        }

        /* --- Dynamic Roadmap Interface --- */
        .roadmap-card {
            display: none;
            background: #FFFFFF;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid #E2E8F0;
            margin-top: 25px;
            animation: fadeIn 0.5s ease forwards;
        }
        .roadmap-card.active { display: block; }
        .meta-title { color: #0F2038; font-size: 22px; margin: 0 0 5px 0; font-weight: 700; }
        .meta-desc { color: #64748B; font-size: 13.5px; margin: 0 0 25px 0; line-height: 1.6; }

        /* --- Vertical Timeline Engine --- */
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
        .node-body { background: #F8FAFC; padding: 15px; border-radius: 6px; border-left: 4px solid #D4AF37; }
        .node-body h5 { color: #0F2038; margin: 0 0 5px 0; font-size: 14.5px; font-weight: 600; }
        .node-body p { color: #475569; margin: 0; font-size: 13px; line-height: 1.5; }
        .tag-badge { display: inline-block; background: #E2E8F0; color: #1E293B; padding: 2px 6px; border-radius: 4px; font-size: 11px; font-weight: 600; margin-top: 6px; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(6px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="dashboard-body">

    <!-- Sidebar Module -->
    <aside class="sidebar">
        <div class="sidebar-logo"><h2>CareerGuide</h2></div>
        <ul class="sidebar-menu">
            <li><a href="dashboard.php">📊 Dashboard</a></li>
            <li><a href="assessment.php" class="active">💼 Explore Careers</a></li>
            <li><a href="php/logout.php">🚪 Logout</a></li>
        </ul>
    </aside>

    <!-- Main Content Panel -->
    <div class="dashboard-main">
        <header class="topbar">
            <h3>Unified <span style="color: #D4AF37;">National Career Directory</span></h3>
        </header>
        
        <main class="dash-content">
            <div class="directory-container">
                
                <!-- STREAMS SELECTION HEADERS -->
                <div class="section-card">
                    <h3 class="section-heading">Step 1: Select Academic Stream / Qualification</h3>
                    <div class="stream-tabs">
                        <!-- School & Secondary -->
                        <button class="stream-btn" onclick="switchStream('stream-school', this)">🏫 10th / Schooling</button>
                        <button class="stream-btn" onclick="switchStream('stream-inter', this)">📚 Intermediate (11th & 12th)</button>
                        <button class="stream-btn" onclick="switchStream('stream-diploma', this)">⚙️ Diploma / ITI</button>
                        <!-- B.Tech Branches -->
                        <button class="stream-btn" onclick="switchStream('stream-btech-core', this)">🔌 B.Tech (Core Branches)</button>
                        <button class="stream-btn" onclick="switchStream('stream-btech-cs', this)">💻 B.Tech (IT & Software)</button>
                        <!-- Degree / UG Courses -->
                        <button class="stream-btn" onclick="switchStream('stream-ug-med', this)">🩺 UG Medicine & Allied</button>
                        <button class="stream-btn" onclick="switchStream('stream-ug-arts', this)">🎨 UG Arts, Commerce & Law</button>
                        <!-- PG Courses -->
                        <button class="stream-btn" onclick="switchStream('stream-pg', this)">🎓 Post Graduation (PG)</button>
                    </div>
                </div>

                <!-- DYNAMIC SUB-OPTION PANELS -->
                <div class="section-card">
                    <h3 class="section-heading">Step 2: Select Career Objective or Higher Education</h3>
                    
                    <!-- 10th Panel -->
                    <div id="stream-school" class="split-panel">
                        <div class="sub-box">
                            <h4>🎯 Career Entry Opportunities</h4>
                            <div class="option-list">
                                <button class="target-btn" onclick="renderRoadmap('sch-rail')">Indian Railway Staff (Group D)</button>
                                <button class="target-btn" onclick="renderRoadmap('sch-def')">Defense Forces (Constable/Tradesman)</button>
                            </div>
                        </div>
                        <div class="sub-box">
                            <h4>🎓 Immediate Academic Pathways</h4>
                            <div class="option-list">
                                <button class="target-btn" onclick="renderRoadmap('sch-higher-inter')">Higher Secondary (General Streams)</button>
                                <button class="target-btn" onclick="renderRoadmap('sch-higher-poly')">Polytechnic Engineering Diploma</button>
                            </div>
                        </div>
                    </div>

                    <!-- Intermediate Panel -->
                    <div id="stream-inter" class="split-panel">
                        <div class="sub-box">
                            <h4>🎯 Technical & General Careers</h4>
                            <div class="option-list">
                                <button class="target-btn" onclick="renderRoadmap('int-nda')">National Defence Academy (NDA Officer)</button>
                                <button class="target-btn" onclick="renderRoadmap('int-ssc')">SSC CHSL Govt Clerical Roles</button>
                            </div>
                        </div>
                        <div class="sub-box">
                            <h4>🎓 Professional Degree Pathways</h4>
                            <div class="option-list">
                                <button class="target-btn" onclick="renderRoadmap('int-mpc-eng')">MPC Stream to Engineering (B.E/B.Tech)</button>
                                <button class="target-btn" onclick="renderRoadmap('int-bipc-med')">BiPC Stream to Medical Sciences</button>
                                <button class="target-btn" onclick="renderRoadmap('int-cec-comm')">Commerce Stream (B.Com/BBA/CA)</button>
                            </div>
                        </div>
                    </div>

                    <!-- Diploma & ITI Panel -->
                    <div id="stream-diploma" class="split-panel">
                        <div class="sub-box">
                            <h4>🎯 Industry & PSU Job Roles</h4>
                            <div class="option-list">
                                <button class="target-btn" onclick="renderRoadmap('dip-rrb-je')">Railway Recruitment Board Junior Engineer</button>
                                <button class="target-btn" onclick="renderRoadmap('dip-psu')">PSU Technical Trainee (BHEL, NTPC)</button>
                            </div>
                        </div>
                        <div class="sub-box">
                            <h4>🎓 Higher Studies Options</h4>
                            <div class="option-list">
                                <button class="target-btn" onclick="renderRoadmap('dip-ecet')">B.Tech Lateral Entry (Direct 2nd Year)</button>
                            </div>
                        </div>
                    </div>

                    <!-- B.Tech Core Panel -->
                    <div id="stream-btech-core" class="split-panel">
                        <div class="sub-box">
                            <h4>🎯 Core Engineering Roles</h4>
                            <div class="option-list">
                                <button class="target-btn" onclick="renderRoadmap('eng-ece-vlsi')">ECE: VLSI Design & Microchips</button>
                                <button class="target-btn" onclick="renderRoadmap('eng-eee-power')">EEE: Power Systems & EV Grid</button>
                                <button class="target-btn" onclick="renderRoadmap('eng-mech-cad')">Mechanical: CAD Design & Automation</button>
                                <button class="target-btn" onclick="renderRoadmap('eng-civil-struc')">Civil: Structural & Infra Design</button>
                                <button class="target-btn" onclick="renderRoadmap('eng-aero')">Aerospace: Avionics & Flight Dynamics</button>
                            </div>
                        </div>
                        <div class="sub-box">
                            <h4>🎓 Postgraduate Options (Core)</h4>
                            <div class="option-list">
                                <button class="target-btn" onclick="renderRoadmap('pg-gate-mtech')">M.Tech Specialization via GATE</button>
                                <button class="target-btn" onclick="renderRoadmap('pg-ms-abroad')">MS Degree (International Research)</button>
                            </div>
                        </div>
                    </div>

                    <!-- B.Tech CS Panel -->
                    <div id="stream-btech-cs" class="split-panel">
                        <div class="sub-box">
                            <h4>🎯 Software & Tech Job Roles</h4>
                            <div class="option-list">
                                <button class="target-btn" onclick="renderRoadmap('cs-fullstack')">Full-Stack Software Engineer</button>
                                <button class="target-btn" onclick="renderRoadmap('cs-aiml')">AI & Machine Learning Scientist</button>
                                <button class="target-btn" onclick="renderRoadmap('cs-datasci')">Big Data & Analytics Engineer</button>
                                <button class="target-btn" onclick="renderRoadmap('cs-cyber')">Cyber Security & Pentesting Architect</button>
                            </div>
                        </div>
                        <div class="sub-box">
                            <h4>🎓 Corporate & Executive Options</h4>
                            <div class="option-list">
                                <button class="target-btn" onclick="renderRoadmap('pg-mba')">MBA in Business Analytics/Product Development</button>
                            </div>
                        </div>
                    </div>

                    <!-- Medicine Panel -->
                    <div id="stream-ug-med" class="split-panel">
                        <div class="sub-box">
                            <h4>🎯 Healthcare Sector Careers</h4>
                            <div class="option-list">
                                <button class="target-btn" onclick="renderRoadmap('med-physician')">Medical Officer / General Physician</button>
                                <button class="target-btn" onclick="renderRoadmap('med-pharma')">Clinical Research & Pharmacist</button>
                                <button class="target-btn" onclick="renderRoadmap('med-biotech')">Biotech R&D Lab Researcher</button>
                            </div>
                        </div>
                        <div class="sub-box">
                            <h4>🎓 Medical Specializations</h4>
                            <div class="option-list">
                                <button class="target-btn" onclick="renderRoadmap('pg-neet-pg')">MD / MS Specialization via NEET-PG</button>
                            </div>
                        </div>
                    </div>

                    <!-- Arts, Commerce & Law Panel -->
                    <div id="stream-ug-arts" class="split-panel">
                        <div class="sub-box">
                            <h4>🎯 Professional Corporate Roles</h4>
                            <div class="option-list">
                                <button class="target-btn" onclick="renderRoadmap('arts-ca')">Chartered Accountant (Corporate Audit)</button>
                                <button class="target-btn" onclick="renderRoadmap('arts-lawyer')">Corporate Lawyer & Legal Consultant</button>
                                <button class="target-btn" onclick="renderRoadmap('arts-civil-servant')">Civil Services (IAS / IPS / IFS)</button>
                            </div>
                        </div>
                        <div class="sub-box">
                            <h4>🎓 Academic & Creative Paths</h4>
                            <div class="option-list">
                                <button class="target-btn" onclick="renderRoadmap('pg-ma-mcom')">Master of Arts / Master of Commerce</button>
                            </div>
                        </div>
                    </div>

                    <!-- Postgraduate Panel -->
                    <div id="stream-pg" class="split-panel">
                        <div class="sub-box">
                            <h4>🎯 Elite Domain Roles</h4>
                            <div class="option-list">
                                <button class="target-btn" onclick="renderRoadmap('pg-rnd-scientist')">R&D Scientist / Senior Consultant</button>
                                <button class="target-btn" onclick="renderRoadmap('pg-professor')">University Professor & Researcher</button>
                            </div>
                        </div>
                        <div class="sub-box">
                            <h4>🎓 Doctoral Research</h4>
                            <div class="option-list">
                                <button class="target-btn" onclick="renderRoadmap('pg-phd')">Ph.D. Fellowship Programme</button>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- CENTRAL DYNAMIC ROADMAP INJECTOR DISPLAY -->
                <div id="master-roadmap-view" class="roadmap-card">
                    <!-- JavaScript will inject complete timeline engine data structures dynamically here -->
                </div>

            </div>
        </main>
    </div>

    <!-- OBJECT-ORIENTED JAVASCRIPT DIRECTORY CONFIGURATION MAP -->
    <script>
        // High-fidelity central repository mapping keys to comprehensive professional milestone data structures
        const careerDatabase = {
            // --- 10th / Schooling ---
            'sch-rail': {
                title: "Indian Railways Technical Staff Entry",
                desc: "Direct entry pathway into Central Government operations within the Indian Railways network.",
                steps: [
                    { title: "Step 1: Academic Eligibility", desc: "Clear 10th Standard with passing grades from a recognized regional or central board.", tags: "Matriculation Certification" },
                    { title: "Step 2: Competitive Entrance", desc: "Apply for Railway Recruitment Cell (RRC) Group D or Assistant Track Machine positions.", tags: "RRB Written Examination" },
                    { title: "Step 3: Physical Assessment & Medicals", desc: "Qualify for standard physical efficiency and operational visual tests.", tags: "PET, Medical Fitness Evaluation" }
                ]
            },
            'sch-def': {
                title: "Defense Forces (Constable / Tradesman)",
                desc: "Direct recruitment pathways into Indian Army, Navy, Air Force, or Para-military forces at the matriculation level.",
                steps: [
                    { title: "Step 1: Physical Parameters", desc: "Ensure your height, chest expansion, and running endurance meet official defense notifications.", tags: "Physical Standards Check" },
                    { title: "Step 2: Written Test Preparation", desc: "Study basic mathematics, general knowledge, reasoning, and regional language modules.", tags: "Defense Matric-Level Exam" },
                    { title: "Step 3: Medical Board Clearance", desc: "Undergo rigorous visual, auditory, and systemic clinical tests before the final merit list.", tags: "Military Medical Board" }
                ]
            },
            'sch-higher-inter': {
                title: "Higher Secondary Education (General Streams)",
                desc: "Standard 2-year intermediate academic line opening broad windows for professional graduation lines.",
                steps: [
                    { title: "Step 1: Stream Streamlining", desc: "Choose your specialty domain like MPC (Engineering), BiPC (Medical), or CEC/MEC (Commerce/Arts).", tags: "Stream Allocation" },
                    { title: "Step 2: Board & Entrance Alignment", desc: "Prepare for your respective state board or central CBSE syllabus concurrently with national tests.", tags: "10+2 Academic Syllabus" }
                ]
            },
            'sch-higher-poly': {
                title: "Polytechnic Engineering Diploma Track",
                desc: "3-year accelerated professional technical educational curriculum bypassing standard Intermediate lines.",
                steps: [
                    { title: "Step 1: Competitive Entrance", desc: "Attempt your state's polytechnic admission entrance exam right after secondary schooling.", tags: "POLYCET / State Exam" },
                    { title: "Step 2: Specialization Selection", desc: "Enroll in your target engineering department for hands-on, industry-oriented lab instruction.", tags: "Diploma in ME / ECE / CSE" },
                    { title: "Step 3: Industry Onboarding / Lateral Leap", desc: "Graduate to join core operational plants as a supervisor or enter advanced engineering programs.", tags: "Junior Technician Certification" }
                ]
            },

            // --- Intermediate (11th & 12th) ---
            'int-nda': {
                title: "National Defence Academy (NDA) Officer Selection",
                desc: "The premier entry gate to serve as a commissioned military commander within the Army, Navy, or Air Force.",
                steps: [
                    { title: "Step 1: Elite Academic Preparation", desc: "Conclude 10+2 schooling focusing on Advanced Mathematics and Physics.", tags: "Intermediate MPC Line" },
                    { title: "Step 2: Clear National UPSC Examination", desc: "Secure qualifying ranks in the highly competitive biennial written test.", tags: "UPSC NDA Written Test" },
                    { title: "Step 3: Services Selection Board (SSB) Interview", desc: "Pass the intensive 5-day psychology, leadership, and physical task screening.", tags: "SSB Evaluation Command" },
                    { title: "Step 4: Armed Forces Academy Commissioning", desc: "Undergo 3 years of academic training at Khadakwasla followed by specialized finishing school.", tags: "B.Sc/B.Tech Defense Degree" }
                ]
            },
            'int-ssc': {
                title: "Staff Selection Commission (SSC CHSL Officer)",
                desc: "Securing stable clerical, data entry, and executive support positions across central ministries.",
                steps: [
                    { title: "Step 1: Tier-1 Computer Based Exam", desc: "Master quantitative aptitude, general intelligence, English language comprehension, and general awareness.", tags: "SSC Tier-1 Objective Test" },
                    { title: "Step 2: Tier-2 Advanced Test & Typing Matrix", desc: "Qualify mathematical models and establish a typing speed threshold of 30-35 words per minute.", tags: "Typing Test & Merit List" }
                ]
            },
            'int-mpc-eng': {
                title: "Engineering Track via MPC Domain",
                desc: "Transitioning secondary education foundations into professional graduate technical engineering lines.",
                steps: [
                    { title: "Step 1: Entrance Crack Strategy", desc: "Ace national or regional state engineering screening tests like JEE Main, JEE Advanced, or EAPCET.", tags: "JEE / State EAPCET Exams" },
                    { title: "Step 2: Counseling & Campus Selection", desc: "Participate in centralized seat allocations based on merit ranks to lock branches.", tags: "IIT/NIT/State University Counseling" }
                ]
            },
            'int-bipc-med': {
                title: "Medical & Allied Sciences via BiPC",
                desc: "The pathway toward clinical practice, nursing, pharmacology, and global biomedical domains.",
                steps: [
                    { title: "Step 1: National Eligibility Test", desc: "Crack the highly competitive single window medical entrance examination.", tags: "NEET-UG Exam Framework" },
                    { title: "Step 2: Core Medical Onboarding", desc: "Secure allocations in MBBS, BDS, BAMS, BHMS, or professional nursing lines.", tags: "Clinical Course Allocation" }
                ]
            },
            'int-cec-comm': {
                title: "Commerce & Management Blueprint (CEC/MEC)",
                desc: "Gateway into financial analytics, corporate consulting, banking, and strategic accounting systems.",
                steps: [
                    { title: "Step 1: Baseline Undergraduate Enrollment", desc: "Opt for corporate pathways like B.Com (Computers/Honors), BBA, or professional CA integration.", tags: "UG Commerce Onboarding" },
                    { title: "Step 2: Professional Competency Alignment", desc: "Acquire specialized knowledge in audit structures, financial reporting, and market investment patterns.", tags: "Corporate Financial Frameworks" }
                ]
            },

            // --- Diploma / ITI ---
            'dip-rrb-je': {
                title: "Railway Recruitment Board Junior Engineer (RRB JE)",
                desc: "Technical management and engineering maintenance positions inside the vast Indian Railways structure.",
                steps: [
                    { title: "Step 1: CBT Stage-1 Clearance", desc: "Qualify the screening round comprising logical reasoning, general science, and math metrics.", tags: "RRB Technical Screening" },
                    { title: "Step 2: CBT Stage-2 Core Branch Testing", desc: "Demonstrate deep domain capabilities in Civil, Mechanical, Electrical, or Electronics Engineering concepts.", tags: "Core Engineering Paper" }
                ]
            },
            'dip-psu': {
                title: "PSU Technical Trainee Roles",
                desc: "Secure stable positions in elite Public Sector Undertakings like BHEL, NTPC, IOCL, and ONGC as technicians.",
                steps: [
                    { title: "Step 1: Form Tracking & Skill Mapping", desc: "Apply via designated diploma recruitment notifications matching your exact engineering branch.", tags: "PSU Direct Openings" },
                    { title: "Step 2: Technical Exam & Trade Test", desc: "Clear the computer-based operational test followed by a hands-on machinery/trade evaluation.", tags: "Industrial Trade Competency" }
                ]
            },
            'dip-ecet': {
                title: "B.Tech Lateral Entry (Direct 2nd Year)",
                desc: "Accelerated engineering graduation path allowing diploma holders to join directly into the sophomore year.",
                steps: [
                    { title: "Step 1: State ECET Competency", desc: "Prepare and crack the Engineering Common Entrance Test focused on core diploma topics.", tags: "State ECET Matrix" },
                    { title: "Step 2: Academic Scaling", desc: "Bridge the gap between practical diploma workflows and theoretical advanced engineering mathematics.", tags: "B.Tech Sophomore Integration" }
                ]
            },

            // --- B.Tech Core Branches ---
            'eng-ece-vlsi': {
                title: "VLSI Circuit Design & Silicon Microchip Engineer",
                desc: "Design and verify highly dense Integrated Circuits (ICs) driving modern computation technologies.",
                steps: [
                    { title: "Step 1: Hardware Description Languages", desc: "Code abstract behavioral logic systems into precise physical transistor placement instructions.", tags: "Verilog, SystemVerilog, VHDL" },
                    { title: "Step 2: Verification & Simulation Suites", desc: "Synthesize code structures and run layout timing tests to eliminate manufacturing anomalies.", tags: "Xilinx Vivado, Cadence Virtuoso, Synopsys Tools" },
                    { title: "Step 3: Semiconductor Cleanroom Fab Implementation", desc: "Understand lithography processes and physical tape-out steps.", tags: "ASIC Design, FPGA Prototypical Deployment" }
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
            'eng-mech-cad': {
                title: "Mechanical CAD Design & Industrial Automation",
                desc: "Develop complex mechanical assets and integrate automated robotic assembly structures.",
                steps: [
                    { title: "Step 1: Geometric Modeling Fluency", desc: "Generate advanced 3D parametric representations of automotive and aerospace subsystems.", tags: "SolidWorks, CATIA, Autodesk Inventor" },
                    { title: "Step 2: Finite Element Analysis (FEA)", desc: "Simulate thermal, structural, and computational fluid dynamic stresses on component frameworks.", tags: "ANSYS, HyperMesh Toolsets" }
                ]
            },
            'eng-civil-struc': {
                title: "Civil Structural & Smart Infrastructure Designer",
                desc: "Plan, model, and oversee execution profiles of high-rise structures and urban transit networks.",
                steps: [
                    { title: "Step 1: Structural Analytical Blueprints", desc: "Apply dynamic structural loads and verify steel/concrete compliance standards mathematically.", tags: "STAAD.Pro, ETABS Systems" },
                    { title: "Step 2: BIM & Project Scheduling", desc: "Integrate multi-dimensional building information modeling with precise execution timelines.", tags: "Autodesk Revit, Primavera P6" }
                ]
            },
            'eng-aero': {
                title: "Aerospace Avionics & Flight Dynamics Engineer",
                desc: "Engineer commercial/military aircraft flight systems and drone navigation architectures.",
                steps: [
                    { title: "Step 1: Aerodynamics & Propulsion Study", desc: "Analyze fluid flows across wing foils and optimize combustion parameters for propulsion systems.", tags: "ANSYS Fluent, OpenFOAM" },
                    { title: "Step 2: Embedded Avionics Controls", desc: "Program real-time flight control computers and automated telemetry routing systems.", tags: "Embedded C, RTOS Architectures" }
                ]
            },

            // --- B.Tech IT & Software ---
            'cs-fullstack': {
                title: "Full-Stack Enterprise Software Architect",
                desc: "Design, build, deploy, and maintain robust client-side interfaces and scalable distributed cloud databases.",
                steps: [
                    { title: "Step 1: Client-Side UI Mastery", desc: "Master reactive design architectures, DOM paradigms, and asynchronous programming logic.", tags: "HTML5, CSS3, Modern JavaScript, React.js / Vue.js" },
                    { title: "Step 2: Server-Side Logic Foundations", desc: "Build highly concurrent APIs, handle asynchronous event execution loops, and manage server micro-frameworks.", tags: "Node.js, Express, Python Django, Java Spring Boot" },
                    { title: "Step 3: Database Administration & Systems Design", desc: "Structure high-availability relational schemas and distributed non-relational storage clusters.", tags: "MySQL, PostgreSQL, MongoDB, Redis Caching" },
                    { title: "Step 4: DevOps Pipelines & Cloud Infrastructure", desc: "Automate delivery systems and coordinate containers within enterprise public clouds.", tags: "Git, Docker, Kubernetes orchestration, AWS Cloud Deployments" }
                ]
            },
            'cs-aiml': {
                title: "Artificial Intelligence & Machine Learning Engineer",
                desc: "Develop advanced statistical algorithms, neural network models, and autonomous intelligent workflows.",
                steps: [
                    { title: "Step 1: Advanced Mathematical Prerequisites", desc: "Establish deep mathematical proficiencies in multi-variable data computation frameworks.", tags: "Linear Algebra, Multivariate Calculus, Bayesian Statistics" },
                    { title: "Step 2: Data Manipulation Engines", desc: "Master structural analytical programming pipelines for feature engineering tasks.", tags: "Python, NumPy Arrays, Pandas Dataframes, Matplotlib" },
                    { title: "Step 3: Predictive Modeling & Deep Architectures", desc: "Train complex machine learning algorithms and deep neural layer systems for structural abstractions.", tags: "Scikit-Learn, TensorFlow, PyTorch, Convolutional Neural Networks (CNNs)" }
                ]
            },
            'cs-datasci': {
                title: "Big Data & Infrastructure Analytics Engineer",
                desc: "Process massive-scale unstructured streaming data pipelines to fuel predictive corporate intelligence.",
                steps: [
                    { title: "Step 1: Distributed Storage Ecosystems", desc: "Manage high-throughput filesystem networks designed for petabyte-scale data components.", tags: "Hadoop Architecture, HDFS Clusters" },
                    { title: "Step 2: Stream Processing Engines", desc: "Write highly optimized data transformation routines operating on live computational messaging systems.", tags: "Apache Spark, Apache Kafka, Scala Logic" }
                ]
            },
            'cs-cyber': {
                title: "Cyber Security & Enterprise Penetration Architect",
                desc: "Harden corporate network infrastructure and execute continuous defensive/offensive security operations.",
                steps: [
                    { title: "Step 1: Networking Foundations & Shell Scripting", desc: "Understand TCP/IP architectures, subnet routing policies, and secure Linux server environments.", tags: "CCNA Concepts, Linux Bash, Python Automation" },
                    { title: "Step 2: Vulnerability Analysis & Incident Response", desc: "Perform penetration testing across web apps, decrypt cryptographic configurations, and manage patches.", tags: "Burp Suite, Wireshark, Metasploit, CEH Certification" }
                ]
            },

            // --- UG Medicine & Allied ---
            'med-physician': {
                title: "Medical Officer / Registered General Physician",
                desc: "Diagnose systemic human ailments, direct clinical treatment pathways, and drive localized public health policies.",
                steps: [
                    { title: "Step 1: Academic MBBS Tenure", desc: "Conclude 4.5 years of rigorous pre-clinical, para-clinical, and clinical medical education.", tags: "MBBS Degree" },
                    { title: "Step 2: Compulsory Rotatory Internship (CRRI)", desc: "Acquire hands-on training across emergency trauma rooms, surgical theatres, and outpatient departments.", tags: "1-Year Clinical Residency" }
                ]
            },
            'med-pharma': {
                title: "Clinical Research Director & Pharmacist",
                desc: "Formulate drug delivery systems, run clinical trial protocols, and maintain strict pharmaceutical regulations.",
                steps: [
                    { title: "Step 1: Pharmacology Essentials", desc: "Master biochemistry, medicinal chemistry, toxicology vectors, and complex manufacturing methodologies.", tags: "B.Pharm / Pharm.D Academic Track" },
                    { title: "Step 2: Trial Coordination & Quality Assurance", desc: "Enforce Good Clinical Practice (GCP) codes and direct bio-equivalence testing workflows.", tags: "FDA Compliance, SAS Clinical Training" }
                ]
            },
            'med-biotech': {
                title: "Biotechnology R&D Lab Researcher",
                desc: "Engineer genetic modifications, isolate synthetic proteins, and design novel diagnostic kits.",
                steps: [
                    { title: "Step 1: Molecular Biology Foundations", desc: "Gain command over gene splicing mechanisms, cell culture operations, and recombinant DNA setups.", tags: "B.Tech / B.Sc Biotechnology" },
                    { title: "Step 2: Bio-Informatics & Data Modeling", desc: "Utilize computational engines to map complex genomic profiles and model protein folding structures.", tags: "BLAST Tools, Next-Gen Sequencing (NGS)" }
                ]
            },

            // --- UG Arts, Commerce & Law ---
            'arts-ca': {
                title: "Chartered Accountant (CA Qualification)",
                desc: "The elite professional standard governing corporate accounting, audit protocols, and financial strategies in India.",
                steps: [
                    { title: "Step 1: Establish Foundation", desc: "Register with the central institute and clear the baseline accounting entrance test.", tags: "ICAI CA Foundation Exam" },
                    { title: "Step 2: Intermediate Tier Success", desc: "Qualify across multi-subject groups spanning complex corporate law structures and audit methodologies.", tags: "CA Intermediate Certification" },
                    { title: "Step 3: Mandatory Executive Articleship", desc: "Complete 2 years of intense practical training directly under a registered auditing firm.", tags: "Practical Professional Training" },
                    { title: "Step 4: Final Assessment Board", desc: "Clear the ultimate advanced groups to receive statutory financial signing authorization.", tags: "CA Final Designation" }
                ]
            },
            'arts-lawyer': {
                title: "Corporate Lawyer & Legal Consultant",
                desc: "Structure corporate mergers, navigate international compliance frameworks, and represent enterprises in judicial setups.",
                steps: [
                    { title: "Step 1: Legal Education & Jurisprudence", desc: "Acquire comprehensive knowledge across constitutional laws, contracts, intellectual property, and arbitration.", tags: "LL.B / Integrated BA-LL.B Degree" },
                    { title: "Step 2: Bar Council Enrollment & Litigation", desc: "Clear the All India Bar Examination to obtain practicing rights across provincial high courts and the supreme court.", tags: "AIBE Certification, Bar Council Registry" }
                ]
            },
            'arts-civil-servant': {
                title: "Civil Services Career Track (IAS / IPS Officers)",
                desc: "Govern public administration infrastructure, policy implementation, and law enforcement frameworks across India.",
                steps: [
                    { title: "Step 1: Preliminary Filtering Test", desc: "Attempt the objective-type nationwide screening exam checking general awareness and analytical skills.", tags: "UPSC Prelims (GS & CSAT)" },
                    { title: "Step 2: Descriptive Main Examination", desc: "Write comprehensive academic essays and deep-dive subject evaluations across multiple specialized areas.", tags: "UPSC Mains (9 Conventional Papers)" },
                    { title: "Step 3: Personality Evaluation & Interview", desc: "Pass the comprehensive oral interview conducted by the central board assessing leadership traits and ethical integrity.", tags: "UPSC Interview Phase" }
                ]
            },

            // --- Cross-Over Postgraduate & Higher Studies Nodes ---
            'pg-gate-mtech': {
                title: "Higher Studies: M.Tech via GATE Admission",
                desc: "Secure advanced specializations from premium national institutions to access elite engineering R&D roles.",
                steps: [
                    { title: "Step 1: Achieve High National Score", desc: "Master the comprehensive undergraduate engineering syllabus for a technical national examination.", tags: "GATE Exam Registration" },
                    { title: "Step 2: Institutional Counseling Admissions", desc: "Secure specialized academic seats across premier technological research universities.", tags: "IIT / NIT M.Tech Admission" },
                    { title: "Step 3: Thesis Defense & Industry Integration", desc: "Conclude structural industrial research projects and publish authoritative technical papers.", tags: "Postgraduate Engineering Degree" }
                ]
            },
            'pg-ms-abroad': {
                title: "International Master of Science (MS Research Track)",
                desc: "Acquire global research experience and specialization across international technological ecosystems.",
                steps: [
                    { title: "Step 1: Standardized Profiles Hardening", desc: "Clear language and analytic proficiency exams while compiling letters of academic recommendation.", tags: "GRE / TOEFL / IELTS Credentials" },
                    { title: "Step 2: Statement of Purpose & Professor Alignment", desc: "Draft a concise description of your intended research goals and secure funding/research assistantships.", tags: "SOP & Research Grant Allocation" }
                ]
            },
            'pg-mba': {
                title: "Master of Business Administration (MBA Executive Line)",
                desc: "Pivot technical capabilities into corporate leadership, strategy consulting, and product lifecycle management.",
                steps: [
                    { title: "Step 1: National Management Screening", desc: "Master analytical reasoning, verbal comprehension, and complex data interpretation.", tags: "CAT / XAT / GMAT Gateways" },
                    { title: "Step 2: Case Analysis & Strategic Internships", desc: "Evaluate corporate case studies and engage with Fortune 500 tech firms during summer training camps.", tags: "IIM / Top Business School Frameworks" }
                ]
            },
            'pg-neet-pg': {
                title: "MD / MS Specialization via NEET-PG Admissions",
                desc: "Acquire specific clinical specialization (Cardiology, Neurology, Surgery) to operate as a consultant.",
                steps: [
                    { title: "Step 1: Core Domain Mastery", desc: "Revise all 19 medical subjects learned during the MBBS tenure to tackle clinical scenario problems.", tags: "NEET-PG Competitive Matrix" },
                    { title: "Step 2: Specialized Clinical Residency", desc: "Undergo 3 years of intense practical hospital operations, case defenses, and emergency management.", tags: "MD / MS Specialty Designation" }
                ]
            },
            'pg-ma-mcom': {
                title: "Master of Arts / Master of Commerce (Post-Graduation)",
                desc: "Advanced academic tracks tailored for corporate fiscal analytics, economics research, or financial management.",
                steps: [
                    { title: "Step 1: Post Graduate Entrance Examinations", desc: "Qualify central university entrance examinations assessing conceptual undergraduate depth.", tags: "CUET-PG / Institutional Screenings" },
                    { title: "Step 2: Advanced Core Specialization", desc: "Conclude comprehensive econometric mapping or advanced sociological case documentation.", tags: "Master's Thesis Submission" }
                ]
            },
            'pg-rnd-scientist': {
                title: "Research & Development Senior Scientist",
                desc: "Drive innovative product discovery models within premium state defense labs or corporate research centers.",
                steps: [
                    { title: "Step 1: Build Research Portfolio", desc: "Publish high-impact articles in globally indexed peer-reviewed scientific journals.", tags: "Scopus / IEEE Publication Frameworks" },
                    { title: "Step 2: Direct Scientific Recruitment Recruitment", desc: "Clear strategic interviews handled by bodies like DRDO, ISRO, or multinational tech labs.", tags: "Scientist Group-A Designation" }
                ]
            },
            'pg-professor': {
                title: "University Professor & Academic Researcher",
                desc: "Deliver advanced lectures, mentor doctoral candidates, and run institutional research labs.",
                steps: [
                    { title: "Step 1: National Lecture Qualification", desc: "Clear national eligibility assessments proving profound domain command and teaching aptitude.", tags: "UGC-NET / CSIR-NET Credentials" },
                    { title: "Step 2: Institutional Career Progression", desc: "Begin as an Assistant Professor, publish steady literature, and secure permanent academic chairs.", tags: "Academic Rank Indexing" }
                ]
            },
            'pg-phd': {
                title: "Doctoral Fellowship Programme (Ph.D.)",
                desc: "The ultimate academic frontier involving the generation of entirely new knowledge and structural paradigms.",
                steps: [
                    { title: "Step 1: Research Proposal Formulation", desc: "Draft an authoritative thesis synopsis highlighting unexplored problems in your domain.", tags: "JRF Fellowship Allocation" },
                    { title: "Step 2: Rigorous Defense & Dissertation", desc: "Conduct multi-year controlled experimentation, defend claims before international boards, and publish your final thesis.", tags: "Doctor of Philosophy Title" }
                ]
            }
        };

        // Stream Tab Controller
        function switchStream(streamId, buttonElement) {
            // Hide all active option panels
            const panels = document.querySelectorAll('.split-panel');
            panels.forEach(panel => panel.classList.remove('active'));

            // Clear any open roadmap viewcards
            const roadmapCard = document.getElementById('master-roadmap-view');
            roadmapCard.classList.remove('active');

            // Reset selection status across all buttons
            const streamButtons = document.querySelectorAll('.stream-btn');
            streamButtons.forEach(btn => btn.classList.remove('active'));
            
            const targetButtons = document.querySelectorAll('.target-btn');
            targetButtons.forEach(btn => btn.classList.remove('active'));

            // Show current target section panel
            const targetPanel = document.getElementById(streamId);
            if(targetPanel) targetPanel.classList.add('active');
            
            // Mark current selection header button active
            buttonElement.classList.add('active');
        }

        // Dynamic Roadmap Engine Renderer
        function renderRoadmap(roadmapKey) {
            // Update active status for target option list buttons
            const targetButtons = document.querySelectorAll('.target-btn');
            targetButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active styling to the clicked element
            const clickedBtn = event.currentTarget;
            if(clickedBtn) clickedBtn.classList.add('active');

            const viewContainer = document.getElementById('master-roadmap-view');
            const data = careerDatabase[roadmapKey];

            // Safety Fallback for non-mapped records
            if (!data) {
                viewContainer.innerHTML = `
                    <h3 class="meta-title">Detailed Roadmap In Preparation</h3>
                    <p class="meta-desc">The specific timeline layout configuration for key "${roadmapKey}" is currently being populated into the index directory database. Please select another operational route option above.</p>
                `;
                viewContainer.classList.add('active');
                return;
            }

            // Build structural timeline HTML sequence programmatically
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

            // Inject the generated HTML into the display card container
            viewContainer.innerHTML = timelineHTML;
            viewContainer.classList.add('active');
        }
    </script>
</body>
</html>