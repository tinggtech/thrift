<?php
	ob_start();
	session_start();
	require_once 'php/config.php';
	
		// if session is not set this will redirect to login page
        if( !isset($_SESSION['admin'])) {
            header("Location: index.php");
            exit;
        }
?>
<?php
$session = $_SESSION['admin'];

$res=mysqli_query($dbConn,"SELECT * FROM users WHERE cust_id='$session'");
$userRow=mysqli_fetch_array($res);

    $surname = $userRow['surname'];
	$cust_fname = $userRow['firstname'];
	$cust_lname = $userRow['lastname'];
    $cust_email = $userRow['email'];
    $cust_tel = $userRow['telephone'];
    $cust_gender = $userRow['gender'];
    $cust_maritalStatus = $userRow['maritalStatus'];
    $cust_date = $userRow['dateOfBirth'];

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
            padding: 3rem 2.5rem 1rem;
            color: rgb(152, 18, 206);
        }
        .bottom h3{
            margin:  .7rem 0;
            font-size: 1.1rem;
            box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.3);
            padding: .8rem 1rem;
            border-radius: 10px;
        }
        .bottom span{
            font-size: 1rem;
            margin:  1rem;
            opacity:  .8;
        }
        .contain{
            padding-top: 2.5rem;
        } 
        .savings{
            margin-top: .5rem;
        }
        .container{
            width: 90%;
            position: relative;
            margin: auto;
            display: flex;
            flex-direction: column;
            height: 50vh;
        }
        header{
            display: flex;
            justify-content: space-between;
            width: 80%;
            margin: auto;
            padding-top: 1rem;
        }
        header a{
            color: rgb(152, 18, 206);
        }
        header a i{
            font-size: 2rem;
            color: rgb(152, 18, 206);
        }
        .btn a{
            margin-top: 1rem;
            display: inline-block;
            box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.4);
            background: rgb(152, 18, 206);
            color: white;
            padding: .9rem 2.5rem;
            border-radius: 20px;
        }
        .profile-pic{
            width: 40%;
            height: 100%;
        }
        .profile-pic img{
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 10px;
        }
        .bottom{
            padding-top: 2rem;
            width: 90%;
            margin: auto;
        }
        input[type=submit]{
            position: absolute;
            top:20rem;
            right: 0; 
            display: none;
        }
        .profile{
            padding-top:1rem;
            color: var(--primary-color);
            text-align: center;
            padding-left: 2rem;
        }

    </style>
</head>
<body>
    <section class="signin savings">
        <header>
            <a href="./home.php"><i class="bi bi-arrow-left"></i></a>
            <a href="form-admin.php">Edit</a>
        </header>

        <div class="container">
            <div class="profile-form">
                <div class="profile-pic">
                    <div class="contain">
                        <img src="<?php if(@$userRow['image']==''){
                            echo 'images/img.jpg';
                        } else{echo 'images/'. @$userRow['image'];} ?>">
    </div>
        </div>
                   </div>
                </div>
        </div>
    </section>
    <div class="bottom"><a href="admin-picture.php" class='profile'>edit picture</a>
        <h2>Profile</h2>
            <h3>Cust_id: <span><?php if(isset($_SESSION['user'])); echo $session; ?></span> </h3>
            <h3>Full Name: <?php echo $surname . ' ' .$cust_fname . ' '. $cust_lname;  ?></h3>
            <h3>Email Address: <span><?php echo $cust_email;  ?></span></h3>
            <h3>Telephone: <span><?php echo $cust_tel;  ?></span></h3>
            <h3>Gender: <span><?php echo $cust_gender;  ?></span></h3>
            <h3>Marital Status: <span><?php echo $cust_maritalStatus;  ?></span></h3>
            <h3>Date of Birth: <span><?php echo $cust_date;  ?></span></h3>
            <br><br>    
    </div>
</body>

</html>
<?php ob_end_flush(); ?>