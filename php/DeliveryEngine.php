<?php

session_start();
include_once('conn2.php');
//super Global variable
$SUPPLIER_CATEGORY= $_SESSION['SUPPLIER_CATEGORY'];
$REGISTERD_AS=$_SESSION['ROLE'];
$NAME_OF_COMPANY=$_SESSION['COMPANY_NAME'];
$CATEGORY_OF_SUPPLIER=$_SESSION['SUPPLIER_CATEGORY'];
$EMAIL=$_SESSION['EMAIL'];
$GLOBALS['COMPANY_NAME'];
$ITEM_COUNT=$_SESSION['COUNT_VAL'];
$ACCOUNT_TYPE=$_SESSION['ACCOUNT_TYPE'];

//Accepted delivery
if(isset($_POST['ConfirmItemDeliverd']))
{
  //tEST STUB
	$COMPANY_NAME=$_POST['COMPANY_NAME'];
	$PRODUCT_NAME=$_POST['PRODUCT_NAME'];
	$PRODUCT_IMAGE=$_POST['PRODUCT_IMAGE'];
	$QUANTITY=$_POST['QUANTITY'];
	$UNIT=$_POST['UNIT'];
	$PRICE_PER_UNIT=$_POST['PRICE_PER_UNIT'];
	$PAYMENT_APPROVAL_STATUS=$_POST['PAYMENT_APPROVAL_STATUS'];
	$TOTAL_PRICE=$_POST['TOTAL_PRICE'];
	$FROM_CLIENT=$_POST['FROM_CLIENT'];
	$DELIVERY_STATUS=$_POST['DELIVERY_STATUS'];
	$REMARKS=$_POST['REMARKS'];

	echo "DELIVERY_STATUS: ".$DELIVERY_STATUS."<BR>"." PRODUCT_NAME: ".$PRODUCT_NAME."<BR>";
    //
	//CHECK DUPLICATE
    if (CheckDuplicateEntry($COMPANY_NAME,$PRODUCT_NAME,$QUANTITY,$PRICE_PER_UNIT,$FROM_CLIENT,$TOTAL_PRICE,$DELIVERY_STATUS,$REMARKS)===true) {
    	# code...
    	exit();
    } else if(CheckDuplicateEntry($COMPANY_NAME,$PRODUCT_NAME,$QUANTITY,$PRICE_PER_UNIT,$FROM_CLIENT,$TOTAL_PRICE,$DELIVERY_STATUS,$REMARKS)===false) {
    	# code...
    	$CONFIRM="INSERT INTO DeliveryRecord (
    COMPANY_NAME,
	PRODUCT_NAME,
	PRODUCT_IMAGE,
	QUANTITY,
	UNIT,
	PRICE_PER_UNIT,
	PAYMENT_APPROVAL_STATUS,
	TOTAL_PRICE,
	FROM_CLIENT,
	DELIVERY_STATUS,
	REMARKS)
    VALUES (
            '$COMPANY_NAME',
	        '$PRODUCT_NAME',
	        '$PRODUCT_IMAGE',
	        '$QUANTITY',
	        '$UNIT',
	        '$PRICE_PER_UNIT',
	        '$PAYMENT_APPROVAL_STATUS',
	        '$TOTAL_PRICE',
	        '$FROM_CLIENT',
	        '$DELIVERY_STATUS',
	        '$REMARKS')";

	if (mysqli_query($conn, $CONFIRM))
	{
	    echo "DELIVERY ACCEPETED";
	    RecordedConfirmedPurchaseList($COMPANY_NAME,$PRODUCT_NAME);
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
    }

    
	
} 
//Rected delivery
if(isset($_POST['RejectItemDeliverd']))
{ 
	//tEST STUB
	$COMPANY_NAME=$_POST['COMPANY_NAME'];
	$PRODUCT_NAME=$_POST['PRODUCT_NAME'];
	$PRODUCT_IMAGE=$_POST['PRODUCT_IMAGE'];
	$QUANTITY=$_POST['QUANTITY'];
	$UNIT=$_POST['UNIT'];
	$PRICE_PER_UNIT=$_POST['PRICE_PER_UNIT'];
	$PAYMENT_APPROVAL_STATUS=$_POST['PAYMENT_APPROVAL_STATUS'];
	$TOTAL_PRICE=$_POST['TOTAL_PRICE'];
	$FROM_CLIENT=$_POST['FROM_CLIENT'];
	$DELIVERY_STATUS=$_POST['DELIVERY_STATUS'];
	$REMARKS=$_POST['REMARKS'];
	
	echo "DELIVERY_STATUS: ".$DELIVERY_STATUS."<BR>"." PRODUCT_NAME: ".$PRODUCT_NAME."<BR>";

	//CHECK DUPLICATE
    if (CheckDuplicateEntry($COMPANY_NAME,$PRODUCT_NAME,$QUANTITY,$PRICE_PER_UNIT,$FROM_CLIENT,$TOTAL_PRICE,$DELIVERY_STATUS,$REMARKS)===true) {

    	exit();
    } else if(CheckDuplicateEntry($COMPANY_NAME,$PRODUCT_NAME,$QUANTITY,$PRICE_PER_UNIT,$FROM_CLIENT,$TOTAL_PRICE,$DELIVERY_STATUS,$REMARKS)===false) {
    	# code...
    	$REJECT="INSERT INTO DeliveryRecord (
    COMPANY_NAME,
	PRODUCT_NAME,
	PRODUCT_IMAGE,
	QUANTITY,
	UNIT,
	PRICE_PER_UNIT,
	PAYMENT_APPROVAL_STATUS,
	TOTAL_PRICE,
	FROM_CLIENT,
	DELIVERY_STATUS,
	REMARKS)
    VALUES (
            '$COMPANY_NAME',
	        '$PRODUCT_NAME',
	        '$PRODUCT_IMAGE',
	        '$QUANTITY',
	        '$UNIT',
	        '$PRICE_PER_UNIT',
	        '$PAYMENT_APPROVAL_STATUS',
	        '$TOTAL_PRICE',
	        '$FROM_CLIENT',
	        '$DELIVERY_STATUS',
	        '$REMARKS')";
	if (mysqli_query($conn, $REJECT))
	{
	    echo "DELIVERY REJECTED";
	    RecordedConfirmedPurchaseList($COMPANY_NAME,$PRODUCT_NAME);
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);

    }
    


	

	

}

//CHECK DUPLICATE FUNCTION

function CheckDuplicateEntry($COMPANY_NAME,$PRODUCT_NAME,$QUANTITY,$PRICE_PER_UNIT,$FROM_CLIENT,$TOTAL_PRICE,$DELIVERY_STATUS,$REMARKS){


define("DB_SERVER", "195.8.222.39");
define("DB_USER", "pick2get");
define("DB_PASSWORD", "3DZX5J8k");
define("DB_DATABASE", "pick2get");


$servername = "localhost";
$username = "pick2get";
$password = "3DZX5J8k";
$dbname = "pick2get_pick2get";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);



  $CheckDuplicate="SELECT * FROM DeliveryRecord WHERE COMPANY_NAME='$COMPANY_NAME'  AND FROM_CLIENT='$FROM_CLIENT' AND TOTAL_PRICE='$TOTAL_PRICE' AND PAYMENT_APPROVAL_STATUS='$PAYMENT_APPROVAL_STATUS' AND PRODUCT_NAME='$PRODUCT_NAME' AND QUANTITY='$QUANTITY' AND PRICE_PER_UNIT='PRICE_PER_UNIT' AND DELIVERY_STATUS='$DELIVERY_STATUS' AND REMARKS='$REMARKS' ";

  $DuplicateResult=mysqli_query($conn,$CheckDuplicate);

  
  if(mysqli_num_rows($DuplicateResult) >0)
           { 
              $FROM_CLIENT=$row['FROM_CLIENT'];
              $PRODUCT_NAME=$row['PRODUCT_NAME'];
              $DELIVERY_STATUS=$row['DELIVERY_STATUS'];
              echo"ALREADY CHECKED  AS: ".$DELIVERY_STATUS."FOR ORDER OF HOTEL_EMAIL: ".$FROM_CLIENT."  FOR PRODUCT NAME: ".$PRODUCT_NAME."<br>";

            return true;

           }
            else{
              return false;
            }
    

}

//function update the  RecordedConfirmedPurchaseList

function  RecordedConfirmedPurchaseList($COMPANY_NAME,$PRODUCT_NAME)
{

define("DB_SERVER", "195.8.222.39");
define("DB_USER", "pick2get");
define("DB_PASSWORD", "3DZX5J8k");
define("DB_DATABASE", "pick2get");


$servername = "localhost";
$username = "pick2get";
$password = "3DZX5J8k";
$dbname = "pick2get_pick2get";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

 date_default_timezone_set('EAC');
 $today = date("F j, Y, g:i a");


$sql = "UPDATE RecordedConfirmedPurchaseList SET DELIVERY_STATUS_TO_US='DELIVERD',DELIVERD_TO_US_ON='$today' WHERE COMPANY_NAME='COMPANY_NAME' HAVING PRODUCT_NAME='$PRODUCT_NAME'";

if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
    return true;
} else {
    echo "Error updating record: " . mysqli_error($conn);
    return false;
}

mysqli_close($conn);


} 



?>