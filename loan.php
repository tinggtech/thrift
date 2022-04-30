<?php
	ob_start();
	session_start();
    require_once 'php/config.php';

	// if session is not set this will redirect to login page
    if( !isset($_SESSION['user']) ) {
        header("Location: index.php");
        exit;
    }

$error = false;
$session = $_SESSION['user'];
$msg = '';
$msg_class = '';

$res=mysqli_query($dbConn,"SELECT * FROM users WHERE cust_id='$session'");
	$userRow=mysqli_fetch_array($res);
    $surname = $userRow['surname'];
	$firstname = $userRow['firstname'];
	$lastname = $userRow['lastname'];
    $fullname = $surname. ' ' .$firstname. ' ' .$lastname;
    $telephone = $userRow['telephone'];
    $gender = $userRow['gender'];
    $bvn = $userRow['bvn'];
    $image = $userRow['image'];
    $maritalStatus = $userRow['maritalStatus'];
    $home_address = $userRow['home_address'];
    $bankName = $userRow['bankName'];
    $accountNumber = $userRow['accountNumber'];

if (isset($_POST['btn-signup'])) {
	//for the database
$profileImageName = time() . '_' . $_FILES['form']['name'];
//for image upload
$target_dir = 'images/';
$target_file = $target_dir.basename($profileImageName);
//VALIDATION
if($_FILES['form']['size'] > 1000000){
    $msg = "Image size should not be greater than 1.00mb";
    $msg_class = 'red';
    $error = true;
}
//check if file exists
if(file_exists($target_file)){
    $msg = "File already exists";
    $error = true;
}
	// clean user inputs to prevent sql injections
	$loan_amount = trim($_POST['loan_amount']);
	$loan_amount = strip_tags($loan_amount);
	$loan_amount = htmlspecialchars($loan_amount);

	$loan_duration = trim($_POST['loan_duration']);
	$loan_duration = strip_tags($loan_duration);
	$loan_duration = htmlspecialchars($loan_duration);
	
	$guarantor_id = trim($_POST['guarantor_id']);
	$guarantor_id = strip_tags($guarantor_id);
	$guarantor_id = htmlspecialchars($guarantor_id);

	$nok = trim($_POST['nok']);
	$nok = strip_tags($nok);
	$nok = htmlspecialchars($nok);

    $lg_query = "SELECT * FROM users WHERE cust_id='$guarantor_id'";
    $lg_result = mysqli_query($dbConn,$lg_query);
    $count = mysqli_num_rows($lg_result);
    if($count == 1){
        $lg_status = '1';
    }

//upload image only if no errors
if(empty($error)){
    if(move_uploaded_file($_FILES['form']['tmp_name'], $target_file)){
        $query = "INSERT INTO `loan_tbl`(cust_id,fullname,passport,loan_amount,loan_duration,guarantor_id,bvn,nok,verification_form,lg_status,loan_status,loan_date,loan_complete) VALUES('$session','$fullname', '$image', '$loan_amount', '$loan_duration', '$guarantor_id', '$bvn', '$nok', '$profileImageName', '$lg_status', '0', NOW(), '0')";
		$res = mysqli_query($dbConn,$query) or die(mysqli_error($dbConn));
		
		if ($res) {
			header('Location: successful.php');
		} else {
			$errMSG = "Something went wrong, try again later...";	
		}	
			
	}
	
}	
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
    <link rel="stylesheet" href="./assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <title></title>
    <style>
        input[type=text]{
            background: white;
            border-bottom: 2px solid rgba(0,0,0,.2);
            color: black;
        }
        .bottom h2{
            padding: 4rem 0;
            text-align: center;
            color: var(--primary-color);
        }
        form{
            padding-top: 6.5rem;
        } 
        img{
            width: 120px;
            height: 120px;
            margin-bottom: 1rem;
            border-radius: 50%;
        }
        .back{
            font-size: 1.7rem;
            position: absolute;
            top: 1rem;
            left: 1.7rem;
            color: var(--primary-color);
            height: 2rem;
        }
    </style>
</head>
<body>
    <section class="signin">
        <div class="container">
            <div class="bottom">
                <a href="./home.php"><i class="bi bi-arrow-left back"></i></a>
				<h2>Edit Loan Record</h2>
                <form class="content" method="POST" action="loan.php" autocomplete="off" enctype='multipart/form-data'>
                  <div class="error">
                    <?php
                    if(isset($errMSG)){
                       echo @$errMSG;
                    }
                    if(isset($loan_amountError)){
                        echo @$loan_amountError . '<br>';
                     }
                     if(isset($loan_durationError)){
                        echo @$loan_durationError . '<br>';
                     }
                     if(isset($guarantor_idError)){
                        echo @$guarantor_idError . '<br>';
                     }
                     if(isset($nokError)){
                        echo @$nokError . '<br>';
                     }
                     if(isset($bvnError)){
                        echo @$bvnError . '<br>';
                     }
                     if(isset($bankNameError)){
                        echo @$bankNameError . '<br>';
                     }
                     if(isset($accountNumberError)){
                        echo @$accountNumberError . '<br>';
                     }
                    ?>
                  </div>
                    <p>Enter Loan Amount </p>
                    <input type="tel" autocomplete name='loan_amount' value="<?php echo @$loan_amount; ?>" required><br><br>
                    <p>Enter Reason for Loan </p>
                    <input type="text" autocomplete name='loan_amount' value="<?php echo @$loan_reason; ?>" required><br><br>
                    <p>Select Loan Type</p>
                    <select name="loan_duration"><br><br>
						<option value="1">Members Loan</option>
						<option value="2">Non Members Loan</option>
                        <option value="3">Emergency Loan</option>
					</select><br><br>
                    <p>Select Loan Duration</p>
                    <select name="loan_duration"><br><br>
						<option value="1">1 month</option>
						<option value="2">2 month</option>
                        <option value="3">3 month</option>
                        <option value="4">4 month</option>
                        <option value="5">5 month</option>
						<option value="6">6 month</option>
                        <option value="7">7 month</option>
                        <option value="8">8 month</option>
                        <option value="9">9 month</option>
						<option value="10">10 month</option>
                        <option value="11">11 month</option>
                        <option value="12">12 month</option>
					</select><br><br>
                    <p>Enter Next of Kin</p>
                    <input type="text" autocomplete name='nok' value="<?php echo @$nok; ?>" required><br><br>
                    <p>Select any Verification form, National ID Card, NIN, Drivers License etc</p>
                    <input type="file" name="form" id="profileImage"><br><br>
                    <p>Enter Guarantor cust_id</p>
                    <input type="text" name='guarantor_id' value="<?php echo @$guarantor_id; ?>" required><br><br>
                    <p style='color: red;'>NOTE: The Loan Guarantor must have regitsered with a thriftlyte account. <br>
                    Make sure your profile and bank details is correct including your profile picture for security reasons.</p>
                    <div class="btn">
                        <input type="submit" name="btn-signup" value="Submit">
                    </div><br><br>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
<?php ob_end_flush(); ?>