<?php 
require('../config/autoload.php'); 
$hid=$_GET['hid'];
$dao = new DataAccess(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccination Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #74ebd5, #ACB6E5);
            margin: 0;
            padding: 0;
            display: flex;
        }

        .container_gray_bg {
            background-color: #f8f9fa; /* Light gray background for the table container */
            padding: 20px;
            border-radius: 8px;
            margin: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff; /* White background for the table */
            border-radius: 8px;
            overflow: hidden; /* To apply border radius to table */
        }

        .table th, .table td {
            padding: 12px;
            text-align: center; /* Center align text in table cells */
            border: 1px solid #dee2e6; /* Light border for table */
        }

        .table th {
            background-color: #6f6fdc; /* Match the sidebar color */
            color: white; /* Text color for the header */
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2; /* Zebra stripes for rows */
        }

        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-success {
            background-color: #28a745; /* Green background for success buttons */
            color: white;
            text-decoration: none;
        }

        .btn-success:hover {
            background-color: #218838; /* Darker green on hover */
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container_gray_bg" id="home_feat_1">
    <div class="container">
        <div class="header">
            <h1>Vaccine Data Management</h1>
        </div>
        <div class="row">
            <div class="col-md-10">
                <table class="table">
                    <tr>
                        <th>Vaccine ID</th>
                        <th>Vaccine Name</th>
                        <th>Age Given</th>
                        <th>Doses Required</th>
                        <th>Month Gap</th>
                        <th>Side Effects</th>
                        <th>Booster Required</th>
                        <th>Vaccine Type</th>
                        <th>Administration Method</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    // Define the actions for edit and delete
                    $actions = array(
                        'edit' => array(
                            'label' => 'Edit',
                            'link' => 'editvaccine.php?hid='.$hid.'&',
                            'params' => array('id' => 'vid'),
                            'attributes' => array('class' => 'btn btn-success')
                        ),
                        'delete' => array(
                            'label' => 'Delete',
                            'link' => 'deletevaccine.php?hid='.$hid.'&',
                            'params' => array('id' => 'vid'),
                            'attributes' => array('class' => 'btn btn-success')
                        )
                    );

                    // Configure the table
                    $config = array();
                    
                    // Fields for the query
                    $fields = array('vid','name', 'age_given', 'doses_required', 'shedule_catagory', 'side_effects', 'booster_required', 'vaccine_type', 'vacination_method');
                    $vaccines = $dao->selectAsTable($fields, 'b_vaccines', "status=1", null, $actions, $config);
                    
                    // Display the table with data
                    echo $vaccines;
                    ?>
                </table>
            </div>    
        </div><!-- End row -->
    </div><!-- End container -->
</div><!-- End container_gray_bg -->

</body>
</html>
