<?php

$error = false;
$playernumber = '';
if ( isset($_POST['btn-signup']) ) {
	
	// clean user inputs to prevent sql injections
	$firstname = trim($_POST['firstname']);
	$firstname = strip_tags($firstname);
	$firstname = htmlspecialchars($firstname);

	$lastname = trim($_POST['lastname']);
	$lastname = strip_tags($lastname);
	$lastname = htmlspecialchars($lastname);
	
	$surname = trim($_POST['surname']);
	$surname = strip_tags($surname);
	$surname = htmlspecialchars($surname);
	
	/*$tel = trim($_POST['tel']);
	$tel = strip_tags($tel);
	$tel = htmlspecialchars($tel);

	$pass = trim($_POST['pass']);
	$pass = strip_tags($pass);
	$pass = htmlspecialchars($pass);

	$pass2 = trim($_POST['pass2']);
	$pass2 = strip_tags($pass2);
	$pass2 = htmlspecialchars($pass2);
*/

// The length we want the unique reference number to be  
$unique_ref_length = 4;  
  
// A true/false variable that lets us know if we've  
// found a unique reference number or not  
$unique_ref_found = false;  
  
// Define possible characters.  
// Notice how characters that may be confused such  
// as the letter 'O' and the number zero don't exist  
$possible_chars = "0123456789";  
  
// Until we find a unique reference, keep generating new ones  
while (!$unique_ref_found) {  
  
    // Start with a blank reference number  
    $unique_ref = "";  
      
    // Set up a counter to keep track of how many characters have   
    // currently been added  
    $i = 0;  
      
    // Add random characters from $possible_chars to $unique_ref   
    // until $unique_ref_length is reached  
    while ($i < $unique_ref_length) {  
      
        // Pick a random character from the $possible_chars list  
        $char = substr($possible_chars, mt_rand(0, strlen($possible_chars)-1), 1);  
          
        $unique_ref .= $char;  
          
        $i++;    
    } 
	$year = date('Y');
	$playernumber = 'OCM/'. $year .'/'.$unique_ref;
	$query = mysqli_query($dbConn, "SELECT * FROM `users` 
              WHERE `cust_id`='$playernumber'");  
    $result = @mysqli_query($query);  
    if (@mysqli_num_rows($result)==0) {
	// Our new unique reference number is generated.  
    // Lets check if it exists or not 
    $unique_ref_found = true;     
      
	}
	// basic firstname validation
	if (empty($firstname)) {
		$error = true;
	} else if (strlen($firstname) < 2) {
		$error = true;
		$firstNameError = "firstname must have more than 2 Characters.";
	} 

	// basic name validation
	if (empty($lastname)) {
		$error = true;
	} else if (strlen($lastname) < 2) {
		$error = true;
		$lastNameError = "lastname must have more than 2 Characters.";
	}
	
	//basic surname validation
	if (empty($surname)) {
		$error = true;
	} else if (strlen($surname) < 2) {
		$error = true;
		$surNameError = "surname must have more than 2 Characters.";
	}

	//basic telephone validation
	/*if (empty($tel)) {
		$error = true;
	}else if(strlen($tel) < 10) {
			$error = true;
			$telError = "telephone number must have 11 characters.";
		} else {
		// check surname exist or not
		$query = "SELECT * FROM personalinfo_tbl WHERE cust_phoneNumber='$tel' ";
		$result = mysqli_query($dbConn,$query);
		$count = mysqli_num_rows($result);
		if($count > 0){
			$error = true;
			$surnameError = "telephone number already exists.";
		}
	}
	
	// password validation
	if (empty($pass)){
		$error = true;
		$passError = "Please enter password.";
	} else if(strlen($pass) < 6) {
		$error = true;
		$passError = "Password must have atleast 6 characters.";
	}
	
	if (empty($pass2)){
		$error = true;
	} else if ($pass !== $pass2){
		$error = true;
		$passError2 = "Password does not match.";
	}
	
	// password encrypt using SHA256();
	$password = hash('sha256', $pass2);
*/
	
	// if there's no error, continue to signup
	if( !$error ) {		
		$query = "INSERT INTO `users`(user_id,cust_id,surname,firstname,lastname) VALUES('','$playernumber','$surname', '$firstname','$lastname')";
		$res = mysqli_query($dbConn,$query) or die(mysqli_error($dbConn));
		
		if ($res) {
			$_SESSION['user'] = $playernumber;
			header('Location: email.php');
		} else {
			$errMSG = "Something went wrong, try again later...";	
		}	
			
	}
	
}	
}