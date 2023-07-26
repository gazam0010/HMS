<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diabetes Prediction</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .prediction-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .prediction-heading {
            text-align: center;
            color: black;
            margin-bottom: 20px;
        }

        .prediction-description {
            margin-bottom: 10px;
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        .login-message {
            font-size: 18px;
            text-align: center;
            color: #555;
            margin-bottom: 20px;
        }

        .login-button {
            text-align: center;
        }

        .login-button a {
            display: inline-block;
            background-color: black;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .login-button a:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="prediction-container">
        <h1 class="prediction-heading">Diabetes Prediction</h1>
        <p class="prediction-description">
            The diabetes prediction on this website is based on a machine learning model trained using data provided by
            the National Institute of Diabetes and Digestive and Kidney Diseases (NIDDK), USA. The model has achieved an
            accuracy rate of approximately 80.58%.
        </p>
        <p class="prediction-description">
            The prediction is made using an XGBoost classifier, which is a powerful machine learning algorithm known for
            its performance in various applications.
        </p>
        <p class="prediction-description">
            The model is trained on a dataset containing various features related to diabetes risk factors, such as
            number of pregnancies, glucose level, blood pressure, skin thickness, insulin level, BMI, diabetes pedigree
            function, and age.
        </p>
        <p class="login-message">
            If you want to use this feature and make a diabetes prediction, please log in to your account.
        </p>
        <div class="login-button">
            <a href="login.php">Login</a>
        </div>
    </div>
    
</body>

</html>

<?php
include 'footer.php';
?>