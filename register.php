<?php
ob_start();
session_start(); // start a new session or continues the previous
if( isset($_SESSION['client'])!="" ){
 header("Location: home.php"); // redirects to home.php
}
include_once 'dbconnect.php';
$error = false;
if ( isset($_POST['btn-signup']) ) {

 // sanitize user input to prevent sql injection
 $first_name = trim($_POST['first_name']);
 $first_name = strip_tags($first_name);
 $first_name = htmlspecialchars($first_name);

 $last_name = trim($_POST['last_name']);
 $last_name = strip_tags($last_name);
 $last_name = htmlspecialchars($last_name);
 
 $user_email = trim($_POST['user_email']);
 $user_email = strip_tags($user_email);
 $user_email = htmlspecialchars($user_email);

 $user_pass = trim($_POST['user_pass']);
 $user_pass = strip_tags($user_pass);
 $user_pass = htmlspecialchars($user_pass);

 // basic name validation
 if (empty($first_name)) {
  $error = true;
  $nameError = "Please enter your first name.";
 } else if (strlen($first_name) < 3) {
  $error = true;
  $nameError = "Name must have atleat 3 characters.";
 } else if (!preg_match("/^[a-zA-Z ]+$/",$first_name)) {
  $error = true;
  $nameError = "Name must contain alphabets and space.";
 }

 if (empty($last_name)) {
  $error = true;
  $nameError = "Please enter your last name.";
 } else if (strlen($last_name) < 3) {
  $error = true;
  $nameError = "Name must have atleat 3 characters.";
 } else if (!preg_match("/^[a-zA-Z ]+$/",$last_name)) {
  $error = true;
  $nameError = "Name must contain alphabets and space.";
 }


 //basic email validation
 if ( !filter_var($user_email,FILTER_VALIDATE_EMAIL) ) {
  $error = true;
  $emailError = "Please enter valid email address.";
 } else {
  // check whether the email exist or not
  $query = "SELECT user_email FROM `customer` WHERE user_email='$user_email'";
  $result = mysqli_query($conn, $query);
  $count = mysqli_num_rows($result);
  if($count!=0){
   $error = true;
   $emailError = "Provided Email is already in use.";
  }
 }
 // password validation
 if (empty($user_pass)){
  $error = true;
  $passError = "Please enter password.";
 } else if(strlen($user_pass) < 6) {
  $error = true;
  $passError = "Password must have atleast 6 characters.";
 }

 // password hashing for security
$password = hash('sha256', $user_pass);


 // if there's no error, continue to signup
 if( !$error ) {
  
  $query = "INSERT INTO customer(first_name,last_name, user_email, user_pass) VALUES('$first_name','$last_name','$user_email','$user_pass')";
  $res = mysqli_query($conn, $query);
  
  if ($res) {
   $errTyp = "success";
   $errMSG = "Successfully registered, you may login now";
   unset($first_name);
   unset($last_name);
   unset($user_email);
   unset($user_pass);
  } else {
   $errTyp = "danger";
   $errMSG = "Something went wrong, try again later...";
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
    <title> BigLibrary Login & Registration System</title>
  
    <link rel="shortcut icon" href="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous"><!-- for the heart icon in the footer -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    
  </head>
  <style>
  html {
    font-size: 90%;
    background: url("./images/mark-cruz-330105-unsplash.jpg") no-repeat center center fixed;
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
    justify-content: flex-start;
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
  }

  #emailHelp {
    font-size: .7rem;
  }

  .login {
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
          <h2>Sign up</h2>
         <?php
          if ( isset($errMSG) ) {
          ?>
          <div class="alert alert-<?php echo $errTyp ?>">
            <?php echo $errMSG; ?>
          </div>
        <?php
          }
          ?>

          <form>
            <div class="form-group">
              <label for="inputFirstName">Enter your first name</label>
              <input type="text" name="first_name" class="form-control" placeholder="First Name" maxlength="20" value="<?php echo $first_name ?>" />
              <span class="text-danger"><?php echo $nameError; ?></span>
            </div>
            <div class="form-group">
              <label for="inputLastName">Enter your last name</label>
              <input type="text" name="last_name" class="form-control" placeholder="Last Name" maxlength="20" value="<?php echo $last_name ?>" />
              <span class="text-danger"><?php echo $nameError; ?></span>
            </div>
            <div class="form-group">
              <label for="inputEmail">Enter your email address</label>
              <input type="email" name="user_email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter your email" alue="<?php echo $user_email; ?>" maxlength="40">
              <span class="text-danger"><?php echo $emailError; ?></span>
             </div>
            <div class="form-group">
              <label for="inputPassword">Choose a password</label>
              <input type="password" name="user_pass" class="form-control" id="input" placeholder="Your password" maxlength="15">
              <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            <button type="submit" name="btn-signup" class="btn btn-block btn-primary">Sign up</button>

            <a class="registerText" href="index.php"> <span class="login">Go here if you're already signed up</span></a>
          </form>
      </section>
    </main>
  </body>
</html>