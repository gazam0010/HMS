<?php
require_once 'login_session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="head">
        <div class="top-banner">
            <div class="container">
                <div class="small-bold-text banner-text">
                    <h1>SMART HEALTH MONITORING SYSTEM<span class="small-text"> (for doctors)</span></h1>
                </div>
            </div>
        </div>

        <nav>
            <div class="welcome-messageX">
                <div class="containerX">
                    <?php
                    if (isset($_SESSION['dname'])) {
                        $pname = $_SESSION['dname'];
                        echo '<p class="welcome-textX" style="text-align: right;">Welcome, ' . $pname . '!</p>';
                    }
                    ?>
                </div>
            </div>
            <div class="container main-nav flex">
                <a href="#" class="health-logo">
                    <img src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/health-logo-design-template-413edd6c579e1c7ac61e14ffdd75eec5_screen.jpg"
                        alt="health-logo" width="80px" height="80px">
                </a>

                <div class="nav-links">
                    <ul class="flex">
                        <li><a href="home.php" class="hover-link">Home</a></li>
                        <li><a href="About.php" class="hover-link">About Project</a></li>
                        <li><a href="doctorpanel.php" class="hover-link">Dashboard</a></li>
                        <li><a href="apt_engage.php" class="hover-link">Appointments</a></li>
                        <li><a href="wallet_doc.php" class="hover-link">Wallet</a></li>
                        <li><a href="d_changepsw.php" class="hover-link" target="_blank">Change Password</a></li>
                        <li><a href="d_logout.php" class="hover-link">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <br>
    <style>
        .welcome-box {
            color: black;
            border-radius: 5px;
        }

        .welcome-messageX {
            font-size: 1.0rem;
            text-align: right;
            margin: 0;

        }

        .head {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--primary-text-color);
            background-color: white;
        }

        .small-text {
            font-size: 1.2rem;
        }

        a {
            text-decoration: none;
            display: inline-block;
            color: var(--primary-text-color);
        }

        a:hover {
            color: var(--accent-color);
        }

        .ul {
            list-style-type: none;
        }

        .small-bold-text {
            font-size: 4rem;
            font-weight: 900;
            text-align: center;
            margin-top: 50px;
            color: var(--accent-color);
        }

        .containerX {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .flex {
            display: flex;
            align-items: center;
        }

        .hover-link {
            transition: 0.2s ease-out;
        }

        .hover-link:hover {
            color: var(--accent-color);
        }

        .top-banner {
            background-image: url("https://andy-crane.co.uk/harryb/templates/yootheme/cache/320-background-5a0209f9.png");
            background-color: #0c1011;
            background-size: cover;
            background-position: center;
            padding: 5px;
            text-align: center;
        }

        .banner-text {
            color: rgb(49, 45, 41);
            font-size: x-large;
            font-weight: bold;
            padding: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .main-nav {
            justify-content: space-between;
            color: black;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid black;
        }

        .Health-logo img {
            image-rendering: crisp-edges;
            width: 280px;
            height: 300px;
            float: right top;
        }

        .nav-links {
            flex-basis: 700px;
            margin-left: 10px;
        }

        .nav-links ul {
            list-style-type: none;
            justify-content: space-evenly;
            gap: 30px;
            margin: 0;
            padding: 0;
        }

        .nav-links li {
            display: inline-block;
            margin: 0 10px;
        }

        .nav-links li:not(:last-child) {
            position: relative;
        }

        .nav-links li:not(:last-child)::after {
            content: '';
            position: absolute;
            right: -15px;
            /* Adjust the distance of the line from the link */
            top: 50%;
            transform: translateY(-50%);
            width: 1px;
            height: 20px;
            /* Adjust the height of the line */
            background-color: #ccc;
            /* Change the color to desired grey shade */
        }
    </style>
</body>

</html>
