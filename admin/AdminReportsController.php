<?php
// AdminReportsController.php

class AdminReportsController {

    // Method to generate the report
    public function generateReport($filters = []) {
        // Logic to fetch the report data from the database based on the filters
        // Sample mock data for demonstration
        $reports = [
            [
                'parent_name' => 'John Doe',
                'baby_name' => 'Baby1',
                'health_center_name' => 'Health Center 1',
                'vaccine_name' => 'Vaccine A',
                'appointment_date' => '2024-12-10',
                'status' => 'Completed'
            ],
            [
                'parent_name' => 'Jane Smith',
                'baby_name' => 'Baby2',
                'health_center_name' => 'Health Center 2',
                'vaccine_name' => 'Vaccine B',
                'appointment_date' => '2024-12-12',
                'status' => 'Pending'
            ]
        ];
        // Apply filters (if any)
        if (!empty($filters)) {
            // Filtering logic, for example, filter by start date, end date, etc.
            // This is just a placeholder to demonstrate how filtering might work
            $reports = array_filter($reports, function($report) use ($filters) {
                if (!empty($filters['start_date']) && $report['appointment_date'] < $filters['start_date']) {
                    return false;
                }
                if (!empty($filters['end_date']) && $report['appointment_date'] > $filters['end_date']) {
                    return false;
                }
                return true;
            });
        }
        
        return $reports;
    }
}
?>
