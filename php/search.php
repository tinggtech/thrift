<?php
include_once "config.php";
$searchTerm = mysqli_real_escape_string($dbConn, $_POST['searchTerm']);
$output = '';
$sql = mysqli_query($dbConn, "SELECT * FROM users WHERE firstname LIKE '%{$searchTerm}%' OR lastname LIKE '%{$searchTerm}%'");

if(mysqli_num_rows($sql) > 0){
    include 'data.php';
} else{
    $output .= "NO user found related to your search term";
}
echo $output;