<?php
session_start();

if (
    !isset($_SESSION['login-success']) ||
    $_SESSION['login-success'] !== 'Patient Login Success' ||
    !isset($_SESSION['user-role']) ||
    $_SESSION['user-role'] !== 'patient' ||
    !isset($_SESSION['user-id']) ||
    !isset($_SESSION['pname']) ||
    !isset($_SESSION['pemail'])
) {
    header('Location: /HMS/login.php');
    exit();
}

$pid = $_SESSION['user-id'];
$pname = $_SESSION['pname'];
$pemail = $_SESSION['pemail'];

/* DB Connectivity */

define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'SecureSSL000@');
define('DB_NAME', 'test');

// Create database connection
$connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (!$connection) {
    die("Failed to connect to the database: " . mysqli_connect_error());
}
?>