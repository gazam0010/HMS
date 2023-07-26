<?php
require_once 'login_session.php';

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['submit'])) {
    $newPassword = validate($_POST['new_password']);
    $confirmPassword = validate($_POST['confirm_password']);

    if ($newPassword !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        $patientID = $_SESSION['user-id'];

        $updateQuery = "UPDATE patient SET psw = '$newPassword' WHERE pid = '$patientID'";

        if ($connection->query($updateQuery) === TRUE) {
            $successMessage = "Password updated successfully.";
        } else {
            $error = "Error updating password: " . $connection->error;
        }
    }
}

$connection->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Change Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        h2 {
            margin-top: 20px;
            text-align: center;
            color: #333;
        }

        .container {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="password"] {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 14px;
        }

        .error-message {
            color: red;
        }

        .success-message {
            color: green;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            font-size: 14px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
<title>
    Change Password | Patient
</title>
</head>

<body>
    <h2>Change Password</h2>
    <div class="container">
        <?php
        if (isset($error)) {
            echo '<p class="error-message">' . $error . '</p>';
        }
        if (isset($successMessage)) {
            echo '<p class="success-message">' . $successMessage . '</p>';
        }
        ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <p align="right"><strong> Username: <?php echo $pname; ?></strong></p>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" id="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Change Password" class="btn">
            </div>
        </form>
    </div>
</body>

</html>