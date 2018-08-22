<?php
include_once("conn2.php");
      $name=$_POST['PictureName'];
	   
      $errors= array();
      $file_name=$_FILES["EditImage"]["name"];
      $file_size=$_FILES['EditImage']['size'];
      $file_tmp=$_FILES['EditImage']['tmp_name'];
      $file_type=$_FILES['EditImage']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['EditImage']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }

      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,'/home/pick2get/www/www/Asset/image/'.$file_name);
         echo "Success"."<br>";
      }else{
         print_r($errors);
      }


		//Validate user

      $ImageName=$file_name;
      echo "This is the image name: ".$ImageName."<br>";
      echo "This is th profile name".$name."<br>";
      
exit();
$UpdateImage="UPDATE Products SET PRODUCT_IMAGE='$ImageName'";
	                    if($conn->query($UpdateImage) === TRUE)
	                    {
                           echo"Image updated successfully!";
                           
	                    }
	                    else
	                    {
	                       echo"Error ".mysql_error();
	                    }


?>