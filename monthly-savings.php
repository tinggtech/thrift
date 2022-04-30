<?php
	ob_start();
	session_start();
    require_once 'php/config.php';

	// if session is not set this will redirect to login page
    if( !isset($_SESSION['admin']) ) {
        header("Location: index.php");
        exit;
    }
?>

<?php

$error = false;
$session = $_SESSION['admin'];
if ( isset($_POST['savings-signup']) ) {
    $savings = trim($_POST['savings']);
	$savings = strip_tags($savings);
	$savings = htmlspecialchars($savings);


    if (empty($savings)){
		$error = true;
	} 

    // if there's no error, continue to signup
	if( !$error ) {		
		$query = "UPDATE `thriftlyte_admin` SET savings='$savings'  WHERE cust_id='$session'";
		$res = mysqli_query($dbConn,$query) or die(mysqli_error($dbConn));
		
		if ($res) {
			header('Location: successful.php');
			unset($savings);
            unset($savings2);

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
        h2{
            color:rgba(0,0,0,.8);
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
                    if(isset($savingsError)){
                        echo @$savingsError . '<br>';
                     }
                     ?>
                    
                    <form class="content" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                    <h2>Monthly Payment</h2><br>
                    <p>Enter an Amount that each user should pay this month</p>
                    <input type="tel" name='savings' required><br><br>
                    <div class="btn">
                        <input type="submit" name='savings-signup' value="Continue">
                    </div><br><br>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
<?php ob_end_flush(); ?>