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
        .home-header{
            width: 100%;
        }
        .home-header .container{
            width: 100%;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .back, .settings{
            font-size: 1.7rem;
            color: var(--primary-color);
        }
        .middle{
            display: flex;
            gap: .5rem;
            align-items: center;
            justify-content: center;
        }
        h2 span{
            font-size: 1.2rem !important;
        }
    </style>
</head>
<body>
<?php
       if(isset($_SESSION['user']));
       $session = $_SESSION['user'];
       @$res=mysqli_query($dbConn,"SELECT * FROM users WHERE cust_id='$session'");
       @$userRow=mysqli_fetch_array($res);
?>
<header class='home-header'>
    <div class="container">
    <div class="middle">
        <a href="./users.php"><i class="bi bi-arrow-left back"></i></a>
        <a href="profile.php"><img src="<?php if(@$userRow['image']==''){
            echo 'images/img.jpg';
        } else{echo 'images/'. @$userRow['image'];} ?>"></a>
        <h2><span><?php echo @$userRow['lastname']; ?></span></h2>
    </div>
            <a href="./settings.php"><i class="icofont-settings settings"></i></a>
    </div>
    </header><br>
    <?php
$session = $_SESSION['user'];

$user_id = mysqli_real_escape_string($dbConn, $_GET['user_id']);
$sql = mysqli_query($dbConn, "SELECT * FROM users WHERE cust_id = '$user_id'");
if(mysqli_num_rows($sql) > 0){
    $row = mysqli_fetch_array($sql);
}
?>
    <div class="chat-box">
        
        

        
    </div>
    <form action="#" class="typing-area">
        <input type="text" name="outgoing_id" value="<?php echo $_SESSION['user']; ?>" hidden>
        <input type="text" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" class="input-field" name="message" placeholder="type a message here">
        <button><i class="icofont-telegram"></i></button>
    </form>

    <script src="./chat.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>