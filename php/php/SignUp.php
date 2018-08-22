<?php
//include_once(conn.php);
//SignUp(Registration) written 5/19/2017

//servername varable
$servername = "localhost";
$username = "root";
$password = "";


 


//Variable
//$name="/^[A-Za-z]{20}/";
//$emailValidation="/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/";
$num="/^[0-9]+$/";
$CompanyName=$_POST['cpny_name'];
$Email=$_POST['email'];
$Password=$_POST['pswd1'];
//$Password2=$_POST['pswd2'];
$RegisterdAs=$_POST['rgstr'];

//validate user

if(empty($CompanyName)||empty($Email)||empty($Password)||empty($RegisterdAs))
{
 
 Echo
"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Please fill in the Fields</b>
 </div>";
 exit();

}

if(!preg_match("/^[a-zA-Z ]*$/",$CompanyName)){
  echo
  "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>The name entered is not valid!</b>
 </div>";
  exit();

}

if(!filter_var($Email, FILTER_VALIDATE_EMAIL)){

	echo
  "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>The email entered is not valid!</b>
 </div>";
  exit();

}


if(empty($RegisterdAs)===true){
	echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Please Choose Type of registration</b>
 </div>";
  exit();
}

//Hash password from $Password
$Hash=password_hash($Password, PASSWORD_DEFAULT);
$RegisterdAs=$_POST['rgstr'];
//SQl insert
try {
	    $conn = new PDO("mysql:host=$servername;dbname=pick2get", $username, $password);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "INSERT INTO useregistration (COMPANY_NAME,EMAIL,PASSWORD,REGISTERD_AS)
	    VALUES ('$CompanyName','$Email','$Hash','$RegisterdAs')";
	    // use exec() because no results are returned
	    $conn->exec($sql);

	    echo "<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>New record created successfully Awaiting Account Activation</b>
 </div>";


	    
    }
catch(PDOException $e)
    {
     echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

?>