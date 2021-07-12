<?php 

//connect to DB
require "includes/connectDB.php";
$pdo = connectDB();

$query = "SELECT * FROM temperature_data WHERE date = CURDATE() ORDER BY time DESC LIMIT 1";
$stmt = $pdo->query($query);
$row = $stmt->fetch();

$time = $row['time'];
$humidity = $row['humidity'];
$temp = $row['temperature'];

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
    <p><?=$time?></p>
    <p><?=$humidity?></p>
    <p><?=$temp?></p>
</body>
</html>