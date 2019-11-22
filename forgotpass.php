
<?php

error_reporting(0);

$errors ='';

if($_POST['submit']=='Send')
{
    //keep it inside
    $email=$_POST['email'];
    $password = $_GET['passsword'];
    $con=mysqli_connect("Localhost","root","","register_login");
    // Check connection
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $query = mysqli_query($con,"SELECT * FROM user_login WHERE email='$email'")
    or die(mysqli_error($con));

    if (mysqli_num_rows ($query)==1)
    {
        $code= rand(100,999);
        $message="You activation link is:http://localhost/FORM_LOGIN_PHP/resetpassword.php?email=$email&code=$code";
        mail($email, "Send Code", $message);
        echo 'Email sent';
        $query2 = mysqli_query($con,"UPDATE password SET passsword='$password' WHERE email='$email'")
        or die(mysqli_error($con)); 
        }
        else
        {
       $errors = '<div class="alert alert-danger" role="alert">Sorry, Your email does not exists in our record database</div>';
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>

    <!-- library icon fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- style icon -->
    <link href="css/styles.css" rel="stylesheet">

</head>
<body>

    <!-- Material form login -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-5 rounded">
                <div class="card">
                    <h5 class="card-header info-color white-text text-center py-4">
                    <strong>Forgot Password</strong>
                    </h5>
                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">
                    <!-- Form -->
                    <form class="text-center"action="forgotpass.php" method="POST">
                        <!-- Email -->
                        <div class="md-form">
                        <?= $errors?>
                            <input type="email"name="email" id="email" class="form-control" placeholder="E-mail">
                        </div>
                        <!-- Sign in button -->
                        <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="submit" value="Send">Send Code To Mail</button>
                        <!-- Social login -->
                        <a href="signin.php">Sing in</a>
                        <p>or sign in with:</p>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-youtube"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                    </form>
                    <!-- Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>








