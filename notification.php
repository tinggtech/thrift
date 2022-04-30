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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="./assets/font-awesome/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <title></title>
    <style>
        .bottom{
            margin-top: 2rem;
        }
        .bottom .btn{
            text-align: left;
        }
        .uid{
            color: red;
        }
        .btn{
            height: 3rem;
            background: var(--primary-color);
            display: inline-block;
            padding: 1rem 2rem;
            border-radius: 15px;
        }
        .btn a{
            color: var(--white);
        }
        h2 span{
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <?php
        if(isset($_SESSION['user']));
        $session = $_SESSION['user'];
        $query=mysqli_query($dbConn,"SELECT * FROM users WHERE cust_id='$session'");
        $userRow = mysqli_fetch_array($query);
    ?>
    <section class="signin">
        <div class="container">
            <div class="bottom">
                <div class="content">
                    <h2>Hi, <span><?php echo @$userRow['firstname']; ?></span></h2><br><br>
                    <?php 
                    $output = '';
                    $res=mysqli_query($dbConn,"SELECT * FROM notification WHERE cust_id='$session'");
                    if(mysqli_num_rows($res) > 0){
                        while($row=mysqli_fetch_array($res)){
                            $output ='<p>'.$row['id'] .' '.$row['messages'] .'</p>';
                            echo $output; 
                        }
                    }
                    ?>
                    <br><br>
                </div>
            </div>
            
        </div>
    </section>
    
</body>
</html>
<?php ob_end_flush(); ?>




