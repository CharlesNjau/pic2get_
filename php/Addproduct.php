<?php
include_once('conn2.php');

//Sanitise global variablehdrgdrd
$ProductName=mysqli_real_escape_string($conn,$_POST['Pname']);

//Add logic to insert image

      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }

      
      if(empty($errors)==true){
      	$location='/home/pick2get/www/www/Asset/image/'.$file_name;
         move_uploaded_file($file_tmp,$location);
         echo "This is the location  ".$location."<br>";
         echo "Success"."<br>";
      }else{
         print_r($errors);
      }

    //Validate user



$ImageName=$file_name;
$Unit=mysqli_real_escape_string($conn,$_POST['Unit']);
$Quantity=mysqli_real_escape_string($conn,$_POST['Qnty']);
$Price_Unit=mysqli_real_escape_string($conn,$_POST['Price']);
$ItemGroup=mysqli_real_escape_string($conn,$_POST['ItmGrp']);
$ProductCategory=mysqli_real_escape_string($conn,$_POST['PCtgry']);


echo "This is the Proroduct name:  ".$ProductName."</br>".
     "Product Image: ".$ImageName."<br>".
     "The unit: ".$Unit."</br>".
     "The quantity: ".$Quantity."</br>".
	 "The item unit price: ".$Price_Unit."</br>".
	 "The Product category: ".$ProductCategory."<br>".
	 "This is the item group: ".$ItemGroup."<br>";
//insert into database

	   $sql = "INSERT INTO Products (PRODUCT_NAME,TYPE,ITEM_GROUP,PRODUCT_IMAGE,UNIT,QUANTITY,PRICE_PER_UNIT)
		VALUES ('$ProductName','$ItemGroup','$ProductCategory','$ImageName','$Unit','$Quantity','$Price_Unit')";

		if (mysqli_query($conn, $sql))
		{
		    echo "New record created successfully"."<br>";
		} 
		else 
		{
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}




?>