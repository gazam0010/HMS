<?php
require_once 'login_session.php';



$query = "SELECT * FROM patient WHERE pid = '$pid'";
$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $patientRow = mysqli_fetch_assoc($result);

    // Assign patient information to variables
    $pid = $patientRow['pid'];
    $pname = $patientRow['pname'];
    $pemail = $patientRow['email'];
    $pmobile = $patientRow['pmobile'];
    $birthday = $patientRow['birthday'];
    $pgender = $patientRow['pgender'];
    $pcity = $patientRow['pcity'];
    $paddress = $patientRow['Address'];
}

// Check if the form is submitted for updating patient info
if (isset($_POST['update_patient'])) {
    $newMobile = $_POST['new_mobile'];
    $newCity = $_POST['new_city'];
    $newAddress = $_POST['new_address'];

    // Update the patient's mobile, city, and address in the database
    $updateQuery = "UPDATE patient SET pmobile='$newMobile', pcity='$newCity', Address='$newAddress' WHERE pid='$pid'";
    $updateResult = mysqli_query($connection, $updateQuery);

    if ($updateResult) {
        // Refresh the page to show the updated information
        header("Location: patientpanel.php");
        exit();
    } else {
        echo "Error updating patient information: " . mysqli_error($connection);
    }
}
?>
<?php
include 'header_after_pat.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>
        Dashboard | Patient
    </title>
</head>

<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>Patient Dashboard</h1>
            <!-- Add any other dashboard header content here -->
        </div>
        <div class="patient-info-container">
            <div class="patient-info">
                <?php if (isset($pname)) { ?>
                    <!-- Display fetched patient information -->
                    <h2>Name:
                        <strong>
                            <?php echo $pname; ?>
                        </strong>
                    </h2>
                    <p>Email:
                        <strong>
                            <?php echo $pemail; ?>
                        </strong>
                    </p>
                    <p>ID:
                        <strong>
                            <?php echo $pid; ?>
                        </strong>
                    </p>
                    <p>Mobile Number:
                        <strong>
                            <?php echo $pmobile; ?>
                        </strong>
                    </p>
                    <p>Date of Birth:
                        <strong>
                            <?php echo $birthday; ?>
                        </strong>
                    </p>
                    <p>Gender:
                        <strong>
                            <?php echo $pgender; ?>
                        </strong>
                    </p>
                    <p>City:
                        <strong>
                            <?php echo $pcity; ?>
                        </strong>
                    </p>
                    <p>Address:
                        <strong>
                            <?php echo $paddress; ?>
                        </strong>
                    </p>
                    <hr>
                    <h4 align="center">Update Profile</h4>
                    <!-- Form to update patient information -->
                    <form action="patientpanel.php" method="POST">
                        <label for="new_mobile">New Mobile Number:</label>
                        <input type="text" id="new_mobile" name="new_mobile" placeholder="Enter new mobile number" required>
                        <label for="new_city">New City:</label>
                        <input type="text" id="new_city" name="new_city" placeholder="Enter new city" required>
                        <label for="new_address">New Address:</label>
                        <input type="text" id="new_address" name="new_address" placeholder="Enter new address" required>
                        <br>
                        <input type="submit" name="update_patient" value="Update">
                    </form>
                <?php } else { ?>
                    <p>No patient information found.</p>
                <?php } ?>
            </div>
        </div>
    </div>

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

        .patient-info-container {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .patient-info {
            /* Add your styles for patient information here */
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        /* Styles for the form to update patient information */
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
</body>

</html>
<?php
include 'footer.php';
?>