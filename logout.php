<?php
session_start();
if (!isset($_SESSION['client'])) {
 header("Location: index.php");
} else if(isset($_SESSION['client'])!="") {
 header("Location: home.php");
}

if (isset($_GET['logout'])) {
 unset($_SESSION['client']);
 session_unset();
 session_destroy();
 header("Location: index.php");
 exit;
}
?>