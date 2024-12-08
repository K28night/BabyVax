<?php 
require('../config/autoload.php'); 

$dao = new DataAccess(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccine Stocks</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #74ebd5, #ACB6E5); /* Matches your admin dashboard background */
            color: #333;
        }

        .container_gray_bg {
            padding: 20px;
            margin-top: 50px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table th, .table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .table th {
            background-color: #6f6fdc;
            color: #fff;
        }

        .table td {
            background-color: #f9f9f9;
        }

        .table td a {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            color: #fff;
        }

        .btn-primary {
            background-color: #3498db;
        }

        .btn-success {
            background-color: #2ecc71;
        }

        .btn-primary:hover, .btn-success:hover {
            opacity: 0.9;
        }

        .update-btn {
            margin: 0 auto;
            display: block;
            width: 80%;
        }

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <div class="container_gray_bg" id="home_feat_1">
        <div class="container">
            <h1>Vaccine Stock Details</h1>
            <div class="row">
                <div class="col-md-10 center">
                    <table class="table">
                        <tr>
                            <th>Stock Id</th>
                            <th>Center Name</th>
                            <th>Vaccine Name</th>
                            <th>Stocks Available</th>
                            <th>Appointments</th>
                            <th>Update On</th>
                            <th>Update Availability</th>
                            <th>Availability Status</th>
                            <th>Edit Stocks</th>
                        </tr>

                        <?php
                        // Define the actions for edit
                        $actions = array(
                            'edit' => array(
                                'label' => 'Update Stocks',
                                'link' => 'update_stocks.php',
                                'params' => array('id' => 's_id'),
                                'attributes' => array('class' => 'btn btn-success')
                            ),
                        );

                        // Fetch the vaccine stock data
                        $fields = array('s_id', 'v_name', 'v_id', 'c_id', 'c_name', 'stocks_available', 'date_updated');
                        $vaccines = $dao->getData($fields, 'vaccine_stocks', 1);

                        if (!empty($vaccines)) {
                            foreach ($vaccines as $row) {
                                $vaccine_id = $row['v_id']; 
                                $center_id = $row['c_id'];
                                $condition = "v_id = $vaccine_id AND c_id = $center_id";

                                // Get availability data
                                $fields1 = array('is_available','slot_id');
                                $avail = $dao->getData($fields1, 'slots1', $condition); 
                                $availability = !empty($avail[0]['is_available']) ? $avail[0]['is_available'] : 'No available';

                                // Count appointments
                                $count = $dao->count('id', 'appointments', $condition);

                                // Render table rows
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['s_id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['c_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['v_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['stocks_available']) . "</td>";
                                echo "<td>" . htmlspecialchars($count) . "</td>";
                                echo "<td>" . htmlspecialchars($row['date_updated']) . "</td>";
                                echo "<td><a href='update_page.php?id=" . $row['s_id'] . "' class='btn btn-primary update-btn'>Update</a></td>";
                                echo "<td>" . htmlspecialchars($availability) . "</td>";
                                echo "<td><a href='update_page.php?id=" . $row['s_id'] . "' class='btn btn-primary update-btn'>Update</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9'>No vaccine stock data available.</td></tr>";
                        }
                        ?>
                    </table>
                </div>    
            </div>
        </div>
    </div>
</body>
</html>
