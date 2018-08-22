<?php

/*
 This script will display Goods in According to the Buttom pressed
*/
session_start();
 /*
This is the session data to be passed to the EditImage.php (page)
which are the product name and image name
*/

//$_SESSION['imagename'];
//Call databse connection
include_once('conn2.php');
//Script for selecting all products

if(isset($_GET['AllProducts'])){

/*
This block of code here displays table content the ability to edit them
*/
$GetAllProduct="select * from Products";


$result=mysqli_query($conn,$GetAllProduct);

echo'<br>'."
<span id='feedback'></span>
<form id='tableform' action='php/editimage.php' method='post' enctype='multipart/form-data'>
<table class='table'>
       <tbody>
       <thead>
           <td><B>PRODUCT ID</B></td>
           <td><B>TYPE</B></td>
           <td><B>ITEM GROUP</B></td>
           <td><B>PRODUCT NAME</B></td>
           <td><B>PRODUCT IMAGE</B></td>
           <td><B>UNIT</B></td>
           <td><B>QUANTITY</B></td>
           <td><B>PRICE PER UNIT</B></td>
           <td><B>EDIT IMAGE</B></td>
           
           <td><B>DELETE</B></td>

       </thead>
";
if(mysqli_num_rows($result) > 0)
{  


    
   while($row = $result->fetch_assoc()) 
    {
         $Id=$row['PRODUCT_ID'];
         $Type=$row['TYPE'];
         $Item=$row['ITEM_GROUP'];
         $ProductName=$row['PRODUCT_NAME'];
         $ProductImage=$row['PRODUCT_IMAGE'];
         $Unit=$row['UNIT'];
         $Quantity=$row['QUANTITY'];
         $PricePerUnit=$row['PRICE_PER_UNIT'];


         
          echo"<tr>
         <td>$Id</td>
         <td contenteditable='true' id='Type' Type='$Type' ProductName='$ProductName'>$Type</td>
         <td contenteditable='true' id='Item' Item='$Item'  ProductName='$ProductName'>$Item</td>
         <td contenteditable='true' id='ProductName' ProductName='$ProductName' >$ProductName</td>
         <td><img src='http://pick2get.com/Asset/image/$ProductImage'style='width:30px' style='width:30px' ></td>
         <td contenteditable='true' id='Unit' Unit='$Unit' ProductName='$ProductName'>$Unit</td>
         <td contenteditable='true' id='Quantity'Quantity='$Quantity' ProductName='$ProductName'>$Quantity</td>
         <td contenteditable='true' id='PricePerUnit' PricePerUnit='$PricePerUnit' ProductName='$ProductName'>$PricePerUnit</td>
         <td><input type='button' id='ImageUpdate' ImageName='$ProductImage' ProductName='$ProductName' class='btn btn-info' value='EDIT IMAGE'></td>
          
         <td><input type='button' id='deleteItem' ImageName='$ProductImage' ProductName='$ProductName' class='btn btn-info' value='DELETE'></td>

        </tr>";

        
        
    }
     echo" </tbody>
                        </table>
                        </form>
                        ";
  

}
else 
{
    
echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error Fetching Data</b>
 </div>";
}

}

//Script for selecting dry goods
if(isset($_GET['DryGoods'])){
/*
This block of code here displays table content 
the ability to edit them for dry goods
*/

$getFruitsAndVegie="SELECT * FROM  Products WHERE TYPE='Dry Goods'";

$result=mysqli_query($conn,$getFruitsAndVegie);

echo'<br>'."
<span id='feedback'></span>
<form id='tableform' action='php/editimage.php' method='post' enctype='multipart/form-data'>
<table class='table'>
       <tbody>
       <thead>
           <td><B>PRODUCT ID</B></td>
           <td><B>TYPE</B></td>
           <td><B>ITEM GROUP</B></td>
           <td><B>PRODUCT NAME</B></td>
           <td><B>PRODUCT IMAGE</B></td>
           <td><B>UNIT</B></td>
           <td><B>QUANTITY</B></td>
           <td><B>PRICE PER UNIT</B></td>
           <td><B>EDIT IMAGE</B></td>
           
           <td><B>DELETE</B></td>

       </thead>
";
if(mysqli_num_rows($result) > 0)
{  


    
   while($row = $result->fetch_assoc()) 
    {
         $Id=$row['PRODUCT_ID'];
         $Type=$row['TYPE'];
         $Item=$row['ITEM_GROUP'];
         $ProductName=$row['PRODUCT_NAME'];
         $ProductImage=$row['PRODUCT_IMAGE'];
         $Unit=$row['UNIT'];
         $Quantity=$row['QUANTITY'];
         $PricePerUnit=$row['PRICE_PER_UNIT'];


         
           echo"<tr>
         <td>$Id</td>
         <td contenteditable='true' id='Type' Type='$Type'  ProductName='$ProductName'>$Type</td>
         <td contenteditable='true' id='Item' Item='$Item'  ProductName='$ProductName'>$Item</td>
         <td contenteditable='true' id='ProductName' ProductName='$ProductName' >$ProductName</td>
         <td><img src='http://pick2get.com/Asset/image/$ProductImage'style='width:30px' style='width:30px' ></td>
         <td contenteditable='true' id='Unit' Unit='$Unit' ProductName='$ProductName'>$Unit</td>
         <td contenteditable='true' id='Quantity'Quantity='$Quantity' ProductName='$ProductName'>$Quantity</td>
         <td contenteditable='true' id='PricePerUnit' PricePerUnit='$PricePerUnit' ProductName='$ProductName'>$PricePerUnit</td>
         <td><input type='button' id='ImageUpdate' ImageName='$ProductImage' ProductName='$ProductName' class='btn btn-info' value='EDIT IMAGE'></td>
          
         <td><input type='button' id='deleteItem' ImageName='$ProductImage' ProductName='$ProductName' class='btn btn-info' value='DELETE'></td>

        </tr>";

        
        
    }
     echo" </tbody>
                        </table>
                        </form>
                        ";
  

}
else 
{
    
echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error Fetching Data</b>
 </div>";
}

exit();
}

//Script for selecting Perishable Goods
if(isset($_GET['Perishable'])){
/*
This block of code here displays table content 
the ability to edit them for Perishable
*/
$getFruitsAndVegie="SELECT * FROM  Products WHERE ITEM_GROUP='Seafood'OR ITEM_GROUP='Meats'" ;

$result=mysqli_query($conn,$getFruitsAndVegie);



echo'<br>'."
<span id='feedback'></span>
<form id='tableform' action='php/editimage.php' method='post' enctype='multipart/form-data'>
<table class='table'>
       <tbody>
       <thead>
           <td><B>PRODUCT ID</B></td>
           <td><B>TYPE</B></td>
           <td><B>ITEM GROUP</B></td>
           <td><B>PRODUCT NAME</B></td>
           <td><B>PRODUCT IMAGE</B></td>
           <td><B>UNIT</B></td>
           <td><B>QUANTITY</B></td>
           <td><B>PRICE PER UNIT</B></td>
           <td><B>EDIT IMAGE</B></td>
           
           <td><B>DELETE</B></td>

       </thead>
";
if(mysqli_num_rows($result) > 0)
{  


    
   while($row = $result->fetch_assoc()) 
    {
         $Id=$row['PRODUCT_ID'];
         $Type=$row['TYPE'];
         $Item=$row['ITEM_GROUP'];
         $ProductName=$row['PRODUCT_NAME'];
         $ProductImage=$row['PRODUCT_IMAGE'];
         $Unit=$row['UNIT'];
         $Quantity=$row['QUANTITY'];
         $PricePerUnit=$row['PRICE_PER_UNIT'];


        
         echo"<tr>
         <td>$Id</td>
         <td contenteditable='true' id='Type' Type='$Type'  ProductName='$ProductName'>$Type</td>
         <td contenteditable='true' id='Item' Item='$Item'  ProductName='$ProductName'>$Item</td>
         <td contenteditable='true' id='ProductName' ProductName='$ProductName' >$ProductName</td>
         <td><img src='http://pick2get.com/Asset/image/$ProductImage'style='width:30px' style='width:30px' ></td>
         <td contenteditable='true' id='Unit' Unit='$Unit' ProductName='$ProductName'>$Unit</td>
         <td contenteditable='true' id='Quantity'Quantity='$Quantity' ProductName='$ProductName'>$Quantity</td>
         <td contenteditable='true' id='PricePerUnit' PricePerUnit='$PricePerUnit' ProductName='$ProductName'>$PricePerUnit</td>
         <td><input type='button' id='ImageUpdate' ImageName='$ProductImage' ProductName='$ProductName' class='btn btn-info' value='EDIT IMAGE'></td>
          
         <td><input type='button' id='deleteItem' ImageName='$ProductImage' ProductName='$ProductName' class='btn btn-info' value='DELETE'></td>

        </tr>";
        
        
    }
     echo" </tbody>
                        </table>
                        </form>
                        ";
  

}
else 
{
    
echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error Fetching Data</b>
 </div>";
}


exit();
}

//Script for selecting staioneries
if(isset($_GET['STAIONERIES'])){
/*
This is blok of code displays the stationeri
table
*/
$getFruitsAndVegie="SELECT * FROM  Products WHERE ITEM_GROUP='Stationery'AND TYPE='Utilities'";  
$result=mysqli_query($conn,$getFruitsAndVegie);

echo'<br>'."
<span id='feedback'></span>
<form id='tableform' action='php/editimage.php' method='post' enctype='multipart/form-data'>
<table class='table'>
       <tbody>
       <thead>
           <td><B>PRODUCT ID</B></td>
           <td><B>TYPE</B></td>
           <td><B>ITEM GROUP</B></td>
           <td><B>PRODUCT NAME</B></td>
           <td><B>PRODUCT IMAGE</B></td>
           <td><B>UNIT</B></td>
           <td><B>QUANTITY</B></td>
           <td><B>PRICE PER UNIT</B></td>
           <td><B>EDIT IMAGE</B></td>
           
           <td><B>DELETE</B></td>

       </thead>
";
if(mysqli_num_rows($result) > 0)
{  


    
   while($row = $result->fetch_assoc()) 
    {
         $Id=$row['PRODUCT_ID'];
         $Type=$row['TYPE'];
         $Item=$row['ITEM_GROUP'];
         $ProductName=$row['PRODUCT_NAME'];
         $ProductImage=$row['PRODUCT_IMAGE'];
         $Unit=$row['UNIT'];
         $Quantity=$row['QUANTITY'];
         $PricePerUnit=$row['PRICE_PER_UNIT'];


         
           echo"<tr>
         <td>$Id</td>
         <td contenteditable='true' id='Type' Type='$Type'  ProductName='$ProductName'>$Type</td>
         <td contenteditable='true' id='Item' Item='$Item'  ProductName='$ProductName'>$Item</td>
         <td contenteditable='true' id='ProductName' ProductName='$ProductName' >$ProductName</td>
         <td><img src='http://pick2get.com/Asset/image/$ProductImage'style='width:30px' style='width:30px' ></td>
         <td contenteditable='true' id='Unit' Unit='$Unit' ProductName='$ProductName'>$Unit</td>
         <td contenteditable='true' id='Quantity'Quantity='$Quantity' ProductName='$ProductName'>$Quantity</td>
         <td contenteditable='true' id='PricePerUnit' PricePerUnit='$PricePerUnit' ProductName='$ProductName'>$PricePerUnit</td>
         <td><input type='button' id='ImageUpdate' ImageName='$ProductImage' ProductName='$ProductName' class='btn btn-info' value='EDIT IMAGE'></td>
          
         <td><input type='button' id='deleteItem' ImageName='$ProductImage' ProductName='$ProductName' class='btn btn-info' value='DELETE'></td>

        </tr>";

        
        
    }
     echo" </tbody>
                        </table>
                        </form>
                        ";
  

}
else 
{
    
echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error Fetching Data</b>
 </div>";
}
exit();

}
//Script for selecting accessories
if(isset($_GET['ACCESORIES'])){
/*
This is blok of code displays the stationeri
table
*/

$getFruitsAndVegie="SELECT * FROM  Products WHERE ITEM_GROUP='Kitchen Fuel'  AND TYPE='Utilities'";
$result=mysqli_query($conn,$getFruitsAndVegie);

echo'<br>'."
<span id='feedback'></span>
<form id='tableform' action='php/editimage.php' method='post' enctype='multipart/form-data'>
<table class='table'>
       <tbody>
       <thead>
           <td><B>PRODUCT ID</B></td>
           <td><B>TYPE</B></td>
           <td><B>ITEM GROUP</B></td>
           <td><B>PRODUCT NAME</B></td>
           <td><B>PRODUCT IMAGE</B></td>
           <td><B>UNIT</B></td>
           <td><B>QUANTITY</B></td>
           <td><B>PRICE PER UNIT</B></td>
           <td><B>EDIT IMAGE</B></td>
          
           <td><B>DELETE</B></td>

       </thead>
";
if(mysqli_num_rows($result) > 0)
{  


    
   while($row = $result->fetch_assoc()) 
    {
         $Id=$row['PRODUCT_ID'];
         $Type=$row['TYPE'];
         $Item=$row['ITEM_GROUP'];
         $ProductName=$row['PRODUCT_NAME'];
         $ProductImage=$row['PRODUCT_IMAGE'];
         $Unit=$row['UNIT'];
         $Quantity=$row['QUANTITY'];
         $PricePerUnit=$row['PRICE_PER_UNIT'];


          echo"<tr>
         <td>$Id</td>
         <td contenteditable='true' id='Type' Type='$Type'  ProductName='$ProductName'>$Type</td>
         <td contenteditable='true' id='Item' Item='$Item'  ProductName='$ProductName'>$Item</td>
         <td contenteditable='true' id='ProductName' ProductName='$ProductName' >$ProductName</td>
         <td><img src='http://pick2get.com/Asset/image/$ProductImage'style='width:30px' style='width:30px' ></td>
         <td contenteditable='true' id='Unit' Unit='$Unit' ProductName='$ProductName'>$Unit</td>
         <td contenteditable='true' id='Quantity'Quantity='$Quantity' ProductName='$ProductName'>$Quantity</td>
         <td contenteditable='true' id='PricePerUnit' PricePerUnit='$PricePerUnit' ProductName='$ProductName'>$PricePerUnit</td>
         <td><input type='button' id='ImageUpdate' ImageName='$ProductImage' ProductName='$ProductName' class='btn btn-info' value='EDIT IMAGE'></td>
          
         <td><input type='button' id='deleteItem' ImageName='$ProductImage' ProductName='$ProductName' class='btn btn-info' value='DELETE'></td>

        </tr>";
        
        
    }
     echo" </tbody>
                        </table>
                        </form>
                        ";
  

}
else 
{
    
echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error Fetching Data</b>
 </div>";
}
exit(); 
}
//Script for selecting Wet goods
if(isset($_GET['WetGoods'])){
/*
This block of code here displays table content 
the ability to edit them for WetGoods
*/

$getFruitsAndVegie=" SELECT * FROM  Products WHERE ITEM_GROUP='Beers' OR ITEM_GROUP='Champagne'OR 
ITEM_GROUP='Rum' OR 
ITEM_GROUP='Cognac' OR 
ITEM_GROUP='Tequila' OR 
ITEM_GROUP='Vodka' OR 
ITEM_GROUP='Whisky' OR 
ITEM_GROUP='Rose Wine' OR 
ITEM_GROUP='White Wine' OR 
ITEM_GROUP='Red Wine' OR 
ITEM_GROUP='White Wine' OR 
ITEM_GROUP='White Wine'OR 
ITEM_GROUP='White Wine' OR
ITEM_GROUP='Syrups'OR
ITEM_GROUP='Appertive' OR
ITEM_GROUP='Soft Drinks'OR
ITEM_GROUP='Enegy' AND TYPE='Wet Goods'

 " ;

$result=mysqli_query($conn,$getFruitsAndVegie);

echo'<br>'."
<span id='feedback'></span>
<form id='tableform' action='php/editimage.php' method='post' enctype='multipart/form-data'>
<table class='table'>
       <tbody>
       <thead>
           <td><B>PRODUCT ID</B></td>
           <td><B>TYPE</B></td>
           <td><B>ITEM GROUP</B></td>
           <td><B>PRODUCT NAME</B></td>
           <td><B>PRODUCT IMAGE</B></td>
           <td><B>UNIT</B></td>
           <td><B>QUANTITY</B></td>
           <td><B>PRICE PER UNIT</B></td>
           <td><B>EDIT IMAGE</B></td>
           
           <td><B>DELETE</B></td>

       </thead>
";
if(mysqli_num_rows($result) > 0)
{  


    
   while($row = $result->fetch_assoc()) 
    {
         $Id=$row['PRODUCT_ID'];
         $Type=$row['TYPE'];
         $Item=$row['ITEM_GROUP'];
         $ProductName=$row['PRODUCT_NAME'];
         $ProductImage=$row['PRODUCT_IMAGE'];
         $Unit=$row['UNIT'];
         $Quantity=$row['QUANTITY'];
         $PricePerUnit=$row['PRICE_PER_UNIT'];


           echo"<tr>
         <td>$Id</td>
         <td contenteditable='true' id='Type' Type='$Type'  ProductName='$ProductName'>$Type</td>
         <td contenteditable='true' id='Item' Item='$Item'  ProductName='$ProductName'>$Item</td>
         <td contenteditable='true' id='ProductName' ProductName='$ProductName' >$ProductName</td>
         <td><img src='http://pick2get.com/Asset/image/$ProductImage'style='width:30px' style='width:30px' ></td>
         <td contenteditable='true' id='Unit' Unit='$Unit' ProductName='$ProductName'>$Unit</td>
         <td contenteditable='true' id='Quantity'Quantity='$Quantity' ProductName='$ProductName'>$Quantity</td>
         <td contenteditable='true' id='PricePerUnit' PricePerUnit='$PricePerUnit' ProductName='$ProductName'>$PricePerUnit</td>
         <td><input type='button' id='ImageUpdate' ImageName='$ProductImage' ProductName='$ProductName' class='btn btn-info' value='EDIT IMAGE'></td>
          
         <td><input type='button' id='deleteItem' ImageName='$ProductImage' ProductName='$ProductName' class='btn btn-info' value='DELETE'></td>

        </tr>";

        
        
    }
     echo" </tbody>
                        </table>
                        </form>
                        ";
  

}
else 
{
    
echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error Fetching Data</b>
 </div>";
}
exit();
}

//Script for selecting Fruits and Veggies
if(isset($_GET['FruitsAndVeggies'])){
/*
This block of code here displays table content the ability to edit them for fruits and vegetable
*/
$GetAllProduct="select * from Products  WHERE TYPE='Fruits and vegetable'";


$result=mysqli_query($conn,$GetAllProduct);

echo'<br>'."
<span id='feedback'></span>
<form id='tableform' action='php/editimage.php' method='post' enctype='multipart/form-data'>
<table class='table'>
       <tbody>
       <thead>
           <td><B>PRODUCT ID</B></td>
           <td><B>TYPE</B></td>
           <td><B>ITEM GROUP</B></td>
           <td><B>PRODUCT NAME</B></td>
           <td><B>PRODUCT IMAGE</B></td>
           <td><B>UNIT</B></td>
           <td><B>QUANTITY</B></td>
           <td><B>PRICE PER UNIT</B></td>
           <td><B>EDIT IMAGE</B></td>
           
           <td><B>DELETE</B></td>

       </thead>
";
if(mysqli_num_rows($result) > 0)
{  


    
   while($row = $result->fetch_assoc()) 
    {
         $Id=$row['PRODUCT_ID'];
         $Type=$row['TYPE'];
         $Item=$row['ITEM_GROUP'];
         $ProductName=$row['PRODUCT_NAME'];
         $ProductImage=$row['PRODUCT_IMAGE'];
         $Unit=$row['UNIT'];
         $Quantity=$row['QUANTITY'];
         $PricePerUnit=$row['PRICE_PER_UNIT'];


          echo"<tr>
         <td>$Id</td>
         <td contenteditable='true' id='Type' Type='$Type'  ProductName='$ProductName'>$Type</td>
         <td contenteditable='true' id='Item' Item='$Item'  ProductName='$ProductName'>$Item</td>
         <td contenteditable='true' id='ProductName' ProductName='$ProductName' >$ProductName</td>
         <td><img src='http://pick2get.com/Asset/image/$ProductImage'style='width:30px' style='width:30px' ></td>
         <td contenteditable='true' id='Unit' Unit='$Unit'ProductName='$ProductName'>$Unit</td>
         <td contenteditable='true' id='Quantity'Quantity='$Quantity' ProductName='$ProductName'>$Quantity</td>
         <td contenteditable='true' id='PricePerUnit' PricePerUnit='$PricePerUnit' ProductName='$ProductName'>$PricePerUnit</td>
         <td><input type='button' id='ImageUpdate' ImageName='$ProductImage' ProductName='$ProductName' class='btn btn-info' value='EDIT IMAGE'></td>
          
         <td><input type='button' id='deleteItem' ImageName='$ProductImage' ProductName='$ProductName' class='btn btn-info' value='DELETE'></td>

        </tr>";

        
        
    }
     echo" </tbody>
                        </table>
                        </form>
                        ";
  

}
else 
{
    
echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error Fetching Data</b>
 </div>";
}

exit();
}
//Script for updating  images into system databse

if(isset($_POST['updateimage'])){
$img_name=$_POST['img_name'];
$prdt_name=$_POST['prdt_name'];
$_SESSION['ImageName']=$img_name;
$_SESSION['ProductName']=$prdt_name;
echo"http://pick2get.com/EditImage.php";
exit();
}

//Script for editng Type
if(isset($_POST['EditType'])){
  $oldValue=$_POST['val'];
  $newVal=$_POST['Type'];
  $ProductName=$_POST['ProductName'];
//echo"script functional"."\n"."This is the old value: ".$oldValue."<br>"."This is the new value: ".$newVal."Product name to change item: ".$ProductName;
//Begin Entering data to the database 
$UpdateProduct = "UPDATE Products SET TYPE='$newVal' WHERE PRODUCT_NAME='$ProductName' AND TYPE='$oldval'";

if (mysqli_query($conn, $UpdateProduct)) 
{
    //echo "Record updated successfully type changed from: ".$oldval."to ".$newVal;
    echo"<div class='alert alert-success'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Record updated successfully type changed to $newVal.</b>
 </div>";
} else {
    echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error updating record:  . mysqli_error($conn)</b>
 </div>";

    
}

mysqli_close($conn);
exit();
}
//Script for editng Item
if(isset($_POST['EditItem'])){
  $ProductName=$_POST['ProductName'];
  $oldValue=$_POST['Oldval'];
  $newVal=$_POST['Item'];
//echo"script functional"."\n"."This is the old value: ".$oldValue."\n"."This is the new value: ".$newVal."\n"."Product name to change item: ".$ProductName;

//Begin Entering data to the database 
$UpdateProduct = "UPDATE Products SET ITEM_GROUP='$newVal' WHERE PRODUCT_NAME='$ProductName' ";

if (mysqli_query($conn, $UpdateProduct)) 
{
    //echo "Record updated successfully type changed from: ".$oldval."to ".$newVal;
    echo"<div class='alert alert-success'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Record updated successfully item changed to $newVal.</b>
 </div>";
} else {
    echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error updating record:  . mysqli_error($conn)</b>
 </div>";

    
}

mysqli_close($conn);


exit();
}
//Script for editng Product name
if(isset($_POST['EditProductName'])){
  $oldValue=$_POST['val'];
  $newVal=$_POST['ProductName'];
//echo"script functional"."\n"."This is the old value: ".$oldValue."\n"."This is the new value: ".$newVal;


//Begin Entering data to the database 
$UpdateProduct = "UPDATE Products SET PRODUCT_NAME='$newVal' WHERE PRODUCT_NAME='$oldval' ";

if (mysqli_query($conn, $UpdateProduct)) 
{
    //echo "Record updated successfully type changed from: ".$oldval."to ".$newVal;
    echo"<div class='alert alert-success'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Record updated successfully product name changed to $newVal.</b>
 </div>";
} else {
    echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error updating record:  . mysqli_error($conn)</b>
 </div>";

    
}

mysqli_close($conn);

exit();
}
//Script for editng Unit of product
if(isset($_POST['EditUnit'])){
  $oldValue=$_POST['val'];
  $newVal=$_POST['Unit'];
  $ProductName=$_POST['ProductName'];
//echo"script functional"."\n"."This is the old value: ".$oldValue."\n"."This is the new value: ".$newVal."\n"."ProductName: ".$ProductName;

//Begin Entering data to the database 
$UpdateProduct = "UPDATE Products SET UNIT='$newVal' WHERE PRODUCT_NAME='$ProductName' AND UNIT='$oldval' ";

if (mysqli_query($conn, $UpdateProduct)) 
{
    //echo "Record updated successfully type changed from: ".$oldval."to ".$newVal;
    echo"<div class='alert alert-success'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Record updated successfully unit changed to $newVal.</b>
 </div>";
} else {
    echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error updating record:  . mysqli_error($conn)</b>
 </div>";

    
}

mysqli_close($conn);



exit();
}
//Script for editng price per unit of product
if(isset($_POST['EditPricePerUnit'])){
  $oldValue=$_POST['val'];
  $newVal=$_POST['PricePerUnit'];
  $ProductName=$_POST['ProductName'];
//echo"script functional"."\n"."This is the old value: ".$oldValue."\n"."This is the new value: ".$newVal."\n"."ProductName: ".$ProductName;

  //Begin Entering data to the database 
$UpdateProduct = "UPDATE Products SET PRICE_PER_UNIT='$newVal' WHERE PRODUCT_NAME='$ProductName' AND PRICE_PER_UNIT='$oldval' ";

if (mysqli_query($conn, $UpdateProduct)) 
{
    //echo "Record updated successfully type changed from: ".$oldval."to ".$newVal;
    echo"<div class='alert alert-success'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Record updated successfully pricce per unit changed to $newVal.</b>
 </div>";
} else {
    echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error updating record:  . mysqli_error($conn)</b>
 </div>";

    
}

mysqli_close($conn);


exit();
}
//Script for editng Quantity of product
if(isset($_POST['EditQuantity'])){
  $oldValue=$_POST['val'];
  $newVal=$_POST['Quantity'];
  $ProductName=$_POST['ProductName'];
//echo"script functional"."\n"."This is the old value: ".$oldValue."\n"."This is the new value: ".$newVal."\n"."ProductName: ".$ProductName;

   //Begin Entering data to the database 
$UpdateProduct = "UPDATE Products SET QUANTITY='$newVal' WHERE PRODUCT_NAME='$ProductName' AND QUANTITY='$oldval' ";

if (mysqli_query($conn, $UpdateProduct)) 
{
    //echo "Record updated successfully type changed from: ".$oldval."to ".$newVal;
    echo"<div class='alert alert-success'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Record updated successfully Quantity changed to $newVal.</b>
 </div>";
} else {
    echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error updating record:  . mysqli_error($conn)</b>
 </div>";

    
}

mysqli_close($conn);
exit();
}

//Script to delete product
if (isset($_POST['DeleteProduct'])) {
  # code...

  $ProductName=$_POST['ProductName'];

  echo"This is item is about to be deleted".$ProductName;
  exit();
  $DeleteProduct = "DELETE FROM Products WHERE PRODUCT_NAME='$ProductName'";
  if (mysqli_query($conn, $DeleteProduct)) 
  {
      //echo "Record updated successfully type changed from: ".$oldval."to ".$newVal;
      echo"<div class='alert alert-success'>
  <a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Produt is $ProductName was deleted successfully.</b>
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