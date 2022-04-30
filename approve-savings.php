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
/*
$error = false;
$session = $_SESSION['user'];
if ( isset($_POST['profile-signup']) ) {
    $tel = trim($_POST['tel']);
	$tel = strip_tags($tel);
	$tel = htmlspecialchars($tel);

    //basic tel validation
	if (empty($tel)) {
		$error = true;
	}    
    //for the database
    $profileImageName = time() . '_' . $_FILES['profileImage']['name'];
    //for image upload
    $target_dir = 'images/';
    $target_file = $target_dir.basename($profileImageName);
    //VALIDATION
    if($_FILES['profileImage']['size'] > 1000000){
        $msg = "Image size should not be greater than 1.00mb";
        $msg_class = 'red';
        $error = true;
    }
    //check if file exists
    if(file_exists($target_file)){
        $msg = "File already exists";
        $error = true;
    }
    // if there's no error, continue to signup
	if( !$error ) {		
        if(move_uploaded_file($_FILES['profileImage']['tmp_name'], $target_file)){
            $query = "INSERT INTO  image='$profileImageName'";
		    $res = mysqli_query($dbConn,$query) or die(mysqli_error($dbConn));   
        }
		if ($res) {
			header('Location: bankDetails-signup.php');
			unset($tel);

		} else {
			$errMSG = "Something went wrong, try again later...";	
		}	
			
	}
	
}	
*/
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
        input[type=text]{
            background: transparent;
        }
        .btn{
            margin-top: 1rem;
            box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.4);
            padding: .7rem 2rem;
            background: rgb(152, 18, 206);
            border-radius: 15px;
        }
        .btn a{
            color: #fff;
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
                    if(isset($telError)){
                        echo @$telError . '<br>';
                     }
                     ?>
                    
                    <form class="content" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype='multipart/form-data'>
                    <p>The payment will be approved by the Admin, check your notification box for approval.</p>
                    <div class="btn">
                        <a href="home.php">Continue</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
<?php ob_end_flush(); ?>