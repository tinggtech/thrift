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
$output = ' ';

$user_id = mysqli_real_escape_string($dbConn, $_GET['cust_id']);
$res = mysqli_query($dbConn,"SELECT * FROM loan_tbl WHERE cust_id='$user_id' and lg_status='1'");
$userRow=mysqli_fetch_array($res);

    $fullname = $userRow['fullname'];
	$loan_amount = $userRow['loan_amount'];
	$loan_date = $userRow['loan_date'];
    $loan_duration = $userRow['loan_duration'];
    $guarantor_id = $userRow['guarantor_id'];
    $screenshot = $userRow['loan_screenshot'];
    $nok = $userRow['nok'];
    $bvn = $userRow['bvn'];


    if ( isset($_POST['approve-btn']) ) {
        $query = "UPDATE loan_tbl SET loan_approval='1' WHERE cust_id='$user_id'";
		$ress = mysqli_query($dbConn,$query) or die(mysqli_error($dbConn));

		if ($ress) {
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
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="./assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Loan</title>
    <style>
        input[type=text]{
            background: white;
            border-bottom: 2px solid rgba(0,0,0,.2);
            color: black;
        }
        .bottom h2{
            padding: 3rem 2.5rem 1rem;
            color: rgb(152, 18, 206);
        }
        .bottom h3{
            margin:  .7rem 0;
            font-size: 1.1rem;
            box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.3);
            padding: .8rem 1rem;
            border-radius: 10px;
        }
        .bottom span{
            font-size: 1rem;
            margin:  1rem;
            opacity:  .8;
        }
        form{
            padding-top: 2.5rem;
        } 
        .savings{
            margin-top: .5rem;
        }
        .container{
            width: 90%;
            position: relative;
            margin: auto;
            display: flex;
            flex-direction: column;
            height: 50vh;
        }
        header{
            display: flex;
            justify-content: space-between;
            width: 80%;
            margin: auto;
            padding-top: 1rem;
        }
        header a{
            color: rgb(152, 18, 206);
        }
        header a i{
            font-size: 2rem;
            color: rgb(152, 18, 206);
        }
        .btn a{
            margin-top: 1rem;
            display: inline-block;
            box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.4);
            background: rgb(152, 18, 206);
            color: white;
            padding: .9rem 2.5rem;
            border-radius: 20px;
        }
        .profile-pic{
            width: 40%;
            height: 100%;
        }
        .profile-pic img{
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 10px;
        }
        .bottom{
            padding-top: 2rem;
            width: 90%;
            margin: auto;
        }
        .bottom img{
            width: 100%;
            height: max-content;
            margin-top: 1rem;
        }
        .img-cont{
            text-align: center;
        }
        .bottom h4{
            text-align: center;
            padding-top: 1rem;
            font-size: 1.4rem;
        }

    </style>
</head>
<body>
<section class="signin savings">
        <header>
            <a href="./verifyloan.php"><i class="bi bi-arrow-left"></i></a>
        </header>

        <div class="container">
            <div class="profile-form">
                <div class="profile-pic">
                    <form class="contain">
                        <img src="<?php echo 'images/'. @$userRow['passport']; ?>" onclick="triggerClick()" id="profileDisplay"> <div class="profile-name">
                            <input type="file" name="profileImage" onchange="displayImage(this)" id="profileImage" style="display:  none;">    
                        <input type="submit" name="pic-btn" style="color: rgb(152, 18, 206); box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.3); background-color: white; padding: .7rem 2rem; border-radius: 25px; cursor: pointer;" value="Upload Image"/>       
                        </form>
        </div>
                   </div>
                </div>
        </div>
    </section>
    <form class="contain" method="POST" action="verifyloanview.php" enctype='multipart/form-data'>
    <div class="bottom">
        <h2>Verify Loan</h2>
            <!--<h3>Cust_id: <span><?php echo $cust_id; ?></span> </h3>-->
            <h3>Full Name: <?php echo $fullname;  ?></h3>
            <h3>Loan Amount: <span><?php echo $loan_amount;  ?></span></h3>
            <h3>Loan Date: <span><?php echo $loan_date;  ?></span></h3>
            <h3>Loan Duration: <span><?php echo $loan_duration;  ?> months</span></h3>
            <h3>Guarantor Id: <span><?php echo $guarantor_id;  ?></span></h3>
            <h3>Next of Kin: <span><?php echo $nok;  ?></span></h3>
            <h3>Bvn: <span><?php echo $bvn;  ?></span></h3>
            <h4><p>Verification Form</h4>
            <div class="img-cont">
            <img src="<?php echo 'images/'. @$screenshot; ?>">
            </div>
            <div class="btn">
                <input type="submit" name="approve-btn" value="Approve">
            </div><br><br>
    </div>
    </form>
</body>
</html>
<?php ob_end_flush(); ?>