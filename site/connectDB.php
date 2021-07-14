<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);




function connectDB(){
    
    $config = parse_ini_file("../config.ini");

    $dsn = "mysql:host=$config[host];dbname=$config[database];charset=utf8mb4";

    try {
        $pdo = new PDO($dsn, $config['user'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    } 
    catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }


    return $pdo;
}
?>