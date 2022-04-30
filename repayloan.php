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
            padding: 3rem 0;
            text-align: center;
        }
        form{
            padding-top: 4rem;
        } 
    </style>
</head>
<body>
    <section class="signin savings">
        <div class="container">
            <div class="bottom">
				<h2>Loan Repayment</h2>
                <form class="content" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                    <p>Cust_id: <span></span> </p>
                    
                    <p>Loan Date: <span>02/20/2020</span></p>
                    <p>Loan Amount: <span>20000</span></p>
                    <p>Loan Duration: <span>12 Months</span></p>
                    <p>Principal: <span>20000</span></p>
                    <p>Interest: <span>5000</span></p>
                    <p>total: <span>40000</span></p>
                    <input name="savings_edit" type="checkbox" value="agree" required><span> I agree to Cooperative Terms and Condition</span>
                    <div class="btn">
                        <input type="submit" name="btn-signup" value="Verify Record">
                    </div><br><br>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
<?php ob_end_flush(); ?>