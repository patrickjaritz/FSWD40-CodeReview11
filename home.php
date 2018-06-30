<?php require_once 'actions/db_connect.php'; ?>

 <?php
ob_start();
session_start();
require_once 'dbconnect.php';

// if session is not set this will redirect to login page
if( !isset($_SESSION['client']) ) {
 header("Location: index.php");
 exit;
}




// select logged-in users detail
$res=mysqli_query($conn, "SELECT * FROM customer WHERE `customer_id`=".$_SESSION['client']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>



<!DOCTYPE html>

<html>

<head>

  
    <title>Welcome to the PHP Car Rental,  <?php echo $userRow['first_name']; ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="shortcut icon" href="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous"><!-- for the heart icon in the footer -->

<style type="text/css">
 

  html {
    font-size: 90%;
    background: url("./images/action-asphalt-automobile-593172.jpg") no-repeat center center fixed;
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


    </style>

 

</head>

<body class="container">

<div style="text-align: left;" class="alert alert-secondary" role="alert">


<a href="cars_location.php"><h6>Car Locations</h6></a>
</div>

<br>

<div style="text-align: right;" class="alert alert-primary" role="alert">


           Hi <?php echo $userRow['first_name']."!" ; ?>
            
    <br>
    <a href="logout.php?logout">Sign out</a>
  
   
</div>


<br>

<div class="container">
	   <div>
    <hr>
   
    <button onclick="showcarlist()" class="btn btn-primary btn-lg">Car List</button>
    <p id="CarList"></p>
    </div>
    <hr>
    <div>
    <hr>
   
    <button onclick="showofficelist()" class="btn btn-primary btn-lg">Office List</button>
    <p id="OfficeList"></p>
    </div>
    <hr>


</div>


	<script>

        function showofficelist(){
        var obj, dbParam, xmlhttp;
        obj = {}; 
        dbParam = JSON.stringify(obj); 
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("OfficeList").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "office_list.php?OfficeList=" + dbParam, true); 
        xmlhttp.send(); 
        }



        function showcarlist(){
        var obj, dbParam, xmlhttp;
        obj = {}; 
        dbParam = JSON.stringify(obj); 
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("CarList").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "cars_list.php?CarList=" + dbParam, true); 
        xmlhttp.send(); 
        }



</script>
            

</body>


</html>