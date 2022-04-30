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

$res = mysqli_query($dbConn,"SELECT * FROM loan_tbl WHERE loan_complete = '0'");

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
        header a i{
            font-size: 2rem;
            padding: 5rem 3rem;
            color: rgb(152, 18, 206);
        }
        img{
            width: 6rem;
            height: 6rem;
            border-radius: 50%;
            box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.4);
        }

  
    </style>
</head>
<body>
<header class='admin-header'>
        <div class="container">
            <a href="./admin-home.php"><i class="bi bi-arrow-left"></i></a>
            <h2>Active Loans</h2>
        </div>
    </header>
        <section class="admin-main">
            <div class="container">
            <div class="scroll">
            <thead>
                <table>
                    <tr>
                        <th>Picture</th>
                        <th>Loan Id</th>
                        <th>Full Name</th>
                        <th>Loan Amount</th>
                        <th>Loan Paid</th>
                        <th>Loan Duration</th>
                        <th>Gurantor Id</th>
                        <th>Verification Form</th>
                        <th>Next of Kin</th>
                        <th>Loan Date</th>
                    </tr>
            <?php
                            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                                echo '<tr>
                                <td><div class="img-container">
                                <img src='. "images/". @$row['passport'].'>
                                </div></td>
                                    <td><h3><span>'. $row['cust_id'] .'</span></h3></td>
                                    <td><h3><span>'. $row['fullname'] .'</span></h3></td>
                                    <td><h3><span>'. $row['loan_amount'] .'</span></h3></td>
                                    <td><h3><span>'. $row['repay_loan'] .'</span></h3></td>
                                    <td><h3><span>'. $row['loan_duration'] .'</span></h3></td>
                                    <td><h3><span>'. $row['guarantor_id'] .'</span></h3></td>
                                    <td><img src='. "images/". @$row['verification_form'].'></td>
                                    <td><h3><span>'. $row['nok'] .'</span></h3></td>
                                    <td><h3><span>'. $row['loan_date'] .'</span></h3></td>
                        </tr>'
                        ;}
                                ?></table>
            </div>
            </div>
        </section>






    <!--<section class="signin savings">
        <header>
            <a href="./admin-home.php"><i class="bi bi-arrow-left"></i></a>
        </header>
        <div class="container">
            <h3>Active Loans</h3>
            <?php
                            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                                echo '<div class="verifyloan">
                                <form class="container">
                                <div class="img-container">
                                <img src='. "images/". @$row['passport'].'>
                                </div>
                                <div class="content">
                                    <h3>Full Name: <span>'. $row['fullname'] .'</span></h3>
                                    <h3>Cust_id: <span>'. $row['cust_id'] .'</span></h3>
                                </div>
                            </form>
                          </div>
                        </div>'
                        ;}
                                ?>
                </div>
            </div>
        </div>
    </section> -->
</body>
</html>
<?php ob_end_flush(); ?>