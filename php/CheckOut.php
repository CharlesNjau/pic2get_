<?php

session_start();

Include_once("conn2.php");

$useremail=$_SESSION['EMAIL'];
$UserId=$_SESSION['UID'];


/*echo "This is the session id ".$useremail."</br>"."This is the session useremail ".$UserId."</br>";
exit();*/



           $useremail=$_SESSION['EMAIL'];
           $UserId=$_SESSION['UID'];
           //Perform a query to to delete
           
            /*#Test stub#
           echo  "This is the session id ".$useremail."</br>"."This is the session useremail ".$UserId."</br>";

           exit();*/

           $RemoveItem="SELECT * FROM cart WHERE USER_ID='$UserId'";
           $result=mysqli_query($conn,$RemoveItem);

          echo"    <span id='ToCart'></span>    
                    <table id='tblProduct' class='table'>
                      <div class='alert alert-warning'><a href='#' class='close' data-dismis='alert' arial-lable='close' id='CloseTable'>&times</a><b>Close Table</b>
                      </div>
                      <tbody>  

                     <thead>
                                      <tr>
                                        
                                        <th>Product Name </th>
                                        <th>Product Image</th>
                                        <th>Quantity</th>
                                    
                                        
                                        <th>Unit</th>
                                        <th>Unit Price</th>
                                        <th>Total</th>
                                        <th>Remove</th>

                                      </tr>
                                    </thead>


                  "; 
          if(mysqli_num_rows($result) > 0)
          {  


             $Total_price_of_goods=0;             
             while($row = $result->fetch_assoc()) 
              {
                  $Image=$row['PRODUCT_IMAGE'];
                  $product=$row['PRODUCT_NAME'];
                  $unit=$row['UNIT'];
                  $Price=$row['UNIT_PRICE'];
                  $Available_goods=$row['QUANTITY'];
                  $Total=$row['TOTAL'];

                  
                  $Total_Array=array($Total);
                  $Total_sum=array_sum($Total_Array);
                  $Total_price_of_goods=$Total_price_of_goods+$Total_sum;

                  
                 

                  echo"
                     
                      <tr>
                      <td>".$product."</td>
                      <td>
                      <img src='Asset/image/$Image' class='img-responsive' style='width:40px' style='height:40px'>
                      </td>
                      <td>".$Available_goods."</td>
                      <td>".$unit."</td>
                      <td>".$Price."</td>
                      <td>".$Total."</td>
                      <td>
                      <input type='button'id='Rmv'price='$Price' product_name='$product' amount_present='$Available_goods' unit='$unit' class='btn btn-block' value='Remove' >
                      </td>
                      </tr>
                      ";//onclick=getVal('".$product."')
                    

                  
                  
              }
               echo" </tbody>
                                  </table>
                                  <div class='row'>
                                    <div class='col-md-8'></div>
                                    <div class='col-md-4'></div>
                                    <B><p align='center'>TOTAL PRICE OF GOODS IS: '$Total_price_of_goods  TSH '</p><B>
                                  </div>

                                  
                                  <div align='center'>
                                  <input type='button'id='ThreeGPay' class='btn btn-block' value='Pay with 3G'   style='width:300px;' style='Display:none;' />
                                  </div>
                                  </br>
                                  </br>
                                  <div align='center'>
                                  <input type='button'id='CrediPay' class='btn btn-block' value='Pay on Credit' style='width:300px;' style='width:300px;' />
                                  </div>
                                  
                                 
                                  

                                  ";
            

          }
         
else 
{
    
echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Add item to Shopping cart</b>
 </div>".mysql_error();
}















$conn->close();

?>