<!DOCTYPE html>
<html lang="en">
<?php 
if (isset($_GET['id'])) {
    $pid = $_GET['id'];
}


require('../config/autoload.php'); 

$dao = new DataAccess(); 
?>
<script> let pid=<?php echo $pid;?></script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
    /* Global Styles */
body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(135deg, #74ebd5, #ACB6E5);
    margin: 0;
    padding: 0;
    display: flex;
    overflow-x: hidden;
}

/* Sidebar */
.sidebar {
    width: 220px;
    height: 100vh;
    color: white;
    padding: 20px;
    position: fixed;
    transition: width 0.3s ease;
    background-color: #4a69a5;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.3);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.sidebar.collapsed {
    width: 60px;
}

.sidebar h2 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 1.5rem;
    font-weight: bold;
    color: #fff;
}

.sidebar ul {
    list-style: none;
    padding: 0;
    flex-grow: 1;
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
    background-color: #657c93;
    cursor: pointer;
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

/* Main Content */
.main-content {
    margin-left: 250px;
    padding: 20px;
    width: calc(100% - 250px);
    transition: margin-left 0.3s ease, width 0.3s ease;
    text-align: center;
}

.main-content.expanded {
    margin-left: 60px;
    width: calc(100% - 60px);
}

header h1 {
    font-size: 2.5rem;
    color: #333;
    text-align: center;
    margin-bottom: 10px;
}

header p {
    font-size: 1.2rem;
    color: #555;
    text-align: center;
    margin-bottom: 20px;
}

/* Cards */
.cards {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.card {
    background-color: rgba(255, 255, 255, 0.9);
    padding: 20px;
    border-radius: 10px;
    width: calc(30% - 20px);
    text-align: center;
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s, box-shadow 0.3s;
    margin: 5px;
    position: relative;
    overflow: hidden;
    border: 1px solid #ddd;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 12px 20px rgba(0, 0, 0, 0.25);
}

.card h2 {
    font-size: 1.5em;
    margin-bottom: 10px;
    color: #4a69a5;
    font-weight: bold;
}

.card p {
    font-size: 1.2em;
    color: #333;
}

.card .icon {
    font-size: 3em;
    margin-bottom: 15px;
}

/* Buttons */
button {
    background-color: #28ba07;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 15px;
    cursor: pointer;
    transition: background-color 0.3s;
    font-size: 1em;
    margin-top: 10px;
    outline: none;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

button:hover {
    background-color: #209005;
}

/* Charts */
.health-chart-container, .growth-chart-section {
    background-color: #f2f2f2;
    padding: 15px;
    border-radius: 8px;
    margin-top: 20px;
}

.health-chart-container {
    margin-top: 30px;
}

.growth-chart-section {
    margin-top: 40px;
}

.health-summary {
    margin-top: 15px;
    font-size: 1.2em;
    color: #209005;
    font-weight: bold;
}

.messages-container {
    background-color: #f2f2f2;
    padding: 20px;
    border-radius: 8px;
    color: #333;
    margin-top: 30px;
}

/* Responsiveness */
@media (max-width: 768px) {
    .card {
        width: 100%;
        margin: 10px 0;
    }
    .sidebar {
        width: 60px;
    }
    .main-content {
        margin-left: 60px;
        width: calc(100% - 60px);
    }
}

/* Logout Button */
#out {
    background-color: #FF6347;
}

#out:hover {
    background-color: #D9534F;
}

/* Hover effects for icons and cards */
.card .icon:hover {
    color: #28ba07;
    transform: scale(1.1);
}

.card:hover {
    box-shadow: 0px 12px 20px rgba(0, 0, 0, 0.25);
    transform: translateY(-10px);
}

/* Sidebar collapse animation */
.sidebar-toggle {
    transition: transform 0.3s ease;
}

.sidebar.collapsed .sidebar-toggle {
    transform: rotate(90deg);
}


    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-toggle" onclick="toggleSidebar()">
            <span>&#9776;</span>
        </div>
        <ul>
            <li><a href="#overview">Overview</a></li>
            <li><a href="p_view_vaccine.php?pid=<?= $pid ?>">Vaccine Information</a></li>
            <li><a href="appoinment.php?pid=<?= $pid ?>">Make Appoinment</a></li>
            <li><a href="p_view_appointment.php?pid=<?= $pid ?>">Appoinment History</a></li>
            <li><a href="p_view_baby.php?pid=<?= $pid ?>">My Baby's Records</a></li>
            <li><a href="view_appointment_history.php?hid=<?= $pid ?>">Vaccination History</a></li>
            <li><a href="viewcenter.php?pid=<?= $pid ?>">Health Centers</a></li>
            
            <li><a href="#reports">Reports</a></li>
        </ul>
    </div>

    <div class="main-content">
        <header>
            <h1>Parent Dashboard</h1>
            <p>Manage your child's vaccination records effectively.</p>
        </header>

        <div class="cards">
            <div class="card">
                <div class="icon">📅</div>
                <h2>Upcoming Vaccination</h2>
                <p>No upcoming appointments</p>
                <button onclick="makeNewAppointment()">Book Appointment</button>
            </div>

            <div class="card">
                <div class="icon">👼</div>
                <h2>Add Baby Details</h2>
                <p>Check past vaccinations and details</p>
                <button onclick="addBaby()">Add Baby</button>
            </div>

            <div class="card">
                <div class="icon">🔔</div>
                <h2>Notifications</h2>
                <p>Stay updated with reminders</p>
                <button onclick="viewNotifications()">View Notifications</button>
            </div>
        </div>

        <div class="health-chart-container">
            <canvas id="healthChart"></canvas>
        </div>
        <div class="growth-chart-section">
    <h2>Baby Growth Tracker</h2>
    <canvas id="growthChart"></canvas>
    <div id="healthSummary" class="health-summary"></div>
</div>


        <div class="messages-container">
            <h3>Health Tips & Reminders</h3>
            <p>Don’t forget to keep track of upcoming vaccinations!</p>
            <p>Make sure your baby stays hydrated, especially on warm days.</p>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        }

        function makeNewAppointment() {
            alert("Redirecting to appointment booking.");
        }

        function viewHistory() {
            alert("Redirecting to vaccination history.");
            window.location.href="view_history.php?pid=" + pid;
        }

        function viewNotifications() {
            alert("Redirecting to notifications.");
        }

        function addBaby() {
            alert("Redirecting to add baby page.");
            window.location.href="child.php?pid=" + pid;
        }

        const ctx = document.getElementById('healthChart').getContext('2d');
        const healthChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Birth', '2 Months', '4 Months', '6 Months', '9 Months', '12 Months'],
                datasets: [{
                    label: 'Baby Health (Weight in Kg)',
                    data: [3.5, 5.5, 6.8, 8.0, 8.8, 9.5],
                    backgroundColor: 'rgba(40, 186, 7, 0.2)',
                    borderColor: '#28ba07',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Age'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Weight (Kg)'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
        document.addEventListener("DOMContentLoaded", function() {
    // Example data from the backend
    const babyData = {
        ageMonths: [1, 2, 3, 4, 5, 6],
        height: [50, 54, 58, 61, 65, 68], // Example height data
        weight: [3.5, 4.0, 4.8, 5.2, 6.0, 6.5] // Example weight data
    };

    // Chart configuration
    const ctx = document.getElementById('growthChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: babyData.ageMonths,
            datasets: [
                {
                    label: 'Height (cm)',
                    data: babyData.height,
                    borderColor: '#28ba07',
                    fill: false,
                    borderWidth: 2,
                },
                {
                    label: 'Weight (kg)',
                    data: babyData.weight,
                    borderColor: '#209005',
                    fill: false,
                    borderWidth: 2,
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: { title: { display: true, text: 'Age (months)' } },
                y: { title: { display: true, text: 'Growth' } }
            }
        }
    });

    // Health Summary
    function updateHealthSummary() {
        const isHealthy = true; // Replace with actual health condition check logic
        const summaryElement = document.getElementById('healthSummary');
        summaryElement.innerText = isHealthy
            ? "Your baby’s growth is on track! Keep up the good nutrition and regular check-ups."
            : "Consider consulting with a healthcare provider regarding your baby's growth pattern.";
    }

    updateHealthSummary();
});
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
