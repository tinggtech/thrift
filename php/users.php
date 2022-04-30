<?php
	session_start();
	include "config.php";
$output = '';
$session = $_SESSION['user'];
$sql = mysqli_query($dbConn, "SELECT * FROM users WHERE NOT cust_id='$session'");
if(mysqli_num_rows($sql) == 1){
    $output .= 'No user is available for chat';
} elseif(mysqli_num_rows($sql) > 0){
    require "data.php";
}
echo $output;
?> 