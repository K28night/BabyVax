<?php
// Include necessary files for database connection and report generation
require('../config/autoload.php'); 
require_once('AdminReportsController.php');
require_once('PHPExcel.php'); // For Excel export

// Handle form submission and generate report
$reports = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $filters = [
        'start_date' => $_POST['start_date'] ?? null,
        'end_date' => $_POST['end_date'] ?? null,
        'health_center_id' => $_POST['health_center_id'] ?? null,
        'vaccine_id' => $_POST['vaccine_id'] ?? null
    ];

    // Instantiate the report controller and generate report data
    $reportController = new AdminReportsController();
    $reports = $reportController->generateReport($filters);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Report - BabyVax</title>
    <!-- Add CSS for styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 20px;
        }
        .report-table {
            margin-top: 30px;
        }
        .report-table th, .report-table td {
            text-align: center;
        }
        .btn {
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Admin Report - Vaccination Records</h2>

        <!-- Report Filter Form -->
        <form method="POST" action="" class="form-inline justify-content-center">
            <label for="start_date">Start Date: </label>
            <input type="date" name="start_date" class="form-control mx-2">
            
            <label for="end_date">End Date: </label>
            <input type="date" name="end_date" class="form-control mx-2">
            
            <label for="health_center_id">Health Center: </label>
            <select name="health_center_id" class="form-control mx-2">
                <option value="">Select Health Center</option>
                <!-- Add options dynamically from your database -->
                <option value="1">Health Center 1</option>
                <option value="2">Health Center 2</option>
            </select>

            <label for="vaccine_id">Vaccine: </label>
            <select name="vaccine_id" class="form-control mx-2">
                <option value="">Select Vaccine</option>
                <!-- Add options dynamically from your database -->
                <option value="1">Vaccine 1</option>
                <option value="2">Vaccine 2</option>
            </select>

            <button type="submit" class="btn btn-primary">Generate Report</button>
        </form>

        <!-- Display Report Table -->
        <?php if (!empty($reports)) : ?>
            <div class="report-table">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Parent Name</th>
                            <th>Baby Name</th>
                            <th>Health Center</th>
                            <th>Vaccine</th>
                            <th>Appointment Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reports as $index => $report) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($report['parent_name']) ?></td>
                                <td><?= htmlspecialchars($report['baby_name']) ?></td>
                                <td><?= htmlspecialchars($report['health_center_name']) ?></td>
                                <td><?= htmlspecialchars($report['vaccine_name']) ?></td>
                                <td><?= htmlspecialchars($report['appointment_date']) ?></td>
                                <td><?= htmlspecialchars($report['status']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Buttons to Export Report -->
            <div class="text-center">
                <form method="POST" action="export_report.php">
                    <input type="hidden" name="report_data" value="<?= base64_encode(json_encode($reports)) ?>">
                    <button type="submit" class="btn btn-success">Export as PDF</button>
                    <button type="submit" class="btn btn-info">Export as Excel</button>
                </form>
            </div>
        <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST') : ?>
            <div class="alert alert-warning text-center">No records found for the selected filters.</div>
        <?php endif; ?>
    </div>

    <!-- Add necessary scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
