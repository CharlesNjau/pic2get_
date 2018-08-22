<?php
include_once("conn2.php");
//SignUp(Registration) written 5/19/2017

//Variable
$name="/^[A-Za-z]{20}/";
$emailValidation="/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/";
$num="/^[0-9]+$/";
$CompanyName=mysqli_real_escape_string($conn,$_POST['cpny_name']);//
$Email=mysqli_real_escape_string($conn,$_POST['email']);//
$Password=mysqli_real_escape_string($conn,$_POST['pswd1']);//$_POST['pswd1']
$RegisterdAs=$_POST['rgstr'];//"Supplier";
$SupplierCategory=mysqli_real_escape_string($conn,$_POST['SupplierCtgry']);


//validate user


if(empty($CompanyName)||empty($Email)||empty($Password)||empty($RegisterdAs))
{
 

 echo "1";
 exit();

}

if(!preg_match("/^[a-zA-Z ]*$/",$CompanyName)){
 echo "2";
 exit();

}

if(!filter_var($Email, FILTER_VALIDATE_EMAIL)){

 echo "3";
 exit();

}


if(empty($RegisterdAs)===true){
 echo "4";
 exit();
}

//Hash password from $Password
$Hash=password_hash($Password, PASSWORD_DEFAULT);


//SQl insert

    $query="INSERT INTO useregistration (COMPANY_NAME,EMAIL,PASSWORD,REGISTERD_AS,SUPPLIER_CATEGORY)#ADD supplier category
	    VALUES ('$CompanyName','$Email','$Hash','$RegisterdAs','$SupplierCategory')";

	    if ($conn->query($query) === TRUE)
	    {
    		 $Errormsg="<div class='alert alert-warning'><a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b></b>Your Account has been registerd</div>";
    		echo $Errormsg ;
		} else 
		{
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();

?>