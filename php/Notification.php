<?php
session_start();
include_once('conn2.php');
//super Global variable
$SUPPLIER_CATEGORY= $_SESSION['SUPPLIER_CATEGORY'];
$REGISTERD_AS=$_SESSION['ROLE'];
$NAME_OF_COMPANY=$_SESSION['COMPANY_NAME'];
$CATEGORY_OF_SUPPLIER=$_SESSION['SUPPLIER_CATEGORY'];
$EMAIL=$_SESSION['EMAIL'];
$GLOBALS['COMPANY_NAME'];
$ITEM_COUNT=$_SESSION['COUNT_VAL'];
$ACCOUNT_TYPE=$_SESSION['ACCOUNT_TYPE'];





// Notication SCript for all Three pages Admin,Hotel Client

//Admin Notification
if(isset($_GET['ChckItemsDeliverd'])){//Admin ChckItemsDeliverd
 /*echo"Admin ChckItemsDeliverd"."<br>";#Test Stub
 echo"NAME_OF_COMPANY: ".$NAME_OF_COMPANY."<br>";
   echo"CATEGORY_OF_SUPPLIER: ".$CATEGORY_OF_SUPPLIER."<br>";
    echo"EMAIL: ".$EMAIL."<br>";
     echo"REGISTERD_AS: ".$REGISTERD_AS."<br>";*/
     CheckDeliveryAdmin($NAME_OF_COMPANY,$EMAIL,$REGISTERD_AS);

}
if(isset($_GET['InbndPymnt'])){//Admin InbndPymnt
 
     CheckInboundPaymentAdmin($NAME_OF_COMPANY,$EMAIL,$REGISTERD_AS);

}
if(isset($_GET['OutbndPymnt'])){//Admin OutbndPymnt
  
     
     CheckOutboundPaymentAdmin($NAME_OF_COMPANY,$EMAIL,$REGISTERD_AS);
  
}
if(isset($_GET['PndPymnt'])){//Admin PndPymnt
  /*echo"Admin PndPymnt";
  echo"NAME_OF_COMPANY: ".$NAME_OF_COMPANY."<br>";
   echo"CATEGORY_OF_SUPPLIER: ".$CATEGORY_OF_SUPPLIER."<br>";
    echo"EMAIL: ".$EMAIL."<br>";
     echo"REGISTERD_AS: ".$REGISTERD_AS."<br>";*/
     CheckPendingPaymentAdmin($NAME_OF_COMPANY,$EMAIL,$REGISTERD_AS);
  
}
if(isset($_GET['CncldPymnt'])){//Admin CncldPymnt
  /*echo"Admin CncldPymnt"."<br>";
  echo"NAME_OF_COMPANY: ".$NAME_OF_COMPANY."<br>";
   echo"CATEGORY_OF_SUPPLIER: ".$CATEGORY_OF_SUPPLIER."<br>";
    echo"EMAIL: ".$EMAIL."<br>";
     echo"REGISTERD_AS: ".$REGISTERD_AS."<br>";*/
      CheckCancledAdmin($NAME_OF_COMPANY,$EMAIL,$REGISTERD_AS);
}

//Hotel Client notification
if(isset($_GET['H_ChckItemsDeliverd'])){//HotelClient Check Deliverd item
  
     CheckDelivery($NAME_OF_COMPANY,$EMAIL,$REGISTERD_AS);

  
}
if(isset($_GET['H_OutbndPymnt'])){//HotelClient Outbound Payments
  
     CheckOutboundPayment($NAME_OF_COMPANY,$EMAIL,$REGISTERD_AS,$ACCOUNT_TYPE);
  
}
if(isset($_GET['H_PndPymnt'])){//HotelClient Pending Payment
  
    CheckPendingPayment($NAME_OF_COMPANY,$EMAIL,$REGISTERD_AS);

  
}
if(isset($_GET['H_CncldPymnt'])){//HotelClient Canceled Payments
 
     CheckCancled($NAME_OF_COMPANY,$EMAIL,$REGISTERD_AS);
  
}

//Supplier Notification
if(isset($_GET['Transactionhistory'])){//Supplier Payment Histroy
   
     CheckTransactionHistory($NAME_OF_COMPANY,$EMAIL,$REGISTERD_AS);
  
  
}

//Add special offer notification
if(isset($_GET['AddSpecialOffer']))
{
     //View product to be bought from supplier
  echo"
  <span align=center id=form_feed_back></span>
  <h2 align='center'><B>SPECIAL OFFER CONSOLE</B></h2>
  <form id='orderform'  action='php/MakeOrder.php' method='post' enctype='multipart/form-data'>
  <textarea class='form-control' rows='5' id='Special_Offer'></textarea>
  <div align='center'>
  <input type=button id='ADD_SPECIAL_OFFER' class='btn btn-success' value='ADD_SPECIAL_OFFER'>
  <input type=button id='ADIM_VIEW_SPECIAL_OFFER' class='btn btn-success' value='VIEW_SPECIAL_OFFER'>
  </div>
                                        
  </form>";
                                          
                                         

                                       
}
if(isset($_POST['ADD_SPECIAL_OFFER']))
{
  $SPECIAL_OFFER_NAME=$_POST['Special_Offer'];
  if(ToAddSpecialOffer($SPECIAL_OFFER_NAME)===true){
    exit();
  }
  else if(ToAddSpecialOffer($SPECIAL_OFFER_NAME)===false){
    exit();
  }

}
//View Special offer Hotel Clien
if(isset($_GET['VIEW_SPECIAL_OFFER'])){
  //Generate view for speacial offers

  //View product to be bought from supplier
  echo"
  <p align='center' style='font-size: 11px;'><B>OFFER OF THE DAY</B></p>
  <form id='orderform'  action='php/MakeOrder.php' method='post' enctype='multipart/form-data'>
                                        <table class='table' style='font-size: 11px;'>
                                        <tbody>
                                         <thead>
                                            <tr>
                                            <td><strong>OFFER_OF_THE_DAY</strong></td>
                                            <td><strong>DATE</strong></td>

                                            </tr>
                                          </thead>";
                                          
                                          $ShowAcceptedSupplyListItems="SELECT * FROM SpeciaOffer ORDER BY ID DESC LIMIT 1";
                                          $result1=mysqli_query($conn,$ShowAcceptedSupplyListItems);

                                          

                                      if(mysqli_num_rows($result1)>0)
                                      {
                                        while($row = $result1->fetch_assoc()) 
                                        {
                                            
                                            $SPECIAL_OFFER_NAME=$row['SPECIAL_OFFER_NAME'];
                                            $ADDED_ON_DATE_RECORDED=$row['ADDED_ON_DATE_RECORDED'];
                                            
                                            

                                            echo"
                                               
                                                <tr>
                                                <td>".$SPECIAL_OFFER_NAME."</td>
                                                <td>".$ADDED_ON_DATE_RECORDED."</td>
                                                
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

//View Special offer Admin
if(isset($_GET['ADIM_VIEW_SPECIAL_OFFER'])){
  //Generate view for speacial offers

  //View product to be bought from supplier
  echo"
  <h2 align='center'><B>OFFER CONFIGARATION CONSOLE</B></h2>
  <form id='orderform'  action='php/MakeOrder.php' method='post' enctype='multipart/form-data'>
                                        <table class='table' style='font-size: 11px;'>
                                        <tbody>
                                         <thead>
                                            <tr>
                                            <td><strong>OFFER_OF_THE_DAY</strong></td>
                                            <td><strong>DATE</strong></td>

                                            </tr>
                                          </thead>";
                                          
                                          $ShowAcceptedSupplyListItems="SELECT * FROM SpeciaOffer";
                                          $result1=mysqli_query($conn,$ShowAcceptedSupplyListItems);

                                          

                                      if(mysqli_num_rows($result1)>0)
                                      {
                                        while($row = $result1->fetch_assoc()) 
                                        {
                                            
                                            $SPECIAL_OFFER_NAME=$row['SPECIAL_OFFER_NAME'];
                                            $ADDED_ON_DATE_RECORDED=$row[' ADDED_ON_DATE_RECORDED'];
                                            
                                            

                                            echo"
                                               
                                                <tr>
                                                <td>".$PRODUCT_NAME."</td>
                                                <td>".$ADDED_ON_DATE_RECORDED."</td>
                                                
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

//function declaration 
function CheckDelivery($NAME_OF_COMPANY,$EMAIL,$REGISTERD_AS)
{
   //cONNECTION STRING 
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
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 


  //Check The delivery of item 
   //echo" sent from function CheckDelivery NAME_OF_COMPANY: ".$NAME_OF_COMPANY."<br>";

  //View product to be bought from supplier
  echo"
  <h2 align='center'><B>CONFIRM THE DELIVERY ITEMS BY PICK2GET</B></h2>
  <form id='orderform'  action='php/MakeOrder.php' method='post' enctype='multipart/form-data'>
                                        <table class='table' style='font-size: 11px;'>
                                        <tbody>
                                         <thead>
                                          <tr>

                                            <td><strong>PRODUCT_NAME</strong></td>
                                            <td><strong>PRODUCT_IMAGE</strong></td>
                                            <td><strong>QUANTITY</strong></td>
                                            <td><strong>TO BE SUPPLIED TO CLIENT</strong></td>
                                            <td><strong>CONFIRM ITEM RECEIVED</strong></td>
                                            <td><strong>REJECT ITEM RECEIVED</strong></td>
                                            <td><strong>REMARKS</strong></td>




                                            
                                          </tr>
                                          </thead>";
                                          
                                          $ShowAcceptedSupplyListItems="
SELECT RecordedConfirmedPurchaseList.PRODUCT_NAME,RecordedConfirmedPurchaseList.PRODUCT_IMAGE,RecordedConfirmedPurchaseList.QUANTITY,RecordedConfirmedPurchaseList.UNIT,RecordedConfirmedPurchaseList.PRICE_PER_UNIT,RecordedConfirmedPurchaseList.TOTAL_PRICE,AcceptedSupplyList.PAYMENT_APPROVAL_STATUS,RecordedConfirmedPurchaseList.HOTEL_EMAIL,AcceptedSupplyList.COMPANY_NAME
FROM AcceptedSupplyList,RecordedConfirmedPurchaseList 
WHERE AcceptedSupplyList.HOTEL_EMAIL=RecordedConfirmedPurchaseList.HOTEL_EMAIL HAVING HOTEL_EMAIL='$EMAIL'";
                                          $result1=mysqli_query($conn,$ShowAcceptedSupplyListItems);

                                          

                                      if(mysqli_num_rows($result1)>0)
                                      {
                                        while($row = $result1->fetch_assoc()) 
                                        {
                                            
                                            $PRODUCT_NAME=$row['PRODUCT_NAME'];
                                            $PRODUCT_IMAGE=$row['PRODUCT_IMAGE'];
                                            $QUANTITY=$row['QUANTITY'];
                                            $UNIT=$row['UNIT'];
                                            $FROM_CLIENT=$row['HOTEL_EMAIL'];
                                            

                                            echo"
                                               
                                                <tr>
                                                <td>".$PRODUCT_NAME."</td>
                                                <td><img src='Asset/image/$PRODUCT_IMAGE' class='img-responsive' style='width:30px' style='width:30px'></td>
                                                <td>".$QUANTITY."</td>
                                                <td>".$UNIT."</td>
                                                <td>".getName($FROM_CLIENT)."</td>
                                                <td><input type='button'id='ConfirmItemDeliverd' COMPANY_NAME='$COMPANY_NAME' ACTUAL_COUNT='$ACTUAL_COUNT' CONFIRMED_COUNT='$CONFIRMED_COUNT' SUPPLIER_CATEGORY='$SUPPLIER_CATEGORY' PAYMENT_MODE='$ACCOUNT_TYPE' TOTAL_PRICE=$TOTAL_PRICE FROM_CLIENT='$FROM_CLIENT'  class='btn btn-info' value='CONFIRM RECEIVED ' ></td>
                                                <td><input type='button'id='RejectItemDeliverd' COMPANY_NAME='$COMPANY_NAME' ACTUAL_COUNT='$ACTUAL_COUNT' CONFIRMED_COUNT='$CONFIRMED_COUNT' SUPPLIER_CATEGORY='$SUPPLIER_CATEGORY' PAYMENT_MODE='$ACCOUNT_TYPE' TOTAL_PRICE=$TOTAL_PRICE FROM_CLIENT='$FROM_CLIENT'  class='btn btn-danger' value='REJECT ITEM' ></td>
                                                <td><textarea class='form-control' rows='3' id='comment'></textarea></td>
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

function CheckDeliveryAdmin($NAME_OF_COMPANY,$EMAIL,$REGISTERD_AS)
{
   //cONNECTION STRING 
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
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 


  //Check The delivery of item 
   //echo" sent from function CheckDelivery NAME_OF_COMPANY: ".$NAME_OF_COMPANY."<br>";

   //View product to be bought from supplier
  echo"
  <span id='formfeedback'></span>
  <h2 align='center'><B>CONFIRM THE DELIVERY ITEMS BY SUPPLIER</B></h2>
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
                                            <td><strong>CONFIRM ITEM RECEIVED</strong></td>
                                            <td><strong>REJECT ITEM RECEIVED</strong></td>
                                            <td><strong>REMARKS</strong></td>
                                            </tr>
                                          </thead>";
                                          
                                          $ShowAcceptedSupplyListItems="
SELECT RecordedConfirmedPurchaseList.PRODUCT_NAME,RecordedConfirmedPurchaseList.PRODUCT_IMAGE,RecordedConfirmedPurchaseList.QUANTITY,RecordedConfirmedPurchaseList.UNIT,RecordedConfirmedPurchaseList.PRICE_PER_UNIT,RecordedConfirmedPurchaseList.TOTAL_PRICE,AcceptedSupplyList.PAYMENT_APPROVAL_STATUS,RecordedConfirmedPurchaseList.HOTEL_EMAIL,AcceptedSupplyList.COMPANY_NAME
FROM AcceptedSupplyList,RecordedConfirmedPurchaseList 
WHERE AcceptedSupplyList.HOTEL_EMAIL=RecordedConfirmedPurchaseList.HOTEL_EMAIL";
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
                                            $CLIENT=getName($FROM_CLIENT);
                                            

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
                                                <td>".$CLIENT."</td>
                                                <td><input type='button'id='ConfirmItemDeliverd' COMPANY_NAME='$COMPANY_NAME' PRODUCT_NAME='$PRODUCT_NAME' PRODUCT_IMAGE='$PRODUCT_IMAGE' QUANTITY='$QUANTITY' UNIT='$UNIT' PRICE_PER_UNIT='$PRICE_PER_UNIT'  PAYMENT_APPROVAL_STATUS='$PAYMENT_APPROVAL_STATUS' TOTAL_PRICE='$TOTAL_PRICE' FROM_CLIENT='$CLIENT' DELIVERY_STATUS='ACCEPTED'  class='btn btn-info' value='CONFIRM RECEIVED '></td>
                                                <td><input type='button'id='RejectItemDeliverd' COMPANY_NAME='$COMPANY_NAME' PRODUCT_NAME='$PRODUCT_NAME' PRODUCT_IMAGE='$PRODUCT_IMAGE' QUANTITY='$QUANTITY' UNIT='$UNIT' PRICE_PER_UNIT='$PRICE_PER_UNIT'  PAYMENT_APPROVAL_STATUS='$PAYMENT_APPROVAL_STATUS' TOTAL_PRICE='$TOTAL_PRICE' FROM_CLIENT='$CLIENT' DELIVERY_STATUS='REJECTED'  class='btn btn-danger' value='REJECT ITEM'></td>
                                                <td><textarea class='form-control' rows='3' id='Remark'></textarea></td>
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


} 

function CheckInboundPayment($NAME_OF_COMPANY,$EMAIL,$REGISTERD_AS)
{
  //cONNECTION STRING 
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
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

   echo" sent from function CheckInboundPayment NAME_OF_COMPANY: ".$NAME_OF_COMPANY."<br>";

  //View product to be bought from supplier
  echo"
  <h2 align='center'><B>LIST OF INBOUND PAYMENTS </B></h2>
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
                                            <td><strong>FROM_CLIENT</strong></td>
                                                                                      
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

function CheckInboundPaymentAdmin($NAME_OF_COMPANY,$EMAIL,$REGISTERD_AS)
{
  //cONNECTION STRING 
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
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

   echo" sent from function CheckInboundPayment NAME_OF_COMPANY: ".$NAME_OF_COMPANY."<br>";

  //View product to be bought from supplier
  echo"
  <h2 align='center'><B>LIST OF INBOUND PAYMENTS TO PICK2GET </B></h2>
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
                                            <td><strong>FROM_CLIENT</strong></td>
                                                                                      
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

function CheckOutboundPayment($NAME_OF_COMPANY,$EMAIL,$REGISTERD_AS)
{
  //cONNECTION STRING 
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
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
   //echo" sent from function CheckOutboundPayment NAME_OF_COMPANY: ".$NAME_OF_COMPANY."<br>";



    echo"
  <h2 align='center'><B>OUT BOUND CREDIT PAYMENTS</B></h2>
  <form id='orderform'  action='php/MakeOrder.php' method='post' enctype='multipart/form-data'>
                                        <table class='table' style='font-size: 11px;'>
                                        <tbody>
                                         <thead>
                                          <tr>

                                            
                                            <td><strong>PRODUCT_NAME</strong></td>
                                            <td><strong>PRODUCT_IMAGE</strong></td>
                                            <td><strong>QUANTITY</strong></td>
                                            <td><strong>UNIT</strong></td>
                                            <td><strong>PRICE_PER_UNIT</strong></td>
                                            <td><strong>TOTAL_PRICE</strong></td>
                                            

                                            
                                          </tr>
                                          </thead>";
                                          
                                          $ShowAcceptedSupplyListItems="SELECT * FROM  sales  WHERE USER_EMAIL='$EMAIL' ";
                                          $result1=mysqli_query($conn,$ShowAcceptedSupplyListItems);

                                          

                                      if(mysqli_num_rows($result1)>0)
                                      {
                                        while($row = $result1->fetch_assoc()) 
                                        {
                                            
                                            
                                            $PRODUCT_NAME=$row['PRODUCT_NAME'];
                                            $PRODUCT_IMAGE=$row['PRODUCT_IMAGE'];
                                            $QUANTITY=$row['QUANTITY'];
                                            $UNIT=$row['UNIT'];
                                            $PRICE_PER_UNIT=$row['UNIT_PRICE'];
                                            $TOTAL_PRICE=$row['TOTAL']; 
                                            $FROM_CLIENT=$row['USER_EMAIL'];
                                            

                                            echo"
                                               
                                                <tr>
                                                <td>".$PRODUCT_NAME."</td>
                                                <td><img src='Asset/image/$PRODUCT_IMAGE' class='img-responsive' style='width:30px' style='width:30px'></td>
                                                <td>".$QUANTITY."</td>
                                                <td>".$UNIT."</td>
                                                <td>".$PRICE_PER_UNIT."</td>
                                                <td>".$TOTAL_PRICE."</td>
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

function CheckOutboundPaymentAdmin($NAME_OF_COMPANY,$EMAIL,$REGISTERD_AS)
{
  //cONNECTION STRING 
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
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
   //echo" sent from function CheckOutboundPayment NAME_OF_COMPANY: ".$NAME_OF_COMPANY."<br>";



    echo"
  <h2 align='center'><B>OUT BOUND PAYMENTS</B></h2>
  <form id='orderform'  action='php/MakeOrder.php' method='post' enctype='multipart/form-data'>
                                        <table class='table' style='font-size: 11px;'>
                                        <tbody>
                                         <thead>
                                          <tr>

                                            
                                            <td><strong>PRODUCT_NAME</strong></td>
                                            <td><strong>PRODUCT_IMAGE</strong></td>
                                            <td><strong>QUANTITY</strong></td>
                                            <td><strong>UNIT</strong></td>
                                            <td><strong>PRICE_PER_UNIT</strong></td>
                                            <td><strong>TOTAL_PRICE</strong></td>
                                            

                                            
                                          </tr>
                                          </thead>";
                                          
                                          $ShowAcceptedSupplyListItems="SELECT * FROM  sales  WHERE USER_EMAIL='$EMAIL' ";
                                          $result1=mysqli_query($conn,$ShowAcceptedSupplyListItems);

                                          

                                      if(mysqli_num_rows($result1)>0)
                                      {
                                        while($row = $result1->fetch_assoc()) 
                                        {
                                            
                                            
                                            $PRODUCT_NAME=$row['PRODUCT_NAME'];
                                            $PRODUCT_IMAGE=$row['PRODUCT_IMAGE'];
                                            $QUANTITY=$row['QUANTITY'];
                                            $UNIT=$row['UNIT'];
                                            $PRICE_PER_UNIT=$row['UNIT_PRICE'];
                                            $TOTAL_PRICE=$row['TOTAL']; 
                                            $FROM_CLIENT=$row['USER_EMAIL'];
                                            

                                            echo"
                                               
                                                <tr>
                                                <td>".$PRODUCT_NAME."</td>
                                                <td><img src='Asset/image/$PRODUCT_IMAGE' class='img-responsive' style='width:30px' style='width:30px'></td>
                                                <td>".$QUANTITY."</td>
                                                <td>".$UNIT."</td>
                                                <td>".$PRICE_PER_UNIT."</td>
                                                <td>".$TOTAL_PRICE."</td>
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

function CheckPendingPayment($NAME_OF_COMPANY,$EMAIL,$REGISTERD_AS)
{
  
//cONNECTION STRING 
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
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
   //echo" sent from function CheckPendingPayment NAME_OF_COMPANY: ".$NAME_OF_COMPANY."<br>";

    $HOTEL_NAME=strtoupper(getName($EMAIL));

    echo"
  <h2 align='center'><B>PENDING CREDIT PAYMENT BOUND PAYMENTS OF $HOTEL_NAME  </B></h2>
  <form id='orderform'  action='php/MakeOrder.php' method='post' enctype='multipart/form-data'>
                                        <table class='table' style='font-size: 11px;'>
                                        <tbody>
                                         <thead>
                                          <tr>

                                            
                                            <td><strong>PRODUCT_NAME</strong></td>
                                            <td><strong>PRODUCT_IMAGE</strong></td>
                                            <td><strong>QUANTITY</strong></td>
                                            <td><strong>UNIT</strong></td>
                                            <td><strong>PRICE_PER_UNIT</strong></td>
                                            <td><strong>TRANS_ACTION_TIME</strong></td>
                                            

                                            
                                          </tr>
                                          </thead>";
                                          
                                          $ShowAcceptedSupplyListItems="SELECT * FROM  sales  WHERE USER_EMAIL='$EMAIL' AND PAYMENT_MODE='3G' ";
                                          $result1=mysqli_query($conn,$ShowAcceptedSupplyListItems);

                                          

                                      if(mysqli_num_rows($result1)>0)
                                      {
                                        while($row = $result1->fetch_assoc()) 
                                        {
                                            
                                            
                                            $PRODUCT_NAME=$row['PRODUCT_NAME'];
                                            $PRODUCT_IMAGE=$row['PRODUCT_IMAGE'];
                                            $QUANTITY=$row['QUANTITY'];
                                            $UNIT=$row['UNIT'];
                                            $PRICE_PER_UNIT=$row['UNIT_PRICE'];
                                            $TOTAL_PRICE=$row['TOTAL']; 
                                            $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
                                            

                                            echo"
                                               
                                                <tr>
                                                <td>".$PRODUCT_NAME."</td>
                                                <td><img src='Asset/image/$PRODUCT_IMAGE' class='img-responsive' style='width:30px' style='width:30px'></td>
                                                <td>".$QUANTITY."</td>
                                                <td>".$UNIT."</td>
                                                <td>".$PRICE_PER_UNIT."</td>
                                                <td>".$TOTAL_PRICE."</td>
                                                <td>".$TRANS_ACTION_TIME."</td>
                                                </tr>
                                                ";//onclick=getVal('".$product."')
                                                
                                              

                                            
                                            
                                        }

                                      }
                                      else
                                      {
                                          echo"NO PENDING PAYMENTS FOUND FOR ".$HOTEL_NAME;

                                      }
                                        

                                       
                                         echo" </tbody>
                                                            </table>
                                                            ";
                                      

                                    

                                      echo  "</table>
                                        
                                        
                                        </form>";



exit();


} 

function CheckPendingPaymentAdmin($NAME_OF_COMPANY,$EMAIL,$REGISTERD_AS)
{
  //cONNECTION STRING 
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
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
   //echo" sent from function CheckPendingPayment NAME_OF_COMPANY: ".$NAME_OF_COMPANY."<br>";

    echo"
  <h2 align='center'><B>PENDING CREDIT PAYMENTS TO PICK2GET </B></h2>
  <form id='orderform'  action='php/MakeOrder.php' method='post' enctype='multipart/form-data'>
                                        <table class='table' style='font-size: 11px;'>
                                        <tbody>
                                         <thead>
                                          <tr>

                                            
                                            <td><strong>PRODUCT_NAME</strong></td>
                                            <td><strong>PRODUCT_IMAGE</strong></td>
                                            <td><strong>QUANTITY</strong></td>
                                            <td><strong>UNIT</strong></td>
                                            <td><strong>PRICE_PER_UNIT</strong></td>
                                            <td><strong>TOTAL_PRICE</strong></td>
                                            <td><strong>PAYMENT_MODE</strong></td>
                                            <td><strong>FROM_CLIENT</strong></td>
                                            <td><strong>PAYMENT_STATUS</strong></td>
                                            <td><strong>COMFIRM_PAID</strong></td>
                                            

                                            
                                          </tr>
                                          </thead>";
                                          
                                          $ShowAcceptedSupplyListItems="SELECT * FROM  sales  WHERE  PAYMENT_MODE='CREDIT' ";
                                          $result1=mysqli_query($conn,$ShowAcceptedSupplyListItems);

                                          

                                      if(mysqli_num_rows($result1)>0)
                                      {
                                        while($row = $result1->fetch_assoc()) 
                                        {
                                            
                                            
                                            $PRODUCT_NAME=$row['PRODUCT_NAME'];
                                            $PRODUCT_IMAGE=$row['PRODUCT_IMAGE'];
                                            $QUANTITY=$row['QUANTITY'];
                                            $UNIT=$row['UNIT'];
                                            $PRICE_PER_UNIT=$row['UNIT_PRICE'];
                                            $TOTAL_PRICE=$row['TOTAL']; 
                                            $PAYMENT_MODE=$row['PAYMENT_MODE'];
                                            $FROM_CLIENT=$row['USER_EMAIL'];
                                            

                                            echo"
                                               
                                                <tr>
                                                <td>".$PRODUCT_NAME."</td>
                                                <td><img src='Asset/image/$PRODUCT_IMAGE' class='img-responsive' style='width:30px' style='width:30px'></td>
                                                <td>".$QUANTITY."</td>
                                                <td>".$UNIT."</td>
                                                <td>".$PRICE_PER_UNIT."</td>
                                                <td>".$TOTAL_PRICE."</td>
                                                <td>".$PAYMENT_MODE."</td>
                                                <td>".strtoupper(getName($FROM_CLIENT))."</td>
                                                <td>NOT PAID</td>
                                                <td><input type='button'id='ConfirmItemDeliverd' COMPANY_NAME='$COMPANY_NAME' ACTUAL_COUNT='$ACTUAL_COUNT' CONFIRMED_COUNT='$CONFIRMED_COUNT' SUPPLIER_CATEGORY='$SUPPLIER_CATEGORY' PAYMENT_MODE='$ACCOUNT_TYPE' TOTAL_PRICE=$TOTAL_PRICE FROM_CLIENT='$FROM_CLIENT'  class='btn btn-info' value='CONFIRM PAID ' ></td>

                                                </tr>
                                                ";//onclick=getVal('".$product."')
                                              

                                            
                                            
                                        }

                                      }
                                      else
                                      {
                                          echo"NO PENDING PAYMENTS FOUND FOR ".strtoupper(getName($EMAIL));

                                      }
                                        

                                       
                                         echo" </tbody>
                                                            </table>
                                                            ";
                                      

                                    

                                      echo  "</table>
                                        
                                        
                                        </form>";




} 

function CheckTransactionHistory($NAME_OF_COMPANY,$EMAIL,$REGISTERD_AS)
{
   
   //cONNECTION STRING 
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
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //echo" sent from function CheckTransactionHistory NAME_OF_COMPANY: ".$NAME_OF_COMPANY."<br>";


}     
function CheckCancled($NAME_OF_COMPANY,$EMAIL,$REGISTERD_AS)
{
   
   //cONNECTION STRING 
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
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo" sent from function CheckCancled NAME_OF_COMPANY: ".$NAME_OF_COMPANY."<br>";
} 

//function to add to special offer

function ToAddSpecialOffer($SPECIAL_OFFER_NAME)
{
  //Add special offer


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

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO SpeciaOffer (SPECIAL_OFFER_NAME)
    VALUES ('$SPECIAL_OFFER_NAME')";

    if (mysqli_query($conn, $sql)) {
        echo "New SpeciaOffer created successfully";
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        return false;
    }

    mysqli_close($conn);

} 

//get function name
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