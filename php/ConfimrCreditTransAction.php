<?php
session_start();
include_once('conn2.php');
$email=$_SESSION['EMAIL'];
$UserId=$_SESSION['UID'];
$_SESSION['EmailToverify']=$wer=$_GET['Email'];
$_SESSION['IdToverify']=$id=$_GET['Id'];
$_SESSION['ProductName']=$ProductName=$_GET['Product'];
//echo "This is the ID from get: $id"."\n"."############ "."<br>";








 //echo "This is the email captured with get: $wer". "<br>";

 echo"
<!DOCTYPE html>
<html>

<head>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<title>Credit Confirmation page</title>
<link rel='icon' href='http://pick2get.com/Asset/icon/download.png'>
<!-- Latest compiled and minified CSS -->
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
<!-- jQuery library -->
<script href='https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.1/jquery.js'></script>



<!-- Latest compiled and minified JavaScript -->
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>









</head>
</html>
<body>
 
      <form method='post' class='form form-control' action='confrim.php'>
       <h4><b>ENTER PASSWORD TO CONFIRM CREDIT TRANSACTION OF $ProductName</b></h4>
       <table class='table'>
        <tr>

        <td><input type='password' name='pswd' class='form-control' name='password' style='width:120px;'></td>
        <td></td>
        <td><input type='submit' name='GetConfirmation' class='btn btn-info' value='confirm transaction'></td> 
        </tr>
       <table>
       
       
      </from>
    
</body>
 ";

 //header("location:$wer");
     
 

 


?>