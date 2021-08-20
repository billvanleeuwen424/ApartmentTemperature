<?php

//returns an array of data from indoors.
//currently returns temp, humidity 2021-08-19
function currentIndoor(){
    //get room temp from DB
    require "connectDB.php";
    $pdo = connectDB();

    $query = "SELECT * FROM temperature_data WHERE date = CURDATE() ORDER BY time DESC LIMIT 1";
    $stmt = $pdo->query($query);
    $row = $stmt->fetch();

    $insideTime = $row['time'];
    $insideHumidity = $row['humidity'];
    $insideTemp = $row['temperature'];

    //assign the data to the return array
    $insideData = array();
    $insideData[0] = $insideTemp;
    $insideData[1] = $insideHumidity;

    return $insideData;
}

//returns an array of data from outdoors.
//currently returns temp, humidity 2021-08-19
function currentOutdoor(){
    //get the api key
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

    //assign the data to the return array
    $outsideData = array();
    $outsideData[0] = $outsideTemp;
    $outsideData[1] = $outsideHumidity;

    return $outsideData;
}
?>