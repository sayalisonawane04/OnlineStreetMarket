<?php

session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/html/CITY_STREET_MART/login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <style>
        /* General Reset */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
        }

        .success-container {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 90%;
        }

        .success-container h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: #ffdf00;
        }

        .success-container p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .btn {
            text-decoration: none;
            display: inline-block;
            background: #ffdf00;
            color: #000;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: #ffe680;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="success-container">
        <h1>Thank You!</h1>
        <p>Your order has been placed successfully and will be processed shortly.</p>
        <a href="UserHistory.php" class="btn">Return to Home</a>
    </div>
</body>
</html>
