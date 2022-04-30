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
        .bottom .btn{
            text-align: left;
        }
        .uid{
            color: red;
        }
        .btn{
            height: 3rem;
            background: var(--primary-color);
            display: inline-block;
            padding: 1rem 3rem;
            border-radius: 25px;
        }
        .btn a{
            color: var(--white);
        }
    </style>
</head>
<body>
    <?php
        if(isset($_SESSION['user']));
        $session = $_SESSION['user'];
        @$res=mysqli_query($dbConn,"SELECT * FROM users WHERE cust_id='$session'");
	    @$userRow=mysqli_fetch_array($res);
    ?>
    <section class="signin">
        <div class="container">
            <div class="top">
                <div class="logo">
                    <img src="./assets/img/BREU4705.jpg" alt="">
                </div>
            </div>
            <div class="bottom">
                <div class="content">
                    <h2>Hi, <?php echo @$userRow['firstname']; ?></h2><br><br>
                    <p>You have successfully registered with thriftlyte.</p>
                    <p class='uid'>Your UId is <?php echo $_SESSION['user']; ?></p><br>
                    <div class="btn">
                        <a href="./home.php">Continue</a>
                    </div><br><br>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
<?php ob_end_flush(); ?>




