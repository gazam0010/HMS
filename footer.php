<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>

</html>
<!-- FOOTER SECTION -->
<html>

<head>
    <style>
        footer {
            padding: 20px 0 0 0;
            background-color: #9ea5a7;
            /* background-color: #9ea5a7; */
        }

        .link-column {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
            /* padding: 5px;
        margin: 5px; */
        }

        .footer-container {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 5px;
        }

        .health-management-logo img {
            margin-top: 20px;
            width: 150px;
            height: 150px;
            float: right;
            /* margin-left: 500px; */
        }

        .hover-link {
            color: black;
            text-decoration: none;
            transition: color 0.5s ease;
        }

        .hover-link:hover {
            color: black;
        }

        .link-column+.link-column::before {
            /* content: "SMART HEALTH MONITORING SYSTEM"; */
            display: block;
            width: 1px;
            height: 100%;
            background-color: #fff;
            margin-left: 10px;
        }

        .subfooter {
            text-align: center;
            margin-top: 20px;
        }

        .subfooter p {
            font-size: 14px;
            color: #555;
        }

        .subfooter-box {
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
        }

        .containerx {
            max-width: 1250px;
            margin-inline: var(--accent-color-dark);
            padding-inline: var(--padding-inline-section);
        }
    </style>


</head>

<footer>

    <div class="containerx flex footer-container">
        <div class="link-column flex">
            <!-- <h4>QUICK ACCESS</h4> -->
            <h4>SMART HEALTH MONITORING SYSTEM</h4>
            <h3><a>My project, Patient Health Monitoring, aims to develop a comprehensive and efficient system for
                    monitoring
                    and managing patients' health. By utilising specialised physicians and machine learning models.</a>
            </h3>
        </div>
        <div class="link-column flex">
            <h4>SERVICES</h4>
            <a href="#" class="hover-link">Regular Check-ups</a>
            <a href="#" class="hover-link">Health Tracking</a>
            <a href="#" class="hover-link">Remote Monitoring</a>
            <a href="#" class="hover-link">Collaboration</a>
            <a href="#" class="hover-link">Communication</a>
        </div>
        <div class="link-column flex">
            <h4>APPOINTMENT Management</h4>
            <a href="#" class="hover-link">Management</a>
            <a href="#" class="hover-link">Book Appointment</a>
            <a href="#" class="hover-link">View Appointment</a>
            <a href="#" class="hover-link">Edit Appointment</a>
            <a href="#" class="hover-link">Delete Appointment</a>
        </div>
        <div class="link-column flex">
            <h4>ML MODEL INTEGRATION</h4>
            <a href="#" class="hover-link">Decision Support</a>
            <a href="#" class="hover-link">Empowering Patients</a>
            <a href="#" class="hover-link">Diabetes</a>
            <a href="#" class="hover-link">Cancer</a>
            <a href="#" class="hover-link">Pneumonia</a>
        </div>
        <div class="link-column flex">
            <h4>CONTACT</h4>
            <a href="#" class="hover-link">Phone: 123-456-7890 &#x1F4DE;</a>
            <a href="#" class="hover-link">Email: saimaparvez23@gmail.com &#x1F4E7;</a>
            <a href="#" class="hover-link">Address: Department of Computer Science, Aligarh, India &#x1F30D;</a>
        </div>
        <a href="#" class="health-management-logo">
            <img src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/health-logo-design-template-413edd6c579e1c7ac61e14ffdd75eec5_screen.jpg?ts=1604410182"
                alt="health-logo" style="float: right; margin-left: 20px; margin-top: 20px;">
        </a>
    </div>
    <div class="subfooter">
        <div class="subfooter-box">
            <p>&copy; Thanks for visiting our website. All rights reserved.
                <a>Made by Saima Parvez</a>
            </p>
        </div>
    </div>
</footer>

<section class="Example-sectiopn"></section>


</body>

</html>