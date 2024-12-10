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
    <link rel="stylesheet" href="welcome.css">
    <style>
    /* Global Styles */


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
