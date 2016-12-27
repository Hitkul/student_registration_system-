<?php

include("mysqli_connect.php");
session_start();
$error="";
$id  = $_SESSION['id'];
$query = "SELECT * FROM `reg_status` WHERE id LIKE '$id'";
$response = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($response,MYSQLI_ASSOC);
if ($row['status'] == 0) {
  $query = "SELECT * FROM `eligibility_status` WHERE id LIKE '$id'";
  $response = mysqli_query($dbc, $query);
  $row = mysqli_fetch_array($response,MYSQLI_ASSOC);
  if ($row['status'] == 1) {
    $query = "SELECT * FROM `fee_status` WHERE id LIKE '$id'";
    $response = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($response,MYSQLI_ASSOC);
    if ($row['status'] == 1) {
    	header("location:dashboard.php");
    }else{
     	//TODO redirect to pay u page
      $temp = "payU_redirect.php";
      $error = "You have not payed semester fee please contact finance department. <br> <a href = $temp>Click here to pay fee online.</a>";
     	header("location:registration_error.php?msg=$error");
    }

  }else{
  	//TODO redirect to error page

    $error = "You are not eligible to register for this semester, please contact program office.";
   	header("location:registration_error.php?msg=$error");
  }

}else{
 	//TODO redirect to error page
  $error = "You have already registered.";
 	header("location:registration_error.php?msg=$error");
}
mysqli_close($dbc);
?>
