<?php
	ob_start();
	session_start();
    require_once 'php/config.php';

	// if session is not set this will redirect to login page
    if( !isset($_SESSION['user']) ) {
        header("Location: index.php");
        exit;
    }
?>

<?php

$error = false;
$session = $_SESSION['user'];
if ( isset($_POST['email-signup']) ) {
    $email = trim($_POST['email']);
	$email = strip_tags($email);
	$email = htmlspecialchars($email);

    //basic email validation
	if (empty($email)) {
		$error = true;
	} else {
		// check email exist or not
		$query = "SELECT * FROM `users` WHERE email='$email'";
		$result = mysqli_query($dbConn,$query);
		$count = mysqli_num_rows($result);
		if($count > 0){
			$error = true;
			$emailError = "email already exists.";
		}
	}

    // if there's no error, continue to signup
	if( !$error ) {		
		$query = "UPDATE `users` SET email='$email' WHERE cust_id='$session'";
		$res = mysqli_query($dbConn,$query) or die(mysqli_error($dbConn));
		
		if ($res) {
			header('Location: password.php');
			unset($email);

		} else {
			$errMSG = "Something went wrong, try again later...";	
		}	
			
	}
	
}	

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./assets/css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="./assets/font-awesome/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <title></title>
    <style>
        form p{
            color: black;
        }
    </style>
</head>
<body>
    <section class="signin">
        <div class="container">
            <div class="top">
                <div class="logo">
                    <img src="./assets/img/BREU4705.jpg" alt="">
                </div>
            </div>
            <div class="bottom">
                <div class="content">
                <div class="error">
                    <?php
                    if(isset($errMSG)){
                       echo @$errMSG;
                    }
                    if(isset($emailError)){
                        echo @$emailError . '<br>';
                     }
                     ?>
                    
                    <form class="content" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                    <p>Enter Email Address </p>
                    <input type="email" name='email' value="<?php echo @$email; ?>" required>
                    <div class="btn">
                        <button type="submit" name='email-signup'>Continue</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
<?php ob_end_flush(); ?>