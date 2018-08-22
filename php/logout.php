<?php




/*
log out script this will is responsiible for destroying session and deleting user from
userlog and recording them in userlogrecord table
*/

include_once("conn3.php");
session_start();

require "class.DetectDevice.php";//Check Device detail
$device = new DetectDevice();

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


#echo "This is the user ip: " .$UserIP. "  user device: ".$UserDevice;
#exit();

$ROLE=$_SESSION['ROLE'];//Var2 is used to query user based on role
$SUID= $_SESSION['UID'];//
$SEMAIL=$_SESSION['EMAIL'];//$SEMAIL is used to query user based on email

#Test stub
//echo $ROLE."</br>".$SEMAIL."</br>";


//Set Active use log out time
$update_query="UPDATE USERLOG SET LOGOUT_TIME=NOW() WHERE EMAIL='$SEMAIL'";
if ($conn->query($update_query) === TRUE) {
    echo "Record updated successfully \n";
} 
else {
    echo "Error updating record: " . $conn->error;
}

//Save Active user logged from userlog table to Userlogrecord
$SaveUSerQuery="SELECT*FROM USERLOG WHERE EMAIL='$SEMAIL'AND USER_ROLE='$ROLE'";
$result=mysqli_query($conn,$SaveUSerQuery);

if(mysqli_num_rows($result)>0)
{
	while($row = $result->fetch_assoc()) 
		 	{
								             //ASSIGN VALUES TO BE INSERTED INTO USERLOGRECORD
										 	 $RECOREDED_EMAIL=$row['EMAIL'];	
								             $RECOREDED_PASSWORD=$row['PASSWORD'];	
								             $RECOREDED_SESSION_ID=$row['SESSION_ID'];	
								             $RECOREDED_LOGIN_TIME=$row['LOGIN_TIME'];	
								             $RECOREDED_LOGOUT_TIME=$row['LOGOUT_TIME'];	
								             $RECOREDED_USER_ROLE=$row['USER_ROLE'];
								             echo "</br>";
								echo$RECOREDED_EMAIL."#".$RECOREDED_PASSWORD."#".$RECOREDED_SESSION_ID."#".$RECOREDED_LOGIN_TIME."#".$RECOREDED_LOGOUT_TIME."#". $RECOREDED_USER_ROLE."</br>";
								      
								             //Insert data into UserLogRecord table
								 /*$InsertUserlog="INSERT INTO user_log_records 
								 (EMAIL,
								  PASSWORD,
								  SESSION_ID,
								  LOGIN_TIME,
								  LOGOUT_TIME,
								  USER_ROLE ) 
								 VALUES(
								            EMAIL='$RECOREDED_EMAIL',
								            PASSWORD='$RECOREDED_PASSWORD',
								            SESSION_ID='$RECOREDED_SESSION_ID',
								            LOGIN_TIME='$RECOREDED_LOGIN_TIME',
								            LOGOUT_TIME='$RECOREDED_LOGOUT_TIME',
								            USER_ROLE='$RECOREDED_USER_ROLE')";*/

							$InsertUserlog="INSERT INTO USER_LOG_RECORDS (EMAIL,PASSWORD,SESSION_ID,LOGIN_TIME,LOGOUT_TIME,USER_ROLE) SELECT EMAIL,PASSWORD,SESSION_ID,LOGIN_TIME,LOGOUT_TIME,USER_ROLE  FROM USERLOG WHERE EMAIL='$RECOREDED_EMAIL'";	

								            //Run query to insert user logg information into userlogrecord table

		                                    if ($conn->query($InsertUserlog) === TRUE) 
								                {
												        echo "Data inserted successfully \n";
												        //Update USER_LOG_RECORDS with $UserIP & $UserDevice.

												
												    	$UpdateUSER_LOG_RECORDS="UPDATE USER_LOG_RECORDS SET USER_IP='$UserIP',DEVICE='$UserDevice' WHERE EMAIL='$SEMAIL'";
														if ($conn->query($UpdateUSER_LOG_RECORDS) === TRUE) 
														{
														echo "Logging out \n";
														} else 
														{
														echo "Error: " . $InesrtTosale2 . "<br>" . $conn->error;
														}

												} 
												else 
												{
												    echo "Error: " . $InsertUserlog . "<br>" . $conn->error;
												}
												           


			} 
             
         }
//Delete ACtive use from userlog table  
$DeleteUser="DELETE FROM USERLOG WHERE EMAIL='$SEMAIL'";
 if ($conn->query($DeleteUser) === TRUE) 
								                {
												    echo "Data deleted from userlog successfully"."</br>";
												} else 
												{
												    echo "Error: " . $InsertUserlog . "<br>" . $conn->error;
												}                                             



//unset session data
if(isset($_SESSION['ROLE'])&&isset($_SESSION['UID'])&&isset($_SESSION['EMAIL']))
{
   # echo "Session Data to be destroyed"."<br>".$_SESSION['ROLE']."<br>".$_SESSION['UID']
#."</br>".$_SESSION['EMAIL'];

unset($_SESSION['ROLE']);
unset($_SESSION['UID']);
unset($_SESSION['EMAIL']);

}
//Destroy session data

session_destroy();

$url="http://localhost:/pick2get/index.php";

echo $url;

header("location:http://localhost:/pick2get/index.php");




?>