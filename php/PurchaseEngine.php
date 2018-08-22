<?php
session_start();
/*
Purchase record Management this os the script for getting price and total from table
*/

include_once("conn2.php");

//Global variables

//Sanitise and validate User Data


$useremail=$_SESSION['EMAIL'];
$UserId=$_SESSION['UID'];



//validation variable

$number="/^[0-9]+$/";
$string="/^[a-zA-Z ]*$/";

//Validation start

/*if(empty($Quantity)){
Echo
"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Cant Submit an empty cart</b>
 </div>";
 exit();
}

if(is_nan($Quantity)===false){
"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Please fill in the Fields</b>
 </div>";
 exit();
}*/
//Remove from cart php code block


//insert into Cart values
if(isset($Price)||isset($ProductName)||isset($AmountPresent)||isset($unit)||isset($Quantity)||isset($AmountRemaining)||isset($Total)||isset($useremai)||isset($UserId))
{

$Price=mysqli_real_escape_string($conn,$_POST['Price']);//int
$ProductName=mysqli_real_escape_string($conn,$_POST['ProductName']);//String
$AmountPresent=mysqli_real_escape_string($conn,$_POST['AmountPresent']);//int
$unit=mysqli_real_escape_string($conn,$_POST['unit']);//string
$Quantity=mysqli_real_escape_string($conn,$_POST['Quantity']);//int
$AmountRemaining=mysqli_real_escape_string($conn,$_POST['AmountRemaining']);//Amount remaining after purchase
$Total=mysqli_real_escape_string($conn,$_POST['Total']);//Calculate Total in Tsh//int
$SupplierCategory=mysqli_real_escape_string($conn,$_POST['SupplierCategory']);//Supplier category value to be passed to sales and PurchaseOrderTable for sorting items category wise
$Image=mysqli_real_escape_string($conn,$_POST['Image']);//Product image name



 //UPDATE CART WITH PRODUCT IMAGE



//Perform query insertion
 $AddToCart="INSERT INTO cart (USER_ID,USER_EMAIL,AVAILABLE_AMOUNT,	BALANCE_STOCK,PRODUCT_NAME,QUANTITY,UNIT,UNIT_PRICE,TOTAL,SUPPLIER_CATEGORY,PRODUCT_IMAGE) VALUES(
         '$UserId',
         '$useremail',
         '$AmountPresent',
         '$AmountRemaining',
         '$ProductName',
         '$Quantity',
         '$unit',
         '$Price',
         '$Total',
         '$SupplierCategory',
         '$Image')";
    if ($conn->query($AddToCart) === TRUE) {

   	
     
      Echo"<div class='alert alert-success'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Goods Added To cart Are.'$ProductName'.'</BR>'.
'Price: '.'$Price'.'</BR>'.'Quantity: '.'$Quantity'.'$unit'.'<br>'.'Total Price'.'$Total'.'</b>'</b>
 		   </div>";

	} 
	else {
    Echo"<div class='alert alert-success'>
         <a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error adding goods to cart</b>
        </div>".mysqli_error($conn);
	}

    mysqli_close($conn);
 	exit();
	

}







































//Reset Quantity to zero $_POST['QtyReset']
if(isset($_POST['QtyReset']))
{

   $reset=$_POST['QtyReset'];
   $resetQuery="UPDATE  CART ()";	
   


   echo  "Product reset to: ".$reset;



}

if(isset($_POST['data'])||isset($_POST['ProductQuantity'])||isset($_POST['name']))
{
	
    $name=$_POST['name'];
	$Quantity=$_POST['ProductQuantity'];
	$qty=json_decode($Quantity,true);

	echo "This quantity from PurchaseEngine: ".$qty;
	
	$Productname=$_POST['data'];
	$PNAME=json_decode($Productname,true);
//
echo "This from PurchaseEngine: ".$PNAME;
//Begin By sending Data to the Product table
exit();
	$GetPrice="SELECT * FROM products WHERE PRODUCT_NAME='".$PNAME."'";
	$result=mysqli_query($conn,$GetPrice);

	if(mysqli_num_rows($result) > 0)
    {
       		while($row = $result->fetch_assoc()) 
		    {
		        
		        $price=$row['PRICE/UNIT'];
		        echo "This from PurchaseEngine: ".$price;
		    }
		    $price;
		    //Add to this to Mini Cart

		    //$SendToMiniCart="INSERT INTO mini_cart "
    } 
    else
    {
      echo "Error fetching Data";
    }

}
else
{
	Echo "Error fetching data";
}


//function 


?>