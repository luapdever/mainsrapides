<?php
//Connexion a la base de donnees

$connect = new PDO('mysql:host=localhost;dbname=mainsrapides', 'luapdever', 'oklm2022',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

// $connect = new PDO('
//     mysql:host=' . $_ENV['DATABASE_HOST'] . ';dbname=' . $_ENV['DATABASE_NAME'],
//     $_ENV['DATABASE_USERNAME'],
//     $_ENV['DATABASE_PASSWORD'],
//     [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
// );

$connect->exec('SET NAMES utf8');
$GLOBALS["connect"] = $connect;
$GLOBALS["app_url"] = "http://localhost:8000";
$GLOBALS["ftp_url"] = __DIR__."/../mainsrapides";   //A modifier au deploiement

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

require __DIR__.'/init.php';
require __DIR__.'/scripts_php/helpers.php';

?>