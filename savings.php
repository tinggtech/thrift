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
$session = $_SESSION['user'];

$res=mysqli_query($dbConn,"SELECT * FROM users WHERE cust_id='OCM/2022/1305'");
$userRow=mysqli_fetch_array($res);

    $surname = $userRow['surname'];
	$firstname = $userRow['firstname'];
	$lastname = $userRow['lastname'];
    $fullname = $surname .' '. $firstname .' '. $lastname;
    $account_number = $userRow['accountNumber'];
    $bank_name = $userRow['bankName'];

?>
<?php
$ress=mysqli_query($dbConn,"SELECT * FROM thriftlyte_admin WHERE cust_id='OCM/2022/1305'");
$userRows=mysqli_fetch_array($ress);

$savings = $userRows['savings'];

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
            padding: 3rem 0;
            text-align: center;
        }
        form{
            margin-top: 6rem;
        } 
        .btn{
            padding-top: 2rem;
        }
        .btn a{
            color: #fff;
            box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.3);
            background: rgb(152, 18, 206);
            padding: .9rem 2.5rem;
            border-radius: 25px;
            font-size: .9rem;
        }
        header a{
			font-size: 2rem;
			margin-left: 2rem;
			color: rgb(152, 18, 206);
		}
        h2{
            font-size: 1.7rem;
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <section class="signin savings">
    <header><br><br>
        <a href="./home.php"><i class="bi bi-arrow-left"></i></a>
        </header>
        <div class="container">
            <div class="bottom">
				<h2>Monthly Savings</h2>
                <form class="content" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                    <p>Account Name: <span><?php echo $fullname;  ?></span></p>
                    <p>Account Number: <span><?php echo $account_number;  ?></span> </p>
                    <p>Bank Name: <span><?php echo $bank_name; ?></span></p>
                    <p>Savings: <span><?php echo $savings; ?></span></p>
                    <div class="btn">
                        <a href="./make-payment.php">Make Payment</a>
                    </div><br><br>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
<?php ob_end_flush(); ?>