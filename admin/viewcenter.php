<?php 
require('../config/autoload.php'); 
$dao = new DataAccess();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Centers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #74ebd5, #ACB6E5);
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container_gray_bg {
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff; /* White background for the table container */
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 1200px; /* Limit the max width */
        }

        h1 {
            text-align: center;
            color: #6f6fdc; /* Color to match the sidebar */
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th, .table td {
            padding: 12px;
            text-align: center; /* Center align text in table cells */
            border: 1px solid #dee2e6; /* Light border for table */
        }

        .table th {
            background-color: #6f6fdc; /* Header color */
            color: white; /* Text color for header */
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2; /* Zebra stripes for rows */
        }

        .table tr:hover {
            background-color: #eaeaea; /* Highlight on hover */
        }

        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 14px;
        }

        .btn-success {
            background-color: #28a745; /* Green background for success buttons */
            color: white;
            text-decoration: none;
        }

        .btn-danger {
            background-color: #dc3545; /* Red background for delete buttons */
            color: white;
            text-decoration: none;
        }

        .btn-success:hover, .btn-danger:hover {
            opacity: 0.8; /* Slightly fade on hover */
        }

        img {
            width: 200px; /* Set a fixed width for images */
            border-radius: 4px; /* Optional: Rounded image corners */
        }
    </style>
</head>
<body>

<div class="container_gray_bg" id="home_feat_1">
    <h1>Listed Health Centers</h1>
    <div class="row">
        <div class="col-md-10">
            <table class="table">
                <tr>
                    <th>Licence Id</th>
                    <th>HId</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                <?php
                $actions = array(
                    // 'edit' => array(
                    //     'label' => 'Edit',
                    //     'link' => 'editcenters.php',
                    //     'params' => array('id' => 'hid'),
                    //     'attributes' => array('class' => 'btn btn-success')
                    // ),
                    'delete' => array(
                        'label' => 'Delete',
                        'link' => 'editstudentsimage.php',
                        'params' => array('id' => 'hid'),
                        'attributes' => array('class' => 'btn btn-danger')
                    )
                );

                $config = array(
                    'srno' => true, // Enable serial number
                    'hiddenfields' => array('hid'),
                    'actions_td' => false,
                    'images' => array(
                        'field' => 'img',
                        'path' => '../uploads/',
                        'attributes' => array('style' => 'width:170px;')
                    )
                );

                $fields = array('hid','lid', 'hname','location','email', 'img');

                $users = $dao->selectAsTable($fields, 'hcenters as s', "approve_ad='1'", null, $actions, $config);
                
                echo $users;
                ?>
            </table>
        </div>
    </div><!-- End row -->
</div><!-- End container -->
    
</body>
</html>
