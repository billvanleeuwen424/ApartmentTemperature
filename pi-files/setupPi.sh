#! /bin/bash


#Some code taken from https://www.uugear.com/portfolio/a-single-script-to-setup-i2c-on-your-raspberry-pi/
if [ "$(id -u)" != 0 ]; then
  echo 'Must run this script with root privileges'
  exit 1
fi


##############
# ENABLE I2C #
##############
echo '>>> Enable I2C'


#add i2c modules to the kernel loader
if grep -q 'i2c-bcm2708' /etc/modules; then
  echo 'Seems i2c-bcm2708 module already exists, skip this step.'
else
  echo 'i2c-bcm2708' >> /etc/modules
fi
if grep -q 'i2c-dev' /etc/modules; then
  echo 'Seems i2c-dev module already exists, skip this step.'
else
  echo 'i2c-dev' >> /etc/modules
fi

#modify boot files to include i2c
if grep -q 'dtparam=i2c1=on' /boot/config.txt; then
  echo 'Seems i2c1 parameter already set, skip this step.'
else
  echo 'dtparam=i2c1=on' >> /boot/config.txt
fi
if grep -q 'dtparam=i2c_arm=on' /boot/config.txt; then
  echo 'Seems i2c_arm parameter already set, skip this step.'
else
  echo 'dtparam=i2c_arm=on' >> /boot/config.txt
fi

#remove spi and i2c from blacklist
if [ -f /etc/modprobe.d/raspi-blacklist.conf ]; then
  sed -i 's/^blacklist spi-bcm2708/#blacklist spi-bcm2708/' /etc/modprobe.d/raspi-blacklist.conf
  sed -i 's/^blacklist i2c-bcm2708/#blacklist i2c-bcm2708/' /etc/modprobe.d/raspi-blacklist.conf
else
  echo 'File raspi-blacklist.conf does not exist, skip this step.'
fi




########################
# Install pip packages #
########################

apt install -y python3-pip

pip install adafruit-blinka pytz mysql-connector adafruit-circuitpython-bme280

#match the first number after Python
pythonVersion=$(python -V | grep -Po '(?<=Python )(.)')

if [[ $pythonVersion -eq 3 ]]
then 
    echo "python3"
fi