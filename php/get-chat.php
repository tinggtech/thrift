<?php
session_start();

if(isset($_SESSION['user'])){
    include_once 'config.php';
    $incoming_id = mysqli_real_escape_string($dbConn, $_POST['incoming_id']);
    $outgoing_id = mysqli_real_escape_string($dbConn, $_POST['outgoing_id']);
    $message = mysqli_real_escape_string($dbConn, $_POST['message']);
    $output = '';
$sql = "SELECT * FROM messages WHERE (outgoing_msg_id = '$outgoing_id' AND incoming_msg_id = '$incoming_id') OR (outgoing_msg_id = '$incoming_id' AND incoming_msg_id = '$outgoing_id') ORDER BY msg_id";
$query = mysqli_query($dbConn, $sql);
if(mysqli_num_rows($query) > 0){
    while($row = mysqli_fetch_assoc($query)){
        if($row['outgoing_msg_id'] === $outgoing_id){
            $output .= '<div class="chat outgoing">
            <div class="details">
                <p>'. $row['message'] .'</p>
            </div>
        </div>';
        } else{
            $output .= '<div class="chat incoming">
            <img src="./assets/img/user3.PNG">
            <div class="details">
                <p>'. $row['message'] .'</p>
            </div>
        </div>';
        }
    }
}
echo $output;
}