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
$session = $_SESSION['admin'];

$res=mysqli_query($dbConn,"SELECT * FROM users WHERE cust_id='$session'");
$userRow=mysqli_fetch_array($res);

	$cust_fname = $userRow['firstname'];
	$cust_lname = $userRow['lastname'];
    $cust_accNumber = $userRow['accountNumber'];
    $cust_bankName = $userRow['bankName'];
    $cust_bvn = $userRow['bvn'];
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
    <link rel="stylesheet" href="./assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <title></title>
    <style>
        input[type=text]{
            background: white;
            border-bottom: 2px solid rgba(0,0,0,.2);
            color: black;
        }
        .bottom h2{
            padding: 3rem 2.5rem;
            color: rgb(152, 18, 206);
        }
        .bottom h3{
            margin:  .7rem 0;
            font-size: 1.1rem;
            box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.3);
            padding:  .8rem 2rem;
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
            margin-top: .1rem;
        }
        .savings .container{
            width: 90%;
            margin: auto;
        }
        header a i{
            font-size: 2rem;
            padding: 5rem 3rem;
            color: rgb(152, 18, 206);
        }
    </style>
</head>
<body>
    <section class="signin savings">
        <header>
            <a href="./admin-settings.php"><i class="bi bi-arrow-left"></i></a>
        </header>
        <div class="container">
            <div class="bottom">
				<h2>Bank Details</h2>
                <form class="content" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                    <h3>Cust_id: <span><?php if(isset($_SESSION['admin'])); echo $session; ?></span> </h3>
                    <h3>Full Name: <?php echo $cust_fname . ' '. $cust_lname;  ?></h3>
                    <h3>Account Number: <span><?php echo $cust_accNumber;  ?></span></h3>
                    <h3>Bank Name: <span><?php echo $cust_bankName;  ?></span></h3>
                    <h3>Bvn: <span><?php echo $cust_bvn;  ?></span></h3>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
<?php ob_end_flush(); ?>