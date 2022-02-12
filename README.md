# My Apartment Temperature Project

## Intro
This is one of my first ever side projects. for as long as I can remember I have been interested in Raspberry Pi's. I enjoy building programs to interface between the real and digital worlds; this project is no exception.

## Description
The files located in the pi-files directory are running on a Raspberry Pi Zero with a BME280 sensor in my apartment. This Python code uses the adafruit library to read values from the sensor using the I2C protocol, and inserts that data into a MySQL database running on my webserver.

The site directory contains the HTML/CSS and PHP that runs on the webserver. This PHP code gets the most recent temperature and humidity data from the database, as well as pinging the Open Weather API to get local temperature data.

### Update for Feb 2022
After having to migrate/change the pi manually more than once, I wrote a BASH script to set the pi up in order to start gathering and submitting data.


## Technologies Used
- Python
- PHP
- Linux
- External API
- MySQL
- Pure CSS Framework
- BASH
