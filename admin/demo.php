<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slot Details Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: 50px auto;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 15px rgba(64, 64, 64, 0.1);
            background-color: #fff;
            text-align: left;
        }

        table th, table td {
            padding: 12px 15px;
        }

        table th {
            background-color: #2a9d8f;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.1rem;
            text-align: center;
        }

        table tr {
            border-bottom: 1px solid #dddddd;
        }

        table tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        table tr:last-of-type {
            border-bottom: 2px solid #2a9d8f;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        table td {
            color: #333;
            text-align: center;
        }

        @media (max-width: 768px) {
            table thead {
                display: none;
            }

            table, table tbody, table tr, table td {
                display: block;
                width: 100%;
            }

            table tr {
                margin-bottom: 15px;
            }

            table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            table td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 15px;
                font-weight: bold;
                text-align: left;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Slot Details</h2>
    <table>
        <thead>
            <tr>
                <th>Field</th>
                <th>Data Type</th>
                <th>Constraint</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td data-label="Field">slot_id</td>
                <td data-label="Data Type">INT</td>
                <td data-label="Constraint">Primary Key</td>
                <td data-label="Description">Unique ID for the time slot</td>
            </tr>
            <tr>
                <td data-label="Field">v_id</td>
                <td data-label="Data Type">INT</td>
                <td data-label="Constraint">Foreign Key</td>
                <td data-label="Description">Unique ID of the vaccine</td>
            </tr>
            <tr>
                <td data-label="Field">c_id</td>
                <td data-label="Data Type">INT</td>
                <td data-label="Constraint">Foreign Key</td>
                <td data-label="Description">Unique ID of the health center</td>
            </tr>
            <tr>
                <td data-label="Field">date</td>
                <td data-label="Data Type">DATE</td>
                <td data-label="Constraint">Not Null</td>
                <td data-label="Description">Date of the slot</td>
            </tr>
            <tr>
                <td data-label="Field">time_slot_1</td>
                <td data-label="Data Type">TIME</td>
                <td data-label="Constraint">Not Null</td>
                <td data-label="Description">First time slot</td>
            </tr>
            <tr>
                <td data-label="Field">time_slot_2</td>
                <td data-label="Data Type">TIME</td>
                <td data-label="Constraint">Optional</td>
                <td data-label="Description">Second time slot</td>
            </tr>
            <tr>
                <td data-label="Field">time_slot_3</td>
                <td data-label="Data Type">TIME</td>
                <td data-label="Constraint">Optional</td>
                <td data-label="Description">Third time slot</td>
            </tr>
            <tr>
                <td data-label="Field">is_available</td>
                <td data-label="Data Type">BOOLEAN</td>
                <td data-label="Constraint">Not Null</td>
                <td data-label="Description">Availability status (1 = available, 0 = not available)</td>
            </tr>
        </tbody>
    </table>
</div>

</body>
</html>
