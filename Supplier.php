<?php
session_start();
//Check if session is set if not redirec user to index.php
if(!isset($_SESSION['EMAIL']) || !isset($_SESSION['UID']) || !isset($_SESSION['ROLE'])|| $_SESSION['ROLE']!='Supplier')
{

    header("location:http://localhost/pick2get/index.php");
}

 //Notification for new Supplyordes
 function NewSupplyOrders(){

  //Notification
//define("DB_SERVER", "195.8.222.39");
//define("DB_USER", "pick2get");
//define("DB_PASSWORD", "3DZX5J8k");
//define("DB_DATABASE", "pick2get");


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
 $SUPPLIER_CATEGORY=$_SESSION['SUPPLIER_CATEGORY'];

$sql  = "SELECT COUNT(ID) FROM PurchaseOrderTable WHERE SUPPLIER_CATEGORY='$SUPPLIER_CATEGORY'";



$rs = mysqli_query($conn,$sql);
 //-----------^  need to run query here

 $result = mysqli_fetch_array($rs);
 //here you can echo the result of query
  $_SESSION['COUNT_VAL']=$COUNT_VAL=$result[0];
  return $COUNT_VAL;


 }
 //Function get ConfirmedSupplyOrders
 function ConfirmedSupplyOrders()
 {
    //Notification
    //define("DB_SERVER", "195.8.222.39");
    //define("DB_USER", "pick2get");
    //define("DB_PASSWORD", "3DZX5J8k");
    //define("DB_DATABASE", "pick2get");


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
      $COMPANY_NAME=$_SESSION['COMPANY_NAME'];
      $sql = "SELECT COUNT( PAYMENT_APPROVAL_STATUS) FROM AcceptedSupplyList WHERE COMPANY_NAME='$COMPANY_NAME'";
      
            $rs = mysqli_query($conn,$sql);
           //-----------^  need to run query here

           $result = mysqli_fetch_array($rs);
           //here you can echo the result of query
            $COUNT_VAL=$result[0];
            return $COUNT_VAL;

 } 

 //function CanceledDelivery

 function CanceledDelivery()
 {
    //Notification
   


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
      $COMPANY_NAME=$_SESSION['COMPANY_NAME'];
      $sql = "SELECT COUNT( COMPANY_NAME) FROM DeliveryRecord WHERE COMPANY_NAME='Kipemba fish and Meat supplies' AND DELIVERY_STATUS='REJECTED'";
      
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
<title>Supplier Page</title>
<link rel="icon" href="http://pick2get.com/Asset/icon/download.png">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="BootStrap/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="Jquery/jqueryv3.js"></script>

<!-- Latest compiled JavaScript -->
<script src="BootStrap/js/bootstrap.min.js"></script>

<!-- main.js -->
<script src="Js/Jquery/JQmain.js"></script>

<!--Supplier.js-->
<script src="Js/Jquery/Suppliermain.js"></script>



</head>

<body>
<div class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <img class="navbar-brand" src="Asset/icon/download.png" />
      <a class="navbar-brand" href="#" ><span>Pick2Get</span></a>
   </div>
    <ul class="nav navbar-nav">
  <li><a class="nav-brand" href="#"><b>LOGGED AS:</b> <?php echo $_SESSION['ROLE']."  <b> USER:</b> ".strtoupper($_SESSION['COMPANY_NAME'])." <b>CATEGORY:</b> ". $_SESSION['SUPPLIER_CATEGORY'];?></a></li>
    </ul>
    <!--right panel content-->
    <!--right panel content-->
    <ul class="nav navbar-nav navbar-right">
      <li style="width:280px;left: 10px;top: 10px;"><input type="text" class="form-control" style="width:auto;float:right" id="search-btn"></li>
      <li style="top:10px;left:10px;"><input type="button" class="btn btn-primary" id="search-btn" value="Search"></li>
      <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="Asset/icon/Tranaction 2.png" width="22" height="25">Payment</a> 
        <ul class="dropdown-menu" style="background:#FFF">
        <div class="panel-info">
         <li><a href="#" id="Transactionhistory"><img src="Asset/icon/HistoryIcon.png"  width="22" height="25">Transactionhistory</a></li>
        </div>
        </ul>
        
      </li>
     <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-bell"></span>Alert<span class="badge"> <?php echo "  "." ".NewSupplyOrders()+ConfirmedSupplyOrders()+CanceledDelivery();?> </span></a>
        <ul class="dropdown-menu" style="background:#FFF">
        <div class="panel-info">
         <li><a id="NewOrders" href="#"><img src="Asset/icon/invetory.png" width="22" height="25">New Orders  <span class="badge"> <?php echo " ".NewSupplyOrders();?></span></a></li>
         <li><a id='ConfirmedSupply' href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="Asset/icon/list.png" width="22" height="25">Confirmed Supply    <span class="badge"><?php echo"".ConfirmedSupplyOrders(); ?></span></a></li>
         <li><a href="#" id='CanceledPayments'><img src="Asset/icon/view icon.png" width="22" height="25">Canceled Payments <span class="badge"><?php echo"".CanceledDelivery(); ?></span></a>
        </div>
        </ul>
     </li><!--General alerrt drop down menu-->
     <li><a href="#" id="LogOut3"><span class="glyphicon glyphicon-user"></span>Logout</a></li>
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
                     <div class="nav nav-pills nav-stacked">
                       <li class="active"><a hrerf="#"><h4>CATEGORIES 1#</h4></a></li>
                       <li><a hrerf="#">CATEGORIES</a></li>
                       <li><a hrerf="#">CATEGORIES</a></li>
                       <li><a hrerf="#">CATEGORIES</a></li> 
                     </div>
             <!--Copy this to supplier page and system admin-->   
                     <div class="nav nav-pills navbar-stacked">
                           <li class="active"><a hrerf="#"><h4>ACTION 2#</h4></a></li>
                           <li><a hrerf="#">ACTION NO 1#</a></li>
                           <li><a hrerf="#">ACTION NO 2#</a></li>
                           <li><a hrerf="#">ACTION NO 3#</a></li> 
                     </div>
           </div>
           <!--Copy this to all three template-->
       <div class="col-md-8">
          <div class="panel panel-info">
            <div class="panel-heading"><b>SUPPLIER PAGE</b></div>
                <div class="panel-body">
                <!--Diplay tabular content accrording to supplier Category-->

                     <div class='table-responsive'>
                       <span id='DisplayOrderListContent'>
                         <!--tabular content Goes Here-->

                       </span>
                     </div>
                <!--Diplay Non tabular content accrording to supplier Category-->
                <div id='NonTabular Content'>
                  <span id='NonDisplayOrderListContent'>
                  <!--Non tabular content Goes Here-->
                    
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
