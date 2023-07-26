<?php
require_once 'login_session.php';
$getAid = $_GET['aid'];


$query = "SELECT * FROM appointments WHERE aid = $getAid";
$result = mysqli_query($connection, $query);

$options = '';
$row = mysqli_fetch_assoc($result);
if($row['vc_link'] !== '') {
    $options = $row['vc_link'];
}
else {
    $options = NULL;
}

mysqli_close($connection);

echo $options;
?>
