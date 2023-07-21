<?php
function generateRandomData()
{
    $parameters = [
        ['name' => 'gender'],
        ['name' => 'age', 'mean' => 45, 'stdDev' => 20],
        ['name' => 'urea', 'mean' => 5.12, 'stdDev' => 2.93],
        ['name' => 'cr', 'mean' => 68.94, 'stdDev' => 59.98],
        ['name' => 'hba1c', 'mean' => 8.28, 'stdDev' => 2.53],
        ['name' => 'chol', 'mean' => 4.86, 'stdDev' => 1.30],
        ['name' => 'tg', 'mean' => 2.34, 'stdDev' => 1.40],
        ['name' => 'hdl', 'mean' => 1.20, 'stdDev' => 0.66],
        ['name' => 'ldl', 'mean' => 2.60, 'stdDev' => 1.11],
        ['name' => 'vldl', 'mean' => 1.85, 'stdDev' => 3.66],
        ['name' => 'bmi', 'mean' => 29.57, 'stdDev' => 4.96],
    ];

    $randomData = [];

    foreach ($parameters as $param) {
        $name = $param['name'];
        if ($param['name'] === 'gender') {
            $randomValue = mt_rand(0, 1);
            $gender = ($randomValue == 0) ? "Female" : "Male";
            $randomData[$name] = $gender;
        } else {
            $randomValue = generateRandomValue($param['mean'], $param['stdDev'], $param);
            $randomData[$name] = max(0.1, $randomValue);
        }
    }

    return $randomData;
}

// Function to generate a random value based on the provided mean and standard deviation
function generateRandomValue($mean, $stdDev, $param)
{
    if ($param['name'] === 'age') {
        $randomValue = $mean + ($stdDev * (mt_rand() / mt_getrandmax() - 0.5) * 2);
        return round(max(0.1, $randomValue));
    } else {
        $randomValue = $mean + ($stdDev * (mt_rand() / mt_getrandmax() - 0.5) * 2);
        return round(max(0.1, $randomValue), 2);
    }
}

// Call the function and store the generated random data
$randomData = generateRandomData();

// Print the generated random data with line break after every 3 data elements

$count = 0;
echo "<div class='message-content'>";
foreach ($randomData as $name => $value) {
    if ($count % 3 == 0 && $count > 0) {
        echo "</div><div class='message-content'>";
    }
    echo "<p style='font-size: 12px;'><strong>&nbsp; $name: </strong> $value, </p>";
    $count++;
}
echo "</div>";




?>