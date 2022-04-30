<?php


$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$dbName = 'thriftlyte';

$dbConn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

if(!$dbConn){
    die('Database Connection Failed: '.mysqli_connect_error());
}