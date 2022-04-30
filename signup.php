<?php
	ob_start();
	session_start();
    require_once 'php/config.php';

	if( isset($_SESSION['user'])!="" ){
		header("Location: home.php");
	}
    require_once 'php/signup.php';
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
    </style>
</head>
<body>
    <section class="signin">
        <div class="container">
            <div class="top">
                <div class="header">
                    <a href="./index.php"><i class="bi bi-arrow-left"></i></a>
                </div>
                <div class="logo">
                    <img src="./assets/img/BREU4705.jpg" alt="">
                </div>
            </div>
            <div class="bottom">
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
                     if(isset($surNameError)){
                        echo @$surNameError . '<br>';
                     }
                     /*if(isset($telError)){
                        echo @$telError . '<br>';
                     }
                     if(isset($passError)){
                        echo @$passError . '<br>';
                     }
                     if(isset($passError2)){
                        echo @$passError2 . '<br>';
                     */
                    ?>
                  </div>
                    <p>Enter Surname </p>
                    <input type="text" autocomplete name='surname' value="<?php echo @$surname; ?>" required><br><br>
                    <p>Enter First Name</p>
                    <input type="text" name='firstname' value="<?php echo @$firstname; ?>" required><br><br>
                    <p>Enter Middle Name</p>
                    <input type="text" name='lastname' value="<?php echo @$lastname; ?>" required><br><br>
                    <!--<p>Enter Telephone</p>
                    <input type="tel" name='tel' value="<?php echo @$tel; ?>" required><br><br>
                    <p>Enter Password </p>
                    <input type="password" name='pass' required><br><br>
                    <p>Repeat Password </p>
                    <input type="password" name='pass2' required><br><br>-->
                    <div class="btn">
                        <input type="submit" name="btn-signup" value="Continue">
                    </div><br><br>
                </form>
            </div>
        </div>
    </section>
</body>
<script src="./assets/jquery-1.11.3-jquery.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {	
	
	// submit form using $.ajax() method
	
	$('#reg-form').submit(function(e){
		
		e.preventDefault(); // Prevent Default Submission
		
		$.ajax({
			url: 'loan.php',
			type: 'POST',
			data: $(this).serialize() // it will serialize the form data
		})
		.done(function(data){
			$('#form-content').fadeOut('slow', function(){
				$('#form-content').fadeIn('slow').html(data);
			});
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');	
		});
	});
	
	
	/*
	// submit form using ajax short hand $.post() method
	
	$('#reg-form').submit(function(e){
		
		e.preventDefault(); // Prevent Default Submission
		
		$.post('submit.php', $(this).serialize() )
		.done(function(data){
			$('#form-content').fadeOut('slow', function(){
				$('#form-content').fadeIn('slow').html(data);
			});
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');
		});
		
	});
	*/
	
});
</script>
</html>
<?php ob_end_flush(); ?>