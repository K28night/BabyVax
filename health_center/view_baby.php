<?php 
require('../config/autoload.php'); 
$id = $_GET['hid'];
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
            background: linear-gradient(135deg, #5554ebd5, #ACB6E5);
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
            <h1>Baby Records</h1>
        </div>
        <div class="row">
            <div class="col-md-10">
                <table class="table">
                    <tr>
                        <th>Baby Id</th>
                        <th>Baby Name</th>
                        <th>Parant Name</th>
                        <th>Vaaccine Name</th>
                        <th>Date Of Birth</th>
                        <th>Genter</th>
                        <th>Blood Group</th>
                        <th>Height
                            (cm)</th>
                        <th>Weight
                            (Kg)</th>
                        <th>Medical Condition</th>
                        <th>Appoinment Date</th>
                        <th>Time Slot</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    // Define the actions for edit and delete
                    $actions = array(
                        // 'edit' => array(
                        //     'label' => 'Edit',
                        //     'link' => 'editvaccine.php',
                        //     'params' => array('id' => 'vid'),
                        //     'attributes' => array('class' => 'btn btn-success')
                        // ),
                        // 'delete' => array(
                        //     'label' => 'Delete',
                        //     'link' => 'deletevaccine.php',
                        //     'params' => array('id' => 'vid'),
                        //     'attributes' => array('class' => 'btn btn-success')
                        // )
                    );

                    // Configure the table
                    $config = array();
                    $join=array(  "baby_details" => [
                        "baby_details.b_id = appointments.b_id", // Join condition
                        "innerjoin"]);
                        $con="c_id='$id'";
                    // Fields for the query
                    $fields = array('baby_details.b_id','baby_details.name','baby_details.parent_names','appointments.v_name', 'baby_details.date_of_birth','baby_details.gender',  'baby_details.blood_group', 'baby_details.height',
                     'baby_details.weight', 'baby_details.medical_conditions','appointments.date','appointments.time_slot','appointments.status');

                    $vaccines = $dao->selectAsTable($fields, 'appointments',$con, $join, $actions, $config);
                    
                    // Display the table with data
                    if(!empty( $vaccines))
                      echo $vaccines;
                   else
                      echo"</table><h2 style='text-align:center'>No Appointments Available</h2>";
                    ?>
                </table>
            </div>    
        </div><!-- End row -->
    </div><!-- End container -->
</div><!-- End container_gray_bg -->
</body>
</html>
