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

<title>Offices requested by <?php echo $userRow['first_name']; ?></title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

<style type="text/css">
 

    <style type="text/css">

        .manageMedia {

            width: 50%;

            margin: auto;

        }

 

        table {

            width: 100%;

            margin-top: 20px;

        }

    </style>

</head>

<body class="container">

    <!--

<div style="text-align: right;" class="alert alert-primary" role="alert">


           Hi <?php echo $userRow['first_name']."!" ; ?>
            
    <br>
    <a href="logout.php?logout">Sign out</a>
  
   
</div>
    -->

  
 

<div class="showOffices">

  
    <table>
        <tbody>
            <?php

            $result = $conn->query("SELECT office.office_name, office.office_address, count(office.office_address) as 'count' FROM office INNER JOIN car on office.office_id = car.fk_office_id GROUP BY office.office_address;");

            $outp = array(); // create an empty array
            $outp = $result->fetch_all(MYSQLI_ASSOC); // fill an array with the requested data and store it in the array
            echo "<table class='table table-striped'><thead><tr><th>Office Name</th><th>Address</th><th>Number of Cars</th></tr></head>";
            foreach($outp as $row){
                  echo "<tr><td>";
                    echo $row['office_name'];
                    echo "</td><td>";
                    echo $row['office_address'];
                    echo "</td><td>";
                    echo $row['count'];
                    echo "</td></tr>";
    
                }
                echo "</table>";
            ?>
        </tbody>
    </table>

</div>
<br>

<div style="text-align: right;" class="alert alert-primary" role="alert">

<a href="home.php">Back</a>
</div>
 

</body>

</html>

