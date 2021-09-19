<?php 
require "libraries/getData.php";
$insideData = currentIndoor();
$outsideData = currentOutdoor();

//get temps from data arrays
$insideTemp = $insideData[0];
$outsideTemp = $outsideData[0];

//get humidity from data arrays
$insideHumidity = $insideData[1];
$outsideHumidity = $outsideData[1];
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
    <header>
        <h1>My Room vs Outdoor Temperature</h1>
        <h3>A Project by Bill Van Leeuwen</h3>
    </header>
    <main>
        <div class="gridCont">
            <div class="pure-g">
                <div class="pure-u-1 pure-u-md-1-2">
                    <div class="l-box">
                        <span class="boxTitle">Room Climate (Raspberry Pi)</span>
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
                        <span class="boxTitle">Outdoor Climate (API)</span>
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
            <div class="pure-g">
                <div class="l-box">
                    <div class="googleMap">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d81382.31549935584!2d-78.34904935233745!3d44.317301941907786!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sca!4v1629498728316!5m2!1sen!2sca" style="border:0;" frameborder=0></iframe>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>