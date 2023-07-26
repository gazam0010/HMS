<?php
session_start();

if (
    !isset($_SESSION['login-success']) ||
    $_SESSION['login-success'] !== 'Doctor Login Success' ||
    !isset($_SESSION['user-role']) ||
    $_SESSION['user-role'] !== 'doctor' ||
    !isset($_SESSION['user-id']) ||
    !isset($_SESSION['dname']) ||
    !isset($_SESSION['demail'])
) {
    header('Location: /HMS/login.php');
    exit();
}

$did = $_SESSION['user-id'];
$pname = $_SESSION['dname'];
$pemail = $_SESSION['demail'];

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