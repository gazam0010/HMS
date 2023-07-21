<?php
// Data variables
$status = "Active";
$name = "John Doe";
$rl = "Developer";

// CSV file path
$csvFile = 'C:/Users/gulfa/Desktop/ad.csv';

// Open the CSV file in append mode
$file = fopen($csvFile, 'a');

// Create an array with the data to append
$data = array($status, $name, $rl);

// Append the data to the CSV file
fputcsv($file, $data);

// Close the file
fclose($file);

echo "Data appended successfully to the CSV file!";
?>
