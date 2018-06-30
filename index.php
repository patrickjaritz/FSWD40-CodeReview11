
<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// it will never let you open index(login) page if session is set
if ( isset($_SESSION['client'])!="" ) {
 header("Location: home.php");
 exit;
}

$error = false;

if( isset($_POST['btn-login']) ) {

 // prevent sql injections/ clear user invalid inputs
 $email = trim($_POST['user_email']);
 $email = strip_tags($email);
 $email = htmlspecialchars($email);

 $pass = trim($_POST['user_pass']);
 $pass = strip_tags($pass);
 $pass = htmlspecialchars($pass);
 // prevent sql injections / clear user invalid inputs

 if(empty($email)){
  $error = true;
  $emailError = "Please enter your email address.";
 } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
  $error = true;
  $emailError = "Please enter valid email address.";
 }

 if(empty($pass)){
  $error = true;
  $passError = "Please enter your password.";
 }

 // if there's no error, continue to login
 if (!$error) {
  
  // $password = hash('sha256', $pass); // password hashing

  $res=mysqli_query($conn, "SELECT `customer_id`, first_name, user_pass FROM customer WHERE user_email='$email'");
  $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
  $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row
  
  if( $count == 1 && $row['user_pass']==$pass ) {
   $_SESSION['client'] = $row['customer_id'];
   header("Location: home.php");
  } else {
   $errMSG = "Incorrect Credentials, Try again...";
  }
  
 }

}
?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Car Rental Login & Registration System</title>
    <link rel="shortcut icon" href="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous"><!-- for the heart icon in the footer -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <style>
  html {
    font-size: 90%;
    background: url("./images/averie-woodard-111831-unsplash.jpg") no-repeat center center fixed;
    background-size: cover;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
  }
  body {
    height: 50%;
    font-size: 1rem;
    position: relative;
    display: flex;
    justify-content: flex-end;
    color: white;
    background-color: transparent;
  }
  main {
    width:40%;
  }
  section {
    padding: 2rem;
  }
  form {
    background: rgba(0,0,0,.5);
    display:flex;
    flex-direction: column;
    max-width: 80%;
    padding: 5px;
  }
  h2{
    text-align: center;
    text-transform: uppercase;
    padding-bottom: 1rem;
  }
  .registerText {
    padding: 5px 0 0 0;
    font-size: .7rem;
    font-weight: bold;
    color: lightgrey;
  }
  #emailHelp {
    font-size: .7rem;
  }
  .signup {
    text-decoration: underline;
  }
  .text-muted {
    color: white;
  }
  @media screen and (max-width:420px){
    main {
      width: 100%;
    }
    form {
      max-width: 100%;
    }
    body {
      width: 100%;;
    }
  }
  </style>
  <body>
    <main>
      <section>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
          <h2>Login</h2>
          <?php
          if ( isset($errMSG) ) {
            echo $errMSG;}
          ?>
          <form>
            <div class="form-group">
              <label for="inputEmail">Email address</label>
              <input type="user_email" name="user_email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Your email" alue="<?php echo $user_email; ?>" maxlength="40">
             <span class="text-danger"><?php echo $emailError; ?></span>
              </div>
            <div class="form-group">
              <label for="inputPassword">Password</label>
              <input type="password" name="user_pass" class="form-control" id="input" placeholder="Your Password" maxlength="15">
              <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            <button type="submit" name="btn-login" class="btn btn-primary">Log in</button>
            <a class="registerText" href="register.php"> <span class="signup">Register here</span></a>
          </form>
      </section>
    </main>
  </body>
</html>
<?php ob_end_flush(); ?>