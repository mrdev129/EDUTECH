<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Programs | College Portal</title>
    <style>
        :root {
            --primary-orange: #ff7900;
            --text-dark: #333;
            --text-gray: #666;
            --bg-light: #f4f7f6;
            --white: #ffffff;
            --border-color: #e0e0e0;
        }

        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg-light);
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        h2 {
            color: var(--text-dark);
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        /* Tabs Navigation */
        .tabs-nav {
            display: flex;
            gap: 12px;
            overflow-x: auto;
            padding-bottom: 15px;
            margin-bottom: 25px;
            border-bottom: 1px solid var(--border-color);
            scrollbar-width: none; /* Firefox */
        }

        .tabs-nav::-webkit-scrollbar { display: none; } /* Chrome/Safari */

        .tab-btn {
            padding: 10px 24px;
            border-radius: 25px;
            border: 1px solid var(--border-color);
            background: var(--white);
            cursor: pointer;
            font-weight: 500;
            white-space: nowrap;
            transition: all 0.3s ease;
            color: var(--text-dark);
        }

        .tab-btn.active {
            background-color: var(--primary-orange);
            color: var(--white);
            border-color: var(--primary-orange);
            box-shadow: 0 4px 10px rgba(255, 121, 0, 0.2);
        }

        /* Content Grid */
        .tab-panel {
            display: none;
            animation: fadeIn 0.4s ease;
        }

        .tab-panel.active {
            display: block;
        }

        .grid-layout {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
        }

        /* Individual Cards */
        .info-card {
            background: var(--white);
            padding: 24px;
            border-radius: 12px;
            border-left: 5px solid var(--primary-orange);
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            transition: transform 0.2s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
        }

        .info-card h3 {
            margin: 0 0 10px 0;
            font-size: 1.1rem;
            color: var(--text-dark);
        }

        .info-card p {
            color: var(--text-gray);
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .info-card a {
            display: inline-block;
            color: var(--primary-orange);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .info-card a:hover {
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Explore Programs</h2>

    <?php
    // In a real app, this data could come from a MySQL Database
    $programs = [
        "MBBS" => [
            ["title" => "Ranking", "desc" => "NIRF - 543 Colleges Ranked", "link" => "View Rankings"],
            ["title" => "Find Colleges", "desc" => "19000+ Colleges in India", "link" => "Discover Colleges"],
            ["title" => "Exams", "desc" => "NEET, IPU CET, AIIMS", "link" => "Check Exam Dates"],
            ["title" => "College Predictor", "desc" => "Know your admission chances", "link" => "Start Predicting"]
        ],
        "B.Tech" => [
            ["title" => "Ranking", "desc" => "IIT Madras, IIT Bombay #1", "link" => "Top Engineering"],
            ["title" => "Find Colleges", "desc" => "4500+ Engineering Hubs", "link" => "Browse Tech Colleges"],
            ["title" => "Exams", "desc" => "JEE Main, JEE Advanced, BITSAT", "link" => "Exam Calendar"],
            ["title" => "Cutoff", "desc" => "Check last year's closing ranks", "link" => "View Cutoffs"]
        ],
        "MBA" => [
            ["title" => "Ranking", "desc" => "IIM Ahmedabad, IIM Bangalore", "link" => "B-School Rankings"],
            ["title" => "Find Colleges", "desc" => "Best MBA in Delhi, Mumbai", "link" => "Find Programs"],
            ["title" => "Exams", "desc" => "CAT, XAT, MAT, GMAT", "link" => "Prep Strategy"],
            ["title" => "ROI", "desc" => "Salary vs Fees Analysis", "link" => "Check Placement Stats"]
        ],
        "Law" => [
            ["title" => "Ranking", "desc" => "NLUs and Private Excellence", "link" => "Top Law Schools"],
            ["title" => "Find Colleges", "desc" => "800+ Law Institutes", "link" => "Explore Law"],
            ["title" => "Exams", "desc" => "CLAT, AILET, LSAT", "link" => "Exam Info"],
            ["title" => "Careers", "desc" => "Corporate, Litigation, Judiciary", "link" => "Career Guide"]
        ]
    ];
    ?>

    <div class="tabs-nav" id="tabs-container">
        <?php $first = true; foreach ($programs as $name => $cards): ?>
            <button class="tab-btn <?php echo $first ? 'active' : ''; ?>" 
                    onclick="switchTab(event, 'tab-<?php echo strtolower($name); ?>')">
                <?php echo $name; ?>
            </button>
        <?php $first = false; endforeach; ?>
    </div>

    <div id="panels-container">
        <?php $first = true; foreach ($programs as $name => $cards): ?>
            <div id="tab-<?php echo strtolower($name); ?>" 
                 class="tab-panel <?php echo $first ? 'active' : ''; ?>">
                <div class="grid-layout">
                    <?php foreach ($cards as $card): ?>
                        <div class="info-card">
                            <h3><?php echo $card['title']; ?></h3>
                            <p><?php echo $card['desc']; ?></p>
                            <a href="#"><?php echo $card['link']; ?> &gt;</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php $first = false; endforeach; ?>
    </div>
</div>

<script>
    function switchTab(event, tabId) {
        // Remove active class from all buttons
        const buttons = document.querySelectorAll('.tab-btn');
        buttons.forEach(btn => btn.classList.remove('active'));

        // Hide all panels
        const panels = document.querySelectorAll('.tab-panel');
        panels.forEach(panel => panel.classList.remove('active'));

        // Activate selected tab and panel
        event.currentTarget.classList.add('active');
        document.getElementById(tabId).classList.add('active');
    }
</script>

</body>
</html>