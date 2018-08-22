<?php
//login process and session
include_once("conn3.php"); 
session_start();
//$sql2="INSERT INTO USERLOG";
$email=mysqli_real_escape_string($conn,$_POST['email']);////
$password=mysqli_real_escape_string($conn,$_POST['pswd']);////
$Hash=password_hash($password, PASSWORD_DEFAULT);
$logas=mysqli_real_escape_string($conn,$_POST['logas']);////
//$_SESSION['name']="Charles";
//echo $email.""."</br>".$Hash."</br>";

//echo $logas;
/*#Test stub
$string='http://localhost/CCWeb/Admin.php';

echo $string;
exit();*/ 

//echo $_SESSION['ROLE'];

/*Test stub
$var2= $_SESSION['ROLE']; 
 echo $password;
 echo "</br>"; 
 echo $Hash;
 echo "</br>"; 
 echo $var2;
 echo "</br>"; 
 echo $email;
 exit();1###*/


 
 			            //perform all page re direction here
					           
					             
		

					           

//Validate user

if(empty($email)||empty($password)||empty($logas))
{
 
 echo "1";
 


 exit();

}


if(!filter_var($email, FILTER_VALIDATE_EMAIL))
{
 echo"2";
 exit();
	
}


//Check user in Database in table useregistration

$sql = "SELECT * FROM useregistration WHERE email='$email'AND REGISTERD_AS='$logas'";

$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
	//Fetch detail from usereregistration and send them to userlog table
    while($row = $result->fetch_assoc()) 
    {

    	$UserEmail=$row['EMAIL'];
    	$UserPassword=$row['PASSWORD'];
    	$ID=$row['ID'];
    	$name=$row['COMPANY_NAME'];
        $loggedAs=$row["REGISTERD_AS"];
        $_SESSION['ACCOUNT_TYPE']=$row['ACCOUNT_TYPE'];
        $_SESSION['SUPPLIER_CATEGORY']=$row['SUPPLIER_CATEGORY'];
        $_SESSION['COMPANY_NAME']=$name;
        


        //Now lets use this detail to send to our userlog table

       // echo json_encode($loggedAs);
       
        
		/*
		  Now set User session by checking if the user is aleady registered
		  in userlog table if not register then assign session if already logged prompt
		  user that he/she is already logged
		*/	
            $GetData="SELECT *FROM USERLOG WHERE EMAIL='$UserEmail'";
       		$result2 = $conn->query($GetData);
	        	if( $result2->num_rows > 0)
	        	{
	            
	            $Userloged=$row['EMAIL'];
	            $AlertMsg="3";//redirect to ajax
                //echo "\n";
	            echo $AlertMsg;



	           // echo json_encode($Userloged);

		        } 
		        if($result2->num_rows < 1)//if no user logged in userlog table insert them in table
		        {
                    //Insert user logg detail
		        	$logUser="INSERT INTO USERLOG(EMAIL,PASSWORD,SESSION_ID,USER_ROLE)VALUES('$UserEmail','$UserPassword','$ID','$loggedAs')";
	        	    if ($conn->query($logUser) === TRUE) 
	        	    {
				    $success="New user logged successfully";
				    //echo"\n";
				    //echo json_encode($success);
				    //echo"\n";
				    //ewfnwlnefwkenfkwenf
				  	}

	           }
	                $fetchUser="SELECT *FROM USERLOG WHERE EMAIL='$UserEmail'";
       		        $result3 = $conn->query($fetchUser);
		        	if( $result3->num_rows > 0)//Once inserted in userlog table set session
		        	{
						while($row = $result3->fetch_assoc())
						        {
					            $SessoniEmail=$row['EMAIL'];
					            $SessionID=$row['ID'];
					            $SessionRole=$row['USER_ROLE'];
					            $LoginTime=$row['LOGIN_TIME'];
					            //set session
					            $_SESSION['EMAIL']=$SessoniEmail;
					            $_SESSION['UID']=$SessionID;
					            $_SESSION['ROLE']=$SessionRole;
					            $_SESSION['LOGINTIME']=$SessionRole;
					            
					            $var2=$_SESSION['ROLE'];//Perform route here
                                $SUID= $_SESSION['UID'];//
                                $SEMAIL=$_SESSION['EMAIL'];

                                //echo $SEMAIL."</br>";
                                //echo $var2."</br>";
                                

                          
                                


                                 if($var2=='Hotel')
                                 {
                                     $string='http://localhost:/pick2get/Hotel Client.php';
                                     echo "$string";


                                 }
                                 if($var2=='Supplier')
                                 {
                                     $string='http://localhost:/pick2get/Supplier.php';
                                    echo "$string";

                                 }
                                 if($var2=='Admin')
                                 {
                                 	$string='http://localhost:/pick2get/Admin.php';

                                 	echo "$string";
                                    //echo json_encode($string);

                                 }




					           

						        }
								//echo 
				    }
				    else
				    {
				    	$errormsg="Error in assisg session";
				    	echo json_encode($errormsg);
				    }	
		
} 

}
else
{
 echo $warning="http://localhost:/pick2get/ErrorPage.php";
 //echo"This account is not registed please register or contact the admin!";
 exit();
}
    
$conn->close();//
?>


