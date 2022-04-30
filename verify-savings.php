<?php
session_start();
	require_once 'php/config.php';
	
		// if session is not set this will redirect to login page
        if( !isset($_SESSION['admin']) ) {
            header("Location: index.php");
            exit;
        }
?>
<?php

$session = $_SESSION['admin'];
if ( isset($_POST['approve']) ) {
		
		$query = "UPDATE `savings_tbl` SET password='$password' WHERE cust_id='$session'";
		$res = mysqli_query($dbConn,$query) or die(mysqli_error($dbConn));
		
		if ($res) {
			header('Location: welcome.php');
			unset($pass);
            unset($pass2);

		} else {
			$errMSG = "Something went wrong, try again later...";	
		}	
			
    }

?>
<?php
$output = ' ';

$res = mysqli_query($dbConn,"SELECT * FROM savings_tbl WHERE savings_status='not paid'");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="./assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Loan</title>
    <style>
        img{
            width: 15rem;
            height: 10rem;
            border-radius: 15px;
            box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.4);
        }
        header a i{
            font-size: 2rem;
            padding: 5rem 3rem;
            color: rgb(152, 18, 206);
        }
        .verifyloan h2{
            text-align: center;
            padding: 1rem 0 1rem;
            color: rgb(152, 18, 206);
            font-size: 1.6rem;
        }
        .btn input{
            font-size: .9 rem;
        }
    </style>
</head>
<body>
    <div class="verifyloan">
    <header>
            <a href="./admin-settings.php"><i class="bi bi-arrow-left"></i></a>
        </header>
        <h2>Verify Savings</h2>
        <?php
    while ($row = mysqli_fetch_array($res)) {
        $img = "images/".$row['savings_screenshot'];
        $output .= '<div class="verifyloan">
        <form class="container">
        <div class="img-container">
        <img src='. $img .'>
        </div>
        <div class="content">
            <h3>Name: <span>'. $row['fullname'] .'</span></h3>
            <h3>Cust_Savings: <span>'. $row['cust_savings'] .'</span></h3>
            <h3>Date: <span>'. $row['savings_date'] .'</span></h3>
        </div>
        <div class="btn">
            <input type="submit" value="approve" name="approve">
            <input type="submit" value="not approved" name="notApproved">
        </div>
    </form>
  </div>
</div>'
;}
    ?>
        
    <?php  echo $output; ?>
</body>
</html>
<?php ob_end_flush(); ?>