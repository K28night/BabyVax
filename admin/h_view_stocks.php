<?php 
require('../config/autoload.php'); 

$dao = new DataAccess(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Center Vaccination Stocks</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #74ebd5, #ACB6E5);
            margin: 0;
            padding: 0;
        }
        .container_gray_bg {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            margin: 40px auto;
            max-width: 1200px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #5151E5;
            color: white;
        }
        tr:hover {
            background-color: rgba(100, 100, 100, 0.1);
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
<body>

<div class="container_gray_bg" id="home_feat_1">
    <h2>Health Center Vaccination Stocks</h2>
    <div class="container">
        <table>
            <tr>
                <th>Stock Id</th>
                <th>Center Name</th>
                <th>Vaccine Name</th>
                <th>Stocks Available</th>
                <th>Appointments</th>
                <th>Stocks Status</th>
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
                'c_name',
                'stocks_available',
                'date_updated'
            );
            $vaccines = $dao->getData($fields, 'vaccine_stocks', 1);

            if (!empty($vaccines)) {
                foreach ($vaccines as $row) {
                    // Fetch availability and appointments count
                    $vaccine_id = $row['v_id']; 
                    $center_id = $row['c_id'];
                    $condition = "v_id = $vaccine_id AND c_id = $center_id";
                    $fields1 = array('is_available', 'slot_id');
                    $avail = $dao->getData($fields1, 'slots1', $condition);
                    
                    $f = !empty($avail[0]['is_available']) ? $avail[0]['is_available'] : 'No available';
                    $id = !empty($avail[0]['slot_id']) ? $avail[0]['slot_id'] : 'No available';
                    $count = $dao->count('id', 'appointments', $condition);
                    
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['s_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['c_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['v_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['stocks_available']) . "</td>";
                    echo "<td>" . htmlspecialchars($count) . "</td>";
                    echo "<td>" . htmlspecialchars($f) . "</td>";
                    echo "<td>" . htmlspecialchars($row['date_updated']) . "</td>";
                    echo "<td>";
                    echo "<form action='stock_avail.php' method='post' onsubmit='return inUpdate();'>";
                    echo "<input type='hidden' name='slot_id' value='" . htmlspecialchars($id) . "'>";
                    echo "<input type='hidden' name='is_available' value=1>"; 
                    echo "<button type='submit' id='in'>Open</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "<td>";
                    echo "<form action='out_of_stock.php' method='post' onsubmit='return outUpdate();'>";
                    echo "<input type='hidden' name='slot_id' value='" . htmlspecialchars($id) . "'>";
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
function outUpdate() {
    return confirm("Are you sure you want to update vaccine Out Of Stock?");
}
function inUpdate() {
    return confirm("Are you sure you want to Open Booking?");
}
</script>
</body>
</html>
