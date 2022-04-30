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
if ( isset($_POST['password-signup']) ) {

    $pass = trim($_POST['pass']);
	$pass = strip_tags($pass);
	$pass = htmlspecialchars($pass);

	$pass2 = trim($_POST['pass2']);
	$pass2 = strip_tags($pass2);
	$pass2 = htmlspecialchars($pass2);

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

    // if there's no error, continue to signup
	if( !$error ) {		
            $profileImageName = 'img.jpg';       
            $query = "UPDATE `users` SET password='$password',image='$profileImageName', created=NOW() WHERE cust_id='$session'";
		    $res = mysqli_query($dbConn,$query) or die(mysqli_error($dbConn)); 
            $not_query = "INSERT INTO `notification`(cust_id, messages) VALUES('$session', 'Thank you for using Thriftlyte')";
		    $not_res = mysqli_query($dbConn,$not_query) or die(mysqli_error($dbConn));  
        }
		
		if ($res && $not_res) {
			header('Location: welcome.php');

		} else {
			$errMSG = "Something went wrong, try again later...";	
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
                    if(isset($passError)){
                        echo @$passError . '<br>';
                     }
                     if(isset($passError2)){
                        echo @$passError2 . '<br>';
                     }
                     ?>
                    
                    <form class="content" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                    <p>Enter Password</p>
                    <input type="password" name='pass' required><br><br>
                    <p>Comfirm Password</p>
                    <input type="password" name='pass2' required><br><br>
                    <div class="btn">
                        <input type="submit" name='password-signup' value="Submit">
                    </div><br><br>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
<?php ob_end_flush(); ?>