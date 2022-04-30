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
if ( isset($_POST['profile-signup']) ) {

    //for the database
    $profileImageName = time() . '_' . $_FILES['profileImage']['name'];
    //for image upload
    $target_dir = 'images/';
    $target_file = $target_dir.basename($profileImageName);
    //VALIDATION
    if($_FILES['profileImage']['size'] > 100000000000){
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
            $query = "UPDATE `users` SET image='$profileImageName' WHERE cust_id='$session'";
		    $res = mysqli_query($dbConn,$query) or die(mysqli_error($dbConn));   
        }
		if ($res) {
			header('Location: successful.php');
			unset($tel);

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
        input[type=text]{
            background: transparent;
        }
    </style>
</head>
<body>
    <section class="signin">
        <div class="container">
            <div class="top">
            <div class="header">
                    <a href="./index.php"><i class="bi bi-arrow-left"></i></a>
                </div>
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
                     ?>
                    
                    <form class="content" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype='multipart/form-data'>
                    <p>Edit Profile Picture </p>
                    <input type="file" name="profileImage">
                    <div class="btn">
                        <input type="submit" name='profile-signup' value="Continue"><br><br>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
<?php ob_end_flush(); ?>