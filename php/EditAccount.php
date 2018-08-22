<?php
/*
This script deals with management of all 
user accout from viewing, removing ,to updating 
*/

//Database connnection file

session_start();
include_once("conn2.php");
//Display all accounts

/*This is a sub part assocciated with activating and deleting accounts accounts*/

//This is part activates credit account
if(isset($_POST['ActivateSupplier'])){
$COMPANY_NAME=$_POST['COMPANY_NAME'];
$REGISTERD_AS=$_POST['REGISTERD_AS'];



 //Make query to database to update account to credit
 $UpadateToCredit="UPDATE useregistration SET ACTIVATION_STATUS='1' WHERE COMPANY_NAME='$COMPANY_NAME' AND REGISTERD_AS='$REGISTERD_AS'";
 



 if (mysqli_query($conn, $UpadateToCredit)) 
{
    //echo "Record updated successfully type changed from: ".$oldval."to ".$newVal;
    echo"<div class='alert alert-success'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>The account $COMPANY_NAME registerd as $REGISTERD_AS is activated </b>
 </div>";
} else {
    echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error updating record:  . mysqli_error($conn)</b>
 </div>";

    
}

mysqli_close($conn);
exit();
}


//This is part activates credit account
if(isset($_POST['ActivateCredit'])){
$COMPANY_NAME=$_POST['COMPANY_NAME'];
$REGISTERD_AS=$_POST['REGISTERD_AS'];
$CREDIT="CREDIT";

 //Make query to database to update account to credit
 $UpadateToCredit="UPDATE useregistration SET ACCOUNT_TYPE='$CREDIT',ACTIVATION_STATUS='1' WHERE COMPANY_NAME='$COMPANY_NAME' AND REGISTERD_AS='$REGISTERD_AS'";



 if (mysqli_query($conn, $UpadateToCredit)) 
{
    //echo "Record updated successfully type changed from: ".$oldval."to ".$newVal;
    echo"<div class='alert alert-success'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>The account $COMPANY_NAME registerd as $REGISTERD_AS activated as credit account</b>
 </div>";
} else {
    echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error updating record:  . mysqli_error($conn)</b>
 </div>";

    
}

mysqli_close($conn);
exit();
}



//This is part activates cash account
if(isset($_POST['ActivateCash'])){

$COMPANY_NAME=$_POST['COMPANY_NAME'];
$REGISTERD_AS=$_POST['REGISTERD_AS'];
$CASH="CASH";



 //Make query to database to update account to cash
 $UpadateToCash="UPDATE useregistration SET ACCOUNT_TYPE='$CASH',ACTIVATION_STATUS='1' WHERE COMPANY_NAME='$COMPANY_NAME' AND REGISTERD_AS='$REGISTERD_AS'";



 if (mysqli_query($conn, $UpadateToCash)) 
{
    //echo "Record updated successfully type changed from: ".$oldval."to ".$newVal;
    echo"<div class='alert alert-success'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>The account $COMPANY_NAME registerd as $REGISTERD_AS activated to cash account</b>
 </div>";
} else {
    echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error updating record:  . mysqli_error($conn)</b>
 </div>";

    
}

mysqli_close($conn);
 exit();
}


//This is part deletes account
if(isset($_POST['DeleteAccount'])){
$COMPANY_NAME=$_POST['COMPANY_NAME'];
$REGISTERD_AS=$_POST['REGISTERD_AS'];


$DeleteAccount="DELETE FROM useregistration WHERE COMPANY_NAME='$COMPANY_NAME' AND REGISTERD_AS='$REGISTERD_AS'";

if (mysqli_query($conn, $DeleteAccount)) 
{
    //echo "Record updated successfully type changed from: ".$oldval."to ".$newVal;
    echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>The account $COMPANY_NAME registerd as $REGISTERD_AS has been deleted</b>
 </div>";
} else {
    echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error updating record:  . mysqli_error($conn)</b>
 </div>";

    
}

mysqli_close($conn);

 exit();
}

?>