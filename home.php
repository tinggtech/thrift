<?php
	ob_start();
	session_start();
	require_once 'php/config.php';
	
		// if session is not set this will redirect to login page
        if( !isset($_SESSION['user']) ) {
            header("Location: index.php");
            exit;
        }
        require_once 'php/home.php';
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
    <link href="./assets/font-awesome/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
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
            justify-content: center;
        }
        .menu .img-left{
            margin-right: .5rem;
        }
        .menu a{
            font-size: 2rem;
            color: rgb(152, 18, 206);
        }
        .total-savings{
            box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.3);
            border-radius: 15px;
            padding: 1rem .5rem .3rem;
            background: var(--primary-color);
            color: white;
            margin-top: 3.5rem;
            margin-bottom: 2rem;
            opacity: .9;
        }
    </style>
</head>
<body>
<?php
       if(isset($_SESSION['user']));
       @$res=mysqli_query($dbConn,"SELECT * FROM users WHERE cust_id='$session'");
       @$userRow=mysqli_fetch_array($res);

       @$ress=mysqli_query($dbConn,"SELECT * FROM savings_tbl WHERE cust_id='$session'");
       @$userRows=mysqli_fetch_array($ress);

       @$loan_res=mysqli_query($dbConn,"SELECT * FROM loan_tbl WHERE cust_id='$session'");
       @$loan_userRow=mysqli_fetch_array($loan_res);
    ?>
    <header class='home-header'>
        <h2>Hi, <span><?php echo @$userRow['firstname']; ?></span></h2>
        <div class="right menu">
            <a class='img-left' href="profile.php"><img src="<?php if(@$userRow['image']==''){
                echo 'images/img.jpg';
            } else{echo 'images/'. @$userRow['image'];} ?>"></a>
            <a href="./settings.php"><i class="icofont-settings">
            </i></a>
    </div>
        </a>
    </header>
    <section class="admin-body">
        <div class="container">
            <h2>Transactions</h2>
            <div class="categories">
                <h4>Categories</h4>
                <a href="">Show All</a>
            </div>
            <div class="box">
                <div class="grid">
                    <h3>Savings</h3>
                    <p>N<?php if(@$userRows['cust_savings'] == ''){
                        echo '0';} else{ echo @$userRows['cust_savings'];}
                     ?>.00</p>
                </div>
                <div class="grid">
                    <h3>Last Saves</h3>
                    <p><?php if(@$userRows['savings_date'] == ''){
                        echo 'No saves';} else{ echo @$userRows['savings_date'];}
                     ?></p>
                </div>
                <div class="grid">
                    <h3>Status</h3>
                    <p><?php if(@$loan_userRows['savings_status'] == ''){
                        echo 'INACTIVE';} else{ echo @$userRows['savings_status'];}
                     ?></p>
                </div>
                <div class="grid">
                    <h3>LOAN</h3>
                    <p><?php if(@$loan_userRow['loan_amount'] == ''){
                        echo 'No Loan';} else{ echo 'N'.@$loan_userRow['loan_amount'].'.00';}
                     ?></p>
                </div>
                <div class="grid">
                    <h3>Loan Paid</h3>
                    <p>N<?php if(@$loan_userRow['repay_loan'] == ''){
                        echo '0';} else{ echo @$loan_userRow['repay_loan'];}
                     ?>.00</p>
                </div>
                <?php
                 $loan_remaining = @$loan_userRow['loan_amount'] - @$loan_userRow['repay_loan'];

            ?>
                <div class="grid">
                    <h3>Outstanding</h3>
                    <p><?php if(@$loan_remaining == ''){
                        echo 'No Loan';} else{ echo 'N' .@$loan_remaining . '.00';}
                     ?></p>
                </div>
                <div class="grid">
                    <h3>Duration</h3>
                    <p><?php if(@$loan_userRow['loan_duration'] == ''){
                        echo '0';} else{ echo @$loan_userRow['loan_duration'];}
                     ?> month</p>
                </div>
                <div class="grid">
                    <h3>Collected</h3>
                    <p><?php if(@$loan_userRow['loan_date'] == ''){
                        echo 'No Loan';} else{ echo @$loan_userRow['loan_date'];}
                     ?></p>
                </div>

            </div>

            <div class="choose-category">
                <h3>Choose a Category</h3>
                <div class="flex">
                    <a href="./savings.php">
                        <i class="icofont-dollar"></i>
                        <p>Save</p>
                    </a>
                    <a href="./loan.php">
                        <i class="icofont-bank"></i>
                        <p>Loan</p>
                    </a>
                </div>
            </div>
        </div>
    </section><br><br><br><br><br><br>
    <div class="fixed">
        <div class="container">
            <a href="./users.php"><i class="icofont-chat"></i></a>
            <a href="./home.php"><i class="icofont-home"></i></a>
            <a style="position: relative;" href="./notification.php"><i class="icofont-notification"></i><span style="position: absolute; top: -5px; box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.1); background: red; color: white; padding: .15rem; border-radius: 50%; right: -7px; font-size: .8rem;">2</span></a>
        </div>
    </div>
</body>
</html>
<?php ob_end_flush(); ?>