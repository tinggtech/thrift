<?php
	ob_start();
	session_start();
	require_once 'php/config.php';
	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['admin']) ) {
		header("Location: index.php");
		exit;
	}
    $session = $_SESSION['admin'];
	// select loggedin users detail
	$res=mysqli_query($dbConn,"SELECT * FROM users WHERE cust_id='$session'");
	$userRow=mysqli_fetch_array($res);
	$cust_fname = $userRow['firstname'];
	$cust_lname = $userRow['lastname'];


$passave = mysqli_query($dbConn,"SELECT * FROM savings_tbl");

while ($activerow=mysqli_fetch_array($passave)){ 
$savings_counter=$activerow['cust_savings'];
@$cust_savings=@$cust_savings + $savings_counter;
}

$activeloan = mysqli_query($dbConn,"SELECT * FROM loan_tbl");
while ($activeloanrow=mysqli_fetch_array($activeloan)){
@$loan_active = @$loan_active + 1;
}
/*
	@$pass=@mysqli_query($dbConn,"SELECT * FROM personalinfo_tbl WHERE AppNumber='$session'");
	@$userPass=@mysqli_fetch_array($pass);

	$pass=mysqli_query($dbConn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$session'");
	$userPass=mysqli_fetch_array($pass);

    $report1=mysqli_query($dbConn,"SELECT * FROM loanrequest_tbl WHERE report='0'");

	$report2=mysqli_query($dbConn,"SELECT * FROM savingamount_tbl WHERE report='0'");


	$msg1=mysqli_query($dbConn,"SELECT * FROM loanrequest_tbl WHERE msg='0'");

	$msg2=mysqli_query($dbConn,"SELECT * FROM savingamount_tbl WHERE msg='0'");

if ((mysqli_num_rows($report1) > 0) or (mysqli_num_rows($report2) > 0)){$rep="rep1.jpg";} else {$rep="rep.jpg";}

if ((mysqli_num_rows($msg1) > 0) or (mysqli_num_rows($msg2) > 0)){$msg="msg1.jpg";} else {$msg="msg.jpg";}

$activeloan = mysqli_query($dbConn,"SELECT * FROM loanrequest_tbl WHERE loan_status='0'");


while ($activerow=mysqli_fetch_array($activeloan)){ 
$activeloan_payment=$activerow['loan_amount'];
@$activeloan_paid=@$activeloan_paid + $activeloan_payment;
}
$active = mysqli_query($dbConn,"SELECT * FROM loanrequest_tbl WHERE loan_status='1' and loan_complete='1'");
@$numactive=0;

while ($activero=mysqli_fetch_array($active)){
@$numactive = @$numactive + 1;
} 
$completeloan = mysqli_query($dbConn,"SELECT * FROM loanrequest_tbl WHERE loan_status='1' and loan_complete='1'");


while ($completerow=mysqli_fetch_array($completeloan)){ 
@$numcomplete = @$numcomplete + 1;
$completeloan_payment=$completerow['loan_amount'];
@$completeloan_paid=@$completeloan_paid + $completeloan_payment;
}
$paidloan = mysqli_query($dbConn,"SELECT * FROM loan_tbl");


while ($paidrow=mysqli_fetch_array($paidloan)){ 
$loan_paid=$paidrow['loan_payment'];
@$totalloan_paid=@$totalloan_paid + $loan_paid;
 }


$totalloan = @$activeloan_paid + @$completeloan_paid; 
$saveselect = mysqli_query($dbConn,"SELECT * FROM savings_tbl");
while ($saverow=mysqli_fetch_array($saveselect)){
$cust_savings=$saverow['cust_savings'];
@$cust_savingstotal = $cust_savingstotal + $cust_savings;
}*/
$activemember = mysqli_query($dbConn,"SELECT * FROM users");
while ($getactiverow=mysqli_fetch_array($activemember)){
@$member_active = @$member_active + 1;
}
/*
$notmember = mysqli_query($dbConn,"SELECT * FROM personalinfo_tbl WHERE cust_status='0' or cust_status=''");
while ($getnotrow=mysqli_fetch_array($notmember)){
@$member_not = @$member_not + 1;
}
$expenses = mysqli_query($dbConn,"SELECT * FROM expenditure_tbl");
while ($expensesrow=mysqli_fetch_array($expenses)){
$amount = $expensesrow['amount'];
@$totalexp=@$totalexp + $amount;

}*/?>
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
        .back{
            font-size: 1.7rem;
        }
    </style>
</head>
<body>
    <header class='home-header'>
        <h2>Hi, <span><?php echo @$userRow['firstname']; ?></span></h2>
        <div class="right menu">
            <a class='img-left' href="admin-profile.php"><img src="<?php echo 'images/'. @$userRow['image']; ?>"></a>
            <a href="./admin-settings.php"><i class="icofont-settings back">
            </i></a>
    </div>
    </header>
    <!--<section class="admin-body">
        <div class="container">
        <h3>Admin Id: <span><?php echo $userRow['cust_id']; ?></span></h3><br>
            <div class="admin-row">
                <div class="admin-col ad">
                    <a href="./active-members.php">users <br><br><span><?php echo @$member_active; ?><br><br>
                <h4>View</h4></span></a>
                </div>
                <div class="admin-col ad">
                    <a href="./active-loans.php">Active Loans<br><br><span><?php echo @$loan_active; ?><br><br>
                        <h4>View</h4></span></a>
                </div>
            </div>
            <div class="admin-row">
                <div class="admin-col">
                    <a href="./total-savings.php">Total Savings<br><br><span>N<?php echo @$cust_savings; ?><br><br>
                        <h4>View</h4></span></a>
                </div>
                <div class="admin-col">
                    <a href="">Gross Income<br><br><span>N<?php echo @$totalloan_paid + @$cust_savingstotal; ?><br><br>
                        <h4>View</h4></span></a>
                </div>
            </div>
            <div class="seeMore">
                <a href="">See More</a> 
            </div>        
        </div>
    </section> -->

    <section class="admin-body">
        <div class="container">
            <h2>Admin Panel</h2>
            <div class="categories">
                <h4>Categories</h4>
                <a href="">Show All</a>
            </div>
            <div class="box">
                <div class="grid" href='./active-members.php'>
                    <i class="icofont-users"></i>
                    <p><?php if(@$member_active == ''){
                        echo '0';} else{ echo @$member_active;}
                     ?> Users</p>
                </div>
                <a href="./active-loans.php" class="grid">
                <i class="icofont-bank"></i>
                    <p><?php if(@$loan_active == ''){
                        echo '0';} else{ echo @$loan_active;}
                     ?> Active Loans</p>
                </a>
                <a href="./total-savings.php" class="grid">
                <i class="icofont-save"></i>
                    <p><?php if(@$cust_savings == ''){
                        echo '0';} else{ echo @$cust_savings;}
                     ?>.00</p>
                </a>
                <div class="grid">
                    <i class='icofont-money'></i>
                    <p><?php echo @$totalloan_paid + @$cust_savingstotal;
                     ?></p>
                </div>


            </div>

            
        </div>
    </section><br><br><br><br><br><br>
    <div class="fixed">
        <div class="container">
            <a href="./users.php"><i class="icofont-chat"></i></a>
            <a href="./admin-home.php"><i class="icofont-home"></i></a>
            <a style="position: relative;" href="./admin-notification.php"><i class="icofont-notification"></i><span style="position: absolute; top: -5px; box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.1); background: red; color: white; padding: .15rem; border-radius: 50%; right: -7px; font-size: .8rem;">2</span></a>
        </div>
    </div>
</body>
</html>