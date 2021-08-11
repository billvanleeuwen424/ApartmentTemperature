import mysql.connector
import configparser

config = configparser.ConfigParser()
config.read('DBinsert.ini')


def connection():
    return mysql.connector.connect(user=config['mysql']['user'], password=config['mysql']['password'], host=config['mysql']['host'], database=config['mysql']['database'])
    