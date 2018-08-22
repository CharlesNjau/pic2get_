<?php
/*
This code generates sale report

*/
//Generate sales tracking report
session_start();
include_once('conn2.php');
require "class.DetectDevice.php";//Check Device detail
$device = new DetectDevice();

$useremail=$_SESSION['EMAIL'];
$UserId=$_SESSION['UID'];

#Test  stub#
/*echo "This is the user email: ".$useremail." user ID is ".$UserId."\n"."<br>";
   $GeneratePurchaseOrder ="INSERT INTO  PurchaseOrderTable (HOTEL_EMAIL,PRODUCT_NAME,QUANTITY,UNIT,SUPPLIER_CATEGORY,PRODUCT_IMAGE)SELECT USER_EMAIL,PRODUCT_NAME,QUANTITY,UNIT,SUPPLIER_CATEGORY,PRODUCT_IMAGE  FROM cart WHERE USER_EMAIL='$useremail'";

						//run query  to up date table
						if($conn->query($GeneratePurchaseOrder) === TRUE){

						   echo "Cash transaction sent to purchase order"."<br>";	
			               
						}
			            else {
			             echo"Error Generating purchase order:  ".mysqli_error($conn);
			            }
exit();*/


$To=$useremail;/*
                    $Subject='CREDIT PAYMENT CONFIRMATION.';
                    $Hash=mysqli_real_escape_string($conn,password_hash($useremail, PASSWORD_DEFAULT));
                    //echo 'This is the hash value'.$Hash."<br>";
                   


					/*echo "This is the session id ".$useremail."</br>"."This is the session useremail ".$UserId."</br>";
					exit();*/

			           //Perform a query to to delete
			           
			            /*#Test stub#
			           echo  "This is the session id ".$useremail."</br>"."This is the session useremail ".$UserId."</br>";

			           exit();

			           $RemoveItem="SELECT * FROM cart WHERE USER_ID='$UserId'";
			           $result=mysqli_query($conn,$RemoveItem);

			          
			          if(mysqli_num_rows($result) > 0)
			          {  


			             $Total_price_of_goods=0;             
			             while($row = $result->fetch_assoc()) 
			              {
			                  $Image=$row['PRODUCT_IMAGE'];
			                  $product=$row['PRODUCT_NAME'];
			                  $unit=$row['UNIT'];
			                  $Price=$row['UNIT_PRICE'];
			                  $Available_goods=$row['QUANTITY'];
			                  $Total=$row['TOTAL'];

			                  
			                  $Total_Array=array($Total);
			                  $Total_sum=array_sum($Total_Array);
			                  $Total_price_of_goods=$Total_price_of_goods+$Total_sum;

			                  
			                 

			                 //onclick=getVal('".$product."')

			                      $message="Please click the link below to verify the credit payment for the follwing goods"
			                         ." \n ".$product."  ".$Available_goods." ".$unit." Unit Price ".$Price." Total: ".$Total."\n"."http://www.pick2get.com/php/ConfimrCreditTransAction.php?Email=$useremail";
					              $From='Do not reply Admin@Pick2get.com';
					                    //Send the email now
					              mail($To,$Subject,$message,$From);
					              

			                    

			                  
			                  
			              }
			             echo"Email sent to $useremail for payment confirmation";  

			          }*/
			         


                    //
                    
                

if(isset($_POST['PaymentMode3g']))
{
 
			 $PaymentMode=$_POST['PaymentMode3g'];

			 //echo $PaymentMode;



			 //Insert into sales by copying from cart

			 $UserIP="";
			 
			 $UserDevice="";
			//Get user IP Address
			 $UserIP = getenv('HTTP_CLIENT_IP')?:
			getenv('HTTP_X_FORWARDED_FOR')?:
			getenv('HTTP_X_FORWARDED')?:
			getenv('HTTP_FORWARDED_FOR')?:
			getenv('HTTP_FORWARDED')?:
			getenv('REMOTE_ADDR');




			$UserDevice=$device->getDeviceType();

			//Begin copying everything to the 

			/*
			formatt
			INSERT INTO archive_table(field1, field2, field3)
			SELECT field7, field8, field9 FROM original_table WHERE id = 1


			*/

			#echo "Payment: ".$PaymentMode."User device is: ".$UserDevice;
			#exit();





			$InesrtTosale ="INSERT INTO  sales (
			USER_ID,
			USER_EMAIL,
			AVAILABLE_AMOUNT,
			BALANCE_STOCK,
			PRODUCT_NAME,
			QUANTITY,
			UNIT,
			UNIT_PRICE,
			TOTAL,
			SUPPLIER_CATEGORY,
			PRODUCT_IMAGE

			)        
			SELECT USER_ID,USER_EMAIL,AVAILABLE_AMOUNT,BALANCE_STOCK,PRODUCT_NAME,QUANTITY,UNIT,UNIT_PRICE,TOTAL,SUPPLIER_CATEGORY,PRODUCT_IMAGE  FROM cart WHERE USER_EMAIL='$useremail'";

			//GeneratePurchaseOrder By Coping confirmed sale from sales table



			
			
			
			

			if ($conn->query($InesrtTosale) === TRUE) 
			{
			//echo "Data inserted successfully";
				    $InesrtTosale2="UPDATE sales SET PAYMENT_MODE='$PaymentMode',USER_IP='$UserIP',DEVICE='$UserDevice',3G_CONFIRMATION_STATUS='1' WHERE USER_EMAIL='$useremail'";
					if ($conn->query($InesrtTosale2) === TRUE) 
					{
					echo "3GTranaction processed successfully"."\n";


                     
						$GeneratePurchaseOrder ="INSERT INTO  PurchaseOrderTable (HOTEL_EMAIL,PRODUCT_NAME,QUANTITY,UNIT,SUPPLIER_CATEGORY,PRODUCT_IMAGE)SELECT USER_EMAIL,PRODUCT_NAME,QUANTITY,UNIT,SUPPLIER_CATEGORY,PRODUCT_IMAGE  FROM cart WHERE USER_EMAIL='$useremail'";

						//run query  to up date table
						if($conn->query($GeneratePurchaseOrder) === TRUE){

                           //UPDATE PURCHASEORDER RECORD TABLE WITH CLIENT_PAYMENT_METHOD TO VOID THE GHOST COLUMN PROBLEM
                            $CLIENT_PAYMENT_METHOD='CASH';
                           if(UpdatePurchaseOrderTable($useremail,$CLIENT_PAYMENT_METHOD)===true){
                           	  echo "Cash transaction sent to purchase order"."\n";
                             
                             exit();
                           }
                           	else if(UpdatePurchaseOrderTable($useremail,$CLIENT_PAYMENT_METHOD)===false){
                           		exit();
                               
                           	}
						   	
			               
						}
			            else {
			             echo"Error Generating purchase order".mysqli_error($conn);
			            }

					} else 
					{
					echo "Error: " . $InesrtTosale2 . "<br>" . $conn->error;
					}
				

					
			} else 
			{
			echo "Error: " . $InesrtTosale . "<br>" . $conn->error;
			}

}

if (isset($_POST['PaymentModeCredit']))
{
			 $PaymentMode=$_POST['PaymentMode'];

			 echo"This is the payement mode: ".$PaymentMode."\n";

			




			 //Insert into sales by copying from cart

			 $UserIP="";
			 
			 $UserDevice="";
			//Get user IP Address
			 $UserIP = getenv('HTTP_CLIENT_IP')?:
			getenv('HTTP_X_FORWARDED_FOR')?:
			getenv('HTTP_X_FORWARDED')?:
			getenv('HTTP_FORWARDED_FOR')?:
			getenv('HTTP_FORWARDED')?:
			getenv('REMOTE_ADDR');




			$UserDevice=$device->getDeviceType();

			//Begin copying everything to the 

			/*
			formatt
			INSERT INTO archive_table(field1, field2, field3)
			SELECT field7, field8, field9 FROM original_table WHERE id = 1


			*/

			#echo "Payment: ".$PaymentMode."User device is: ".$UserDevice;
			#exit();





			$InesrtTosale ="INSERT INTO  sales (
			USER_ID,
			USER_EMAIL,
			AVAILABLE_AMOUNT,
			BALANCE_STOCK,
			PRODUCT_NAME,
			QUANTITY,
			UNIT,
			UNIT_PRICE,
			TOTAL,
			SUPPLIER_CATEGORY,
			PRODUCT_IMAGE

			)        
			SELECT USER_ID,USER_EMAIL,AVAILABLE_AMOUNT,BALANCE_STOCK,PRODUCT_NAME,QUANTITY,UNIT,UNIT_PRICE,TOTAL,SUPPLIER_CATEGORY,PRODUCT_IMAGE  FROM cart WHERE USER_EMAIL='$useremail'";






			if ($conn->query($InesrtTosale) === TRUE) 
			{
			//echo "Data inserted successfully";
				    $InesrtTosale2="UPDATE sales SET PAYMENT_MODE='$PaymentMode',USER_IP='$UserIP',DEVICE='$UserDevice' WHERE USER_EMAIL='$useremail'";
					if ($conn->query($InesrtTosale2) === TRUE) 
					{
					echo "Waiting for email confirmation of payment"."\n";
					//This is were an email will be sent to the client to confirm credit payment
					    //GeneratePurchaseOrder By Coping confirmed sale from sales table


						$GeneratePurchaseOrder ="INSERT INTO  PurchaseOrderTable (HOTEL_EMAIL,PRODUCT_NAME,QUANTITY,UNIT,SUPPLIER_CATEGORY,PRODUCT_IMAGE)SELECT USER_EMAIL,PRODUCT_NAME,QUANTITY,UNIT,SUPPLIER_CATEGORY,PRODUCT_IMAGE  FROM cart WHERE USER_EMAIL='$useremail'";

						//run query  to up date table
						if($conn->query($GeneratePurchaseOrder) === TRUE){

						  
						   //UPDATE PURCHASEORDER RECORD TABLE WITH CLIENT_PAYMENT_METHOD TO VOID THE GHOST COLUMN PROBLEM
                            $CLIENT_PAYMENT_METHOD='CREDIT';
                           if(UpdatePurchaseOrderTable($useremail,$CLIENT_PAYMENT_METHOD)===true){
                             echo "Credit transaction sent to purchase order"."\n";	
                             exit();
                           }
                           	else if(UpdatePurchaseOrderTable($useremail,$CLIENT_PAYMENT_METHOD)===false){
                           		exit();
                               
                           	}
			               
						}
			            else {
			             echo"Error Generating purchase order:  ".mysqli_error($conn);
			            }

					



					$ConfirmPaymentCode=rand();
					//Update confirmation code to the sales table before emailing
                    $UpdateConfirmationCode="UPDATE sales SET CONFIRMATION_CODE='$ConfirmPaymentCode' WHERE  USER_EMAIL='$useremail' AND USER_ID='$UserId' ";
	                    if($conn->query($UpdateConfirmationCode) === TRUE)
	                    {
                           echo"Record updated successfully!"."\n";
	                    }
	                    else
	                    {
	                       echo"Error ".mysql_error();
	                    }
                      $SendItemToEmail="SELECT * FROM cart WHERE USER_ID='$UserId'";
			          $result=mysqli_query($conn,$SendItemToEmail);

			          
			          if(mysqli_num_rows($result) > 0)
			          {  


			             $Total_price_of_goods=0;             
			             while($row = $result->fetch_assoc()) 
			              {
			                  $TransactionId=$row['ID'];
			                  $Image=$row['PRODUCT_IMAGE'];
			                  $product=urlencode($row['PRODUCT_NAME']);
			                  $unit=$row['UNIT'];
			                  $Price=$row['UNIT_PRICE'];
			                  $Available_goods=$row['QUANTITY'];
			                  $Total=$row['TOTAL'];

			                  
			                  $Total_Array=array($Total);
			                  $Total_sum=array_sum($Total_Array);
			                  $Total_price_of_goods=$Total_price_of_goods+$Total_sum;

			                  
			                 

			                 //onclick=getVal('".$product."')

			              $message="Please click the link below to verify the credit payment for the follwing goods"
			                    ." \n ".$TransactionId.$product."  ".$Available_goods." ".$unit." Unit Price ".$Price." Total: ".$Total."\n"."http://www.pick2get.com/php/ConfimrCreditTransAction.php?Email=$useremail&Id=$UserId&Product=$product";
					              $From='Do not reply Admin@Pick2get.com';
					                    //Send the email now
					              /*Strictly for testing should be deleted when done*/
					              echo $message."\n";
					              mail($To,$Subject,$message,$From);
					              

			                    

			                  
			                  
			              }
			             echo"Email sent to $useremail with id $UserId for payment confirmation"."\n";  

			          }


					} 
					else 
					{
					echo "Error: " . $InesrtTosale2 . "<br>" . $conn->error;
					}
				

					
			} 
			
			else 
			{
			echo "Error: " . $InesrtTosale . "<br>" . $conn->error;
			}
			//





}
/*
This function updates the PurchaseOrderTable with CLIENT_PAYMENT_METHOD
and the reason of doing so it elimante the ghost values resulting from using 
temporary tables from joins 
*/

function UpdatePurchaseOrderTable($useremail,$CLIENT_PAYMENT_METHOD)
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


	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "UPDATE PurchaseOrderTable SET CLIENT_PAYMENT_METHOD='$CLIENT_PAYMENT_METHOD' WHERE HOTEL_EMAIL='$useremail'";

	if ($conn->query($sql) === TRUE) {
	  return true;
	} else {
	    
	    return false;
	}

	$conn->close();



}



?>