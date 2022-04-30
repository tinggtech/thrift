<?php
session_start();
if(isset($_SESSION['user'])){
    include_once 'config.php';
    $incoming_id = mysqli_real_escape_string($dbConn, $_POST['incoming_id']);
    $outgoing_id = mysqli_real_escape_string($dbConn, $_POST['outgoing_id']);
    $message = mysqli_real_escape_string($dbConn, $_POST['message']);

    if(!empty($message)){
        $sql = mysqli_query($dbConn, "INSERT INTO messages(incoming_msg_id, outgoing_msg_id, message)
        VALUES('$incoming_id', '$outgoing_id', '$message')
        ");
    }
}
