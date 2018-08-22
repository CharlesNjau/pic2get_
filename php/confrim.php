<?php
session_start();
include_once('conn2.php');

$email=$_SESSION['EmailToverify'];
$id=$_SESSION['IdToverify'];
$ProductName=$_SESSION['ProductName'];





     
 if(isset($_POST['GetConfirmation'])){

  $UpdateConfirmationCode="UPDATE sales SET CONFIRMATION_CODE='0',CREDIT_CONFIRMATION_STATUS='1'WHERE USER_EMAIL='$email' AND USER_ID='$id' AND PRODUCT_NAME='$ProductName'";
	                    
	                    if (mysqli_query($conn, $UpdateConfirmationCode)) {
							  echo"CREDIT PAYMENT AUTHORISED BY: ".$email."<br>";
							  echo"CREDIT CONFIRMATION SET TO 1 FOR TRANSACTION ID $id"."<br>";
							  echo"FOR PRODUCT  $ProductName";

							} else {
							    echo "Error updating record: " . mysqli_error($conn);
							}

                            echo"<a href='index.php' id='link1'>Supplier</a>";
							mysqli_close($conn);
                            session_destroy();

 }




?>