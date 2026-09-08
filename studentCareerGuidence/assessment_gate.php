<?php
header('Content-Type: application/json');

// 1. Sub-Branch Ecosystem Mapping Engine Database
// academicSchema లో ఉన్న ప్రతి సబ్-బ్రాంచ్ ఇక్కడ మ్యాప్ చేయబడింది
$ecosystemDatabase = [
    // --- Schooling Stream ---
    'General Science & Mathematics' => [
        'jobs' => ['Junior Tech Lab Assistant', 'Data Entry Executive'],
        'education' => ['Intermediate MPC Track', 'Intermediate BiPC Track']
    ],
    'Social Sciences & Languages' => [
        'jobs' => ['Content Writer Intern', 'Office Assistant'],
        'education' => ['Intermediate HEC Track', 'Intermediate CEC Track']
    ],
    'IT Skills Foundations' => [
        'jobs' => ['Hardware Repair Technician', 'Computer Operator'],
        'education' => ['Diploma in Computer Science', 'Vocational Intermediate IT']
    ],
    'Basic Electronic Mechanics' => [
        'jobs' => ['Apprentice Electrician', 'Electronic Service Assistant'],
        'education' => ['Diploma in Electrical Engineering', 'ITI Electronics Certification']
    ],

    // --- Intermediate Stream ---
    'Engineering Entrance Track' => [
        'jobs' => ['Technical Support Apprentice', 'Freelance Basic UI Builder'],
        'education' => ['B.Tech Computer Science', 'B.Tech Electronics (ECE)']
    ],
    'Pure Sciences Architecture' => [
        'jobs' => ['Lab Analyst Associate', 'Scientific Content Assistant'],
        'education' => ['B.Sc Data Science', 'B.Sc Mathematics']
    ],
    'Medical Entrance Domain' => [
        'jobs' => ['Medical Lab Auxiliary Practitioner', 'Pharmacy Sales Representative'],
        'education' => ['MBBS Degree Program', 'B.Pharmacy Graduate Track']
    ],
    'Agricultural & Bio Sciences' => [
        'jobs' => ['Farming Technology Assistant', 'Bio-Lab Assistant'],
        'education' => ['B.Sc Agriculture', 'B.Sc Biotechnology']
    ],
    'Accountancy & Business Systems' => [
        'jobs' => ['Junior Bookkeeper', 'Accounts Assistant'],
        'education' => ['B.Com (Computers/Honours)', 'BBA (Management Systems)']
    ],
    'Actuarial Logical Streams' => [
        'jobs' => ['Data Audit Clerk', 'Statistical Assistant'],
        'education' => ['B.Sc Statistics', 'Integrated Master of Economics']
    ],
    'Historical Frameworks & Civics' => [
        'jobs' => ['NGO Field Coordinator', 'Documentation Assistant'],
        'education' => ['BA International Relations', 'BA Political Science']
    ],
    'Fine Arts & Languages' => [
        'jobs' => ['Junior Graphic Illustrator', 'Translator Associate'],
        'education' => ['Bachelor of Fine Arts (BFA)', 'BA English Literature']
    ],

    // --- UG Stream ---
    'Computer Science (CSE)' => [
        'jobs' => ['Full-Stack Developer', 'Cyber Security Analyst', 'Cloud DevOps Engineer'],
        'education' => ['M.Tech Advanced Cyber Security', 'MS Data Science (Global)']
    ],
    'Artificial Intelligence & ML' => [
        'jobs' => ['Machine Learning Engineer', 'Data Scientist', 'AI Prompt Architect'],
        'education' => ['Ph.D. Neural Computing Networks', 'M.Tech Robotics & Automation']
    ],
    'Electronics & Comm (ECE)' => [
        'jobs' => ['Embedded Systems Engineer', 'VLSI Design Engineer'],
        'education' => ['M.Tech VLSI & Embedded Systems', 'MS Embedded Software']
    ],
    'Mechanical Engineering' => [
        'jobs' => ['CAD Design Engineer', 'Production Plant Supervisor'],
        'education' => ['M.Tech Robotics & Automation', 'MBA Global Supply Chain Systems']
    ],
    'Civil Engineering' => [
        'jobs' => ['Structural Site Engineer', 'Quantity Surveyor'],
        'education' => ['M.Tech Structural Engineering', 'MBA Infrastructure Management']
    ],
    'MBBS (General Medicine)' => [
        'jobs' => ['Junior Resident Medical Officer', 'Public Health Consultant'],
        'education' => ['MD Cardiology / Internal Medicine', 'MS Orthopedics Surgery Frameworks']
    ],
    'BDS (Dental Surgery)' => [
        'jobs' => ['Associate Dental Surgeon', 'Dental Consultant'],
        'education' => ['MDS Oral & Maxillofacial Surgery', 'Masters in Hospital Administration']
    ],
    'B.Pharmacy' => [
        'jobs' => ['Drug Regulatory Associate', 'Quality Control Analyst'],
        'education' => ['M.Pharm Industrial Pharmacy', 'MBA Pharma Management']
    ],
    'BPT (Physiotherapy)' => [
        'jobs' => ['Clinical Physiotherapist', 'Sports Rehab Specialist'],
        'education' => ['MPT Sports Physiotherapy', 'Advanced Manual Therapy Certification']
    ],
    'B.Com (Computers/Honours)' => [
        'jobs' => ['Investment Banker', 'Corporate Accountant', 'Financial Analyst'],
        'education' => ['Chartered Accountancy (ICAI)', 'MBA Data Analytics & Finance']
    ],
    'BBA (Management Systems)' => [
        'jobs' => ['Business Development Executive', 'HR Talent Acquisition Specialist'],
        'education' => ['MBA Digital Product Management', 'MBA Global Supply Chain Systems']
    ],
    'B.Sc Data Science' => [
        'jobs' => ['Junior Data Analyst', 'Business Intelligence Developer'],
        'education' => ['MS Data Science (Global)', 'MBA Data Analytics & Finance']
    ],
    'BA International Relations' => [
        'jobs' => ['Policy Research Associate', 'Public Relations Specialist'],
        'education' => ['Master of Public Health (MPH)', 'MA Global Governance & Diplomacy']
    ],

    // --- PG Stream ---
    'Advanced Cyber Security' => [
        'jobs' => ['Chief Information Security Officer (CISO)', 'Lead Pen-Tester'],
        'education' => ['Post-Doctoral Cybersecurity Research', 'CISM / CISSP Advanced Industry Credentials']
    ],
    'VLSI & Embedded Systems' => [
        'jobs' => ['Principal VLSI Architect', 'SoC Verification Engineer'],
        'education' => ['Ph.D. Microelectronics', 'Advanced ASIC Design Fellowships']
    ],
    'Robotics & Automation Systems' => [
        'jobs' => ['Robotics Controls Engineer', 'Automation Systems Architect'],
        'education' => ['Ph.D. Autonomous Systems', 'Advanced Industrial Robotics Fellowship']
    ],
    'Data Analytics & Finance' => [
        'jobs' => ['Chief Financial Officer Strategist', 'Portfolio Risk Director'],
        'education' => ['Chartered Financial Analyst (CFA L3 Title)', 'Executive Management Fellowship']
    ],
    'Global Supply Chain Systems' => [
        'jobs' => ['Director of Logistics Operations', 'Supply Chain Risk Strategist'],
        'education' => ['Ph.D. Operations Research', 'CSCMP Supply Chain Master Designation']
    ],
    'Digital Product Management' => [
        'jobs' => ['Director of Product', 'Chief Product Officer (CPO)'],
        'education' => ['Executive MBA in Strategy', 'Product Leadership Fellowship']
    ],
    'Cardiology / Internal Medicine' => [
        'jobs' => ['Consultant Cardiologist', 'Medical Director'],
        'education' => ['DM Interventional Cardiology', 'Post-Doctoral Fellowship in Cardiology']
    ],
    'Orthopedics Surgery Frameworks' => [
        'jobs' => ['Consultant Orthopedic Surgeon', 'Trauma Unit Chief'],
        'education' => ['M.Ch Joint Replacement Surgery', 'Arthroplasty Fellowship']
    ]
];

// 2. Structural Master Roadmaps Repository Matrix
// ప్రతి ఆప్షన్ యొక్క స్ట్రింగ్ ని లోయర్ కేస్ లో కీస్ గా సెట్ చేసాము, దీనివల్ల వందకు వంద శాతం మ్యాచ్ అవుతుంది
$matrixRoadmaps = [
    // --- SCHOOLING LEVEL ROADS ---
    'junior tech lab assistant' => [
        'title' => 'Junior Technical Lab Assistant Career Track',
        'desc' => 'Entry-level pathway into educational institutes and private testing laboratories.',
        'steps' => [
            ['title' => 'Step 1: Safety & Equipment Mastery', 'info' => 'Learn proper handling of laboratory glassware, basic chemical handling rules, and electronic scale calibration.'],
            ['title' => 'Step 2: Log Keeping & Inventories', 'info' => 'Master data documentation, stock registry management using MS Excel, and equipment cataloging.']
        ]
    ],
    'data entry executive' => [
        'title' => 'Data Entry & Office Administration Operations',
        'desc' => 'Professional track focusing on speed, accuracy, and digital record management.',
        'steps' => [
            ['title' => 'Step 1: Keyboard Ergonomics & Speed', 'info' => 'Achieve 40+ WPM typing speed with 98%+ accuracy using touch typing systems.'],
            ['title' => 'Step 2: Office Suites Mastery', 'info' => 'Master spreadsheet formulas, data validation techniques, and formatting structures in Google Sheets & MS Excel.']
        ]
    ],
    'content writer intern' => [
        'title' => 'Content Writing & Copywriting Apprenticeship',
        'desc' => 'Entry path into digital marketing agencies and creative writing industries.',
        'steps' => [
            ['title' => 'Step 1: Grammar & Narrative Foundations', 'info' => 'Master sentence structures, tone modulation, and proofreading mechanisms.'],
            ['title' => 'Step 2: Basic SEO SEO Principles', 'info' => 'Understand keyword placement, readability scoring, and writing engaging meta-descriptions.']
        ]
    ],
    'office assistant' => [
        'title' => 'Corporate Office Management & Clerical Track',
        'desc' => 'Foundational pathway for maintaining office operations and document indexing.',
        'steps' => [
            ['title' => 'Step 1: Document Control Systems', 'info' => 'Learn scanning, systemic indexing, and maintaining sensitive physical and digital files.'],
            ['title' => 'Step 2: Communication Protocols', 'info' => 'Master formal email formatting, telephone etiquettes, and managing meeting calendars.']
        ]
    ],
    'hardware repair technician' => [
        'title' => 'Computer Hardware Repair & Assembly Specialist',
        'desc' => 'Technical track focused on troubleshooting, building, and upgrading computing rigs.',
        'steps' => [
            ['title' => 'Step 1: Component Diagnostics', 'info' => 'Learn to identify and isolate faults across Motherboards, SMPS units, RAM sticks, and storage drives.'],
            ['title' => 'Step 2: OS Installation & Troubleshooting', 'info' => 'Master dual booting, BIOS configurations, driver updates, and data backup operations.']
        ]
    ],
    'computer operator' => [
        'title' => 'Professional Computer Operator Track',
        'desc' => 'Managing local networks, database entries, and executing administrative computing tasks.',
        'steps' => [
            ['title' => 'Step 1: OS Navigation & Command Line', 'info' => 'Learn file permissions, software installation pathways, and network sharing utilities.'],
            ['title' => 'Step 2: Security Basics', 'info' => 'Understand local malware cleaning protocols, safe internet browsing practices, and peripheral data transfers.']
        ]
    ],
    'apprentice electrician' => [
        'title' => 'Electrical Grid & Home Automation Technician',
        'desc' => 'Vocational blueprint tracking industrial power grids and domestic circuits wiring systems.',
        'steps' => [
            ['title' => 'Step 1: Safety & Circuit Basics', 'info' => 'Master Ohm\'s law, multi-meter operation, safety gear systems, and reading structural blue-prints.'],
            ['title' => 'Step 2: Power Installation', 'info' => 'Learn conduit routing, commercial fuse configurations, inverter installations, and basic line diagnostics.']
        ]
    ],
    'electronic service assistant' => [
        'title' => 'Consumer Electronics Troubleshooting Track',
        'desc' => 'Micro-soldering, integrated circuits engineering, and appliance servicing.',
        'steps' => [
            ['title' => 'Step 1: Soldering & Components', 'info' => 'Master PCB desoldering, testing resistors, capacitors, and identifying transistor breakdowns.'],
            ['title' => 'Step 2: Smart Appliance Troubleshooting', 'info' => 'Learn smart TV circuit tracing, IoT component assembly, and micro-controller diagnostic procedures.']
        ]
    ],

    // --- INTERMEDIATE LEVEL ROADS ---
    'technical support apprentice' => [
        'title' => 'IT Helpdesk & Systems Technical Support Agent',
        'desc' => 'Resolving client infrastructure complaints, active directory operations, and network routing fixes.',
        'steps' => [
            ['title' => 'Step 1: Networking & Troubleshooting Protocols', 'info' => 'Master IP configurations, DNS flushing, ping commands, and remote access operations.'],
            ['title' => 'Step 2: Ticket Management', 'info' => 'Learn SLA timelines, handling tickets via Jira Service Desk, and escalating architectural bugs.']
        ]
    ],
    'freelance basic ui builder' => [
        'title' => 'Independent Frontend User Interface Layout Builder',
        'desc' => 'Building responsive responsive webpage grids directly for international remote clients.',
        'steps' => [
            ['title' => 'Step 1: Semantic Markup & Styling', 'info' => 'Master flexbox layouts, CSS custom variables, and responsive media queries.'],
            ['title' => 'Step 2: No-Code & CMS Integrations', 'info' => 'Learn to convert Figma artboards into functional web applications via Webflow or clean WordPress custom editors.']
        ]
    ],
    'lab analyst associate' => [
        'title' => 'Chemical Quality Assurance & Lab Analyst Associate',
        'desc' => 'Evaluating chemical batch processing parameters inside production and manufacturing plants.',
        'steps' => [
            ['title' => 'Step 1: Analytical Instrumentation', 'info' => 'Learn pH metrics tracking, titration techniques, and basic spectrophotometry operation.'],
            ['title' => 'Step 2: Compliance Logging', 'info' => 'Understand standard batch control parameters and logging documentation under GLP (Good Laboratory Practices).']
        ]
    ],
    'scientific content assistant' => [
        'title' => 'Scientific Literature & Academic Editing Associate',
        'desc' => 'Formatting, proofreading, and reviewing journals for academic publication houses.',
        'steps' => [
            ['title' => 'Step 1: Reference Citation Matrix', 'info' => 'Master scientific citation styles including APA, MLA, Harvard, and Chicago index methodologies.'],
            ['title' => 'Step 2: Publishing Software', 'info' => 'Learn document compiling via LaTeX frameworks and tracking revisions using Adobe Professional tools.']
        ]
    ],
    'medical lab auxiliary practitioner' => [
        'title' => 'Medical Lab Technology Auxiliary Practitioner',
        'desc' => 'Processing patient bio-samples, blood tracking, and pathology laboratory testing structures.',
        'steps' => [
            ['title' => 'Step 1: Phlebotomy & Sample Sorting', 'info' => 'Master safe blood collection protocols, anticoagulant rules, and high-speed centrifuge separation processes.'],
            ['title' => 'Step 2: Pathology Automated Analysis', 'info' => 'Learn to operate automated CBC analyzers and execute micro-biological smear staining.']
        ]
    ],
    'pharmacy sales representative' => [
        'title' => 'Pharmaceutical Product Specialist (Medical Representative)',
        'desc' => 'B2B pharmaceutical market development, institutional networking, and medical outreach.',
        'steps' => [
            ['title' => 'Step 1: Pharmacology Product Mastery', 'info' => 'Understand drug action mechanisms, contraindications, and comparative clinical benefits.'],
            ['title' => 'Step 2: Strategic Doctor Pitching', 'info' => 'Master conversational detailing, clinic queue management, CRM data tracking, and distribution network fulfillment.']
        ]
    ],
    'farming technology assistant' => [
        'title' => 'Precision Agriculture & Smart Farming Systems Advisor',
        'desc' => 'Implementing hydro-agriculture systems, drone surveying, and automated soil tracking.',
        'steps' => [
            ['title' => 'Step 1: Soil & Nutrient Automation', 'info' => 'Learn to handle NPK sensors, automate drip irrigation networks, and analyze soil pH metrics.'],
            ['title' => 'Step 2: Greenhouse Control Systems', 'info' => 'Manage automated temperature, humidity loops, and hydroponic nutrient solution compositions.']
        ]
    ],
    'bio-lab assistant' => [
        'title' => 'Biotechnology & Genetic Culture Lab Assistant',
        'desc' => 'Maintaining bio-reactors, preparing culture mediums, and sterile cleanroom operations.',
        'steps' => [
            ['title' => 'Step 1: Sterilization & Media Preparation', 'info' => 'Master autoclave cycles, preparing agar plate setups, and maintaining absolute aseptic workflow steps.'],
            ['title' => 'Step 2: Cell Culture Monitoring', 'info' => 'Track cell line growth parameters, manage cryogenic freezing arrays, and clean bio-hazard waste systems.']
        ]
    ],
    'junior bookkeeper' => [
        'title' => 'Junior Bookkeeping & Financial Entry Associate',
        'desc' => 'Tracking daily invoices, tracking ledger balances, and cash-flow inputs archiving.',
        'steps' => [
            ['title' => 'Step 1: Double-Entry Ledger Mechanics', 'info' => 'Master accounting debit/credit frameworks, journals allocation rules, and bank reconciliation processes.'],
            ['title' => 'Step 2: Accounting Applications Execution', 'info' => 'Learn professional data accounting loops using Tally Prime, Zoho Books, and basic QuickBooks layers.']
        ]
    ],
    'accounts assistant' => [
        'title' => 'Corporate Accounts Receivable & Payable Specialist',
        'desc' => 'Managing corporate billing pipelines, vendor balances, and operational cash tracking.',
        'steps' => [
            ['title' => 'Step 1: Invoice Validation Frameworks', 'info' => 'Learn to match purchase orders against commercial invoices and process multi-tier corporate payments.'],
            ['title' => 'Step 2: Vendor Ageing Metrics', 'info' => 'Generate accounting reports to identify overdue liabilities and optimize corporate credit cycles.']
        ]
    ],
    'data audit clerk' => [
        'title' => 'Compliance Data Audit & Records Review Clerk',
        'desc' => 'Scanning transactions histories to pinpoint accounting errors or fraudulent patterns.',
        'steps' => [
            ['title' => 'Step 1: Audit Sampling Inferences', 'info' => 'Learn statistical sample picking parameters and tracking deviations across structural ledgers.'],
            ['title' => 'Step 2: Verification Checklist Implementation', 'info' => 'Cross-verify transaction entries directly with physical tax receipts and invoice document databases.']
        ]
    ],
    'statistical assistant' => [
        'title' => 'Statistical Survey Analyst & Data Processing Assistant',
        'desc' => 'Aggregating regional survey data clusters to compile government and market evaluation reports.',
        'steps' => [
            ['title' => 'Step 1: Data Cleaning Procedures', 'info' => 'Identify outliers, handle missing values, and structure raw data inside Excel formats.'],
            ['title' => 'Step 2: Descriptive Modeling Metrics', 'info' => 'Calculate mean, median variances, standard deviations, and generate clear graphic histograms.']
        ]
    ],
    'ngo field coordinator' => [
        'title' => 'NGO Project Field Coordinator & Outreach Lead',
        'desc' => 'Deploying social development frameworks and managing ground operations.',
        'steps' => [
            ['title' => 'Step 1: Stakeholder Communication', 'info' => 'Conduct village surveys, coordinate group meetings, and evaluate local infrastructural needs.'],
            ['title' => 'Step 2: Impact Reporting Metrics', 'info' => 'Document project execution metrics, track fund allocation data, and author monthly impact summaries.']
        ]
    ],
    'documentation assistant' => [
        'title' => 'Public Archives & Legal Documentation Assistant',
        'desc' => 'Organizing regulatory certificates, affidavits, and corporate public filings.',
        'steps' => [
            ['title' => 'Step 1: Legal Cataloging Indexes', 'info' => 'Learn public classification frameworks, deed filing processes, and data confidentiality rules.'],
            ['title' => 'Step 2: Regulatory Portal Submissions', 'info' => 'Master filing applications across digital municipal frameworks and regional registrar interfaces.']
        ]
    ],
    'junior graphic illustrator' => [
        'title' => 'Vector Graphic Artist & Visual Illustrator Intern',
        'desc' => 'Crafting marketing visual components, digital vector graphics, and layouts.',
        'steps' => [
            ['title' => 'Step 1: Vector Geometries Mastery', 'info' => 'Master pen tools operation, bezier path curves, masking, and typography setups inside Adobe Illustrator.'],
            ['title' => 'Step 2: Layout & Color Rules', 'info' => 'Understand color wheel psychology, hierarchy grids, and asset export resolutions for print and digital apps.']
        ]
    ],
    'translator associate' => [
        'title' => 'Professional Translation & Localization Associate',
        'desc' => 'Translating corporate document records, scripts, and manuals between local languages.',
        'steps' => [
            ['title' => 'Step 1: Structural Linguistics Processing', 'info' => 'Master syntax conversions, cultural idiom localization, and professional vocabulary matching.'],
            ['title' => 'Step 2: CAT Tools Integration', 'info' => 'Learn translation workflows using SDL Trados tools, building glossary data, and maintaining formatting layers.']
        ]
    ],

    // --- UG LEVEL ROADS ---
    'full-stack developer' => [
        'title' => 'Full-Stack Software Engineering Blueprint',
        'desc' => 'Technical progression from local machine script deployments to global cloud hosting structures.',
        'steps' => [
            ['title' => 'Step 1: Interface Mechanics', 'info' => 'Master responsive rendering layers using HTML5, CSS3, modern JavaScript ES6, and client React environments.'],
            ['title' => 'Step 2: Server API Layers', 'info' => 'Build asynchronous server microservices using Node.js/Express frameworks alongside secure RESTful data serialization models.'],
            ['title' => 'Step 3: Database & Orchestration', 'info' => 'Implement PostgreSQL/MongoDB pipelines, integrate container virtualization using Docker tools, and setup deployment triggers.']
        ]
    ],
    'cyber security analyst' => [
        'title' => 'Enterprise Network Security Architecture',
        'desc' => 'Defensive threat prevention, systemic exploit diagnostics, and compliance network audits.',
        'steps' => [
            ['title' => 'Step 1: Network Topology Hardening', 'info' => 'Analyze network routing parameters, manage subnets, firewalls, and learn advanced Linux system permission structures.'],
            ['title' => 'Step 2: Penetration Testing Mechanics', 'info' => 'Leverage tools like Nmap, Wireshark, and Metasploit frameworks to isolate system configuration vulnerabilities.'],
            ['title' => 'Step 3: Enterprise Threat Intelligence', 'info' => 'Deploy enterprise SIEM dashboards (Splunk environment), write log alerts, and establish standard security compliance profiles.']
        ]
    ],
    'cloud devops engineer' => [
        'title' => 'Cloud Infrastructure & DevOps Masterclass',
        'desc' => 'Automating software delivery and managing highly scalable cloud environments using modern Infrastructure as Code.',
        'steps' => [
            ['title' => 'Step 1: Scripting & Cloud Core', 'info' => 'Deepen knowledge in Bash/Python scripting, SSH access management, and core services on AWS (EC2, VPC, S3).'],
            ['title' => 'Step 2: CI/CD & Containerization', 'info' => 'Master Docker container provisioning and build automated deployment pipelines with Jenkins or GitHub Actions.'],
            ['title' => 'Step 3: Infrastructure as Code', 'info' => 'Manage cloud infrastructure programmatically using Terraform and Kubernetes orchestration.']
        ]
    ],
    'machine learning engineer' => [
        'title' => 'Machine Learning Production Pipeline Track',
        'desc' => 'Algorithmic engineering roadmap converting statistical models into production-ready software systems.',
        'steps' => [
            ['title' => 'Step 1: Mathematical Foundations', 'info' => 'Master high-dimensional Linear Algebra, Vector Calculuses, Probability models, and Statistical Data Analysis structures.'],
            ['title' => 'Step 2: Model Engineering Mastery', 'info' => 'Deploy regression matrices, random decision trees, and classification pipelines exclusively inside Python Scikit-Learn tools.'],
            ['title' => 'Step 3: Neural Networks & MLOps Infrastructure', 'info' => 'Build deep learning architectures via PyTorch platforms. Scale automated model monitoring deployments with Kubernetes frameworks.']
        ]
    ],
    'data scientist' => [
        'title' => 'Advanced Data Science & Machine Learning Pipeline',
        'desc' => 'Industrial vector data modeling roadmap transforming unorganized transactional data clusters into business optimization algorithms.',
        'steps' => [
            ['title' => 'Step 1: Computational Pipeline Engineering', 'info' => 'Master Python pipelines using NumPy and Pandas libraries. Build clear data visualizations with Tableau and PowerBI dashboards.'],
            ['title' => 'Step 2: Algorithmic Training & Production Deployment', 'info' => 'Train supervised/unsupervised predictive models via Scikit-Learn. Optimize neural deep-learning systems with TensorFlow or PyTorch architectures.']
        ]
    ],
    'ai prompt architect' => [
        'title' => 'Generative AI & Prompt Engineering Track',
        'desc' => 'Designing context-aware LLM prompts, vector embeddings, and cognitive routing systems.',
        'steps' => [
            ['title' => 'Step 1: LLM Context Orchestration', 'info' => 'Master system prompts composition, zero-shot/few-shot engineering, and prompt routing logic.'],
            ['title' => 'Step 2: RAG Pipeline Integration', 'info' => 'Learn to chunk data, generate vector embeddings, store indexes inside Pinecone, and build dynamic retrieval applications.']
        ]
    ],
    'embedded systems engineer' => [
        'title' => 'Embedded Systems Firmware Engineering Track',
        'desc' => 'Writing low-level hardware control firmware, device drivers, and real-time computing systems.',
        'steps' => [
            ['title' => 'Step 1: Bare-Metal C Programming', 'info' => 'Master register-level programming, pointer configurations, and bitwise manipulations inside microcontrollers.'],
            ['title' => 'Step 2: RTOS Kernel Architectures', 'info' => 'Learn task scheduling, mutex configurations, semaphores handling, and peripheral communication (I2C, SPI, UART) via FreeRTOS.']
        ]
    ],
    'vlsi design engineer' => [
        'title' => 'VLSI Circuit Design & Silicon Verification',
        'desc' => 'Architecting integrated circuit systems, hardware synthesis, and micro-chip verification modules.',
        'steps' => [
            ['title' => 'Step 1: HDL System Modeling', 'info' => 'Master hardware description structures inside Verilog or VHDL platforms. Simulate digital logic arrays.'],
            ['title' => 'Step 2: RTL Synthesis & Timing Logic', 'info' => 'Learn logic synthesis tools, static timing analysis (STA), and managing clock domains setup.']
        ]
    ],
    'cad design engineer' => [
        'title' => 'Mechanical CAD Design & Generative Modeling Specialist',
        'desc' => 'Drafting 3D machine prototypes, stress simulations, and manufacturing assembly specifications.',
        'steps' => [
            ['title' => 'Step 1: Parametric 3D Solid Modeling', 'info' => 'Master complex solid state geometry design, constraints configurations, and assembly layouts in SolidWorks or Autodesk Inventor.'],
            ['title' => 'Step 2: FEA Stress Simulation Analytics', 'info' => 'Run structural finite element analysis (FEA), load distribution profiles testing, and fatigue prediction calculations.']
        ]
    ],
    'production plant supervisor' => [
        'title' => 'Manufacturing Production Plant Operations Lead',
        'desc' => 'Optimizing manufacturing line throughput, cycle times, and industrial safety compliance.',
        'steps' => [
            ['title' => 'Step 1: Lean Manufacturing Implementation', 'info' => 'Deploy Six Sigma paradigms, calculate OEE (Overall Equipment Effectiveness), and map value streams.'],
            ['title' => 'Step 2: Industrial Safety Regulations', 'info' => 'Enforce OSHA manufacturing standards, plan preventative maintenance routines, and handle shop-floor resources allocation.']
        ]
    ],
    'structural site engineer' => [
        'title' => 'Structural Construction Project Execution Lead',
        'desc' => 'Supervising concrete foundation reinforcement, site safety, and interpreting civil architectural prints.',
        'steps' => [
            ['title' => 'Step 1: Reinforcement Blueprint Interpretation', 'info' => 'Interpret detailed civil engineering drawings, load transfer structures, and verify bar bending schedules (BBS).'],
            ['title' => 'Step 2: Quality Concrete Quality Audits', 'info' => 'Run concrete slump evaluations, cube compression monitoring tests, and manage multi-tier site resource networks.']
        ]
    ],
    'quantity surveyor' => [
        'title' => 'Civil Quantity Surveying & Cost Estimation Engineer',
        'desc' => 'Compiling bills of quantities (BOQ), material cost tracking, and construction tender evaluations.',
        'steps' => [
            ['title' => 'Step 1: Material Take-Off Calculations', 'info' => 'Extract raw structural dimension data directly from digital blueprints to calculate bulk material requirements.'],
            ['title' => 'Step 2: Contractual Estimation Protocols', 'info' => 'Analyze market unit rates, build comprehensive BOQ structures inside Excel, and monitor project payment applications.']
        ]
    ],
    'junior resident medical officer' => [
        'title' => 'Clinical Ward Operations Junior Resident',
        'desc' => 'Managing inpatient diagnosis flows, emergency stabilization, and case histories profiling.',
        'steps' => [
            ['title' => 'Step 1: Patient Triage & Vitals Monitoring', 'info' => 'Master emergency resuscitation protocols, interpret complex diagnostic readouts, and manage ward rounds.'],
            ['title' => 'Step 2: Pharmaceutical Intervention Tracking', 'info' => 'Formulate patient drug dosage schedules, chart treatment updates, and coordinate critical surgical pre-ops.']
        ]
    ],
    'public health consultant' => [
        'title' => 'Epidemiological Public Health Program Consultant',
        'desc' => 'Designing community healthcare delivery programs and tracking disease outbreak trends.',
        'steps' => [
            ['title' => 'Step 1: Biostatistics & Data Sourcing', 'info' => 'Analyze regional health metric data clusters to trace epidemiological distribution patterns.'],
            ['title' => 'Step 2: Program Execution Audits', 'info' => 'Structure immunization policies and audit field healthcare delivery modules.']
        ]
    ],
    'associate dental surgeon' => [
        'title' => 'Clinical Dental Surgery Associate Specialist',
        'desc' => 'Performing complex root canal treatments, maxillofacial extractions, and prosthodontic repairs.',
        'steps' => [
            ['title' => 'Step 1: Advanced Endodontic Procedures', 'info' => 'Master rotary root canal workflows, digital apex locators, and crown restoration alignments.'],
            ['title' => 'Step 2: Minor Surgical Extractions', 'info' => 'Execute surgical impaction removals, manage local block anesthesia delivery, and direct post-op healing tracks.']
        ]
    ],
    'dental consultant' => [
        'title' => 'Corporate Dental Healthcare Consultant',
        'desc' => 'Auditing dental insurance claims, medical equipment sourcing, and clinical brand management.',
        'steps' => [
            ['title' => 'Step 1: Medical Insurance Claim Underwriting', 'info' => 'Review clinical pre-authorization charts and radiograph reports to validate insurance claim criteria.'],
            ['title' => 'Step 2: Clinical Practice Audits', 'info' => 'Establish standard operating protocols (SOPs) for corporate dental networks.']
        ]
    ],
    'drug regulatory associate' => [
        'title' => 'Pharmaceutical Regulatory Affairs Associate',
        'desc' => 'Compiling pharmacological data dossiers for formal international drug licensing submissions.',
        'steps' => [
            ['title' => 'Step 1: Dossier Formats Architecture', 'info' => 'Master Common Technical Document (CTD) formats, eCTD submissions, and data privacy regulations.'],
            ['title' => 'Step 2: Regional Filings Management', 'info' => 'Coordinate directly with regulatory authorities like CDSCO or FDA to process marketing authorizations.']
        ]
    ],
    'quality control analyst' => [
        'title' => 'Pharmaceutical Quality Control (QC) Analyst',
        'desc' => 'Executing chemical purity verification assays on bulk drug formulations.',
        'steps' => [
            ['title' => 'Step 1: Chromatographic Instrumentation', 'info' => 'Operate High-Performance Liquid Chromatography (HPLC) columns and gas chromatography setups.'],
            ['title' => 'Step 2: Compliance Protocols Validation', 'info' => 'Document assay calculations according to current Good Manufacturing Practices (cGMP) standards.']
        ]
    ],
    'clinical physiotherapist' => [
        'title' => 'Clinical Musculoskeletal Physiotherapist',
        'desc' => 'Diagnosing biomechanical imbalances and prescribing physical rehabilitation programs.',
        'steps' => [
            ['title' => 'Step 1: Orthopedic Assessment Frameworks', 'info' => 'Conduct range-of-motion assessments, nerve conduction tracing, and joint laxity diagnostic protocols.'],
            ['title' => 'Step 2: Therapeutic Modal Execution', 'info' => 'Design customized exercise physiology routines incorporating cryotherapy, dry needling, and manual manipulation.']
        ]
    ],
    'sports rehab specialist' => [
        'title' => 'Elite Sports Kinesiology & Rehabilitation Specialist',
        'desc' => 'Rehabilitating athletic injuries and designing sports performance optimization loops.',
        'steps' => [
            ['title' => 'Step 1: Acute Sports Trauma Control', 'info' => 'Implement soft-tissue damage management, advanced athletic taping, and initial on-field injury assessments.'],
            ['title' => 'Step 2: Functional Athletic Conditioning', 'info' => 'Build eccentric loading programs to return injured athletes safely back to competitive performance.']
        ]
    ],
    'investment banker' => [
        'title' => 'Investment Banking & Asset Capitalization Path',
        'desc' => 'Strategic institutional fundraising, valuations, corporate mergers, and stock market acquisitions.',
        'steps' => [
            ['title' => 'Step 1: Balance Sheet Auditing', 'info' => 'Develop expertise in corporate accounting standards, multi-layered asset sheets, and cash flow operations analysis.'],
            ['title' => 'Step 2: Corporate Valuation Frameworks', 'info' => 'Construct robust Leveraged Buyout (LBO) and Discounted Cash Flow (DCF) financial prediction models inside dynamic spreadsheets.'],
            ['title' => 'Step 3: Deal Execution Management', 'info' => 'Organize transaction parameters for corporate M&A deals and manage public equity fundraising pipeline procedures.']
        ]
    ],
    'corporate accountant' => [
        'title' => 'Corporate Management Accountant & Financial Controller',
        'desc' => 'Compiling profit statements, planning corporate tax returns, and managing asset allocations.',
        'steps' => [
            ['title' => 'Step 1: Statutory Financial Statement Compiling', 'info' => 'Prepare final Profit & Loss sheets, Balance Sheets, and Cash Flow metrics following local accounting standards.'],
            ['title' => 'Step 2: Corporate Taxation Filings', 'info' => 'Calculate corporate advance tax liabilities, compile GST reconciliations, and handle corporate tax filings.']
        ]
    ],
    'financial analyst' => [
        'title' => 'Corporate Financial Planning & Analysis (FP&A) Consultant',
        'desc' => 'Evaluating operational budget variations and analyzing industry asset trends.',
        'steps' => [
            ['title' => 'Step 1: Budget Variance Analytics', 'info' => 'Track actual corporate expenditure metrics against quarterly budget projections to locate cost leakage.'],
            ['title' => 'Step 2: Cost-Benefit Modeling', 'info' => 'Construct forecast scenarios to analyze the economic viability of prospective corporate expansions.']
        ]
    ],
    'business development executive' => [
        'title' => 'B2B Enterprise Sales & Strategic Partnerships Track',
        'desc' => 'Mastering high-ticket pipeline acquisition, contract negotiations, and corporate relationship building.',
        'steps' => [
            ['title' => 'Step 1: Lead Sourcing & Outreach Mechanics', 'info' => 'Master cold outbound systems using LinkedIn Sales Navigator, email personalization software, and tracking metrics inside Salesforce CRM.'],
            ['title' => 'Step 2: Consultative Discovery & Solution Pitching', 'info' => 'Learn complex qualification frameworks (BANT, MEDDPICC). Deliver high-impact customized product demonstrations aligned with client pain points.'],
            ['title' => 'Step 3: Deal Closing & Account Expansion Protocols', 'info' => 'Master enterprise-level contract negotiations, procurement processes, legal SLA reviews, and driving corporate upsells.']
        ]
    ],
    'hr talent acquisition specialist' => [
        'title' => 'Strategic Corporate Recruiter & Talent Sourcer',
        'desc' => 'Managing pipeline sourcing loops, conducting interviews, and planning competitive compensation layouts.',
        'steps' => [
            ['title' => 'Step 1: Boolean Sourcing Pipelines', 'info' => 'Build advanced search strings inside LinkedIn Recruiter and job portals to locate top technical profiles.'],
            ['title' => 'Step 2: Competency-Based Interviewing', 'info' => 'Run behavior evaluation rounds via STAR frameworks and negotiate candidate compensation packages.']
        ]
    ],
    'junior data analyst' => [
        'title' => 'Junior Data Analyst & Metrics Dashboard Developer',
        'desc' => 'Structuring databases queries, generating reports, and tracking business key metrics.',
        'steps' => [
            ['title' => 'Step 1: Advanced Relational SQL Queries', 'info' => 'Master database multi-table joins, subqueries, and window analytical transformations inside PostgreSQL.'],
            ['title' => 'Step 2: BI Dashboard Engineering', 'info' => 'Build interactive data reports using PowerBI or Tableau, connecting directly to live corporate data pipelines.']
        ]
    ],
    'business intelligence developer' => [
        'title' => 'Business Intelligence (BI) Platform Architect',
        'desc' => 'Designing enterprise data warehouses, ETL processing pipelines, and data models.',
        'steps' => [
            ['title' => 'Step 1: Data Warehouse Modeling', 'info' => 'Master star/snowflake schemas architecture, dimensional modeling, and managing central data lakes.'],
            ['title' => 'Step 2: ETL Pipeline Development', 'info' => 'Write automated python scripts or utilize tools like Talend to clean and transform unorganized corporate datasets.']
        ]
    ],
    'policy research associate' => [
        'title' => 'Public Policy Research Analyst',
        'desc' => 'Analyzing government regulations, socioeconomic trends, and writing legislative briefs.',
        'steps' => [
            ['title' => 'Step 1: Qualitative Research Methodologies', 'info' => 'Conduct policy reviews, case study evaluations, and historical legal code analysis.'],
            ['title' => 'Step 2: Legislative Impact Briefing', 'info' => 'Draft non-partisan policy briefs analyzing the socioeconomic consequences of prospective regulatory updates.']
        ]
    ],
    'public relations specialist' => [
        'title' => 'Corporate Communications & Public Relations (PR) Specialist',
        'desc' => 'Managing brand reputation, drafting press releases, and steering crisis communications.',
        'steps' => [
            ['title' => 'Step 1: Media Ecosystem Networking', 'info' => 'Build media distribution networks, organize press conferences, and pitch brand narratives to journalists.'],
            ['title' => 'Step 2: Crisis Narrative Control', 'info' => 'Formulate fast public statements to address brand controversies and maintain public narrative alignment.']
        ]
    ],

    // --- INTERMEDIATE TO UG TRANSITIONS (EDUCATION PATHS) ---
    'b.tech computer science' => [
        'title' => 'Undergraduate Engineering Transition Plan (B.Tech CSE)',
        'desc' => 'Transitioning from secondary schooling science to advanced academic engineering principles.',
        'steps' => [
            ['title' => 'Year 1-2: Core Algorithms & Computation', 'info' => 'Focus heavily on Object-Oriented Programming principles, Data Structures, Discrete Mathematics, and Computer Architecture concepts.'],
            ['title' => 'Year 3-4: Elective Specializations', 'info' => 'Choose focus domains like Database Management, Compiler Design, Distributed Systems, and complete capstone software applications.']
        ]
    ],
    'intermediate mpc track' => [
        'title' => 'Higher Secondary MPC (Mathematics, Physics, Chemistry) Track',
        'desc' => 'Building advanced foundations for technical engineering entrance matrices.',
        'steps' => [
            ['title' => 'Year 1: Calculus & Classical Physics', 'info' => 'Master differential calculus, coordinate geometry, Newtonian mechanics, and atomic structures.'],
            ['title' => 'Year 2: Integration & Organic Foundations', 'info' => 'Deep dive into integral calculus, electrodynamics, matrix theory, and organic carbon compounds mechanisms.']
        ]
    ],
    'intermediate bipc track' => [
        'title' => 'Higher Secondary BiPC (Biology, Physics, Chemistry) Track',
        'desc' => 'Preparatory academic pathway for core medical, dental, and biotechnology domains.',
        'steps' => [
            ['title' => 'Year 1: Human Physiology & Cell Biology', 'info' => 'Study plant and animal classifications, cellular morphology, biomolecules, and basic organic chemistry reactions.'],
            ['title' => 'Year 2: Genetics & Plant Physiology', 'info' => 'Master Mendelian inheritance mechanics, molecular genetics, human reproduction, and inorganic coordination chemistry.']
        ]
    ],
    'intermediate hec track' => [
        'title' => 'Higher Secondary HEC (History, Economics, Civics) Track',
        'desc' => 'Foundational social sciences pathway for civil services, law, and administrative paths.',
        'steps' => [
            ['title' => 'Year 1: Ancient Civilizations & Microeconomics', 'info' => 'Study early human settlements, economic demand-supply loops, and foundational political concepts.'],
            ['title' => 'Year 2: Modern History & Macroeconomic Frameworks', 'info' => 'Analyze national constitutions, Indian macroeconomic planning, and global historical turning points.']
        ]
    ],
    'intermediate cec track' => [
        'title' => 'Higher Secondary CEC (Commerce, Economics, Civics) Track',
        'desc' => 'Foundational pathway for business administration, financial accountancy, and corporate laws.',
        'steps' => [
            ['title' => 'Year 1: Principles of Accountancy & Business Models', 'info' => 'Learn single-entry and double-entry bookkeeping, ledger creations, and consumer behavior theories.'],
            ['title' => 'Year 2: Corporate Bookkeeping & National Income', 'info' => 'Master partnership accounting, bank reconciliations, national income distribution concepts, and civic governance structures.']
        ]
    ],
    'diploma in computer science' => [
        'title' => 'Polytechnic Diploma in Computer Engineering',
        'desc' => 'Vocational technical engineering pathway focused on practical programming frameworks.',
        'steps' => [
            ['title' => 'Year 1-2: Computational Basics', 'info' => 'Learn digital electronics, logic gate configurations, C programming languages, and PC hardware assembly.'],
            ['title' => 'Year 3: Web Engineering & Systems', 'info' => 'Master relational databases, operating systems architecture, and execute a dynamic web application project.']
        ]
    ],
    'vocational intermediate it' => [
        'title' => 'Vocational Higher Secondary IT Specialization',
        'desc' => 'Practical IT skills track bypassing traditional sciences to enter the tech workspace directly.',
        'steps' => [
            ['title' => 'Year 1: Business Computing Operations', 'info' => 'Master productivity tools, operating systems installation, desktop publishing, and basic local area network configuration.'],
            ['title' => 'Year 2: Web Design & Database Inputs', 'info' => 'Learn basic HTML5/CSS3 layouts, database entry screens design, and local network diagnostics execution.']
        ]
    ],
    'diploma in electrical engineering' => [
        'title' => 'Polytechnic Diploma in Electrical & Electronics Engineering',
        'desc' => 'Industrial technical track focused on motor wirings, power generation, and transformer testing.',
        'steps' => [
            ['title' => 'Year 1-2: Electrical Circuits Circuits Core', 'info' => 'Study electrical circuit theories, AC/DC machines operation, power distribution, and electrical instrumentation principles.'],
            ['title' => 'Year 3: Industrial Controls & Switchgear', 'info' => 'Master PLC programming, switchgear protections, electrical estimation methods, and industrial substation layouts.']
        ]
    ],
    'iti electronics certification' => [
        'title' => 'Industrial Training Institute (ITI) Electronics Mechanic Track',
        'desc' => 'Skill-focused craftsmanship credential for direct technical employment in electronics manufacturing.',
        'steps' => [
            ['title' => 'Year 1: Component Handling & Testing', 'info' => 'Learn manual precision soldering, passive electronic component testing, and handling oscilloscopes.'],
            ['title' => 'Year 2: Digital Circuits Circuits Maintenance', 'info' => 'Master micro-controller debugging, solar power panel assemblies, and smart home appliances service tracking.']
        ]
    ],
    'b.tech electronics (ece)' => [
        'title' => 'Undergraduate Engineering Plan (B.Tech ECE)',
        'desc' => 'Academic roadmap navigating semiconductor physics, digital signal architectures, and telecommunication links.',
        'steps' => [
            ['title' => 'Year 1-2: Electronic Networks & Logic', 'info' => 'Master network analysis, electronic device analog circuits, digital logic design, and signals and systems theory.'],
            ['title' => 'Year 3-4: Microcontrollers & Waveguides', 'info' => 'Study microprocessor microarchitectures, digital communication modulations, electromagnetic waves routing, and antenna configurations.']
        ]
    ],
    'b.sc data science' => [
        'title' => 'Undergraduate B.Sc Data Science Degree Program',
        'desc' => 'Integrating computing principles, applied statistics, and computational metrics modeling.',
        'steps' => [
            ['title' => 'Year 1-2: Python & Statistical Pipelines', 'info' => 'Master structured database systems, statistical inference calculations, and exploratory data analysis using Python Pandas arrays.'],
            ['title' => 'Year 3: Predictive Modeling Implementations', 'info' => 'Deploy core machine learning pipelines, master data presentation platforms, and build automated reporting systems.']
        ]
    ],
    'b.sc mathematics' => [
        'title' => 'Undergraduate B.Sc Pure & Applied Mathematics Track',
        'desc' => 'Deep theoretical roadmap tracking algebra, real analysis, and differential geometries.',
        'steps' => [
            ['title' => 'Year 1-2: Real Analysis & Abstract Algebra', 'info' => 'Master linear algebraic matrices, vector calculuses, differential equations modeling, and mathematical logic theorems.'],
            ['title' => 'Year 3: Complex Variables & Numerical Methods', 'info' => 'Study complex analysis parameters, numerical computation algorithms, and mathematical physics concepts.']
        ]
    ],
    'mbbs degree program' => [
        'title' => 'Bachelor of Medicine & Bachelor of Surgery (MBBS)',
        'desc' => 'Rigorous clinical roadmap spanning anatomy, pharmacology, and rotating clinical hospital residencies.',
        'steps' => [
            ['title' => 'Phase 1: Pre-Clinical Foundations', 'info' => 'Master human anatomy dissections, physiological biochemical balances, and organic systemic pathways.'],
            ['title' => 'Phase 2: Para-Clinical & Pharmacology', 'info' => 'Study infectious pathology, clinical microbiology protocols, forensic medicine, and pharmaceutical mechanism profiles.'],
            ['title' => 'Phase 3: Clinical Rotations Internship', 'info' => 'Complete a mandatory 12-month rotating internship across general surgery, medicine, obstetrics, and emergency trauma management wards.']
        ]
    ],
    'b.pharmacy graduate track' => [
        'title' => 'Undergraduate Bachelor of Pharmacy Curriculum',
        'desc' => 'Academic blueprint analyzing drug synthesis, formulation chemistry, and toxicology profiles.',
        'steps' => [
            ['title' => 'Year 1-2: Pharmaceutical Chemistry Foundations', 'info' => 'Study organic pharmaceutical molecules, human anatomy charts, pharmacognosy, and physical pharmaceutics properties.'],
            ['title' => 'Year 3-4: Medicinal Chemistry & Biopharmaceutics', 'info' => 'Master industrial drug formulation engineering, advanced medicinal chemistry design, and clinical pharmacology metrics.']
        ]
    ],
    'b.sc agriculture' => [
        'title' => 'Undergraduate B.Sc in Agricultural Sciences',
        'desc' => 'Agronomy management, plant genetics, soil biochemistry, and agricultural engineering economics.',
        'steps' => [
            ['title' => 'Year 1-2: Agronomy & Soil Biochemistry', 'info' => 'Study crop physiology profiles, soil mineral distributions, plant pathology vectors, and entomology frameworks.'],
            ['title' => 'Year 3-4: Plant Breeding & Agro-Technology', 'info' => 'Master hybrid genetics planning, organic crop cultivation systems, smart irrigation configurations, and complete a rural agricultural attachment program.']
        ]
    ],
    'b.sc biotechnology' => [
        'title' => 'Undergraduate B.Sc in Biotechnology Program',
        'desc' => 'Molecular biology pipelines, recombinant DNA configurations, and industrial bioprocess operations.',
        'steps' => [
            ['title' => 'Year 1-2: Molecular Genetics & Immunology', 'info' => 'Study cellular biology frameworks, microbiology protocols, genetics structures, and core immunology mechanisms.'],
            ['title' => 'Year 3: Recombinant DNA & Bioprocesses', 'info' => 'Master gene cloning methods, tissue culture operations, enzyme engineering, and biochemical filtration pipelines.']
        ]
    ],
    'b.com (computers/honours)' => [
        'title' => 'Undergraduate Bachelor of Commerce Structure',
        'desc' => 'Advanced financial accounting, taxation legal frameworks, corporate auditing, and business analytics applications.',
        'steps' => [
            ['title' => 'Year 1-2: Financial & Cost Accountancy', 'info' => 'Master corporate financial bookkeeping, cost allocation models, business statistics, and commercial laws.'],
            ['title' => 'Year 3: Corporate Auditing & Computerized Taxing', 'info' => 'Study income tax calculations, goods and services tax protocols, corporate auditing methodologies, and computerized accounting systems.']
        ]
    ],
    'bba (management systems)' => [
        'title' => 'Undergraduate Bachelor of Business Administration',
        'desc' => 'Organizational behavior, corporate marketing matrices, financial planning, and operational human resource structures.',
        'steps' => [
            ['title' => 'Year 1-2: Principles of Marketing & Operations', 'info' => 'Study micro-management models, organizational psychology, consumer marketing, and corporate finance frameworks.'],
            ['title' => 'Year 3: Strategic Corporate Management', 'info' => 'Master international business variables, data-backed enterprise strategy, human resource systems, and execute a corporate capstone venture project.']
        ]
    ],
    'b.sc statistics' => [
        'title' => 'Undergraduate B.Sc in Statistical Analysis',
        'desc' => 'Mathematical probability models, sampling theories, regression analytics, and stochastic computing loops.',
        'steps' => [
            ['title' => 'Year 1-2: Probability & Distribution Theory', 'info' => 'Master descriptive statistical modeling, continuous probability patterns, statistical sampling methods, and calculus extensions.'],
            ['title' => 'Year 3: Linear Regression & Hypothesis Validations', 'info' => 'Study parametric testing algorithms, analysis of variance (ANOVA), time series data modeling, and statistical software tools.']
        ]
    ],
    'integrated master of economics' => [
        'title' => '5-Year Integrated Master of Science in Economics',
        'desc' => 'Econometric modeling, game theory metrics, macroeconomic policy structures, and quantitative data analytics.',
        'steps' => [
            ['title' => 'Year 1-3: Intermediate Econometric Foundations', 'info' => 'Master advanced micro/macro economics, mathematical economics layouts, statistical inference, and public finance.'],
            ['title' => 'Year 4-5: Advanced Econometrics & Policy Research', 'info' => 'Deep dive into time-series econometrics, behavioral game theories, global trade architectures, and write an academic research thesis.']
        ]
    ],
    'ba political science' => [
        'title' => 'Undergraduate BA in Political Science Track',
        'desc' => 'Comparative politics frameworks, political philosophies, public administration setups, and constitutional laws study.',
        'steps' => [
            ['title' => 'Year 1-2: Political Theories & National Constitutions', 'info' => 'Study classical political philosophies, comparative government models, and the detailed architecture of the Indian Constitution.'],
            ['title' => 'Year 3: Public Administration & Global Systems', 'info' => 'Master local governance models, public policy analysis frameworks, and modern international political dynamics.']
        ]
    ],
    'bachelor of fine arts (bfa)' => [
        'title' => 'Undergraduate Bachelor of Fine Arts (BFA) Curriculum',
        'desc' => 'Visual art composition, digital asset illustration, painting techniques, and art history critique.',
        'steps' => [
            ['title' => 'Year 1-2: Drawing Foundations & Creative Perspectives', 'info' => 'Master physical life studies, color compositions, anatomy drawing, and history of global classical art models.'],
            ['title' => 'Year 3-4: Visual Media Electives', 'info' => 'Specialize in digital illustration tools, ceramic modeling, printmaking setups, or commercial design portfolios.']
        ]
    ],
    'ba english literature' => [
        'title' => 'Undergraduate BA in English Literature Track',
        'desc' => 'Literary history critique, rhetorical devices processing, creative writing styles, and linguistics frameworks.',
        'steps' => [
            ['title' => 'Year 1-2: Classical Poetry & Drama Layouts', 'info' => 'Analyze British literature timelines, Elizabethan drama structures, rhetorical tropes, and foundational phonetics frameworks.'],
            ['title' => 'Year 3: Contemporary Fiction & Literary Theory', 'info' => 'Study post-colonial literary expressions, modern critical theories, and media communications writing models.']
        ]
    ],

    // --- GRADUATE TO POSTGRADUATE TRANSITIONS ---
    'm.tech advanced cyber security' => [
        'title' => 'Postgraduate Advanced Cybersecurity Research Track',
        'desc' => 'Advanced postgraduate roadmap engineering high-level digital cryptography defense protocols.',
        'steps' => [
            ['title' => 'Semester 1-2: Advanced Cryptographic Design', 'info' => 'Master mathematical algorithms for asymmetric encryption, network protocols, cloud asset authorization systems, and malware analysis.'],
            ['title' => 'Semester 3-4: Thesis Research Defense', 'info' => 'Conduct original research on advanced security threats, design zero-trust protocols, and present findings to the university board.']
        ]
    ],
    'chartered accountancy (icai)' => [
        'title' => 'Chartered Accountancy Certification Path',
        'desc' => 'Elite national structural blueprint governing absolute corporate accounting authority in India.',
        'steps' => [
            ['title' => 'Level 1: CA Foundation Entry Test', 'info' => 'Register with the ICAI board and clear comprehensive tests across commercial business laws and core principles of accounting.'],
            ['title' => 'Level 2: Intermediate Group Valuations', 'info' => 'Qualify across dual academic group divisions testing strategic auditing protocols, financial pricing structures, and complex tax systems.'],
            ['title' => 'Level 3: Executive Articleship Internship', 'info' => 'Complete 2 full years of mandatory operational training inside an officially registered CA auditing firm before sitting final board exams.']
        ]
    ],
    'md cardiology / internal medicine' => [
        'title' => 'Medical Post-Graduate Super-Specialization Track',
        'desc' => 'Transitioning from generic clinical diagnostics to advanced cardiovascular medical science.',
        'steps' => [
            ['title' => 'Year 1-2: Advanced Pathophysiology', 'info' => 'Master acute critical care protocols, echo-cardiography diagnostics, and complex pharmaceutical properties management.'],
            ['title' => 'Year 3: Clinical Dissertation Defense', 'info' => 'Publish original medical research papers, handle advanced cath-lab operations, and pass final clinical practical evaluations.']
        ]
    ],
    'ms data science (global)' => [
        'title' => 'Master of Science in Data Science (Global Pathway)',
        'desc' => 'Advanced statistical inference, cloud scaling systems, and big data pipeline engineering.',
        'steps' => [
            ['title' => 'Year 1: Big Data Distributed Arrays', 'info' => 'Master Apache Spark frameworks, NoSQL distributed data storage clustering, and advanced predictive analysis formulas.'],
            ['title' => 'Year 2: Applied Artificial Intelligence & Thesis', 'info' => 'Deploy deep learning models on cloud platforms (AWS/GCP), build NLP pipelines, and present a data capstone thesis.']
        ]
    ],
    'ms embedded software' => [
        'title' => 'Master of Science in Embedded Software Engineering',
        'desc' => 'Automotive firmware standards (AUTOSAR), real-time safety arrays, and IoT hardware stacks.',
        'steps' => [
            ['title' => 'Year 1: Real-Time Operating Systems (RTOS)', 'info' => 'Master task scheduling algorithms, mutexes configurations, and developing low-level device drivers for Linux systems.'],
            ['title' => 'Year 2: Hardware-Software Co-Design', 'info' => 'Design hardware-in-the-loop (HIL) automation setups and pass hardware functional safety audits.']
        ]
    ],
    'm.tech vlsi & embedded systems' => [
        'title' => 'M.Tech Microelectronics & VLSI System Design',
        'desc' => 'Advanced ASIC architectural design, CMOS digital processing setups, and FPGA profiling tracks.',
        'steps' => [
            ['title' => 'Semester 1-2: Hardware Description Modeling', 'info' => 'Master SystemVerilog verification paradigms, physical silicon synthesis, and clock tree routing optimizations.'],
            ['title' => 'Semester 3-4: Industrial Internship & SoC Tape-Out', 'info' => 'Execute full chip functional verification testing and run static timing analysis on custom micro-chip architectures.']
        ]
    ],
    'm.tech robotics & automation' => [
        'title' => 'M.Tech in Robotics & Autonomous Systems Engineering',
        'desc' => 'Robot operating system (ROS), robotic kinematics pipelines, and industrial computer vision setups.',
        'steps' => [
            ['title' => 'Semester 1-2: Kinematics & Computer Vision', 'info' => 'Master inverse kinematics formulas, spatial coordinate transforms, path planning layouts, and point cloud image filtering.'],
            ['title' => 'Semester 3-4: Autonomous Trajectory Controls', 'info' => 'Deploy neural sensor fusion algorithms, integrate LiDAR navigation meshes, and complete a functional drone/rover setup.']
        ]
    ],
    'm.tech structural engineering' => [
        'title' => 'M.Tech in Structural Engineering & Seismic Resilient Design',
        'desc' => 'Advanced structural finite element dynamics, blast analysis, and high-rise structural designs.',
        'steps' => [
            ['title' => 'Semester 1-2: Nonlinear Structural Modeling', 'info' => 'Master prestressed concrete mechanics, structural dynamic equations, and seismic vibration isolation designs using software like ETABS.'],
            ['title' => 'Semester 3-4: Industrial Structural Design Project', 'info' => 'Draft structural designs for complex multi-story structures resisting heavy wind/seismic loads according to international building codes.']
        ]
    ],
    'mba infrastructure management' => [
        'title' => 'MBA in Infrastructure & Real Estate Project Management',
        'desc' => 'Construction financial models, project risk matrices, public-private partnership (PPP) frameworks, and procurement laws.',
        'steps' => [
            ['title' => 'Year 1: Strategic Infrastructure Costing', 'info' => 'Study construction project scheduling layouts (CPM/PERT methods), equipment asset valuations, and infrastructure contract regulations.'],
            ['title' => 'Year 2: Risk Management & PPP Tender Structures', 'info' => 'Master concession agreement designs, corporate asset financial restructuring, and coordinate real estate rollout operations.']
        ]
    ],
    'ms orthopedics surgery frameworks' => [
        'title' => 'Master of Surgery (MS) in Orthopedics & Trauma Management',
        'desc' => 'Advanced bone pathology management, joint reconstruction mechanics, and complex trauma surgical interventions.',
        'steps' => [
            ['title' => 'Year 1-2: Orthopedic Trauma Operations', 'info' => 'Master internal fracture fixation techniques, orthopedic instrumentation setups, and manage bone grafting pipelines.'],
            ['title' => 'Year 3: Advanced Arthroplasty & Case Defense', 'info' => 'Perform total knee/hip replacement procedures under supervision and present a clinical surgical dissertation to the board.']
        ]
    ],
    'mds oral & maxillofacial surgery' => [
        'title' => 'Master of Dental Surgery (MDS) in Maxillofacial Reconstruction',
        'desc' => 'Surgical management of facial trauma, corrective jaw realignments, and complex dental implantology.',
        'steps' => [
            ['title' => 'Year 1-2: Craniofacial Surgical Anatomy', 'info' => 'Study complex head and neck surgical pathways, manage micro-vascular bone suturing, and operate facial fracture reductions.'],
            ['title' => 'Year 3: Reconstructive Surgery Pathology', 'info' => 'Perform full cleft palate repairs under supervision and defend a maxillofacial clinical thesis before the board.']
        ]
    ],
    'masters in hospital administration' => [
        'title' => 'Master of Hospital Administration (MHA) Program',
        'desc' => 'Clinical quality control, hospital financial management, electronic health record architectures, and legal hospital compliance.',
        'steps' => [
            ['title' => 'Year 1: Hospital System Metrics Operations', 'info' => 'Study outpatient clinic scheduling algorithms, clinical waste management, and emergency room operational optimizations.'],
            ['title' => 'Year 2: Strategic Healthcare Governance', 'info' => 'Implement medical audit protocols, manage hospital human resource structures, and pass healthcare facility accreditation reviews.']
        ]
    ],
    'm.pharm industrial pharmacy' => [
        'title' => 'Master of Pharmacy (M.Pharm) in Industrial Pharmaceutics',
        'desc' => 'Advanced bulk drug manufacturing scales, nano-formulation designs, and stability validation protocols.',
        'steps' => [
            ['title' => 'Year 1: Novel Drug Delivery Architectures', 'info' => 'Design liposomal drug carriers, optimize high-speed continuous encapsulation loops, and master pharmaceutical polymer kinetics.'],
            ['title' => 'Year 2: Industrial Scale-Up & Dissertation', 'info' => 'Execute industrial batch manufacturing validation trials and publish an analytical drug stability research dissertation.']
        ]
    ],
    'mba pharma management' => [
        'title' => 'MBA in Pharmaceutical Marketing & Brand Strategy',
        'desc' => 'Global drug supply chain setups, healthcare product marketing, and drug pricing metrics tracking.',
        'steps' => [
            ['title' => 'Year 1: Pharmaceutical Market Optimization', 'info' => 'Study prescription data analytics, product launch lifecycle loops, and medical representative field management systems.'],
            ['title' => 'Year 2: Global Drug Distribution Architectures', 'info' => 'Manage cold-chain distribution logistics, optimize pricing strategies across distinct regulatory layers, and track patent portfolios.']
        ]
    ],
    'mpt sports physiotherapy' => [
        'title' => 'Master of Physiotherapy (MPT) in Sports Kinesiology',
        'desc' => 'Advanced athletic muscle conditioning, on-field trauma management, and kinetic chain profiling tracks.',
        'steps' => [
            ['title' => 'Year 1: On-Field Sports Biomechanics', 'info' => 'Master high-speed athletic movement capture systems, identify muscular biomechanical faults, and handle acute joint dislocations.'],
            ['title' => 'Year 2: Athletic Performance Conditioning', 'info' => 'Design post-surgical standard load progressions to safely return professional athletes back to active field competition.']
        ]
    ],
    'advanced manual therapy certification' => [
        'title' => 'Post-Graduate Advanced Manual Therapy Fellowship',
        'desc' => 'Advanced clinical training specializing in spinal neural mobilizations, joint adjustments, and fascial releases.',
        'steps' => [
            ['title' => 'Module 1: High-Velocity Low-Amplitude (HVLA) Adjustments', 'info' => 'Master rapid specific manual thrust techniques for spinal facet joint fixations and learn safe adjustment boundaries.'],
            ['title' => 'Module 2: Neuro-Dynamic Mobility Mobilizations', 'info' => 'Learn to trace peripheral nerve entrapments and execute specific neural flossing manipulation models.']
        ]
    ],
    'mba data analytics & finance' => [
        'title' => 'MBA in Financial Analytics & Quantitative Investment Strategy',
        'desc' => 'Financial econometrics, corporate capital structures planning, asset management algorithms, and data-backed risk analysis.',
        'steps' => [
            ['title' => 'Year 1: Applied Financial Econometrics', 'info' => 'Study time-series financial tracking, risk forecasting models, corporate accounting systems, and capital allocations.'],
            ['title' => 'Year 2: Algorithmic Asset Management Portfolio', 'info' => 'Build automated asset tracking sheets via Python/R platforms and execute multi-asset corporate growth strategy simulations.']
        ]
    ],
    'mba digital product management' => [
        'title' => 'MBA in Digital Product Management & Scaling Strategy',
        'desc' => 'Agile software lifecycles, user experience tracking, business monetization models, and data tracking pipelines.',
        'steps' => [
            ['title' => 'Year 1: Product Strategy Blueprinting', 'info' => 'Master user research frameworks, write comprehensive Agile user stories inside Jira, and map global product requirement documents (PRD).'],
            ['title' => 'Year 2: Growth Funnels Hacking & Rollouts', 'info' => 'Analyze North Star growth metrics via Amplitude dashboards, design conversion A/B tests, and manage multi-region product launches.']
        ]
    ],
    'mba global supply chain systems' => [
        'title' => 'MBA in Global Logistics & Supply Chain Operations',
        'desc' => 'International transport laws, inventory optimization math, warehousing automations, and global procurement strategies.',
        'steps' => [
            ['title' => 'Year 1: Operations Research & Warehouse Layouts', 'info' => 'Master linear inventory programming models, warehouse queue optimization models, and international freight customs legal codes.'],
            ['title' => 'Year 2: Strategic Supply Chain Resiliency', 'info' => 'Implement global multi-tier supplier sourcing frameworks and mitigate international shipping block risks using predictive data analytics.']
        ]
    ],
    'master of public health (mph)' => [
        'title' => 'Master of Public Health (MPH) Curriculum',
        'desc' => 'Global healthcare program designs, biometric health tracking, and healthcare deployment legislation.',
        'steps' => [
            ['title' => 'Year 1: Biostatistical Methods & Health Tracking', 'info' => 'Master health dataset auditing routines inside R/SAS, track global pandemic variables, and structure healthcare policy models.'],
            ['title' => 'Year 2: Global Health Program Auditing', 'info' => 'Run environmental health evaluations, manage community vaccine rollouts, and write health equity impact document archives.']
        ]
    ],
    'ma global governance & diplomacy' => [
        'title' => 'MA in Global Governance, International Diplomacy & Treaties',
        'desc' => 'Geopolitical negotiation frameworks, international treaty enforcement tracking, and trade risk management.',
        'steps' => [
            ['title' => 'Year 1: International Trade Jurisprudence', 'info' => 'Analyze public international laws, WTO trade regulations, bilateral negotiation frameworks, and foreign policy paradigms.'],
            ['title' => 'Year 2: Geopolitical Conflict Mediation Strategy', 'info' => 'Simulate cross-border trade negotiations and draft strategic foreign policy briefs evaluating cross-border compliance parameters.']
        ]
    ]
];

// 3. Routing Engine Controller Layer
$action = $_GET['action'] ?? '';

if ($action === 'get_ecosystem') {
    $subBranch = $_GET['sub_branch'] ?? '';
    // ఎంచుకున్న సబ్-బ్రాంచ్ ఇక్కడ చెక్ చేయబడుతుంది
    if (isset($ecosystemDatabase[$subBranch])) {
        echo json_encode($ecosystemDatabase[$subBranch]);
    } else {
        // Fallback default structure
        echo json_encode([
            'jobs' => ['Junior Tech Lab Assistant', 'Data Entry Executive'],
            'education' => ['Intermediate MPC Track', 'Intermediate BiPC Track']
        ]);
    }
    exit();
}

if ($action === 'get_matrix_roadmap') {
    $query = strtolower(trim($_GET['query'] ?? ''));
    
    if (isset($matrixRoadmaps[$query])) {
        echo json_encode($matrixRoadmaps[$query]);
    } else {
        // Fallback Fuzzy Matcher
        foreach ($matrixRoadmaps as $key => $data) {
            if (strpos($key, $query) !== false || strpos($query, $key) !== false) {
                echo json_encode($data);
                exit();
            }
        }
        echo json_encode(['status' => 'not_found']);
    }
    exit();
}