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
$error = false;
if(isset($_SESSION['admin']));
@$res=mysqli_query($dbConn,"SELECT * FROM users WHERE cust_id='$session'");
@$userRow=mysqli_fetch_array($res);

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./assets/css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="./assets/icofont/icofont.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="./assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <title></title>
    <style>
       header{
           width: 80%;
           margin: auto;
           padding-top: 1rem;
       } 
       header a{
           font-size: 2rem;
           color: rgb(152, 18, 206);
       }
       header h2{
           font-size: 1.8rem;
           padding-top: 1rem;
       }
       header p{
           font-size: 1.4rem;
           padding-top: .5rem;
           opacity: .8;
       }
       img{
           width: 30px;
           height: 30px;
           border-radius: 50%;
           box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.3);
       }
       section{
           padding-top: 2rem;
           width: 100%;
           height: 100vh;
       }
       section .container{
           width: 80%;
           margin: auto;
       }
       section .container a{
           display: flex;
           align-items: center;
           gap: 1rem;
           box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.3);
           padding: .5rem 2rem;
           border-radius: 15px;
           margin: 1.5rem 0;
           background: rgb(152, 18, 206);
       }
       section .container a h3{
           font-size: 1rem;
           color: #fff;
       }
       section .container a i{
           color: #fff;
           padding:.5rem;
           font-size: 1.2rem;
       }
    </style>
</head>
<body>
        <header>
            <a href="./admin-home.php"><i class="bi bi-arrow-left"></i></a>
            <h2>My Account</h2>
            <p><?php echo @$userRow['firstname'] . ' '. @$userRow['lastname']; ?></p>        
        </header>
        <section>
            <div class="container">
                <a href="admin-bankDetails.php">
                <i class="icofont-bank"></i>
                    <h3>Bank Details</h3>
                </a>
                <a href="./verifyloan.php">
                <i class="icofont-money"></i>
                    <h3>Verify Loan</h3>
                </a>
                <a href="monthly-savings.php">
                <i class="icofont-save"></i>
                    <h3>Monthly Savings</h3>
                </a>
                <a href="verify-savings.php">
                <i class="icofont-check"></i>
                    <h3>Verify Savings</h3>
                </a>
                <a href="">
                <i class="icofont-print"></i>
                    <h3>Print Result</h3>
                </a>
                <a href="logout.php">
                <i class="icofont-logout"></i>
                    <h3 style='color: red;'>Log out</h3>
                </a>
            </div>
        </section>
    
    
</body>
</html>