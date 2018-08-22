<?php
include_once("conn2.php");

$getFruitsAndVegie="SELECT * FROM  Products WHERE ITEM_GROUP='SANITARY' AND TYPE='Utilities'";

$result=mysqli_query($conn,$getFruitsAndVegie);

echo"    <span id='ToCart'></span>    
          <table id='tblProduct' class='table'>
            <div class='alert alert-warning'><a href='#' class='close' data-dismis='alert' arial-lable='close' id='CloseTable'>&times</a><b>Close Table</b>
            </div>
            <tbody>  

           <thead>
                            <tr>
                              <th>Product Image</th>
                              <th>Product Name </th>
                              <th>Amount available</th>
                              <th>Quantity</th>
                              <th>Add</th>
                              <th>Reset</th>
                              <th>Unit</th>
                              <th>Unit Price</th>
                              <th>Add</th>
                              <th>Remove</th>

                            </tr>
                          </thead>


        "; 
if(mysqli_num_rows($result) > 0)
{  


    
   while($row = $result->fetch_assoc()) 
    {
        $Image=$row['PRODUCT_IMAGE'];
        $product=$row['PRODUCT_NAME'];
        $unit=$row['UNIT'];
        $Price=$row['PRICE_PER_UNIT'];
        $Available_goods=$row['QUANTITY'];
        $id=$row['PRODUCT_ID'];
        $SUPPLIER_CATEGORY=$row['SUPPLIER_CATEGORY'];
       

        echo"
           
            <tr>
            <td><img src='Asset/image/$Image' class='img-responsive' style='width:30px' style='width:30px'></td>
            <td>".$product."</td>
            <td>".$Available_goods."</td>
            <td>
            <input type='text' id='TxtQty'class='form-control' name='name' style='width:60px'>
            </td>
            <td> <input type='button'id='AddQty' class='btn btn-block' value='+'  style='width:20px'></td>
            <td> <input type='button'id='RmvQty' class='btn btn-block' value='-' style='width:20px'></td>
            <td>".$unit."</td>
            <td>".$Price."</td>
            <td>
            <input type='button'id='add' Image='$Image' price='$Price' SupplierCategory='$SUPPLIER_CATEGORY' product_name='$product' amount_present='$Available_goods' unit='$unit'  class='btn btn-block' value='AddToCart ' >
            </td>
            <td>
            <input type='button'id='Rmv'price='$Price' product_name='$product' amount_present='$Available_goods' unit='$unit' class='btn btn-block' value='Remove' >
            </td>
            </tr>
            ";//onclick=getVal('".$product."')
          

        
        
    }
     echo" </tbody>
                        </table>
                        ";
  

}
else 
{
    
echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error Fetching Data</b>
 </div>";
}

$conn->close();

?>