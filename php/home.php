<?php

$session = $_SESSION['user'];
if(isset($session));

$res=mysqli_query($dbConn,"SELECT * FROM users WHERE cust_id='$session'");
	$userRow=mysqli_fetch_array($res);
	$cust_fname = $userRow['firstname'];
	$cust_lname = $userRow['lastname'];

	/*@$passave=@mysqli_query($dbConn,"SELECT * FROM savingamount_tbl WHERE cust_id='$session' and savings_status='1' ORDER BY SN DESC");
	@$userPassave=@mysqli_fetch_array($passave);
	$cust_savings = $userPassave['cust_savings'];

	@$pass=@mysqli_query($dbConn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$session' and cust_passport='$userRow[passport]'");
	@$userPass=@mysqli_fetch_array($pass);

	$pass=mysqli_query($dbConn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$session'");
	$userPass=mysqli_fetch_array($pass);


	$detailloan = mysqli_query($dbConn,"SELECT * FROM loanrequest_tbl WHERE cust_id='$session' and loan_complete='0' LIMIT 1");
    $detailloan1 = mysqli_query($dbConn,"SELECT * FROM loanrequest_tbl WHERE cust_id='$session' and loan_complete='1' LIMIT 1");
    $detailloan2 = mysqli_query($dbConn,"SELECT * FROM loanrequest_tbl WHERE cust_id='$session' and loan_status='0' LIMIT 1");

if (mysqli_num_rows($detailloan) > 0) 
{
$getloan=mysqli_fetch_array($detailloan);
$detail = mysqli_query($dbConn,"SELECT * FROM loan_tbl WHERE cust_id='$session' and cust_id='$getloan[cust_id]'");
} 
elseif (mysqli_num_rows($detailloan2) > 0) 
{
$message="NOT YET";	
}
else
{
$getloan=mysqli_fetch_array($detailloan1);
$detail = mysqli_query($dbConn,"SELECT * FROM loan_tbl WHERE cust_id='$session' and loan_id='$getloan[loan_id]'");
}

while ($detailfetch=mysqli_fetch_array($detail)){
$loan_payment=$detailfetch['loan_payment'];
$payment_date=$detailfetch['payment_date'];
$payment_status=$detailfetch['payment_status'];
$loan_countnext=$detailfetch['loan_countnext'];
$loan_duration=$getloan['loan_duration'];

@$loan_paid=@$loan_paid + $loan_payment;
}
$detailb = mysqli_query($dbConn,"SELECT * FROM savings_tbl WHERE cust_id='$session'");
while ($detailfetchb=mysqli_fetch_array($detailb)){
$cust_savings=$detailfetchb['cust_savings'];
@$cust_savingstotal = $cust_savingstotal + $cust_savings;
$savings_date=$detailfetchb['savings_date'];
$savings_status=$detailfetchb['savings_status'];
}
$divide=mysqli_query($dbConn,"SELECT * FROM dividend_tbl WHERE cust_id='$session' and div_class='loans' LIMIT 1"); 
$dividerow=mysqli_fetch_array($divide);
$divides=mysqli_query($dbConn,"SELECT * FROM dividend_tbl WHERE cust_id='$session' and div_class='savings' LIMIT 1"); 
$dividerows=mysqli_fetch_array($divides);*/