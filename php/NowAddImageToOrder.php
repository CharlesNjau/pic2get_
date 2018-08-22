<?php
include_once("conn2.php");
session_start();
  $ProductName=$_SESSION['ProductName'];
  $Quantity=$_SESSION['Quantity'];

  echo "This is the Product name to be added: ".$ProductName."<br>"." With the quantity of ".$Quantity."<br>";
//exit();
         

      $file_name =$_FILES['image']['name'];



     
      echo"from echo image name: ".$file_name."<br>";
      var_dump($file_name);
      
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];

      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      
      
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
      echo $ImageName."<br>";
    exit();  
    //Check to see if image is already present

            
      
      	 $UpdateImage="UPDATE PurchaseOrderTable SET PRODUCT_IMAGE='$ImageName' WHERE PRODUCT_NAME='$ProductName'";
						  
                       if(mysqli_query($conn,$UpdateImage))
                       {
                           echo"Image ".$ImageName." updated successfully!";
                        
                           //header("location:http://pick2get.com/SystemInvetory.php");

                           echo"<a href='http://pick2get.com/Admin.php'>Go to Admin</a>";
                           exit();
                           
                       }
                       else
                       {
                          echo"Image ".$ImageName." was not updated successfully!";

                          echo "Error ".mysql_error();

                          echo"<a href='http://pick2get.com/Admin.php'>Go to Admin</a>";
                           exit();
                       }

                       
                      

      
       if(CheckImage($ImageName)===FALSE){
       echo "image file: ".$ImageName." aleady present OR You didnt select an Image"."<br>";
        //sleep(7);
        //header("location:http://localhost/ccweb/imageupload.php");
       echo"<a href='http://pick2get.com/SystemInvetory.php'>Home</a>";
      }
  //function for checking if image is present 
 function CheckImage($ImageName){
 	                  define("DB_SERVER", "195.8.222.39");
                    define("DB_USER", "pick2get");
                    define("DB_PASSWORD", "3DZX5J8k");
                    define("DB_DATABASE", "pick2get");


                    $servername = "localhost";
                    $username = "pick2get";
                    $password = "3DZX5J8k";
                    $dbname = "pick2get_pick2get";

						// Create connection
						$conn = new mysqli($servername, $username, $password,$dbname);

						// Check connection
						if ($conn->connect_error) {
						    die("Connection failed: " . $conn->connect_error);
						} 
 	                      $name=$_SESSION['ProductName'];
                       	$ChckVar=$ImageName;
                        $checkimg="SELECT * FROM PurchaseOrderTable WHERE PRODUCT_NAME='$ProductName' AND PRODUCT_IMAGE='$ChckVar'";
                        $result = mysqli_query($conn, $checkimg);

                        if (mysqli_num_rows($result) > 0) 
                        {  
						    
						    return false;
						} 
						else if(mysqli_num_rows($result) < 0)
						{
						    return true;
						}
						else if($ChckVar===""){
							return false;
						}


                       } 

mysqli_close($conn);

?>


