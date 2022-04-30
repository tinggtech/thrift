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

$res=mysqli_query($dbConn,"SELECT * FROM savings_tbl");

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
            <h2>Active Savings</h2>
        </div>
    </header>
        <section class="admin-main">
            <div class="container">
            <div class="scroll">
            <thead>
                <table>
                    <tr>
                        <th>Picture</th>
                        <th>Full Name</th>
                        <th>Cust Id</th>
                        <th>Cust Savings</th>
                        <th>Savings Date</th>
                        <th>Savings Screenshot</th>
                        <th>Edit</th>
                    </tr>
            <?php
                            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                                echo '<tr>
                                <td><div class="img-container">
                                <img src='. "images/". @$row['profile-pic'].'>
                                </div></td>
                                    <td><h3><span>'. $row['fullname'] .'</span></h3></td>
                                    <td><h3><span>'. $row['cust_id'] .'</span></h3></td>
                                    <td><h3><span>'. $row['cust_savings'] .'</span></h3></td>
                                    <td><h3><span>'. $row['savings_date'] .'</span></h3></td>
                                    <td><img src='. "images/". @$row['savings-screenshot'].'></td>
                                    <td><a href="">Edit</a></td>
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
            <h2>Total Savings</h2>
            <?php
                            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                                echo '<div class="verifyloan">
                                <form class="container">
                                <div class="img-container">
                                <img src='. "images/". @$row['profile_pic'].'>
                                </div>
                                <div class="content">
                                    <h3>Full Name: <span>'. $row['fullname'] .'</span></h3>
                                    <h3>Cust_id: <span>'. $row['cust_id'] .'</span></h3>
                                    <h3>Savings: <span>'. $row['cust_savings'] .'</span></h3>
                                </div>
                            </form>
                          </div>
                        </div>'
                        ;}
                                ?>
                </div>
            </div>
        </div><br><br>
    </section> -->
</body>
</html>
<?php ob_end_flush(); ?>