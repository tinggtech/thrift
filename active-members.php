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

$res = mysqli_query($dbConn,"SELECT * FROM users");

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
            <h2>Active Users</h2>
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
                        <th>Email Address</th>
                        <th>Phone Number</th>
                        <th>Cust Id</th>
                        <th>Home Address</th>
                        <th>Date of Birth</th>
                        <th>Marital Status</th>
                        <th>Account Number</th>
                        <th>Bank Name</th>
                        <th>Bvn</th>
                    </tr>
            <?php
                            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                                echo '<tr>
                                <td><div class="img-container">
                                <img src='. "images/". @$row['image'].'>
                                </div></td>
                                    <td><h3><span>'. $row['lastname'] . ' '. $row['firstname'] .'</span></h3></td>
                                    <td><h3><span>'. $row['email'] .'</span></h3></td>
                                    <td><h3><span>'. $row['telephone'] .'</span></h3></td>
                                    <td><h3><span>'. $row['cust_id'] .'</span></h3></td>
                                    <td><h3><span>'. $row['home_address'] .'</span></h3></td>
                                    <td><h3><span>'. $row['dateOfBirth'] .'</span></h3></td>
                                    <td><h3><span>'. $row['maritalStatus'] .'</span></h3></td>
                                    <td><h3><span>'. $row['accountNumber'] .'</span></h3></td>
                                    <td><h3><span>'. $row['bankName'] .'</span></h3></td>
                                    <td><h3><span>'. $row['bvn'] .'</span></h3></td>
                        </tr>'
                        ;}
                                ?></table>
            </div>
            </div>
        </section>
</body>
</html>
<?php ob_end_flush(); ?>