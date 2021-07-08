#a script that uses the bme 280 sensor to gather values

#most of these are adafruit circuit python
import board
import digitalio
import busio
import adafruit_bme280
from adafruit_bme280 import basic

from datetime import datetime, timezone
import time
import pytz

import connectDB


#this is a library object using adafruits bus i2c port
i2c = busio.I2C(board.SCL, board.SDA)
bme280 = basic.Adafruit_BME280_I2C(i2c, address=0x76) 

#calls function in the connectDB module
mydb = connectDB.connection()
mycursor = mydb.cursor()
query = "INSERT INTO `temperature_data` (temperature, humidity, date, time) VALUES (%s,%s,%s,%s)"

#get temp and humidity from sensor
temperature = round(bme280.temperature, 1)
humidity = round(bme280.relative_humidity, 1)

#get time 
timezone = pytz.timezone("America/Toronto")
currenttime = datetime.now(timezone)
pitime = currenttime.strftime("%H:%M:00")
pidate = currenttime.strftime("%Y-%m-%d") 

#insert values into table
values = (temperature, humidity, pidate, pitime)
mycursor.execute(query, values)
mydb.commit()

#debug printing
print("\nTemperature: ", temperature)
print("Humidity: ", humidity)
print("Pressure: %0.1f hpa" % bme280.pressure)
print("Time: %s" % currenttime)


mydb.close()