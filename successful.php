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
$res=mysqli_query($dbConn,"SELECT * FROM users WHERE cust_id='$session'");
$userRow=mysqli_fetch_array($res);

    $surname = $userRow['surname'];
	$firstname = $userRow['firstname'];
	$lastname = $userRow['lastname'];
    $fullname = $surname. ' ' .$firstname. ' ' .$lastname;

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
        img{
            max-width: 100%;
            height: max-content;
        }
        .success{
            width: 100%;
            height: 100vh;
        }
        .success .container{
            width: 80%;
            margin: auto;
            padding-top: 2rem;
        }
    </style>
</head>
<body>
    <section class="success">
        <img src="./assets/img/success.GIF" alt="">
        <div class="container">
            <h3>It was Successful, <span><?php echo $firstname;  ?></span></h3>
                   <div class="btn">
                        <a href="home.php">Continue</a>
                    </div><br><br>
        </div>
    </section>

</body>
</html>
<?php ob_end_flush(); ?>