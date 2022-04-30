<?php

$error = false;

	
	if( isset($_POST['btn-login']) ) {	
		// prevent sql injections/ clear user invalid inputs
		$uid = trim($_POST['uid']);
		$uid = strip_tags($uid);
		$uid = htmlspecialchars($uid);
		
		$password = trim($_POST['password']);
		$password = strip_tags($password);
		$password = htmlspecialchars($password);
		// prevent sql injections / clear user invalid inputs
		
		if(empty($uid)){
			$error = true;
		} 
		
		if(empty($password)){
			$error = true;
		}

        // if there's no error, continue to login
		if (!$error) {
			$password = hash('sha256', $password); // password hashing using SHA256
			$res=mysqli_query($dbConn,"SELECT * FROM users WHERE cust_id='$uid'");
			$row=mysqli_fetch_array($res);
			$count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row

			$admin=mysqli_query($dbConn,"SELECT * FROM thriftlyte_admin WHERE cust_id='$uid' and level='admin'");
			//$adminrow = mysqli_fetch_array($admin); // if uname/pass correct it returns must be 1 row

			if( ($count == 1) && ($row['password']==$password) && (mysqli_num_rows($admin) > 0) ) {
				$_SESSION['admin'] = $row['cust_id'];
				header("Location: admin-home.php");}
			 elseif( ($count == 1) && ($row['password']==$password) && (mysqli_num_rows($user) == 0)) {
				$_SESSION['user'] = $row['cust_id'];
				header("Location: home.php");
			} else {
				$errMSG = "Incorrect Credentials, Try again...";
			}
				
		}
		
	}