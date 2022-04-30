<?php

while($row = mysqli_fetch_assoc($sql)){
    $output .= '<a href="chat.php?user_id='. $row['cust_id'] .'" class="users">
    <div class="grid">
    <img src="images/'. $row['image'].'">
        <div class="users-grid">
            <h3>'.$row['firstname']. ' ' .$row['lastname'] .'</h3>
            <p>No message available</p>
        </div>
        
    </div>
    <span></span>

</a>';
}