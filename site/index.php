<?php 

//get room temp from DB
require "libraries/connectDB.php";
$pdo = connectDB();

$query = "SELECT * FROM temperature_data WHERE date = CURDATE() ORDER BY time DESC LIMIT 1";
$stmt = $pdo->query($query);
$row = $stmt->fetch();

$insideTime = $row['time'];
$insideHumidity = $row['humidity'];
$insideTemp = $row['temperature'];


$ini = parse_ini_file("../../temperature/api.ini");
$currentKey = $ini['openweathercurrent'];

//get current temperature
$currentWeatherApiUrl = 'https://api.openweathermap.org/data/2.5/onecall?lat=44.30&lon=-78.31&exclude=minutely,hourly,daily,alerts&appid=' . $currentKey;
$chCurrent = curl_init($currentWeatherApiUrl);
curl_setopt($chCurrent, CURLOPT_RETURNTRANSFER, True);
$currentData = curl_exec($chCurrent);
curl_close($chCurrent);

//decode JSON and objects within
$currentData = json_decode($currentData);
$currentData = get_object_vars($currentData);
$currentData = get_object_vars($currentData['current']);

$outsideTemp = $currentData['temp'];
$outsideHumidity = $currentData['humidity'];
//convert from kelvin to celcius
$outsideTemp -= 273.15;
$outsideTemp = round($outsideTemp);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raspberry Pi Temperature</title>
</head>
<body>
    <div>
        <p>Time of Data: <?=$insideTime?></p>
    </div>
    <div>
        <p>Room Climate</p>
        <p>Indoor humidity: <?=$insideHumidity?></p>
        <p>Indoor Temperature: <?=$insideTemp?></p>
    </div>
    <div>
        <p>Outer Climate</p>
        <p>Outdoor humidity: <?=$outsideHumidity?></p>
        <p>Outdoor temperature: <?=$outsideTemp?></p>
    </div>
</body>
</html>