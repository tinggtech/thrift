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

<?php

$error = false;
$session = $_SESSION['user'];

if ( isset($_POST['btn-signup']) ) {
    	
	// clean user inputs to prevent sql injections
	$firstname = trim($_POST['firstname']);
	$firstname = strip_tags($firstname);
	$firstname = htmlspecialchars($firstname);

	$lastname = trim($_POST['lastname']);
	$lastname = strip_tags($lastname);
	$lastname = htmlspecialchars($lastname);
	
	$email = trim($_POST['email']);
	$email = strip_tags($email);
	$email = htmlspecialchars($email);
	
	$tel = trim($_POST['tel']);
	$tel = strip_tags($tel);
	$tel = htmlspecialchars($tel);

	$gender = trim($_POST['gender']);
	$gender = strip_tags($gender);
	$gender = htmlspecialchars($gender);

	$maritalStatus = trim($_POST['maritalStatus']);
	$maritalStatus = strip_tags($maritalStatus);
	$maritalStatus = htmlspecialchars($maritalStatus);

    $date = trim($_POST['date']);
	$date = strip_tags($date);
	$date = htmlspecialchars($date);

	$bankName = trim($_POST['bankName']);
	$bankName = strip_tags($bankName);
	$bankName = htmlspecialchars($bankName);

	$accountNumber = trim($_POST['accountNumber']);
	$accountNumber = strip_tags($accountNumber);
	$accountNumber = htmlspecialchars($accountNumber);

	$bvn = trim($_POST['bvn']);
	$bvn = strip_tags($bvn);
	$bvn = htmlspecialchars($bvn);

	// basic firstname validation
	if (empty($firstname)) {
		$error = true;
	} else if (strlen($firstname) < 2) {
		$error = true;
		$firstNameError = "firstname must have more than 2 Characters.";
	} 

	// basic name validation
	if (empty($lastname)) {
		$error = true;
	} else if (strlen($lastname) < 2) {
		$error = true;
		$lastNameError = "lastname must have more than 2 Charactrs.";
	}
	
	//basic email validation
	if (empty($email)) {
		$error = true;
	} 

	//basic telephone validation
	if (empty($tel)) {
		$error = true;
	}if(strlen($tel) < 10) {
			$error = true;
			$telError = "telephone number must have 11 characters.";
		} 
	//basic telephone validation
	if (empty($bankName)) {
		$error = true;
        $bankNameError  = "This field cannot be empty";
	}
	if (empty($accountNumber)) {
		$error = true;
	}else if(strlen($accountNumber) < 10) {
			$error = true;
			$accountNumberError = "account number must have 10 characters.";
		}
		if (empty($bvn)) {
			$error = true;
		}else if(strlen($bvn) < 10) {
				$error = true;
				$bvnError = "BVN must have 10 characters.";
			}
	// if there's no error, continue to signup
	if( !$error ) {		
		$query = "UPDATE users SET cust_id='$session',firstname='$firstname',lastname='$lastname',maritalStatus='$maritalStatus',gender='$gender',email='$email',dateOfBirth='$date',telephone='$tel',bankName='$bankName',accountNumber='$accountNumber',bvn='$bvn' WHERE cust_id='$session'";
		$res = mysqli_query($dbConn,$query) or die(mysqli_error($dbConn));

		if ($res) {
			header('Location: successful.php');
		} else {
			$errMSG = "Something went wrong, try again later...";	
		}	
			
	}
	
}	

	$ress=mysqli_query($dbConn,"SELECT * FROM users WHERE cust_id='$session'");
	$userRows=mysqli_fetch_array($ress);

	
	$cust_fname = $userRows['firstname'];
	$cust_lname = $userRows['lastname'];
	$cust_email = $userRows['email'];
	$cust_tel = $userRows['telephone'];
	$dateOfBirth = $userRows['dateOfBirth'];
	$gender = $userRows['gender'];
	$maritalStatus = $userRows['maritalStatus'];
	$bankName = $userRows['bankName'];
	$accountNumber = $userRows['accountNumber'];
	$bvn = $userRows['bvn'];

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
        input[type=text]{
            background: white;
            border-bottom: 2px solid rgba(0,0,0,.2);
            color: black;
        }
        .bottom h2{
            margin: 1.5rem 0;
            text-align: center;
			color: rgb(152, 18, 206);
        }
        form{
            padding-top: 2.5rem;
        } 
		header a{
			font-size: 2rem;
			margin-left: 2rem;
			color: rgb(152, 18, 206);
		}
    </style>
</head>
<body>
    <section class="signin">
	<header><br><br>
            <a href="./profile.php"><i class="bi bi-arrow-left"></i></a>
        </header>
        <div class="container">
            <div class="bottom">
				<h2>Update Profile</h2>
                <form class="content" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                  <div class="error">
                    <?php
                    if(isset($errMSG)){
                       echo @$errMSG;
                    }
                    if(isset($firstNameError)){
                        echo @$firstNameError . '<br>';
                     }
                     if(isset($lastNameError)){
                        echo @$lastNameError . '<br>';
                     }
                     if(isset($emailError)){
                        echo @$emailError . '<br>';
                     }
                     if(isset($telError)){
                        echo @$telError . '<br>';
                     }
                     if(isset($dateError)){
                        echo @$dateError . '<br>';
                     }
                     if(isset($bankNameError)){
                        echo @$bankNameError . '<br>';
                     }
                     if(isset($accountNumberError)){
                        echo @$accountNumberError . '<br>';
                     }
					 if(isset($bvnError)){
                        echo @$bvnError . '<br>';
                     }
                    ?>
                  </div>
                    <p>First Name </p>
                    <input type="text" autocomplete name='firstname' placeholder="<?php if (@$cust_fname <> ""){echo @$cust_fname;} else {echo "Enter First Name";}?>" value="<?php echo @$cust_fname; ?>" required><br><br>
                    <p>Last Name </p>
                    <input type="text" autocomplete name='lastname' placeholder="<?php if (@$cust_lname <> ""){echo @$cust_lname;} else {echo "Enter Last Name";}?>" value="<?php echo @$cust_lname; ?>" required><br><br>
                    <p>Enter Email</p>
                    <input type="email" name='email' placeholder="<?php if (@$cust_email <> ""){echo @$cust_email;} else {echo "Enter Email Address";}?>" value="<?php echo @$cust_email; ?>" required><br><br>
                    <p>Enter Telephone</p>
                    <input type="tel" name='tel' placeholder="<?php if (@$cust_tel <> ""){echo @$cust_tel;} else {echo "Enter Phone Number";}?>" value="<?php echo @$cust_tel; ?>" required><br><br>
                    <p>Gender </p>
                    <select name="gender"><br><br>
						<option value="male">Male</option>
						<option value="female">Female</option>
					</select><br><br>
                    <p>Marital Status</p>
                    <select name="maritalStatus">
						<option value="married">Married</option>
						<option value="single">Single</option>
						<option value="divorced">Divorced</option>
					</select><br><br>
					<p>Date of Birth</p>
                    <input type="date" name='date' value="<?php echo @$dateOfBirth;  ?>" required><br><br>
                    <p>Bank Name</p>
                    <input type="text" name='bankName' value="<?php echo @$bankName; ?>" required><br><br>
                    <p>Account Number</p>
                    <input type="tel" name='accountNumber' value="<?php echo @$accountNumber; ?>" required><br><br>
					<p>Bvn</p>
                    <input type="tel" name='bvn' value="<?php echo @$bvn; ?>" required><br><br>
                    <div class="btn">
                        <input type="submit" name="btn-signup" value="Update">
                    </div><br><br>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
<?php ob_end_flush(); ?>