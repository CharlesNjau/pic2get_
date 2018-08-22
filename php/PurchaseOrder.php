<?php
include_once('conn2.php');
// PurChaseOrdeS SCript For Admin


if(isset($_GET['MakerOder'])){
  echo"
  <h2 align='center'><B>ORDERS SENT TO SUPPLIERS</B></h2>
  <form id='orderform'  action='php/MakeOrder.php' method='post' enctype='multipart/form-data'>
                                        <table class='table' style='font-size: 11px;'>
                                        <tbody>
                                         <thead>
                                          <tr>

                                            <td width='189'><strong>PRODUCT NAME</strong></td>
                                            <td width='133'><strong>IMAGE</strong></td>
                                            <td width='188'><strong>QUANTITY</strong></td>
                                            <td width='140'><strong>UNIT</strong></td>
                                            <td width='140'><strong>SUPPLIER_CATEGORY</strong></td>
                                            <td width='140'><strong>FROM_CLIENT</strong></td>
                                            
                                            
                                          </tr>
                                          </thead>";


                                          $ShowPurchaseOrder="SELECT * FROM  RecordedPurchaseOrderTable";//Fetch this from recorded purchase RecordedPurchaseOrderTable since this will be cleared after 12hours
                                          $result=mysqli_query($conn,$ShowPurchaseOrder);
                                          if(mysqli_num_rows($result) > 0)
                                    {  


                                        
                                       while($row = $result->fetch_assoc()) 
                                        {
                                            $Image=$row['PRODUCT_IMAGE'];
                                            $PRODUCT_NAME=$row['PRODUCT_NAME'];
                                            $UNIT=$row['UNIT'];
                                            $QUANTITY=$row['QUANTITY'];
                                            $SUPPLIER_CATEGORY=$row['SUPPLIER_CATEGORY'];
                                            $FROM_CLIENT=$row['HOTEL_EMAIL'];
                                           

                                            echo"
                                               
                                                <tr>
                                                <td>". $PRODUCT_NAME."</td>
                                                <td><img src='Asset/image/$Image' class='img-responsive' style='width:30px' style='width:30px'></td>
                                                <td>".$QUANTITY."</td>
                                                <td>".$UNIT."</td>
                                                <td>".$SUPPLIER_CATEGORY."</td>
                                                <td>".$FROM_CLIENT."</td>
                                                
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

//geT items to be sy
if(isset($_GET['GetItemsToBrSuppliedToClient']))
{
  //View product to be bought from supplier
  echo"
  <h2 align='center'><B>APPROVED ITEMS TO BE DELIVERD TO CLIENT IN 48 HOURS</B></h2>
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
                                            <td><strong>PAYMENT_APPROVAL_STATUS</strong></td>
                                            <td width='140'><strong>TO BE SUPPLIED TO CLIENT</strong></td>


                                            
                                          </tr>
                                          </thead>";
                                          
                                          $ShowAcceptedSupplyListItems="
SELECT RecordedConfirmedPurchaseList.PRODUCT_NAME,RecordedConfirmedPurchaseList.PRODUCT_IMAGE,RecordedConfirmedPurchaseList.QUANTITY,RecordedConfirmedPurchaseList.UNIT,RecordedConfirmedPurchaseList.PRICE_PER_UNIT,RecordedConfirmedPurchaseList.TOTAL_PRICE,AcceptedSupplyList.PAYMENT_APPROVAL_STATUS,RecordedConfirmedPurchaseList.HOTEL_EMAIL,AcceptedSupplyList.COMPANY_NAME FROM AcceptedSupplyList,RecordedConfirmedPurchaseList WHERE AcceptedSupplyList.HOTEL_EMAIL=RecordedConfirmedPurchaseList.HOTEL_EMAIL";
                                          $result1=mysqli_query($conn,$ShowAcceptedSupplyListItems);

                                          

                                      if(mysqli_num_rows($result1)>0)
                                      {
                                        while($row = $result1->fetch_assoc()) 
                                        {
                                            $COMPANY_NAME=$row['COMPANY_NAME'];
                                            $PAYMENT_APPROVAL_STATUS=$row['PAYMENT_APPROVAL_STATUS'];
                                            $PRODUCT_NAME=$row['PRODUCT_NAME'];
                                            $PRODUCT_IMAGE=$row['PRODUCT_IMAGE'];
                                            $QUANTITY=$row['QUANTITY'];
                                            $UNIT=$row['UNIT'];
                                            $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                                            $TOTAL_PRICE=$row['TOTAL_PRICE']; 
                                            $FROM_CLIENT=$row['HOTEL_EMAIL'];
                                            

                                            echo"
                                               
                                                <tr>
                                                <td>".$COMPANY_NAME."</td>
                                                <td>".$PRODUCT_NAME."</td>
                                                <td><img src='Asset/image/$PRODUCT_IMAGE' class='img-responsive' style='width:30px' style='width:30px'></td>
                                                <td>".$QUANTITY."</td>
                                                <td>".$UNIT."</td>
                                                <td>".$PRICE_PER_UNIT."</td>
                                                <td>".$TOTAL_PRICE."</td>
                                                <td>".$PAYMENT_APPROVAL_STATUS."</td>
                                                <td>".getName($FROM_CLIENT)."</td>
                                                </tr>
                                                ";//onclick=getVal('".$product."')
                                              

                                            
                                            
                                        }

                                      }
                                      else
                                      {
                                          echo"Error".mysqli_error($conn);
                                      }
                                        

                                       
                                         echo" </tbody>
                                                            </table>
                                                            ";
                                      

                                    

                                      echo  "</table>
                                        
                                        
                                        </form>";



 

}

//GEt items to be supplied to pick toget

if(isset($_GET['GetItemsToBrSuppliedToUs']))
{
  //View product to be bought from supplier
  echo"
  <h2 align='center'><B>APPROVED ITEMS TO BE DELIVERD TO PICK2GET IN 24 HOURS</B></h2>
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
                                            <td><strong>PAYMENT_APPROVAL_STATUS</strong></td>
                                            <td><strong>TO BE SUPPLIED TO CLIENT</strong></td>


                                            
                                          </tr>
                                          </thead>";
                                          
                                          $ShowAcceptedSupplyListItems="
SELECT RecordedConfirmedPurchaseList.PRODUCT_NAME,RecordedConfirmedPurchaseList.PRODUCT_IMAGE,RecordedConfirmedPurchaseList.QUANTITY,RecordedConfirmedPurchaseList.UNIT,RecordedConfirmedPurchaseList.PRICE_PER_UNIT,RecordedConfirmedPurchaseList.TOTAL_PRICE,AcceptedSupplyList.PAYMENT_APPROVAL_STATUS,RecordedConfirmedPurchaseList.HOTEL_EMAIL,AcceptedSupplyList.COMPANY_NAME FROM AcceptedSupplyList,RecordedConfirmedPurchaseList WHERE AcceptedSupplyList.HOTEL_EMAIL=RecordedConfirmedPurchaseList.HOTEL_EMAIL";
                                          $result1=mysqli_query($conn,$ShowAcceptedSupplyListItems);

                                          

                                      if(mysqli_num_rows($result1)>0)
                                      {
                                        while($row = $result1->fetch_assoc()) 
                                        {
                                            $COMPANY_NAME=$row['COMPANY_NAME'];
                                            $PAYMENT_APPROVAL_STATUS=$row['PAYMENT_APPROVAL_STATUS'];
                                            $PRODUCT_NAME=$row['PRODUCT_NAME'];
                                            $PRODUCT_IMAGE=$row['PRODUCT_IMAGE'];
                                            $QUANTITY=$row['QUANTITY'];
                                            $UNIT=$row['UNIT'];
                                            $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                                            $TOTAL_PRICE=$row['TOTAL_PRICE']; 
                                            $FROM_CLIENT=$row['HOTEL_EMAIL'];
                                            

                                            echo"
                                               
                                                <tr>
                                                <td>".$COMPANY_NAME."</td>
                                                <td>".$PRODUCT_NAME."</td>
                                                <td><img src='Asset/image/$PRODUCT_IMAGE' class='img-responsive' style='width:30px' style='width:30px'></td>
                                                <td>".$QUANTITY."</td>
                                                <td>".$UNIT."</td>
                                                <td>".$PRICE_PER_UNIT."</td>
                                                <td>".$TOTAL_PRICE."</td>
                                                <td>".$PAYMENT_APPROVAL_STATUS."</td>
                                                <td>".getName($FROM_CLIENT)."</td>
                                                </tr>
                                                ";//onclick=getVal('".$product."')
                                              

                                            
                                            
                                        }

                                      }
                                      else
                                      {
                                          echo"Error".mysqli_error($conn);
                                      }
                                        

                                       
                                         echo" </tbody>
                                                            </table>
                                                            ";
                                      

                                    

                                      echo  "</table>
                                        
                                        
                                        </form>";



 

}
//Checks the delivery status all sent items 
if(isset($_GET['DeliveryStatus']))
{
  //View product to be bought from supplier
  echo"
  <h2 align='center'><B>DELIVERY STATUS OF ITEM</B></h2>
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
                                            <td><strong>CONFIRMATION</strong></td>
                                            <td><strong>CONFIRMATION_STATUS</strong></td>
                                            <td><strong>RECORDED_TIME</strong></td>
                                            <td><strong>DELIVERY_STATUS_TO_US(IN 24HRS)</strong></td>
                                            <td><strong>DELIVERD_TO_US_ON</strong></td>
                                            <td><strong>DELIVERY_STATUS_TO_CLIENT(IN 48HRS)</strong></td>
                                            <td><strong>DELIVERD_TO_CLIENT_ON</strong></td>
                                            <td><strong>DELIVERD_TO_CLIENT</strong></td>



                                            
                                          </tr>
                                          </thead>";
                                          
                                          $ShowAcceptedSupplyListItems="SELECT * FROM `RecordedConfirmedPurchaseList`";
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
                                            $CONFIRMATION=$row['CONFIRMATION'];
                                            $CONFIRM_STATUS=$row['CONFIRM_STATUS'];
                                            $RECORDED_TIME=$row['RECORDED_TIME'];
                                            $DELIVERY_STATUS_TO_US=$row['DELIVERY_STATUS_TO_US'];
                                            $DELIVERD_TO_US_ON=$row['DELIVERD_TO_US_ON'];
                                            $DELIVERY_STATUS_TO_CLIENT=$row['DELIVERY_STATUS_TO_CLIENT'];
                                            $DELIVERD_TO_CLIENT_ON=$row['DELIVERD_TO_CLIENT_ON'];

                                            $FROM_CLIENT=$row['HOTEL_EMAIL'];
                                            

                                            echo"
                                               
                                                <tr>
                                                <td>".$COMPANY_NAME."</td>
                                                <td>".$PRODUCT_NAME."</td>
                                                <td><img src='Asset/image/$PRODUCT_IMAGE' class='img-responsive' style='width:30px' style='width:30px'></td>
                                                <td>".$QUANTITY."</td>
                                                <td>".$UNIT."</td>
                                                <td>".$PRICE_PER_UNIT."</td>
                                                <td>".$TOTAL_PRICE."</td>
                                                <td>".$CONFIRMATION."</td>
                                                <td>".$CONFIRM_STATUS."</td>
                                                <td>".$RECORDED_TIME."</td>
                                                <td>".$DELIVERY_STATUS_TO_US."</td>
                                                <td>".$DELIVERD_TO_US_ON."</td>
                                                <td>".$DELIVERY_STATUS_TO_CLIENT."</td>
                                                <td>".$DELIVERD_TO_CLIENT_ON."</td>
                                                <td>".getName($FROM_CLIENT)."</td>
                                                </tr>
                                                ";//onclick=getVal('".$product."')
                                              

                                            
                                            
                                        }

                                      }
                                      else
                                      {
                                          echo"Error".mysqli_error($conn);
                                      }
                                        

                                       
                                         echo" </tbody>
                                                            </table>
                                                            ";
                                      

                                    

                                      echo  "</table>
                                        
                                        
                                        </form>";



 

}

//Get Accepted orders

if(isset($_GET['GetAcceptedSuuplyOrer']))
{
  //View product to be bought from supplier
  echo"
  <h2 align='center'><B>ACCEPTED SUPPLY ORDER FROM SUPPLIERS</B></h2>
  <form id='orderform'  action='php/MakeOrder.php' method='post' enctype='multipart/form-data'>
                                        <table class='table'>
                                        <tbody>
                                         <thead>
                                          <tr>

                                            <td width='189'><strong>COMPANY_NAME</strong></td>
                                            <td width='140'><strong>SUPPLIER_CATEGORY</strong></td>
                                            <td width='133'><strong>PRODUCT_NAME</strong></td>
                                            <td width='188'><strong>PRODUCT_IMAGE</strong></td>
                                            <td width='140'><strong>QUANTITY</strong></td>
                                            <td width='140'><strong>UNIT</strong></td>
                                            <td width='140'><strong>PRICE_PER_UNIT</strong></td>
                                            <td width='140'><strong>TOTAL_PRICE</strong></td>
                                            <td width='140'><strong>ORDER FOR CLIENT</strong></td>

                                            
                                          </tr>
                                          </thead>";
                                          
                                          $ShowAcceptedSupplyListItems="SELECT useregistration.COMPANY_NAME,useregistration.SUPPLIER_CATEGORY,useregistration.ACCOUNT_TYPE,ConfirmedPurchaseList.PRODUCT_NAME,ConfirmedPurchaseList.PRODUCT_IMAGE,ConfirmedPurchaseList.QUANTITY,ConfirmedPurchaseList.UNIT,ConfirmedPurchaseList.PRICE_PER_UNIT,ConfirmedPurchaseList.TOTAL_PRICE,ConfirmedPurchaseList.HOTEL_EMAIL FROM useregistration,ConfirmedPurchaseList WHERE useregistration.COMPANY_NAME=ConfirmedPurchaseList.COMPANY_NAME";
                                          $result1=mysqli_query($conn,$ShowAcceptedSupplyListItems);

                                          

                                      if(mysqli_num_rows($result1)>0)
                                      {
                                        while($row = $result1->fetch_assoc()) 
                                        {
                                            $COMPANY_NAME=$row['COMPANY_NAME'];
                                            $SUPPLIER_CATEGORY=$row['SUPPLIER_CATEGORY'];
                                            $PRODUCT_NAME=$row['PRODUCT_NAME'];
                                            $PRODUCT_IMAGE=$row['PRODUCT_IMAGE'];
                                            $QUANTITY=$row['QUANTITY'];
                                            $UNIT=$row['UNIT'];
                                            $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                                            $TOTAL_PRICE=$row['TOTAL_PRICE']; 
                                            $FROM_CLIENT=$row['HOTEL_EMAIL'];
                                            

                                            echo"
                                               
                                                <tr>
                                                <td>".$COMPANY_NAME."</td>
                                                <td>".$PRODUCT_NAME."</td>
                                                <td><img src='Asset/image/$PRODUCT_IMAGE' class='img-responsive' style='width:30px' style='width:30px'></td>
                                                <td>".$QUANTITY."</td>
                                                <td>".$UNIT."</td>
                                                <td>".$PRICE_PER_UNIT."</td>
                                                <td>".$TOTAL_PRICE."</td>
                                                <td>".$SUPPLIER_CATEGORY."</td>
                                                <td>".$FROM_CLIENT."</td>
                                                </tr>
                                                ";//onclick=getVal('".$product."')
                                              

                                            
                                            
                                        }

                                      }
                                      else
                                      {
                                          echo"Error".mysqli_error($conn);
                                      }
                                        

                                       
                                         echo" </tbody>
                                                            </table>
                                                            ";
                                      

                                    

                                      echo  "</table>
                                        
                                        
                                        </form>";








echo"<p><br><br><br></p>";







  //Diplay Item to be payed to with total per order
   echo"
  <h2 align='center'><B>ACCEPTED SUPPLY ORDER FROM SUPPLIERS</B></h2>
  <form id='orderform'  action='php/MakeOrder.php' method='post' enctype='multipart/form-data'>
                                        <table class='table' style='font-size: 11px;'>
                                        <tbody>
                                         <thead>
                                          <tr>

                                            <td width='189'><strong>COMPANY_NAME</strong></td>
                                            <td width='133'><strong>TOTAL_PRICE</strong></td>
                                            <td width='188'><strong>CONFIRMED_COUNT</strong></td>
                                            <td width='140'><strong>ACTUAL_COUNT</strong></td>
                                            <td width='140'><strong>SUPPLIER_CATEGORY</strong></td>
                                            <td width='140'><strong>MODE_OF_PAYEMNT</strong></td>
                                            <td width='140'><strong>ACTION</strong></td>
                                            <td width='140'><strong>ORDER FOR CLIENT</strong></td>

                                            
                                          </tr>
                                          </thead>";
                                          
                                          $ShowAcceptedSupplyList="SELECT useregistration.COMPANY_NAME,useregistration.ACCOUNT_TYPE,AcceptedSupplyList.TOTAL_PRICE,AcceptedSupplyList.CONFIRMED_COUNT,AcceptedSupplyList.ACTUAL_COUNT,AcceptedSupplyList.SUPPLIER_CATEGORY ,AcceptedSupplyList.HOTEL_EMAIL FROM useregistration,AcceptedSupplyList WHERE useregistration.COMPANY_NAME=AcceptedSupplyList.COMPANY_NAME";
                                          $result2=mysqli_query($conn,$ShowAcceptedSupplyList);

                                          

                                      if(mysqli_num_rows($result2)>0)
                                      {
                                        while($row = $result2->fetch_assoc()) 
                                        {
                                            $COMPANY_NAME=$row['COMPANY_NAME'];
                                            $TOTAL_PRICE=$row['TOTAL_PRICE'];
                                            $CONFIRMED_COUNT=$row['CONFIRMED_COUNT'];
                                            $ACTUAL_COUNT=$row['ACTUAL_COUNT'];
                                            $SUPPLIER_CATEGORY=$row['SUPPLIER_CATEGORY'];
                                            $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                                            $FROM_CLIENT=$row['HOTEL_EMAIL'];
                                            

                                            echo"
                                               
                                                <tr>
                                                <td>".$COMPANY_NAME."</td>
                                                <td>".$TOTAL_PRICE."</td>
                                                <td>".$CONFIRMED_COUNT."</td>
                                                <td>".$ACTUAL_COUNT."</td>
                                                <td>".$SUPPLIER_CATEGORY."</td>
                                                <td>".$ACCOUNT_TYPE."</td>
                                                <td><input type='button'id='BuyItem' COMPANY_NAME='$COMPANY_NAME' ACTUAL_COUNT='$ACTUAL_COUNT' CONFIRMED_COUNT='$CONFIRMED_COUNT' SUPPLIER_CATEGORY='$SUPPLIER_CATEGORY' PAYMENT_MODE='$ACCOUNT_TYPE' TOTAL_PRICE=$TOTAL_PRICE FROM_CLIENT='$FROM_CLIENT'  class='btn btn-info' value='$ACCOUNT_TYPE ' ></td>
                                                <td>".$FROM_CLIENT."</td>
                                                </tr>
                                                ";//onclick=getVal('".$product."')
                                              

                                            
                                            
                                        }

                                      }
                                      else
                                      {
                                          echo"Error".mysqli_error($conn);
                                      }
                                        

                                       
                                         echo" </tbody>
                                                            </table>
                                                            ";
                                      

                                    

                                      echo  "</table>
                                        
                                        
                                        </form>";
                                        $conn->close();
}
//Payment option button
if(isset($_POST['MakePurChase'])&&$_POST['MakePurChase']==='CREDIT')
{
   $PAYMENT_MODE=$_POST['MakePurChase'];
   $COMPANY_NAME=$_POST['COMPANY_NAME'];
   $TOTAL_PRICE=$_POST['TOTAL_PRICE'];
   $CONFIRMED_COUNT=$_POST['CONFIRMED_COUNT'];
   $ACTUAL_COUNT=$_POST['ACTUAL_COUNT'];
   $FROM_CLIENT=$_POST['FROM_CLIENT'];
  //Check for duplicate entry
  if(CheckDuplicateEntry($COMPANY_NAME,$FROM_CLIENT,$TOTAL_PRICE)===false)
  {
        if(PayMaster($COMPANY_NAME,$TOTAL_PRICE,$CONFIRMED_COUNT,$ACTUAL_COUNT,$PAYMENT_MODE,$FROM_CLIENT)===true)
       {
         
          exit();
       }
       else if(PayMaster($COMPANY_NAME,$TOTAL_PRICE,$CONFIRMED_COUNT,$ACTUAL_COUNT,$PAYMENT_MODE,$FROM_CLIENT)===false)
       {
        
        exit();

       }

  }
  else if(CheckDuplicateEntry($COMPANY_NAME,$FROM_CLIENT,$TOTAL_PRICE)===false)
  {

  } 
  

}

else if (isset($_POST['MakePurChase'])&&$_POST['MakePurChase']==='CASH')
{
   $PAYMENT_MODE=$_POST['MakePurChase'];
   $COMPANY_NAME=$_POST['COMPANY_NAME'];
   $TOTAL_PRICE=$_POST['TOTAL_PRICE'];
   $CONFIRMED_COUNT=$_POST['CONFIRMED_COUNT'];
   $ACTUAL_COUNT=$_POST['ACTUAL_COUNT'];
   $FROM_CLIENT=$_POST['FROM_CLIENT'];

  
   

   if(PayMaster($PAYMENT_MODE,$COMPANY_NAME,$TOTAL_PRICE,$CONFIRMED_COUNT,$ACTUAL_COUNT,$PAYMENT_MODE,$FROM_CLIENT)===true)
   {
      
      exit();
   }
   else if(PayMaster($PAYMENT_MODE,$COMPANY_NAME,$TOTAL_PRICE,$CONFIRMED_COUNT,$ACTUAL_COUNT,$PAYMENT_MODE,$FROM_CLIENT)===false)
   {
   echo "Error updating record for ".$PAYMENT_MODE." transaction payment"." to account ".$COMPANY_NAME;
    exit();

   }

   

}


function PayMaster($COMPANY_NAME,$TOTAL_PRICE,$CONFIRMED_COUNT,$ACTUAL_COUNT,$PAYMENT_MODE,$FROM_CLIENT)
{
         
          //cONNECTION sRTING dATA
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




          // Check connection
          if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
          }

          //Date varaible data

          //GET DATE
          //DEfault time zone
          date_default_timezone_set('EAC');
          $today = date("F j, Y, g:i a");


          $sql = "UPDATE AcceptedSupplyList SET PAYMENT_APPROVAL_STATUS='APPROVED',DATE_OF_PAYMENT='$today',MODE_OF_PAYMENT='$PAYMENT_MODE' WHERE HOTEL_EMAIL='$FROM_CLIENT'";

          if ($conn->query($sql) === TRUE)
          {
              echo "Record updated successfully for ".$PAYMENT_MODE." transaction payment"." to account ".$COMPANY_NAME."<BR>";

              if(UpdateBackUp($COMPANY_NAME)===true)
              {
                  exit(); 
              }
              else if(UpdateBackUp($COMPANY_NAME)===true){
                exit();

              }
              return true;
          } 
          else
          {
              echo"Error ".mysqli_error($conn)."<br>";
              return false;
          }

          $conn->close();

}	

function UpdateBackUp($COMPANY_NAME)//Update the Table RecordedConfirmedQueList 
{
   //cONNECTION sRTING dATA
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




          // Check connection
          if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
          }

          //Date varaible data

          //GET DATE
          //DEfault time zone
          date_default_timezone_set('EAC');
          $today = date("F j, Y, g:i a");


          $sql = "UPDATE RecordedConfirmedSupplyQueList SET ORDER_STATUS='APPROVED',APPROVED_ON='$today' WHERE COMPANY_NAME='$COMPANY_NAME'";

          if ($conn->query($sql) === TRUE)
          {
              
              return true;
          } 
          else
          {
              echo"Error ".mysqli_error($conn)."<br>";
              return false;
          }

          $conn->close();

}

function CheckDuplicateEntry($COMPANY_NAME,$FROM_CLIENT,$TOTAL_PRICE){


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



  $CheckDuplicate="SELECT * FROM AcceptedSupplyList WHERE COMPANY_NAME='$COMPANY_NAME'  AND HOTEL_EMAIL='$FROM_CLIENT' AND TOTAL_PRICE='$TOTAL_PRICE' AND PAYMENT_APPROVAL_STATUS='APPROVED'";

  $DuplicateResult=mysqli_query($conn,$CheckDuplicate);

  
  if(mysqli_num_rows($DuplicateResult) >0)
           { 
             
             echo"ALREADY PAID SUPPLIER: ".$COMPANY_NAME."FOR ORDDER OF HOTEL_EMAIL: ".$HOTEL_EMAIL." OF THE TOTAL_PRICE: ".$TOTAL_PRICE." IN ".$MODE_OF_PAYMENT." SUPPLIER_CATEGORY ".$SUPPLIER_CATEGORY."<br>";

            return true;

           }
            else{
              return false;
            }
    

}

function getName($FROM_CLIENT)
{

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

$GetName="SELECT COMPANY_NAME FROM useregistration WHERE EMAIL='$FROM_CLIENT'";

  $result=mysqli_query($conn,$GetName);

if (mysqli_num_rows($result) > 0) 
{
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) 
    {
         $HOTEL_NAME=$row['COMPANY_NAME'];
         return $HOTEL_NAME;
    }
     
}
else
  {
              echo"Error".mysqli_error($conn);
              return false;
  }


}

     
 


?>