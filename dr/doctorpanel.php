<?php
require_once 'login_session.php';

$query = "SELECT * FROM doctorprofile WHERE did = '$did'";
$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $doctorRow = mysqli_fetch_assoc($result);

    // Assign doctor information to variables
    $dname = $doctorRow['dname'];
    $demail = $doctorRow['email'];
    $dcontact = $doctorRow['dcontact'];
    $daddress = $doctorRow['daddress'];
    $dspecialization = $doctorRow['dspecialization'];
    $exp = $doctorRow['exp'];
}

// Check if the form is submitted for updating doctor info
if (isset($_POST['update_doctor'])) {
    $newContact = $_POST['new_contact'];
    $newAddress = $_POST['new_address'];
    $newExp = $_POST['new_exp'];

    // Update the doctor's contact, address, and experience in the database
    $updateQuery = "UPDATE doctorprofile SET dcontact='$newContact', daddress='$newAddress', exp='$newExp' WHERE did='$did'";
    $updateResult = mysqli_query($connection, $updateQuery);

    if ($updateResult) {
        // Refresh the page to show the updated information
        header("Location: doctorpanel.php?did=$did");
        exit();
    } else {
        echo "Error updating doctor information: " . mysqli_error($connection);
    }
}
?>
<?php
include 'header_after_dr.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Doctor Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .dashboard-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .dashboard-header h1 {
            font-size: 36px;
            color: #333;
            margin: 0;
            padding: 10px;
        }

        .doctor-info-container {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .doctor-info {
            /* Add your styles for doctor information here */
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        /* Styles for the form to update doctor information */
        form {
            margin-top: 20px;
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            width: 70%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 10%;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>Doctor Panel</h1>
            <!-- Add any other dashboard header content here -->
        </div>
        <div class="doctor-info-container">
            <div class="doctor-info">
                <?php if (isset($dname)) { ?>
                    <!-- Display fetched doctor information -->
                    <h2>Name:
                        <strong><?php echo $dname; ?></strong>
                    </h2>
                    <p>Email:
                        <strong><?php echo $demail; ?></strong>
                    </p>
                    <p>Contact:
                        <strong><?php echo $dcontact; ?></strong>
                    </p>
                    <p>Address:
                        <strong><?php echo $daddress; ?></strong>
                    </p>
                    <p>Specialization:
                        <strong><?php echo $dspecialization; ?></strong>
                    </p>
                    <p>Experience:
                        <strong><?php echo $exp; ?> Years</strong>
                    </p>
                    <hr>
                    <h4 align="center">Update Profile</h4>
                    <!-- Form to update doctor information -->
                    <form action="doctorpanel.php?did=<?php echo $did; ?>" method="POST">
                        <label for="new_contact">New Contact:</label>
                        <input type="text" id="new_contact" name="new_contact" placeholder="Enter new contact number" required>
                        <label for="new_address">New Address:</label>
                        <input type="text" id="new_address" name="new_address" placeholder="Enter new address" required>
                        <label for="new_exp">New Experience:</label>
                        <input type="text" id="new_exp" name="new_exp" placeholder="Enter new experience (Years)" required>
                        <br>
                        <input type="submit" name="update_doctor" value="Update">
                    </form>
                <?php } else { ?>
                    <p>No doctor information found.</p>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>
<?php
include 'footer.php';
?>