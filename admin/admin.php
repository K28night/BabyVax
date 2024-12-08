<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Welcome Page</title>
    <link rel="stylesheet" href="styles.css">
    <style>/* Reset some default styling */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

/* Full page container with background */
body {
    height: 100vh;
    background: linear-gradient(135deg, #72EDF2 10%, #5151E6 100%);
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Admin welcome box styling */
.admin-container {
    text-align: center;
    background-color: white;
    padding: 50px;
    border-radius: 10px;
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
    max-width: 400px;
    width: 100%;
    animation: fadeIn 1.5s ease-in-out;
}

/* Heading and paragraph */
h1 {
    font-size: 2.5rem;
    color: #5151E5;
    margin-bottom: 20px;
}

p {
    font-size: 1.1rem;
    color: #333;
    margin-bottom: 30px;
}

/* Button styling */
.btn {
    text-decoration: none;
    background-color: #5151E5;
    color: white;
    padding: 15px 30px;
    border-radius: 5px;
    font-size: 1rem;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #72EDF2;
    color: #5151E5;
}

/* Animation for fade-in effect */
@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(-20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
</head>
<body>
    <div class="admin-container">
        <div class="welcome-box">
            <h1>Welcome, Admin</h1>
            <p>Your dashboard is ready. Manage your site effortlessly.</p>
            <a href="ad_dashboard.php" class="btn">Go to Dashboard</a>
        </div>
    </div>
</body>
</html>
