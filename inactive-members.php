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

$res = mysqli_query($dbConn,"SELECT * FROM personalinfo_tbl WHERE cust_status='0' or cust_status=''");

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
        .savings{
            margin-top: .5rem;
            width: 100%;
        }
        header a i{
            font-size: 2rem;
            padding: 5rem 3rem;
            color: rgb(152, 18, 206);
        }
        .savings .container h2{
            text-align: center;
            color: rgb(152, 18, 206);
            font-size: 1.6rem;
            padding: 1rem 0 1.5rem ;
        }
        img{
            width: 6rem;
            height: 6rem;
            border-radius: 50%;
            box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.4);
        }
        header a i{
            font-size: 2rem;
            padding: 5rem 3rem;
            color: rgb(152, 18, 206);
        }
        .verifyloan h2{
            text-align: center;
            padding: 1rem 0 2rem;
            color: rgb(152, 18, 206);
            font-size: 1.8rem;
        }
  
    </style>
</head>
<body>
    <section class="signin savings">
        <header>
            <a href="./admin-home.php"><i class="bi bi-arrow-left"></i></a>
        </header>
        <div class="container">
            <h2>Inactive Users</h2>
                            <?php
                            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                                echo '<div class="verifyloan">
                                <form class="container">
                                <div class="img-container">
                                    <img src="./assets/img/notification (12).PNG">
                                </div>
                                <div class="content">
                                    <h3>Full Name: <span>'. $row['cust_lname'] . ' '. $row['cust_fname'] .'</span></h3>
                                    <h3>Cust_id: <span>'. $row['cust_id'] .'</span></h3>
                                    <h3>Phone Number: <span>'. $row['cust_phoneNumber'] .'</span></h3>
                                    <h3>Loan Date: <span>02/04/3647</span></h3>
                                    <h3>Loan Duration: <span>12 Months</span></h3>
                                </div>
                            </form>
                          </div>
                        </div>'
                        ;}
                                ?>
            </div>
        </div>
    </section>
</body>
</html>
<?php ob_end_flush(); ?>