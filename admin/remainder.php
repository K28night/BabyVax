<?php

require('../config/autoload.php'); 
include("header.php");

$dao = new DataAccess();

// Get tomorrow's date
$tomorrow = date('Y-m-d', strtotime('+1 day'));

// Fetch appointments scheduled for tomorrow
$query = "SELECT a.*, p.email FROM appointments a 
          JOIN parents p ON a.parent_id = p.id 
          WHERE a.appointment_date = :appointment_date";

$params = [':appointment_date' => $tomorrow];
// $appointments = $dao->fetchAll($query, $params);

// Function to send email reminder
function sendEmailReminder($email, $vaccine_id, $appointment_date, $start_time) {
    $subject = "Vaccination Reminder";
    $message = "Dear Parent,\n\nThis is a reminder for your child's vaccination appointment.\n"
             . "Vaccine ID: $vaccine_id\n"
             . "Appointment Date: $appointment_date\n"
             . "Start Time: $start_time\n\n"
             . "Please ensure to arrive on time.\n\nThank you!";
    $headers = "From: noreply@yourdomain.com";  // Change to your domain

    // Send the email
    mail($email, $subject, $message, $headers);
}

// Loop through appointments and send reminders
foreach ($appointments as $appointment) {
    $email = $appointment['email'];
    $vaccine_id = $appointment['vaccine_id'];
    $appointment_date = $appointment['appointment_date'];
    $start_time = $appointment['start_time'];

    sendEmailReminder($email, $vaccine_id, $appointment_date, $start_time);
}

// Provide feedback for debugging or confirmation
if (count($appointments) > 0) {
    echo "Reminders sent successfully.";
} else {
    echo "No appointments scheduled for tomorrow.";
}
?>



<!-- 
crontab -e

Run Every Day at 3:30 AM
30 3 * * * /usr/bin/php /path/to/your/script/send_reminders.php
 script automatically every day (e.g., at midnight)
0 0 * * * /usr/bin/php /path/to/your/script/send_reminders.php -->

