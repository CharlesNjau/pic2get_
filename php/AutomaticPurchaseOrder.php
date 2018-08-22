<?
session_start();
include_once('conn2.php');
$SuppplierCategory= $_SESSION['SUPPLIER_CATEGORY'];
$REGISTERD_AS=$_SESSION['ROLE'];
$NAME_OF_COMPANY=$_SESSION['COMPANY_NAME'];
$CATEGORY_OF_SUPPLIER=$_SESSION['SUPPLIER_CATEGORY'];
$EMAIL=$_SESSION['EMAIL'];
$GLOBALS['COMPANY_NAME'];
$ITEM_COUNT=$_SESSION['COUNT_VAL'];
$ACCOUNT_TYPE=$_SESSION['ACCOUNT_TYPE'];
 $PRODUCT_NAME=$_POST['PRODUCT_NAME'];

  //geT hotel email

  //$HOTEL_EMAIL=GetClientEmail($PRODUCT_NAME);

  




//Grab confirmed sales from sales table and insert them in purchase table


//Select everthing from purchase table and sort them categogy wise to be sent to suppliers page

if(isset($_GET['GetOrder']))
{
      echo"<h4 align='center'><B> PLEASE TAKE NOTE YOU HAVE AN HOUR TO CONFIRM THIS ORDER<B></h4>
      <p align='center' id='demo'></p>
      </br></br>
      <span id='FormFeedBack'></span>
      <form id='formOder' action='php/MakeOrder2.php' method='post' enctype='multipart/form-data'>
      <table id='PurChaseOrderForm' class='table'>
      <tbody>
        
        <thead>
        <tr>
          <td><strong>PRODUCT NAME</strong></td>
          <td><strong>IMAGE</strong></td>
          <td><strong>QUANTITY</strong></td>
          <td><strong>UNIT</strong></td>
          <td><strong>PRICE PER UNIT</strong></td>
          <td><strong>CONFIRM ORDER </strong></td>
          <td><strong>UNCONFIRM ORDER </strong></td>
          <td><strong>DATE </strong></td>

          </tr>
        </thead>
          
        ";

        //Perform squery here here arccording to suppplier category

        $getOrderByCategory="SELECT * FROM PurchaseOrderTable WHERE SUPPLIER_CATEGORY='$SuppplierCategory'";
        $result=mysqli_query($conn,$getOrderByCategory);

        if(mysqli_num_rows($result) > 0)
                                          {  


                                              
                                             while($row = $result->fetch_assoc()) 
                                              {
                                                  $Image=$row['PRODUCT_IMAGE'];
                                                  $PRODUCT_NAME=$row['PRODUCT_NAME'];
                                                  $UNIT=$row['UNIT'];
                                                  $QUANTITY=$row['QUANTITY'];
                                                  $DATE=$row['TIME_ORDER_RECEIVED'];

                                                 // $SUPPLIER_CATEGORY=$row['SUPPLIER_CATEGORY'];

                                              echo"
                                              <tr>
                                              <td>". $PRODUCT_NAME."</td>
                                              <td><img src='http://pick2get.com/Asset/image/$Image'style='width:30px' style='width:30px' ></td>
                                              <td>".$QUANTITY."</td>
                                              <td>".$UNIT."</td>
                                              <td contenteditable='true' id='UnitPrice' PRICE_PER_UNIT='$PRICE_PER_UNIT'></td>
                                              <td><input name='Item' Image='$Image' PRICE_PER_UNIT='$PRICE_PER_UNIT' TOTAL_PRICE='$TOTAL_PRICE' PRODUCT_NAME='$PRODUCT_NAME' QUANTITY='$QUANTITY' UNIT='$UNIT' type='button' class='btn btn-info' value='ADD ITEM' id='ItemConfirm' /></td>
                                              <td><input name='Item' PRODUCT_NAME='$PRODUCT_NAME' QUANTITY='$QUANTITY' UNIT='$UNIT' type='button' class='btn btn-danger' value='REMOVE ITEM' id='ItemUnConfirm' /></td>
                                              <td>".$DATE."</td>
                                              </tr>";
                                                 //onclick=getVal('".$product."')
                                                    

                                                  
                                                  
                                              }
                                              echo"
                                                    </tbody>
                                                         </table>
                                                         <div align='center'>
                                                         
                                                         <input style='align:right' type='button' id='btnConfirm' value='CONFIRM ORDER' class='btn btn-success'>
                                                         
                                                         <input style='align:left' type='button' id='btnReject' value='REJECT ORDER' class='btn btn-warning'>
                                                         
                                                         </div>
                                                         </form>";
                                                                                         
                                                    exit();

                                          }
                                          else 
                                          {
                                              
                                          echo"<div class='alert alert-warning'>
                                          <a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error displaying Data</b>
                                           </div>";
                                          }

       
           exit();

     }
else 
{
                                        
    //echo"<div class='alert alert-warning'><a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error !</b></div>".mysqli_error($conn);
}

if (isset($_GET['CanceledPayments'])) {
  # code...
   //View product to be bought from supplier
  echo"
  <span id='formfeedback'></span>
  <h2 align='center'><B>CANCELED PAYMENT FROM BY PICK2GET</B></h2>
  <form id='orderform'  action='php/MakeOrder.php' method='post' enctype='multipart/form-data'>
                                        <table class='table' style='font-size: 11px;'>
                                        <tbody>
                                         <thead>
                                          <tr>

                                            <td><strong>COMPANY_NAME</strong></td>
                                            <td><strong>PRODUCT_NAME</strong></td>
                                            <td><strong>PRODUCT_IMAGE</strong></td>
                                            <td><strong>QUANTITY</strong></td>
                                            <td><strong>UNIT</strong></td>
                                            <td><strong>PRICE_PER_UNIT</strong></td>
                                            <td><strong>TOTAL_PRICE</strong></td>
                                            <td><strong>DELIVERY_STATUS</strong></td>
                                            <td><strong>REASON</strong></td>
                                            </tr>
                                          </thead>";
                                          
                                          $ShowAcceptedSupplyListItems="SELECT * FROM DeliveryRecord";
                                          $result1=mysqli_query($conn,$ShowAcceptedSupplyListItems);

                                          

                                      if(mysqli_num_rows($result1)>0)
                                      {
                                        while($row = $result1->fetch_assoc()) 
                                        {
                                            $COMPANY_NAME=$row['COMPANY_NAME'];
                                            $PRODUCT_NAME=$row['PRODUCT_NAME'];
                                            $PRODUCT_IMAGE=$row['PRODUCT_IMAGE'];
                                            $QUANTITY=$row['QUANTITY'];
                                            $UNIT=$row['UNIT'];
                                            $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                                            $TOTAL_PRICE=$row['TOTAL_PRICE'];
                                            $DELIVERY_STATUS=$row['DELIVERY_STATUS'];
                                            $REMARKS=$row['REMARKS']; 
                                            
                                            
                                            

                                            echo"
                                               
                                                <tr>
                                                <td>".$COMPANY_NAME."</td>
                                                <td>".$PRODUCT_NAME."</td>
                                                <td><img src='Asset/image/$PRODUCT_IMAGE' class='img-responsive' style='width:30px' style='width:30px'></td>
                                                <td>".$QUANTITY."</td>
                                                <td>".$UNIT."</td>
                                                <td>".$PRICE_PER_UNIT."</td>
                                                <td>".$TOTAL_PRICE."</td>
                                                <td>".$DELIVERY_STATUS."</td>
                                                <td>".$REMARKS."</td>
                                                </tr>
                                                ";//onclick=getVal('".$product."')
                                              
                                               
                                            
                                            
                                        }

                                      }
                                      else
                                      {
                                          echo"Error".mysqli_error($conn);
                                      }
                                        

                                       
                                         echo" </tbody>
                                                           
                                                        ";
                                      

                                    

                                      echo  "</table>
                                        
                                        
                                        </form>";

} else {
  # code...
}


//Get All Supply Ordes Approved By Admin

if(isset($_GET['GetConfirmedSupplyOrder']))
{
  echo"
  <h2 align='center'><B>APPROVED SUPPLY ORDER TO SUPPLIERS</B></h2>
  <form id='orderform'  action='php/MakeOrder.php' method='post' enctype='multipart/form-data' >
                                        <table class='table' style='font-size: 11px;'>
                                        <tbody>
                                         <thead>
                                          <tr>

                                            <td width='189'><strong>COMPANY_NAME</strong></td>
                                            <td width='133'><strong>TOTAL_PRICE</strong></td>
                                            <td width='188'><strong>CONFIRMED_COUNT</strong></td>
                                            <td width='140'><strong>ACTUAL_COUNT</strong></td>
                                            <td width='140'><strong>SUPPLIER_CATEGORY</strong></td>
                                            <td width='140'><strong>PAYMENT_STATUS</strong></td>
                                            <td width='140'><strong>DATE</strong></td>
                                            

                                            
                                          </tr>
                                          </thead>";


                                          $ShowPurchaseOrder="SELECT * FROM  AcceptedSupplyList WHERE COMPANY_NAME='$NAME_OF_COMPANY' AND PAYMENT_APPROVAL_STATUS='APPROVED'AND SUPPLIER_CATEGORY='$CATEGORY_OF_SUPPLIER' "; 
                                          $result=mysqli_query($conn,$ShowPurchaseOrder);
                                          if(mysqli_num_rows($result) > 0)
                                    {  


                                        
                                       while($row = $result->fetch_assoc()) 
                                        {
                                            $COMPANY_NAME=$row['COMPANY_NAME'];
                                            $TOTAL_PRICE=$row['TOTAL_PRICE'];
                                            $TOTAL=money_format("Tsh %i",$TOTAL_PRICE);
                                            $CONFIRMED_COUNT=$row['CONFIRMED_COUNT'];
                                            $ACTUAL_COUNT=$row['ACTUAL_COUNT'];
                                            $SUPPLIER_CATEGORY=$row['SUPPLIER_CATEGORY'];
                                            $PAYMENT_APPROVAL_STATUS=$row['PAYMENT_APPROVAL_STATUS'];
                                            $DATE_OF_PAYMENT=$row['DATE_OF_PAYMENT'];
                                           

                                            echo"
                                               
                                                <tr>
                                                <td><strong>".$COMPANY_NAME."</strong></td>
                                                <td><strong>".$TOTAL."</strong></td>
                                                <td><strong>".$CONFIRMED_COUNT."</strong></td>
                                                <td><strong>".$ACTUAL_COUNT."</strong></td>
                                                <td><strong>".$SUPPLIER_CATEGORY."</strong></td>
                                                <td><strong>".$PAYMENT_APPROVAL_STATUS."</strong></td>
                                                <td><strong>".$DATE_OF_PAYMENT."</strong></td>
                                                
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

                                      echo  "</table>
                                        
                                        
                                        </form>";
                                        $conn->close();

}

//Display transaction history
if($_GET['GetTransactionHistory'])
{
  
  $NAME=strtoupper($NAME_OF_COMPANY);
  echo"
  <h2 align='center'><B>TRANSCTION HISTORY OF $NAME</B></h2>
  <form id='orderform'  action='php/MakeOrder.php' method='post' enctype='multipart/form-data' >
                                        <table class='table' style='font-size: 11px;'>
                                        <tbody>
                                         <thead>
                                          <tr>

                                            <td width='189'><strong>COMPANY_NAME</strong></td>
                                            <td width='133'><strong>TOTAL_PRICE</strong></td>
                                            <td width='188'><strong>CONFIRMED_COUNT</strong></td>
                                            <td width='140'><strong>ACTUAL_COUNT</strong></td>
                                            <td width='140'><strong>SUPPLIER_CATEGORY</strong></td>
                                            <td width='140'><strong>PAYMENT_STATUS</strong></td>
                                            <td width='140'><strong>DATE</strong></td>
                                            

                                            
                                          </tr>
                                          </thead>";


                                          $ShowPurchaseOrder="SELECT * FROM  AcceptedSupplyList WHERE COMPANY_NAME='$NAME_OF_COMPANY' AND PAYMENT_APPROVAL_STATUS='APPROVED'AND SUPPLIER_CATEGORY='$CATEGORY_OF_SUPPLIER' "; 
                                          $result=mysqli_query($conn,$ShowPurchaseOrder);
                                          if(mysqli_num_rows($result) > 0)
                                    {  


                                        
                                       while($row = $result->fetch_assoc()) 
                                        {
                                            $COMPANY_NAME=$row['COMPANY_NAME'];
                                            $TOTAL_PRICE=$row['TOTAL_PRICE'];
                                            $TOTAL=money_format("Tsh %i",$TOTAL_PRICE);
                                            $CONFIRMED_COUNT=$row['CONFIRMED_COUNT'];
                                            $ACTUAL_COUNT=$row['ACTUAL_COUNT'];
                                            $SUPPLIER_CATEGORY=$row['SUPPLIER_CATEGORY'];
                                            $PAYMENT_APPROVAL_STATUS=$row['PAYMENT_APPROVAL_STATUS'];
                                            $DATE_OF_PAYMENT=$row['DATE_OF_PAYMENT'];
                                           

                                            echo"
                                               
                                                <tr>
                                                <td><strong>".$COMPANY_NAME."</strong></td>
                                                <td><strong>".$TOTAL."</strong></td>
                                                <td><strong>".$CONFIRMED_COUNT."</strong></td>
                                                <td><strong>".$ACTUAL_COUNT."</strong></td>
                                                <td><strong>".$SUPPLIER_CATEGORY."</strong></td>
                                                <td><strong>".$PAYMENT_APPROVAL_STATUS."</strong></td>
                                                <td><strong>".$DATE_OF_PAYMENT."</strong></td>
                                                
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
                                    <a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>NO RECORD OF TRANACTION FOR $NAME</b>
                                     </div>";
                                    }

                                      echo  "</table>
                                        
                                        
                                        </form>";
                                        $conn->close();


}   

//Add item to purchase list
if(isset($_POST['AddToPurchaseList']))
{
  $PRODUCT_NAME=$_POST['PRODUCT_NAME'];

  //geT hotel email

  //$HOTEL_EMAIL=GetClientEmail($PRODUCT_NAME);

  



  $PRODUCT_IMAGE=$_POST['Image'];
  $QUANTITY=$_POST['QUANTITY'];
  $UNIT=$_POST['UNIT'];
  $PRICE_PER_UNIT=$_POST['PRICE_PER_UNIT'];
  $TOTAL_PRICE=$_POST['TOTAL_PRICE'];
  $COMPANY_NAME;
  $ACCOUNT_TYPE=$_SESSION['ACCOUNT_TYPE'];
  $SuppplierCategory;

 
  $getSupplierName="SELECT COMPANY_NAME FROM useregistration WHERE email='$EMAIL'AND REGISTERD_AS='$REGISTERD_AS'";
      $result = mysqli_query($conn,$getSupplierName);

      if (mysqli_num_rows($result) > 0) {
          // output data of each row
          while($row = mysqli_fetch_assoc($result)) {
              $COMPANY_NAME=$row['COMPANY_NAME'];
             
          }
      } else {
          echo "error getting data ".mysqli_error();
      }

    $GetEmail="SELECT * FROM PurchaseOrderTable WHERE PRODUCT_NAME='$PRODUCT_NAME' AND QUANTITY='$QUANTITY' AND UNIT='$UNIT'";
    $result22=mysqli_query($conn,$GetEmail);
    if(mysqli_num_rows($result22) > 0){
      while($row=mysqli_fetch_assoc($result22))
    {
      $HOTEL_EMAIL=$row['HOTEL_EMAIL'];
      

    }

    }

    
     
  //Test stub
  /*echo"ADDING SUPPLIER_NAME: ".$COMPANY_NAME."<br>".
       "PRODUCT_NAME: ".$PRODUCT_NAME."<br>".
        "QUANTITY: ".$QUANTITY."<br>".
          "UNIT: ".$UNIT."<br>".
            "ITEM CATEGORY: ".$SuppplierCategory."<br>".
             "PRICE_PER_UNIT: ".money_format("Tsh %i", $PRICE_PER_UNIT)."<br>".
               "TOTAL_PRICE: ".money_format("Tsh %i",$TOTAL_PRICE)."<br>".
                "HOTEL_EMAIL ".$HOTEL_EMAIL."<br>".
                  "ACCOUNT_TYPE ".$ACCOUNT_TYPE;

             exit();*/
            //Begin Checking in entry is ConfirmedPurchaseList

            $CheckIfItemPresent="SELECT * FROM  ConfirmedPurchaseList WHERE COMPANY_NAME='$COMPANY_NAME'  AND PRODUCT_NAME='$PRODUCT_NAME' AND HOTEL_EMAIL='$HOTEL_EMAIL' ";


            $result2=mysqli_query($conn,$CheckIfItemPresent);
            if(mysqli_num_rows($result2) >0)
            {
            //IF ITEM IS PRESENT UPDATE STATUS AS NOT CONFRIMED  
                  echo"<div class='alert alert-warning'><a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>$PRODUCT_NAME ALREAGY ADDED TO LIST</b></div>";
                
            }
            else if(mysqli_num_rows($result2) <=0){
              //Insert item to ConfirmedPurchaseList
              $InsertList="INSERT INTO ConfirmedPurchaseList (COMPANY_NAME ,HOTEL_EMAIL,PRODUCT_IMAGE,PRODUCT_NAME,QUANTITY,UNIT,PRICE_PER_UNIT,TOTAL_PRICE,CONFIRMATION,CONFIRM_STATUS,ACCOUNT_TYPE) VALUES ('$COMPANY_NAME','$HOTEL_EMAIL','$PRODUCT_IMAGE','$PRODUCT_NAME','$QUANTITY','$UNIT','$PRICE_PER_UNIT','$TOTAL_PRICE','CONFRIMED','1','$ACCOUNT_TYPE')";

                  if (mysqli_query($conn, $InsertList)) {
                      echo "<div class='alert alert-success'><a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>ITEM CONFIRMED $PRODUCT_NAME</b></div>";
                      exit();
                  } else {
                      echo "Error: "  . mysqli_error($conn);
                  }
            }


           

exit();
}
else
{
 //echo"<div class='alert alert-warning'><a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error Adding  Data</b></div>".mysqli_error($conn); 
}


//Remove Item from purchase list
if(isset($_POST['RemoveFromPurchaseList']))
{
  $PRODUCT_NAME=$_POST['PRODUCT_NAME'];
  $QUANTITY=$_POST['QUANTITY'];
  $PRICE_PER_UNIT=$_POST['PRICE_PER_UNIT'];
  $TOTAL_PRICE=$_POST['TOTAL_PRICE'];

  
  $UNIT=$_POST['UNIT'];
  $COMPANY_NAME;
  $SuppplierCategory;


  $getSupplierName="SELECT COMPANY_NAME FROM useregistration WHERE email='$EMAIL'AND REGISTERD_AS='$REGISTERD_AS'";
      $result = mysqli_query($conn,$getSupplierName);

      if (mysqli_num_rows($result) > 0) {
          // output data of each row
          while($row = mysqli_fetch_assoc($result)) {
              $COMPANY_NAME=$row['COMPANY_NAME'];
             
          }
      } else {
          echo "error getting data ".mysqli_error();
      }

     
  //Test stub
 /* echo"REMOVING SUPPLIER_NAME ".$COMPANY_NAME."<br>".
       "PRODUCT_NAME ".$PRODUCT_NAME."<br>".
        "QUANTITY ".$QUANTITY."<br>".
          "UNIT ".$UNIT."<br>".
            "ITEM CATEGORY ".$SuppplierCategory."<br>";
            exit();*/
            //Begin Checking in entry is ConfirmedPurchaseList

            $CheckIfItemPresent="SELECT * FROM  ConfirmedPurchaseList WHERE COMPANY_NAME='$COMPANY_NAME'  AND PRODUCT_NAME='$PRODUCT_NAME'  ";


            $result2=mysqli_query($conn,$CheckIfItemPresent);
            if(mysqli_num_rows($result2) >0)
            {
            //IF ITEM IS PRESENT  REMOVE IT FROM LIST


             $RemoveItem="DELETE FROM ConfirmedPurchaseList WHERE COMPANY_NAME='$COMPANY_NAME'  AND PRODUCT_NAME='$PRODUCT_NAME'";

             if (mysqli_query($conn,$RemoveItem)) {
                  echo "<div class='alert alert-success'><a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>$PRODUCT_NAME IS REMOVED FROM LIST</b></div>";
              } else {
                  echo "Error deleting record: " . mysqli_error($conn);
              }

              mysqli_close($conn);
              
                    
                  
                
            }
            else if(mysqli_num_rows($result2) <=0){
              
                      echo "<div class='alert alert-success'><a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>NO ITEM PRESENT TO REMOVE</b></div>";
                  
            }
            

exit();
}
else{
 //echo"<div class='alert alert-warning'><a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>ErrorRemoving Data</b></div>".mysqli_error($conn); 
}


//Confirm order
if(isset($_POST['btnConfirm']))

{
            //Perform an query to count the number of rows were CONFIRMED AND RETURN MAXIMUM COLUMN
            //echo'Total Purcase list count is '.$ITEM_COUNT."  for category ".$SuppplierCategory;
              /*
                Get the list of all Items confrimed with respect to to the company name from ConfirmedPurchaseList table
                Display  to supplier
               */

             //Get supplier name
              $getSupplierName="SELECT COMPANY_NAME FROM useregistration WHERE email='$EMAIL'AND REGISTERD_AS='$REGISTERD_AS'";
                  $result = mysqli_query($conn,$getSupplierName);

                  if (mysqli_num_rows($result) > 0) {
                      // output data of each row
                      while($row = mysqli_fetch_assoc($result)) {
                          $COMPANY_NAME=$row['COMPANY_NAME'];
                         
                      }
                  } else {
                      echo "error getting data ".mysqli_error();
                  }
              //Get item count per order by email of buyer
              // $GetItemCount="SELECT COUNT(CONFIRMATION) FROM ConfirmedPurchaseList WHERE COMPANY_NAME='$COMPANY_NAME'";

                   //$rs = mysqli_query($conn,$GetItemCount);
                 //-----------^  need to run query here

                 //$num = mysqli_fetch_array($rs);
                 //here you can echo the result of query
                  //$CONFIRMED_COUNT=$num[0];
                  //var_dump($CONFIRMED_COUNT);

                  //test row count

                  $getSupplierName="SELECT DISTINCT HOTEL_EMAIL FROM ConfirmedPurchaseList WHERE COMPANY_NAME='$COMPANY_NAME' ";
                  $resultXXX = mysqli_query($conn,$getSupplierName);

                  if (mysqli_num_rows($resultXXX) > 0) {
                      // output data of each row
                      
                      while($row = mysqli_fetch_assoc($resultXXX)) {
                              
                           $CUSTOMER_EMAIL=$row['HOTEL_EMAIL'];
                           $array_lenght=count($COUNT_BY_EMAIL);
                          





                           //echo "This is the array count ".$Customer_EMAIL."<br>"." ";

                             //echo"GEt count for this email ".$COMPANY_NAME."<br>";

                            //Get item count per order by email of buyer
                             $GetItemCount="SELECT  COUNT(CONFIRMATION) FROM ConfirmedPurchaseList WHERE COMPANY_NAME='$COMPANY_NAME' AND HOTEL_EMAIL='$CUSTOMER_EMAIL'";

                                $rs = mysqli_query($conn,$GetItemCount);
                               //-----------^  need to run query here

                               $num = mysqli_fetch_array($rs);
                               //here you can echo the result of query
                                $CONFIRMED_COUNT=$num[0];
                               
                                 $TOTAL_PRICE=GetGandTotal($COMPANY_NAME,$CUSTOMER_EMAIL);

                                  //Check for duplicate entry before moving order to que list
                                  if( CheckDuplicateEntry($CONFIRMED_COUNT,$COMPANY_NAME,$CUSTOMER_EMAIL)===false)
                                    {
                                                  //Move Orderto que 
                                                  $MoveOrderToQue="INSERT INTO ConfirmedSupplyQueList (COMPANY_NAME,CONFIRMED_COUNT,ACTUAL_COUNT,TOTAL_PRICE,SUPPLIER_CATEGORY,HOTEL_EMAIL) VALUES('$COMPANY_NAME','$CONFIRMED_COUNT','$ITEM_COUNT','$TOTAL_PRICE','$SuppplierCategory','$CUSTOMER_EMAIL')"; 
                                                  if (mysqli_query($conn, $MoveOrderToQue)) 
                                                  {
                                                    //echo"This is the count for email ".$CUSTOMER_EMAIL."  " .$CONFIRMED_COUNT."<BR>"; 
                                                  }
                                                  else
                                                  {
                                                    echo "error getting data ".mysqli_error($conn);
                                                  }

                                    }
                                  else if(CheckDuplicateEntry($CONFIRMED_COUNT,$COMPANY_NAME,$CUSTOMER_EMAIL)===true)
                                  {
                                      echo "<div class='alert alert-warning'><a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>SUPPLY ORDER FOR $COMPANY_NAME ALREADY SENT</b></div>";
                                  }

                          
                          

                      }
                      

                  } else {
                      echo "error getting data ".mysqli_error();
                  }





                   //tEST sTUB
                  //exit();
              //Move Orderto que 

                      //Check name if present is present to avoid duplicate entry

                     
                                                //$TOTAL_PRICE=GetGandTotal($COMPANY_NAME);
                                          //$MoveOrderToQue="INSERT INTO ConfirmedSupplyQueList (COMPANY_NAME,CONFIRMED_COUNT,ACTUAL_COUNT,TOTAL_PRICE,SUPPLIER_CATEGORY,CUSTOMER_EMAIL) VALUES('$COMPANY_NAME','$CONFIRMED_COUNT','$ITEM_COUNT','$TOTAL_PRICE','$SuppplierCategory','$CUSTOMER_EMAIL')"; 



                                                //if (mysqli_query($conn, $MoveOrderToQue)) 
                                                //{
                                                   // echo "<div class='alert alert-success'><a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>PROCESSING ORDER</b></div>";

                                                  #Display total lis
                                          $GetConfimedListOrder="SELECT * FROM ConfirmedPurchaseList WHERE COMPANY_NAME='$COMPANY_NAME' ";

                                          

                                          $result4=mysqli_query($conn,$GetConfimedListOrder);
                                          if(mysqli_num_rows($result4) >0)
                                          {
                                             //IF ITEM Is PRESENT DISPLAY IN TABLE FORMAT

                                                    echo" <p align='center'><b>$COMPANY_NAME HAS SUPPLIED $CONFIRMED_COUNT OUT OF $ITEM_COUNT THE SUPPLY ORDER IS BEING PROCESSED PLEASE WAIT CONFIRMATION</b></p>
                                                          <form id='formOder' action='php/MakeOrder2.php' method='post' enctype='multipart/form-data'>
                                                          <table id='PurChaseOrderForm' class='table'>
                                                          <tbody>
                                                            
                                                            <thead>
                                                            <tr>
                                                              <td><strong>COMPANY NAME</strong></td>
                                                              <td><strong>PRODUCT NAME</strong></td>
                                                              <td><strong>IMAGE</strong></td>
                                                              <td><strong>QUANTITY</strong></td>
                                                              <td><strong>UNIT</strong></td>
                                                              <td><strong>PRICE PER UNIT</strong></td>
                                                              <td><strong>TOTAL</strong></td>
                                                              <td><strong>STATUS</strong></td>
                                                              </tr>
                                                            </thead>
                                                              
                                                            ";


                                                    while($row = mysqli_fetch_assoc($result4)) 
                                                    {
                                                                          $COMPANY_NAME=$row['COMPANY_NAME'];
                                                                          $PRODUCT_NAME=$row['PRODUCT_NAME'];
                                                                          $Image=$row['PRODUCT_IMAGE'];
                                                                          $UNIT=$row['UNIT'];
                                                                          $QUANTITY=$row['QUANTITY'];
                                                                          $CONFIRMATION=$row['CONFIRMATION'];
                                                                          $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                                                                          $PPP=money_format("Tsh %i",$PRICE_PER_UNIT);
                                                                          $TOTAL_PRICE=$row['TOTAL_PRICE'];
                                                                          $TP=money_format("Tsh %i",$TOTAL_PRICE); 

                                                                          echo"
                                                                      <tr>
                                                                      <td><b>".$COMPANY_NAME."</b></td>
                                                                      <td><b>".$PRODUCT_NAME."</b></td>
                                                                      <td><img src='http://pick2get.com/Asset/image/$Image' style='width:60px' style='width:60px' ></td>
                                                                      <td><b>".$QUANTITY."</b></td>
                                                                      <td><b>".$UNIT."</b></td>
                                                                      <td><b>".$PPP."</b></td>
                                                                      <td><b>".$TP."</b></td>
                                                                      <td><b>".$CONFIRMATION."</b></td>
                                                                      </tr>";

                                                      
                                                    }
                                                            GetMasterTotal($COMPANY_NAME);         
                                                  
                                                                                   
                                                 echo"
                                                                            </tbody>
                                                                                 </table>
                                                                                 </form>"; 
                                                
                                          }
                                         
                                            
                                          



                                                    
                                              //  } else {
                                                //    echo "Error: "  . mysqli_error($conn);
                                                //}

                                
                                        
                                




                                
                                

                                 
                                            
              
              /*
                Copy all 
              
              */



              

                      


}
else
{
//  echo"<div class='alert alert-warning'><a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error Confirming order list</b></div>".mysqli_error($conn); 
}

//Reject order
if(isset($_POST['btnReject']))
{
//perform an query to store this as rejected order
echo"<div class='alert alert-warning'><a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>SUPPLY ORDER DELETED WAITIG FOR NEW ORDER LIST </b></div>";

exit();

}
else
{
  //echo"<div class='alert alert-warning'><a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error Canceling order list</b></div>".mysqli_error($conn); 
}

//function definiton for checking duplicate entry

function CheckDuplicateEntry($CONFIRMED_COUNT,$COMPANY_NAME,$CUSTOMER_EMAIL){


define("DB_SERVER", "195.8.222.39");
define("DB_USER", "pick2get");
define("DB_PASSWORD", "3DZX5J8k");
define("DB_DATABASE", "pick2get");


$servername = "localhost";
$username = "pick2get";
$password = "3DZX5J8k";
$dbname = "pick2get_pick2get";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);



  $CheckDuplicate="SELECT * FROM ConfirmedSupplyQueList WHERE COMPANY_NAME='$COMPANY_NAME' AND CONFIRMED_COUNT='$CONFIRMED_COUNT' AND HOTEL_EMAIL='$CUSTOMER_EMAIL'";

  $DuplicateResult=mysqli_query($conn,$CheckDuplicate);

  
  if(mysqli_num_rows($DuplicateResult) >0)
           { 

            return true;

           }
            else{
              return false;
            }
    

}
/*
The purpose of this function is to get the price per unit and total for a particular company
*/
function GetGandTotal($COMPANY_NAME,$HOTEL_EMAIL){

define("DB_SERVER", "195.8.222.39");
define("DB_USER", "pick2get");
define("DB_PASSWORD", "3DZX5J8k");
define("DB_DATABASE", "pick2get");


$servername = "localhost";
$username = "pick2get";
$password = "3DZX5J8k";
$dbname = "pick2get_pick2get";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$GetPriceAndTotal="SELECT SUM(TOTAL_PRICE) AS TOTAL_PRICE FROM ConfirmedPurchaseList WHERE COMPANY_NAME='$COMPANY_NAME' AND HOTEL_EMAIL='$HOTEL_EMAIL'" ;


$result = mysqli_query($conn,$GetPriceAndTotal); 

while ($row = mysqli_fetch_assoc($result))
{ 
   $total=$row['TOTAL_PRICE'];
   $sum = money_format("Tsh %i",$row['TOTAL_PRICE']);

   //echo"<div alig='center'><b>The grand Total is ".$sum."<b> </div>"."<br>";
   return $total;

}
 

mysqli_close($conn);


}

function GetMasterTotal($COMPANY_NAME){

define("DB_SERVER", "195.8.222.39");
define("DB_USER", "pick2get");
define("DB_PASSWORD", "3DZX5J8k");
define("DB_DATABASE", "pick2get");


$servername = "localhost";
$username = "pick2get";
$password = "3DZX5J8k";
$dbname = "pick2get_pick2get";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$GetPriceAndTotal="SELECT SUM(TOTAL_PRICE) AS TOTAL_PRICE FROM ConfirmedPurchaseList WHERE COMPANY_NAME='$COMPANY_NAME'" ;


$result = mysqli_query($conn,$GetPriceAndTotal); 

while ($row = mysqli_fetch_assoc($result))
{ 
   $total=$row['TOTAL_PRICE'];
   $sum = money_format("Tsh %i",$row['TOTAL_PRICE']);

   echo"<div alig='center'><b>The grand Total is ".$sum."<b> </div>"."<br>";
   return $total;

}
 

mysqli_close($conn);


}

function GetClientEmail($PRODUCT_NAME){

define("DB_SERVER", "195.8.222.39");
define("DB_USER", "pick2get");
define("DB_PASSWORD", "3DZX5J8k");
define("DB_DATABASE", "pick2get");


$servername = "localhost";
$username = "pick2get";
$password = "3DZX5J8k";
$dbname = "pick2get_pick2get";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$GetEmail="SELECT HOTEL_EMAIL FROM PurchaseOrderTable WHERE PRODUCT_NAME='$PRODUCT_NAME'";
$result=mysqli_query($conn,$GetEmail);

while($row=mysqli_fetch_assoc($result))
{
  $email=$row['HOTEL_EMAIL'];
  return $email;

}


}




?>