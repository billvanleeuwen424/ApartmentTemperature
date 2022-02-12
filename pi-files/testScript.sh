#! /bin/bash

#match the first number after Python
pythonVersion=$(python -V | grep -Po '(?<=Python )(.)')

echo $pythonVersion


if [[ $pythonVersion -eq 3 ]]
then 
echo "python3"
fi