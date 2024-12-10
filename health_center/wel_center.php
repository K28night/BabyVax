<!DOCTYPE html>
<html lang="en">
<?php 
if (isset($_GET['id'])) {
    $hid = $_GET['id'];

}
require('../config/autoload.php'); 
$dao = new DataAccess(); 
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Center Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            width: 220px;
            height: 100vh;
            color: white;
            padding: 10px;
            position: fixed;
            transition: width 0.3s ease;
            background-color: #4a69a5; /* Updated background color */
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.3);
        }

        .sidebar.collapsed {
            width: 60px;
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
            flex-wrap: wrap; /* Allow wrapping of cards */
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 5px;
            border-radius: 10px;
            width: calc(30% - 20px); /* Adjusted width for better spacing */
            text-align: center;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
            margin: 10px; /* Added margin for spacing */
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

        /* Health Center List */
        .health-center-list {
            margin-top: 30px;
            text-align: left;
            overflow-x: auto; /* Add horizontal scrolling for long lists */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4a69a5;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .card {
                width: 100%; /* Make cards full width on small screens */
            }
        }
        #out {
            background-color: #FF6347; /* Tomato */
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        #out:hover {
            background-color: #D9534F; /* Darker shade */
        }
        #in {
            background-color: #28ba07; /* Tomato */
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        #in:hover {
            background-color: #209005; /* Darker green shade */
/* Darker shade */
        }
    </style>
</head>
<?php                     $count = 1; ?>
<body>
    <!-- Sidebar for navigation with toggle button -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-toggle" onclick="toggleSidebar()">
            <span>&#9776;</span>
        </div>
<!-- <?php   $id = $_GET['id'];?> -->
        <ul>
            
            <li><a href="view_vaccine.php?hid=<?= $hid ?>">Vaccine Data</a></li>
            <li><a href="hc_profile.php?id=<?= $hid ?>">Health Center Details</a></li>
            <li><a href="view_baby.php?hid=<?= $hid ?>">Baby Records</a></li>
            <li><a href="c_view_appointment.php?hid=<?= $hid ?>">Appoinments</a></li>
            <li><a href="view_hc_stock.php?hid=<?= $hid ?>">Send Request For Stocks</a></li>
            <li><a href="hc_view_request_stock.php?hid=<?= $hid ?>">Stock Request History</a></li>
            <li><a href="view_appointment_history.php?hid=<?= $hid ?>">Vaccination History</a></li>
            <li><a href="view_slots.php?hid=<?= $hid ?>">Vaccine slots Details</a></li>
            <!-- <li><a href="add_slots.php">Add Slots</a></li> -->
            <li><a href="#reports">Reports</a></li>
        </ul>
    </div>

    <!-- Main content area -->
    <div class="main-content">
        <header>
            <h1>Health Center Dashboard</h1>
            <p>Manage and review health center details effectively.</p>
        </header>
        <div class="cards">
            <div class="card">
            <h3>Total Appointments</h3>
            <p> 244 Appointments</p>
            </div>
            <div class="card">
                <h3>Total Vaccines</h3>
                <p>25 Vaccines</p>
            </div>
            <div class="card">
                <h3>Happy Parents</h3>
                <p>120 Healthy Babys</p>
            </div>
        </div>

        <!-- Health Center List -->
        <div class="health-center-list">
            <h2>Track Vaccine Stocks</h2>
            <table>
            <tr>
                <th>Stock Id</th>
                <th>Vaccine Name</th>
                <th>Stocks Available</th>
                <th>Appointments</th>
                <th>Booking Status</th>
                <th>Update On</th>
                <th>Stocks In</th>
                <th>Stocks Out</th>
                
            </tr>
            <?php
            // Query to fetch vaccine stock data
            $fields = array(
                's_id',
                'v_name',
                'v_id',
                'c_id',
                'stocks_available',
                'date_updated'
            );
            $condition1="c_id=$hid";
            $vaccines = $dao->getData($fields, 'vaccine_stocks', $condition1);

            if (!empty($vaccines)) {
                foreach ($vaccines as $row) {
                    // Fetch availability and appointments count
                    $vaccine_id = $row['v_id']; 
                    $center_id = $row['c_id'];
                    $condition = "v_id = $vaccine_id AND c_id = $center_id";
                    $fields1 = array('is_available', 'slot_id');
                    $avail = $dao->getData($fields1, 'slots1', $condition);
                    
                    $f = !empty($avail[0]['is_available']) ? 'Booking Open' : 'Not available';
                    $sid = !empty($avail[0]['slot_id']) ? $avail[0]['slot_id'] :'0';
                    $count = $dao->count('id', 'appointments', $condition);
                    
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['s_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['v_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['stocks_available']) . "</td>";
                    echo "<td>" . htmlspecialchars($count) . "</td>";
                    echo "<td>" . htmlspecialchars($f) . "</td>";
                    echo "<td>" . htmlspecialchars($row['date_updated']) . "</td>";
                    echo "<td>";
                    echo "<form action='stock_avail.php' method='post' onsubmit='return inUpdate();'>";
                    echo "<input type='hidden' name='slot_id' value='" . htmlspecialchars($sid) . "'>";
                    echo "<input type='hidden' name='c_id' value='" . htmlspecialchars($hid) . "'>";
                    echo "<input type='hidden' name='vaccine_id' value='" . htmlspecialchars($vaccine_id) . "'>";
                    echo "<input type='hidden' name='is_available' value=1>"; 
                    echo "<button type='submit' id='in'>Open</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "<td>";
                    echo "<form action='out_of_stock.php' method='post' onsubmit='return outUpdate();'>";
                    echo "<input type='hidden' name='slot_id' value='" . htmlspecialchars($sid) . "'>";
                       echo "<input type='hidden' name='c_id' value='" . htmlspecialchars($hid) . "'>";
                    echo "<input type='hidden' name='is_available' value=0>"; 
                    echo "<button type='submit' id='out'>Close</button>";
                    echo "</form>";
                    echo "</td>";
                   
                    echo "</tr>";
                }
            }
            ?>
        </table>
        </div>
    </div>

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
        function outUpdate() {
    return confirm("Are you sure you want to update vaccine Out Of Stock?");
}
function inUpdate() {
    return confirm("Are you sure you want to Open Booking?");
}
    </script>
</body>

</html>
