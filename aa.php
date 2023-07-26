<?php
require_once 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .custom-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .custom-heading {
            color: #333;
            text-align: center;
        }

        .custom-subheading {
            color: #555;
            margin-top: 30px;
        }

        .custom-paragraph {
            color: #666;
        }

        .custom-list {
            margin-left: 30px;
        }

        .custom-note {
            color: #999;
            font-style: italic;
            margin-top: 20px;
        }

        .custom-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: black;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
        }

        .custom-btn:hover {
            background-color: #0056b3;
        }

        .custom-link {
            color: #007bff;
        }

        .custom-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<br>
    <div class="custom-container">
        <h1 class="custom-heading">Welcome to Online Doctor Appointment Booking System</h1>
        

        <h2 class="custom-subheading">How it Works:</h2>
        <ol class="custom-list">
            <li class="custom-paragraph">Log in using the button below.</li>
            <li class="custom-paragraph">Select your required specialty from the available options.</li>
            <li class="custom-paragraph">Choose your preferred doctor from the list.</li>
            <li class="custom-paragraph">Enter your existing illness details and choose date and time of appointment.</li>
            <li class="custom-paragraph">View the live status of your appointment.</li>
            <li class="custom-paragraph">At the appointment time, you can communicate with the doctor through the encrypted live chat.</li>
            <li class="custom-paragraph">You can see the chat history even after completing the appointment.</li>
        </ol>
        <p class="custom-paragraph">If you want to book an appointment, please log in using the button below.</p>
        <a class="custom-btn" href="login.php">Log In</a>
        <p class="custom-note">Please note that the live chat is AES 128-bit encrypted to ensure the security of your communication.</p>
    </div>
</body>
</html>
<br>
<?php
require_once 'footer.php';
?>
