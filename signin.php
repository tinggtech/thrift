<?php
ob_start();
session_start();
require_once 'php/config.php';

// it will never let you open index(login) page if session is set
if (isset($_SESSION['user'])!="") {
    header("Location: home.php");
    exit;
}
if (isset($_SESSION['admin'])!="") {
    header("Location: admin-home.php");
    exit;
}
require_once 'php/signin.php';
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
        .flex{
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        input{
            padding: 0;
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
            <div class="bottom signin-banner">
                <form class="content" style="top: 0;" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                  <div class="error">
                    <?php
                    if(isset($errMSG)){
                       echo @$errMSG;
                    }
                    if(isset($uidError)){
                        echo @$uidError . '<br>';
                     }
                     if(isset($passError)){
                        echo @$passError . '<br>';
                     }
                    ?>
                  </div>
                    <p>Unique ID </p>
                    <input type="text" name='uid' value="<?php echo @$uid; ?>" required><br><br>
                     <div class="flex">
                        <p>Password </p>
                        <i class="icofont-lock" id='privacy'></i>
                     </div>
                    <input type="password"id="password"  name='password' required>
                    <div class="btn">
                        <input type="submit" name='btn-login' style="background: rgba(255,255,255,.5); font-weight: 700;" value='Log In'>
                        <p><a href="./forgottenpassword.php" style="color: white;">Forgot Password?</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        let password = document.getElementById('password');
        let privacy = document.getElementById('privacy');

        privacy.addEventListener('click', function(){
            if(password.type == 'password') {
                password.type = 'text';
                privacy.classList.remove('icofont-lock');
            }
            else{
                password.type = 'password';
                privacy.classList.add('icofont-user');
            }
        })
    </script>
</body>
</html>
<?php ob_end_flush(); ?>