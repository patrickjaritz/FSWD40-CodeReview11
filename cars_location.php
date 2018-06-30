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

  
    <title>Car details requested by <?php echo $userRow['first_name']; ?></title>
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

<div style="text-align: right;" class="alert alert-primary" role="alert">


           Hi <?php echo $userRow['first_name']."!" ; ?>
            
    <br>
    <a href="logout.php?logout">Sign out</a>
  
   
</div>


<div class="showCars">

  

 <?php
             /* $sql2 = "SELECT * FROM car WHERE car_id = '$car_id'"; */
              $sql2 = "SELECT * FROM office INNER JOIN car ON office.office_id = car.fk_office_id";
    
                $result = $conn->query($sql2);
                if (!$result) {
                  echo "sql query failed";
              } 

              $rows=$result->fetch_all(MYSQLI_ASSOC);
              echo "<div class='container'><h1>Car Location Info</h1>
              <table class='table table-striped'><thead>
              <tr><th>Name</th><th>Image</th><th>Type</th><th>Location</th><th>Address</th><th>Available</th></tr>
              </thead><tbody>";
            foreach($rows as $row){
              echo "<tr><td>";
                echo $row['car_name'];
                echo "</td><td>";
                echo "<img src='";
                echo $row['car_image'];
                echo "' width='200'></td>";
                echo "<td>";
                echo $row['car_type'];
                echo "</td><td>";
                echo $row['office_name'];
                echo "</td><td>";
                echo $row['office_address'];
                echo "</td><td>";
                echo $row['available'];
                echo "</td></tr>";

            }
              echo "</tbody></table></div>";
        
        
          
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

<!--
  /* <td> <a href='show.php?isbn=".$row['isbn']."'> ".$row['last_name']."</a></td> */ -->