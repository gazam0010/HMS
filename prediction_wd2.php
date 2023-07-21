<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "site";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['feedback'])) {
    $fb = $_GET['feedback'];
    $id = $_GET['id'];
    $sql = "UPDATE diabetes SET output_user_gen = '$fb' WHERE id = '$id'";

    if ($conn->query($sql)) {
        header('Location: prediction_wd2.php?fb=1&noPopup=1');


        exit();
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>Diabetes Prediction</title>
    <link rel="stylesheet" href="prediction_wd2.css?">
</head>

<body onload="showMessagePopup()">
    <?php if (!isset($_GET['noPopup'])): ?>

        <div class="popup-message" id="popup-message">
            <div class="message-content">
                <span class="close-button" onclick="closePopupMessage()">&times;</span>
            </div>

            <div class="message-content">
                <p style="font-size: 13px; text-align: left;">You have the option to input your own data or utilize this
                    synthetic random data (click Autofill).</p>
            </div>
            <hr>
            <?php include('ab.php'); ?>
            <input type="button"
                style="float: right; padding: 4px; color: white; background-color: #1ea7fc; font-size: 12px;"
                value="Autofill" onclick="fillFormValues()">
        </div>


    <?php endif; ?>


    <h1>Diabetes Prediction</h1>
    <?php


    if (isset($_POST['predict'])) {
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $urea = $_POST['urea'];
        $cr = $_POST['cr'];
        $hba1c = $_POST['hba1c'];
        $chol = $_POST['chol'];
        $tg = $_POST['tg'];
        $hdl = $_POST['hdl'];
        $ldl = $_POST['ldl'];
        $vldl = $_POST['vldl'];
        $bmi = $_POST['bmi'];
        $output = 0;

        $command = escapeshellcmd("python diabetes_prediction.py --gender $gender --age $age --urea $urea --cr $cr --hba1c $hba1c --chol $chol --tg $tg --hdl $hdl --ldl $ldl --vldl $vldl --bmi $bmi");
        $output = (int)shell_exec($command);

        $idQuery = "SELECT id FROM diabetes ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($conn, $idQuery);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $id = $row['id'] + 1;
        } else {
            $id = null;
        }

        mysqli_free_result($result);



        $sql = "INSERT INTO diabetes (id, gender, age, urea, cr, hba1c, chol, tg, hdl, ldl, vldl, bmi, output_model_gen)
    VALUES ('$id', '$gender', '$age', '$urea', '$cr', '$hba1c', '$chol', '$tg', '$hdl', '$ldl', '$vldl', '$bmi', '$output')";

        $conn->query($sql);


       



        if ($output == 0) {
            echo '<div class="result negative">The person is predicted to be diabetes-free.</div>';
        } elseif ($output == 1) {
            echo '<div class="result suspicious">The person is predicted to be in a pre-diabetic state.</div>';
        } elseif ($output == 2) {
            echo '<div class="result positive">The person is predicted to have diabetes.</div>';
        }
        echo '<div class="message-symbol" style="display: flex; align-items: center; margin-left: 10px;">';
        echo '<div class="message">Please provide the feedback, was the prediction correct? (select current situation)</div>';
        echo '<div class="symbol-container" style="display: flex; align-items: center; margin-left: 10px;">';
        echo '<a class="tick-symbol" href="prediction_wd2.php?feedback=2&id=' . $id . '" title="Diabetic"><span>&#10003;</span></a>';
        echo '<a class="wrong-symbol" href="prediction_wd2.php?feedback=0&id=' . $id . '" title="Non-diabetic"><span>&#10007;</span></a>';
        echo '<a class="suspecious-symbol" href="prediction_wd2.php?feedback=1&id=' . $id . '" title="Pre-diabetic" >
        <span style="font-size: 30px; font-weight: bold;">&#x25CB;</span>
        </a>';

        echo '</div>';
        echo '</div>';


    }


    ?>
    <div class="loading-container hidden" id="loading-container">
        <div class="loading"></div>
    </div>

    <form id="myForm" action="" method="post" class="animate__animated animate__fadeIn">
        <div class="step1">
            <label for="gender">Gender:</label>
            <div class="custom-dropdown">
                <select id="gender" name="gender" required>
                    <option value="0">Female</option>
                    <option value="1">Male</option>
                </select>
            </div><br>

            <label for="age">Age:</label>
            <input type="text" id="age" name="age" value="" required><br>

            <label for="urea">Urea:</label>
            <input type="text" id="urea" name="urea" required><br>

            <label for="cr">Creatnine Ratio:</label>
            <input type="text" id="cr" name="cr" required><br>

            <label for="hba1c">HbA1c:</label>
            <input type="text" id="hba1c" name="hba1c" required><br>
            <br>
            <input type="button" value="Next" onclick="showStep2()">

            <div class="info">The use of an asterisk (*) indicates that units should be expressed in grams per deciliter
                (g/dL). </div>
        </div>

        <div class="step2 hidden">

            <input type="button"
                style="float: right; padding: 10px; color: white; background-color: orangered; font-size: 12px;"
                value="Back" onclick="showStep1()"><br>
            <label for="chol">Cholesterol*:</label>
            <input type="text" id="chol" name="chol" required><br>

            <label for="tg">Trigycerides*:</label>
            <input type="text" id="tg" name="tg" required><br>
            <div class="form-row">
                <label for="hdl">HDL Chol*:</label>
                <input type="text" id="hdl" name="hdl" required>
                <label for="ldl">LDL Chol*:</label>
                <input type="text" id="ldl" name="ldl" required>
            </div>
            <label for="vldl">VLDL*:</label>
            <input type="text" id="vldl" name="vldl" required><br>

            <label for="bmi">BMI:</label>
            <input type="text" id="bmi" name="bmi" required><br>
            <br>
            <input type="submit" name="predict" value="Predict">
            <div class="info">The use of an asterisk (*) indicates that units should be expressed in grams per deciliter
                (g/dL). </div>
        </div>
    </form>

    <div class="info-container">
        This prediction is based on a machine learning model trained using data provided by Rashid, Ahlam (2020),
        “Diabetes Dataset”, Mendeley Data, V1, doi: 10.17632/wj9rwkp9c2.1.<br>
        This model has achieved an accuracy rate of approximately 91%.
        <hr>
        Coded, Trained and Developed by Freak Azam
    </div>

    <script>
        function goBack() {
            document.getElementById('step1-form').style.display = 'block';
            document.getElementById('step2-form').style.display = 'none';
        }
        function showStep2() {
            document.querySelector('.step1').classList.add('hidden');
            document.querySelector('.step2').classList.remove('hidden');
        }
        document.querySelector('form').addEventListener('submit', function () {
            document.getElementById('loading-container').classList.remove('hidden');
        });
        // Function to show the popup message
        function showMessagePopup() {
            var popup = document.getElementById("popup-message");
            popup.style.display = "block";
        }

        function closePopupMessage() {
            var popup = document.getElementById("popup-message");
            popup.style.display = "none";
        }

        function showStep1() {
            document.querySelector('.step1').classList.remove('hidden');
            document.querySelector('.step2').classList.add('hidden');
        }

        function fillFormValues() {
            <?php
            $randomData = generateRandomData();
            foreach ($randomData as $name => $value) {
                $inputName = lcfirst($name);
                if ($inputName == 'gender') {
                    $value = ($value == "Female") ? 0 : 1;
                }
                ?>
                document.getElementById('<?php echo $inputName; ?>').value = '<?php echo $value; ?>';
                <?php
            }
            ?>
        }

    </script>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.js"></script>


</html>

<?php
$conn->close();
?>