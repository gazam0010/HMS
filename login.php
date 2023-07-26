<?php
session_start();
if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $plainpsw = $_POST['psw'];
  $selectedRole = $_POST['login_as'];
  $psw = $plainpsw;

  function validate($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $email = validate($_POST['email']);
  $psw = validate($_POST['psw']);

  if (empty($email)) {
    header("Location: login.php?error=Email id is required");
    exit();
  } elseif (empty($psw)) {
    header("Location: login.php?error=Password is required");
    exit();
  } else {
    $servername = "localhost";
    $username = "root";
    $doctordb = "test";
    $patientDbname = "test";
    $password = "SecureSSL000@";
    // Create connection for doctor
    $doctorConn = new mysqli($servername, $username, $password, $doctordb);

    // Check connection
    if ($doctorConn->connect_error) {
      die("Connection failed: " . $doctorConn->connect_error);
    }


    if ($selectedRole === 'Doctor') {
      // Check if the user is a doctor
      $doctorQuery = "SELECT * FROM doctorprofile WHERE email='$email' AND psw='$psw'";
      $doctorResult = $doctorConn->query($doctorQuery);

      if ($doctorResult->num_rows > 0) {
        // Doctor login successful
        $doctorRow = $doctorResult->fetch_assoc();
        $_SESSION['login-success'] = 'Doctor Login Success';
        $_SESSION['user-role'] = 'doctor';
        $_SESSION['user-id'] = $doctorRow["did"];
        $_SESSION['dname'] = $doctorRow["dname"];
        $_SESSION['demail'] = $doctorRow["email"];
        header('location: /HMS/dr/doctorpanel.php');
        exit();
      } else {
        // Display error for invalid doctor login
        header("Location: login.php?error=Invalid email or password for Doctor login");
        exit();
      }
    } else {
      $doctorConn->close();

      // Create connection for patient
      $patientConn = new mysqli($servername, $username, $password, $patientDbname);

      if ($patientConn->connect_error) {
        die("Connection failed: " . $patientConn->connect_error);
      }

      // Check if the user is a patient
      $patientQuery = "SELECT * FROM patient WHERE email='$email' AND psw='$psw'";
      $patientResult = $patientConn->query($patientQuery);

      if ($patientResult->num_rows > 0) {
        // Patient login successful
        $patientRow = $patientResult->fetch_assoc();
        $_SESSION['login-success'] = 'Patient Login Success';
        $_SESSION['user-role'] = 'patient';
        $_SESSION['user-id'] = $patientRow["pid"];
        $_SESSION['pname'] = $patientRow["pname"];
        $_SESSION['pemail'] = $patientRow["email"];
        header('location: pat/patientpanel.php');
        exit();
      } else {
        // Display error for invalid patient login
        header("Location: login.php?error=Invalid email or password for Patient login");
        exit();
      }

      $patientConn->close();
    }
  }
}

?>
<?php
include 'header.php';
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <div class="outer-box">
    <div class="inner-box">
      <header class="signup-header">
        <h1>Login</h1>
        <p>It Just takes 30 seconds</p>
      </header>
      <main class="signup-body"> <!-- Add the class "signup-body" here -->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" name="login">
          <?php
          if (isset($_GET['error'])) {
            $errorMessage = $_GET['error'];
            echo "<p class='error'>$errorMessage</p>";
          }
          ?>

          <p>
            <label for="login_as"><b>Login As</b></label>
            <select name="login_as" id="login_as">
              <option value="PATIENT">PATIENT</option>
              <option value="Doctor">Doctor</option>
            </select>
          </p>
          <p>
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Enter Your email" name="email">
          </p>
          <p>
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="At least 8 characters" name="psw">
          </p>
          <!-- <p id="error-message" style="color: red; display: none;">Invalid email or password</p> -->
          <p>
            <input type="submit" id="submit" name="login" value="Login Now">
          <p>Don't have an account? <a href="register.php">Register Now</a> </p>
          </p>
        </form>
      </main>
    </div>
    <div class="circle c1"></div>
    <div class="circle c2"></div>
  </div>
  <?php
  include 'footer.php';
  ?>
  <style>
    .error {
      color: red;
      margin-top: 3px;
    }

    .outer-box {
      width: 100%;
      height: 100vh;
      background: linear-gradient(to top left, rgb(156, 160, 161), rgb(236, 236, 243));
    }

    .inner-box {
      width: 500px;
      margin: 0 auto;
      position: relative;
      top: 50%;
      transform: translateY(-50%);
      padding: 20px 40px;
      background-color: #e8edf1cc;
      backdrop-filter: blur(20px);
      border-radius: 8px;
      box-shadow: 2px 2px 5px #1e6b9f;
      border: solid #c4bebecc;
      z-index: 2;
      border: 1px solid #f7f3f3;
      margin-bottom: 25px;
    }

    .signup-header h1 {
      font-size: 2.5rem;
      color: rgb(19, 18, 18);
    }

    .signup-header p {
      font-size: 1rem;
      color: #555;
    }

    .signup-body p {
      margin: 10px;
      font-weight: bold;
    }

    .signup-body p label {
      display: block;
    }

    .signup-body p input,
    .signup-body select {
      width: 100%;
      padding: 10px;
      border: 2px solid #4d4949cc;
      font-size: 1rem;
      margin-top: 4px;
      backdrop-filter: blur(20px);
      border-radius: 8px;
      box-shadow: 2px 2px 5px #1e6b9f;
      color: #023354;
    }

    .signup-body input[type="submit"] {
      background-color: #023354;
      border: none;
      color: white;
      cursor: pointer;
    }

    .signup-body input[type="submit"]:hover {
      background-color: #1e6b9f;
    }

    .signup-footer p {
      color: #585555;
      text-align: center;
    }

    .signup-footer p {
      color: #073e64;
    }

    .circle {
      width: 200px;
      height: 200px;
      border-radius: 100px;
      background: linear-gradient(to top right, #49484eaa, #ffffff);
      position: absolute;
    }

    .c1 {
      top: 400px;
      left: 30px;
    }

    .c2 {
      bottom: 0px;
      right: 30px;
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var errorMessage = document.getElementById('error-message');
      var loginForm = document.forms['login'];

      loginForm.addEventListener('submit', function (event) {
        var email = loginForm.elements['email'].value;
        var psw = loginForm.elements['psw'].value;

        // Replace this condition with your own validation logic
        if (email !== 'user@example.com' || psw !== 'psw') {
          errorMessage.style.display = 'block';
          event.preventDefault(); // Prevent the form from submitting
        }
      });
    });
  </script>
</body>

</html>