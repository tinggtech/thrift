<?php
ob_start();
session_start();
require_once 'php/config.php';

// it will never let you open index(login) page if session is set
if (isset($_SESSION['user'])!="") {
    header("Location: home.php");
    exit;
}
if (isset($_SESSION['admin'])!="") {
    header("Location: admin-home.php");
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
        body{
            background: rgb(152, 18, 206);
        }
    </style>
</head>
<body>
    <section class="signin">
        <div class="container">
            <div class="top index-top" style="border-bottom-left-radius: 150px 150px; border-bottom-right-radius: 150px 20px;">
                <div class="logo index-logo">
                    <img src="./assets/img/logo2.jpg" alt="">
                </div>
            </div>
            <div class="bottom index-banner signin-banner">
                <div class="content">
                    <p>Your First Step <br>
                    to Financial <br>
                    Freedom</p>
                    <div class="btn btn-flex">
                       <a href="./signin.php">Login In</a>
                       <a href="./signup.php">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
<?php ob_end_flush(); ?>