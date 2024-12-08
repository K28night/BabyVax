<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccination Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* General body and layout styles */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #74ebd5, #ACB6E5);
            margin: 0;
            padding: 0;
            display: flex;
        }

        /* Sidebar styles */
        .sidebar {
            width: 250px;
            height: 100vh;
            color: white;
            padding: 5px;
            position: fixed;
            transition: width 0.3s ease;
            background-color: #4a69a5; /* Updated background color */
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.3);
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.5rem;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 15px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: white;
            font-size: 1.1rem;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #657c93; /* Updated hover color */
        }

        .sidebar-toggle {
            cursor: pointer;
            font-size: 1.9rem;
            color: white;
            text-align: center;
            padding-bottom: 10px;
        }

        .sidebar.collapsed h2,
        .sidebar.collapsed ul li a {
            display: none;
        }

        /* Main content area */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 270px);
            transition: margin-left 0.3s ease, width 0.3s ease;
            text-align: center;
        }

        .main-content.expanded {
            margin-left: 90px;
            width: calc(100% - 90px);
        }

        /* Cards layout */
        .cards {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 5px;
            border-radius: 10px;
            width: 30%; /* Adjusted width for better spacing */
            text-align: center;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 12px 20px rgba(0, 0, 0, 0.25);
        }

        .card h3 {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #4a69a5; /* Updated text color */
        }

        .card p {
            font-size: 1.2em;
            color: #333;
        }

        header h1 {
            font-size: 2.5rem;
            color: #333;
            text-align: justify;
            margin-bottom: 10px;
        }

        header p {
            font-size: 1.2rem;
            color: #555;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Dashboard charts */
        .dashboard-charts {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .chart-card {
            background-color: white;
            padding: 5px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: calc(48% - 10px);
            margin-bottom: 30px;
        }

        .chart-card h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        /* Set max height for charts to ensure they fit within the container */
        canvas {
            max-height: 250px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .chart-card,
            .card {
                width: 100%; /* Make cards full width on small screens */
            }
        }
    </style>
    <!-- Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <!-- Sidebar for navigation with toggle button -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-toggle" onclick="toggleSidebar()">
            <span>&#9776;</span>
        </div>
        <ul>
            <li><a href="#overview">Overview</a></li>
            <li><a href="view_vaccine.php">Vaccination Data</a></li>
            <li><a href="viewcenter.php">Health Center Details</a></li>
            <li><a href="view_unlist_center.php">Request For Approval</a></li>
            <li><a href="view_stocks.php">View Vaccine Stocks</a></li>
            <li><a href="ad_view_request_stock.php">Request For Stocks</a></li>
            <li><a href="ad_view_hisory_request_stock.php">History of Request For Stocks</a></li>
            <li><a href="add_stocks.php">Add Stocks</a></li>
            <li><a href="#reports">Reports</a></li>
        </ul>
    </div>

    <!-- Main content area -->
    <div class="main-content">
        <header>
            <h1>Vaccination Admin Dashboard</h1>
            <p>Manage and review vaccination data easily.</p>
        </header>
        <div class="cards">
            <div class="card">
                <h3>Total Health Centers</h3>
                <p>15 Centers</p>
            </div>
            <div class="card">
                <h3>Total Vaccines</h3>
                <p>25 Vaccines</p>
            </div>
            <div class="card">
                <h3>Total Appointments</h3>
                <p>120 Appointments</p>
            </div>
        </div>
        <!-- Dashboard charts -->
        <div class="dashboard-charts">
            <!-- Vaccinations per Month Chart -->
            <div class="chart-card">
                <h3>Vaccinations Per Month</h3>
                <canvas id="vaccinationsPerMonth"></canvas>
            </div>
            <!-- Vaccine Type Distribution -->
            <div class="chart-card">
                <h3>Vaccination Type Distribution</h3>
                <canvas id="vaccineTypeDistribution"></canvas>
            </div>
        </div>

        <div class="dashboard-charts">
            <!-- Side Effects Chart -->
            <div class="chart-card">
                <h3>Reported Side Effects</h3>
                <canvas id="sideEffectsChart"></canvas>
            </div>
            <!-- Age Group Vaccinations -->
            <div class="chart-card">
                <h3>Vaccinations by Age Group</h3>
                <canvas id="ageGroupChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart.js scripts -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementsByClassName('main-content')[0];

            // Toggle sidebar width and main content margin
            if (sidebar.classList.contains('collapsed')) {
                sidebar.classList.remove('collapsed');
                mainContent.classList.remove('expanded');
            } else {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('expanded');
            }
        }

        // Vaccinations Per Month Chart
        const ctxMonth = document.getElementById('vaccinationsPerMonth').getContext('2d');
        const vaccinationsPerMonth = new Chart(ctxMonth, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September'],
                datasets: [{
                    label: 'Vaccinations',
                    data: [120, 150, 180, 200, 240, 300, 320, 280, 290],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Vaccination Type Distribution Chart
        const ctxType = document.getElementById('vaccineTypeDistribution').getContext('2d');
        const vaccineTypeDistribution = new Chart(ctxType, {
            type: 'pie',
            data: {
                labels: ['Type A', 'Type B', 'Type C', 'Type D'],
                datasets: [{
                    label: 'Vaccine Types',
                    data: [40, 30, 20, 10],
                    backgroundColor: ['rgba(255, 99, 132, 0.7)', 'rgba(54, 162, 235, 0.7)', 'rgba(255, 206, 86, 0.7)', 'rgba(75, 192, 192, 0.7)']
                }]
            },
            options: {
                responsive: true
            }
        });

        // Reported Side Effects Chart
        const ctxEffects = document.getElementById('sideEffectsChart').getContext('2d');
        const sideEffectsChart = new Chart(ctxEffects, {
            type: 'bar',
            data: {
                labels: ['Sore Arm', 'Fever', 'Headache', 'Fatigue', 'Nausea'],
                datasets: [{
                    label: 'Reported Side Effects',
                    data: [30, 20, 15, 10, 5],
                    backgroundColor: 'rgba(153, 102, 255, 0.7)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


   // Vaccinations by Age Group
        const ctxAgeGroup = document.getElementById('ageGroupChart').getContext('2d');
        const ageGroupChart = new Chart(ctxAgeGroup, {
            type: 'pie',
            data: {
                labels: ['0-1 years', '1-5 years', '5-10 years', '10+ years'],
                datasets: [{
                    label: 'Age Group Distribution',
                    data: [250, 200, 150, 100],
                    backgroundColor: [
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</body>

</html>
