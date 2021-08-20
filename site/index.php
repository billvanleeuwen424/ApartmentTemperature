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
    <!--pure.css-->
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.6/build/pure-min.css" integrity="sha384-Uu6IeWbM+gzNVXJcM9XV3SohHtmWE+3VGi496jvgX1jyvDTXfdK+rfZc8C1Aehk5" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.6/build/grids-responsive-min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--My stylesheet-->
    <link rel="stylesheet" href="styles/master.css"/>
    <title>Raspberry Pi Temperature</title>
</head>
<body>
    <main>
        <div class="gridCont">
            <div class="pure-g">
                <div class="pure-u-1">
                    <p>Time of Data: <?=$insideTime?></p>
                </div>
            </div>
            <div class="pure-g">
                <div class="pure-u-1 pure-u-md-1-2">
                    <div class="l-box">
                        <p>Room Climate</p>
                        <div class='pure-g'>
                            <div class='pure-u-2'>
                                <div class="pure-g">
                                    <div class="pure-u-2"><span class='unitText'>Temperature: </span></div>
                                    <div class="pure-u-2">
                                        <span class='temp'><?=$insideTemp?></span>
                                        <span class='units'>°C</span>
                                    </div>
                                </div>
                            </div>
                            <div class='pure-u-2'>
                                <div class="pure-g">
                                    <div class="pure-u-2"><span class='unitText'>Humidity: </span></div>
                                    <div class="pure-u-2">
                                        <span class='hum'><?=$insideHumidity?></span>
                                        <span class='units'>%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pure-u-1 pure-u-md-1-2">
                    <div class="l-box">
                        <p>Outer Climate</p>
                        <div class="pure-g">
                            <div class='pure-u-2'>
                                <div class="pure-g">
                                    <div class="pure-u-2"><span class='unitText'>Temperature: </span></div>
                                    <div class="pure-u-2">
                                        <span class='temp'><?=$outsideTemp?></span>
                                        <span class='units'>°C</span>
                                    </div>
                                </div>
                            </div>
                            <div class='pure-u-2'>
                                <div class="pure-g">
                                    <div class="pure-u-2"><span class='unitText'>Humidity: </span></div>
                                    <div class="pure-u-2">
                                        <span class='hum'><?=$outsideHumidity?></span>
                                        <span class='units'>%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>