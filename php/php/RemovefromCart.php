<?php
session_start();
include_once("conn2.php");

$useremail=$_SESSION['EMAIL'];
$UserId=$_SESSION['UID'];
if(isset($_POST['RemoveItem'])&&isset($_POST['ItemToRemove']))
{

 $UserId;
 $ItemToRemove=$_POST['ItemToRemove'];
 //Perform a query to to delete

 $RemoveItem="DELETE FROM cart WHERE USER_ID='$UserId' AND PRODUCT_NAME='$ItemToRemove'";

 if (mysqli_query($conn,$RemoveItem)) {
    Echo"<div class='alert alert-success'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Item Removed '$ItemToRemove'</b>
 		   </div>";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
}

?>