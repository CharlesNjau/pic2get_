<?php
session_start();
//Check if session is set if not redirec user to index.php
if(!isset($_SESSION['EMAIL']) || !isset($_SESSION['UID']) || !isset($_SESSION['ROLE'])|| $_SESSION['ROLE']!='Admin')
{

    header("location:http://localhost/pick2get/index.php");
}

//Notification


//Orders sent to  suppliers
function CountOfOrderSentToSupplier()
{
//Connection Strring



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pick2get";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
 

$sql  = "SELECT COUNT(ID) FROM PurchaseOrderTable ";
$rs = mysqli_query($conn,$sql);
 //-----------^  need to run query here

 $result = mysqli_fetch_array($rs);
 //here you can echo the result of query
 $COUNT_VAL=$result[0];

 return $COUNT_VAL;

}


function NotificationOfConfirmedSupplyOrders()
{
//Connetcition String



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pick2get";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
  
//suppliers accepted to supply orders to pick2get from  AcceptedSupplyList
  

$NotificationofConfirmedSupplyOrdes="SELECT COUNT(ID) FROM AcceptedSupplyList ";



$rs2 = mysqli_query($conn,$NotificationofConfirmedSupplyOrdes);
 //-----------^  need to run query here

$result2 = mysqli_fetch_array($rs2);
//here you can echo the result of query
$COUNT_VAL=$result2[0];

return $COUNT_VAL;

}



function NotificatioForDeliveryOftem()
{
    //Orders sent to  suppliers
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pick2get";


    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql  = "SELECT COUNT(RecordedConfirmedPurchaseList.PRODUCT_NAME) FROM AcceptedSupplyList,RecordedConfirmedPurchaseList WHERE AcceptedSupplyList.HOTEL_EMAIL=RecordedConfirmedPurchaseList.HOTEL_EMAIL";



    $rs = mysqli_query($conn,$sql);
     //-----------^  need to run query here

     $result = mysqli_fetch_array($rs);
     //here you can echo the result of query
     return $COUNT_VAL=$result[0];

}
//Notification for new Hotel account
function NewHoteAccount()
{

 //Orders sent to  suppliers



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pick2get";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
 

$sql  = "SELECT COUNT(COMPANY_NAME) FROM useregistration WHERE  ACTIVATION_STATUS='0' AND ACCOUNT_TYPE='' AND   REGISTERD_AS='Hotel'";



$rs = mysqli_query($conn,$sql);
 //-----------^  need to run query here

 $result = mysqli_fetch_array($rs);
 //here you can echo the result of query
 $COUNT_VAL=$result[0];
 return $COUNT_VAL;
}
//Notification for New Supplier Account
function NewSupplierAccount()
{
  //Orders sent to  suppliers



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pick2get";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
 

$sql  = "SELECT COUNT(COMPANY_NAME) FROM useregistration WHERE  ACTIVATION_STATUS='0' AND ACCOUNT_TYPE='' AND   REGISTERD_AS='Supplier'";



$rs = mysqli_query($conn,$sql);
 //-----------^  need to run query here

 $result = mysqli_fetch_array($rs);
 //here you can echo the result of query
 $COUNT_VAL=$result[0];
 return $COUNT_VAL;

}
//Function for delivery of goods to pick2get from Supplier
function DeliveryStatusToUs()
{
    



    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pick2get";


    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
     

    $sql  = "SELECT COUNT(COMPANY_NAME) FROM RecordedConfirmedPurchaseList WHERE DELIVERY_STATUS_TO_US='NOT DELIVERDE'";



    $rs = mysqli_query($conn,$sql);
     //-----------^  need to run query here

     $result = mysqli_fetch_array($rs);
     //here you can echo the result of query
     $COUNT_VAL=$result[0];
     return $COUNT_VAL;


  
}

//Function for delivery of goods to  Client  from pick2get
function DeliveryStatusToClient()
{
    


    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pick2get";


    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
     

    $sql  = "SELECT COUNT(COMPANY_NAME) FROM RecordedConfirmedPurchaseList WHERE DELIVERY_STATUS_TO_CLIENT='NOT DELIVERDE'";



    $rs = mysqli_query($conn,$sql);
     //-----------^  need to run query here

     $result = mysqli_fetch_array($rs);
     //here you can echo the result of query
     $COUNT_VAL=$result[0];
     return $COUNT_VAL;

}

 

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Page</title>
<link rel="icon" href="http://pick2get.com/Asset/icon/download.png">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="BootStrap/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="Jquery/jqueryv3.js"></script>

<!-- Latest compiled JavaScript -->
<script src="BootStrap/js/bootstrap.min.js"></script>

<!-- main.js -->
<script src="Js/Jquery/JQmain.js"></script>

<!--Admin Jquery main app-->
<script src='Js/Jquery/AdminAppMain.js'></script>
</head>

<body>
<div class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <img class="navbar-brand" src="Asset/icon/download.png" />
      <a class="navbar-brand" href="#" ><span>Pick2Get</span></a>
   </div>
    <ul class="nav navbar-nav">
      <li><a class="nav-brand" href="#">Logged As <?php echo $_SESSION['ROLE']."  user:".$_SESSION['EMAIL'];?></a></li>
    </ul>
    <!--right panel content-->
   <ul class="nav navbar-nav navbar-right">
     <li style="width:280px;left: 10px;top: 10px;"><input type="text" class="form-control" id="search-btn"></li>
     <li style="top:10px;left:10px;"><input type="button" class="btn btn-primary" id="search-btn" value="Search"></li>
     <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="Asset/icon/Notification.png" width="22" height="25">Notication</a>  
        <ul class="dropdown-menu" style="background:#FFF">
        <div class="panel-info">
         <li><a href="#" id='ChckItemsDeliverd'><img src="Asset/icon/Delivery Icon.png"  width="22" height="25">Check Items Deliverd</a></li>
         <li><a href="#" id='InbndPymnt'><img src="Asset/icon/Transaction (1).png" width="22" height="25">InboundPayments</a></li>
         <li><a href="#" id='OutbndPymnt'><img src="Asset/icon/Transaction (1).png" width="22" height="25">OutboundPayments</a></li>
         <li><a href="#" id='PndPymnt'><img src="Asset/icon/pending.png" width="22" height="25">PendingPayment</a></li>
         <li><a href="#" id='CncldPymnt'><img src="Asset/icon/view icon.png" width="22" height="25">CanceledPayments</a>
        </div>
        </ul>
        
      </li>
     <li><a href="#" id="LogOut1"><span class="glyphicon glyphicon-user"></span>Logout</a><span class="alert" id="result3"></li>
    </ul>
  </div>
</div>
<p><br/></p>
<p><br/></p>
<p><br/></p>
<div class="container-fluid">
   <div class="row">
       <div class="col-md-1"></div>
           <div class="col-md-2" align="left">
             <!--Copy this to supplier page and system admin-->
                     <div class="nav nav-pills nav-stacked" style='font-size: 9px;'>
                       <li class="active"><a hrerf="#" ><h4>MANAGE ACCOUNTS</h4></a></li>
                       <li><a hrerf="#" id='lnk1'><b>NEW HOTEL ACCOUNT</b><span class="badge"> <?php echo "    ". NewHoteAccount();?></span></a></li>
                       <li><a hrerf="#" id='lnk6'><b>NEW SUPPLIER ACCOUNT<span class="badge"> <?php echo "    ".NewSupplierAccount();?></span></b></a></li>
                       <li><a hrerf="#" id='lnk2'><b>CHECK ALL ACCOUNTS</b></a></li>
                       <li><a hrerf="#" id='lnk4'><b>VIEW ALL CREDIT ACCOUNT</b></a></li>
                       <li><a hrerf="#" id='lnk5'><b>VIEW ALL CASH ACCOUNT</b></a></li>
                       <li><a hrerf="#" id='lnk3'><b>LOG RECORDS<b/></a></li> 
                       
                     </div>
             <!--Copy this to supplier page and system admin-->   
                     <div class="nav nav-pills navbar-stacked" style='font-size: 9px;'>
                           <li class="active"><a hrerf="#"><h4>VIEW REPORTS</h4></a></li>
                           <li><a hrerf="#" id='ChkcSales'><b>CHECK SALES REPORT</b></a></li>
                           <li><a hrerf="#" id='ChckInvtry'><b>CHECK INVETORY</b></a></li>
                           <li><a hrerf="#" id='ChckPurchaseReporrt'><b>PURCAHSE REPORT</b></a></li>
                           <li><a hrerf="#" id='AuditReport'><b>IMPORT TALLY REPORT(BETA)</b></a></li>
                            
                     </div>
            <!--Action regarding sending orders from suppliers-->
                      <div class="nav nav-pills navbar-stacked" style='font-size: 9px;'>
                           <li class="active"><a hrerf="#"><h4>VIEW PURCHASES</h4></a></li>
                           <li><a hrerf="#" id='SendOrder'><b>ORDERS SENT TO SUPPLIER <span class="badge"> <?php echo " ".CountOfOrderSentToSupplier();?></span></b></a></li>
                           <li><a hrerf="#" id='ChckOrder'><b>ORDER REPLIED <span class="badge"> <?php echo " ".NotificationOfConfirmedSupplyOrders();?></span></b></a></li>
                           <li><a hrerf="#" id='ItmSuply'><b>PENDING ORDERS TO US <span class="badge"> <?php echo "    ".NotificatioForDeliveryOftem();?></span></b></a></li>
                           <li><a hrerf="#" id='RateSupplier'><b>RATE SUPPLIERS</b></a></li>
                           <li><a hrerf="#" id='ChckSuply'><b>SUPPLY ETA</b></a></li>
                            
                     </div>
            <!--Action regarding sending pruduct/goods to client-->
                      <div class="nav nav-pills navbar-stacked" style='font-size: 9px;'>
                           <li class="active"><a hrerf="#"><h4>CLIENT SUPPLY ACTION</h4></a></li>
                           <li><a hrerf="#" id='PndgOrdr'><b>PENDING ORDERS TO CLIENT <span class="badge"> <?php echo "    ".NotificatioForDeliveryOftem();?></span></b></a></li>
                           <li><a hrerf="#" id='DlvrStat'><b>DELIVERY STATUS  <span class="badge"> <?php echo "   ".DeliveryStatusToUs()+DeliveryStatusToClient();?></span></b></a></li>
                           <li><a hrerf="#" id='CncldOrdr'><b>CANCELED ORDERS</b></a></li>
                           <li><a hrerf="#" id='AddSpecialOffer'><b>ADD SPECIAL OFFER</b></a></li>
                            
                     </div>

           </div>
           <!--Display results-->
       <div class="col-md-8">
          <div class="panel panel-info">
            <div class="panel-heading">ADMIN PAGE.</div>
                <div class="panel-body">
                  <div>
                  <!--Non tabular content Goes Here-->
                      <span id='Result'>
                      
                      </span>
                    </div>
                
                
                     <div class='table-responsive'>
                       <span id='DisplayContent'>
                         <!--tabular content Goes Here-->

                       </span>
                     </div>

                     <div class='table-responsive'>
                     <br><p><p><br>
                     <br><p><p><br>
                      <!--Non tabular content Goes Here-->
                      <span id='Result2'>
                      
                      </span>
                    </div>


                   
                </div>
                <div class="panel-footer"><p align="center">Pick2Get All copy rights reserved 2017</p></div>
         </div>
       </div>
       <div class="col-md-1"></div>
   </div>
</div>
</body>
</html>