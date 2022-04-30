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
    <link rel="stylesheet" href="./assets/icofont/icofont.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="./assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <title></title>
    <style>
        img{
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        
        .notify{
            width: 50px;
            height: 50px;
        }
        .admin-col{
            border-radius: 25px;
        }
        .seeMore{
            text-align: center;
            margin: 1rem 0;
            font-size: 1.1rem;
            box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.4);
            padding: .7rem 1rem;
            border-radius: 25px;
            background-color: rgb(152, 18, 206);
        }
        .seeMore a{
             color: white;
        }
        .menu{
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .menu a{
            font-size: 2rem;
            color: rgb(152, 18, 206);
        }
        .total-savings{
            box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.3);
            border-radius: 0 35px;
            padding: 1rem .5rem .3rem;
            background: var(--primary-color);
            color: white;
            margin-top: 3.5rem;
            margin-bottom: 2rem;
            opacity: .9;
        }
        .home-header h2 span{
            font-size: 1rem;
        }
        .menu a{
            font-size: 1rem;
        }
        .home-header{
            justify-content:space-between;
            gap: 1rem;
            padding: 1.5rem 2rem;
        }
        .search-btn{
            background: var(--primary-color);
            color: #fff;
            padding: .5rem;
            border-radius: 5px;
        }
        .users{
            margin-top: 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .home-header a{
            font-size: 1.4rem;
        }
        .home-header a .back{
            font-size: 1.5rem;
            color: var(--primary-color);
        }
        .users .grid{
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .users .grid h3{
            padding: .2rem 0;
            font-size: 1.05rem;
            color: #333;
        }
        .users .grid p{
            font-size: .8rem;
            opacity: .85;
            color: #333;
        }
        .users span{
            width: 8px;
            height: 8px;
            background: green;
            border-radius: 50%;
        }
        .plus{
            color: green;
        }
    </style>
</head>
<body>
<?php
       if(isset($_SESSION['user']));
       $session = $_SESSION['user'];
       @$res=mysqli_query($dbConn,"SELECT * FROM users WHERE cust_id='$session'");
       @$userRow=mysqli_fetch_array($res);

       @$ress=mysqli_query($dbConn,"SELECT * FROM savings_tbl WHERE cust_id='$session'");
       @$userRows=mysqli_fetch_array($ress);

       @$loan_res=mysqli_query($dbConn,"SELECT * FROM loan_tbl WHERE cust_id='$session'");
       @$loan_userRow=mysqli_fetch_array($loan_res);
    ?>
    <header class='home-header'>
    <a href="./index.php"><i class="bi bi-arrow-left back"></i></a>
        <h2>Chats</h2>
        <div class="right menu">
            <a href="./settings.php"><i class="icofont-settings">
            </i></a>
    </div>
        </a>
    </header>
    <section class="admin-body">
        <div class="container"><br><br><br>
            <!--<div class="search">
            <input class="input" type="text" placeholder='Select a user to start chat'>
            <i class="icofont-search search-btn"></i>
            </div> --> 
            <div class="users-list">
            </div>
        </div>
    </section>
    </section><br><br><br><br><br><br>
    <div class="fixed">
        <div class="container">
            <a href=""><i class="icofont-chat"></i></a>
            <a href="./home.php"><i class="icofont-home"></i></a>
            <a style="position: relative;" href="./notification.php"><i class="icofont-notification"></i><span style="position: absolute; top: -5px; box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.1); background: red; color: white; padding: .15rem; border-radius: 50%; right: -7px; font-size: .8rem;">2</span></a>
        </div>
    </div>

    <script src="./users.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>