<!--<?php
session_start();
//Check if session is set if not redirec user to index.php
if(!isset($_SESSION['EMAIL']) || !isset($_SESSION['UID']) || !isset($_SESSION['ROLE']))
{

   header("location:http://localhost/CCWeb/index.php");
}

?>-->
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Shopping cart check out</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="BootStrap/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="Jquery/jqueryv3.js"></script>

<!-- Latest compiled JavaScript -->
<script src="BootStrap/js/bootstrap.min.js"></script>

<!-- main.js -->
<script src="Js/Jquery/JQmain.js"></script>

<!-- HCmain.js -->
<script src="Js/Jquery/HCappMain.js"></script>



</head>

<body ng-app="HCapp" ng-controller="HCCtrl">
<div class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <img class="navbar-brand" src="Asset/icon/download.png" />
      <a class="navbar-brand" href="#" ><span>Pick2Get</span></a>
   </div>
    <ul class="nav navbar-nav">
      <li><a class="nav-brand" href="#">Logged As <?php echo $_SESSION['ROLE']."   USER: ".$_SESSION['EMAIL'];?></a></li>
    </ul>
    <!--right panel content-->
    <ul class="nav navbar-nav navbar-right">
     <li style="width:280px;left: 10px;top: 10px;"><input type="text" class="form-control" id="search-btn"></li>
     <li style="top:10px;left:10px;"><input type="button" class="btn btn-primary" id="search-btn" value="Search"></li>
     <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="Asset/icon/Tranaction 2.png" width="22" height="25" >Transaction</a>
       <ul class="dropdown-menu" style="background:#FFF">
        <div class="panel-info">
         <li><a href="#"><img src="Asset/icon/HistoryIcon.png"  width="22" height="25">Transaction History</a></li>
         <li><a href="#"><img src="Asset/icon/Transaction (1).png" width="22" height="25">Outbound Payments</a></li>
         <li><a href="#"><img src="Asset/icon/pending.png" width="22" height="25">Pending Payment</a></li>
         <li><a href="#"><img src="Asset/icon/view icon.png" width="22" height="25">Canceled Payments</a>
        </div>
        </ul>
     </li>
     <li><a href="#"  class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span>Cart<span class="badge">0</span></a>
       <div class="dropdown-menu" style="width:600px">
        <div class="panel panel-success">
         <div class="panel-heading">
            <div class="row">
             <div class="col-md-3">PRODUCT ID</div>
              <div class="col-md-3">PRODUCT NAME</div>
               <div class="col-md-3">QUANTITT</div>
                <div class="col-md-3">PRICE</div>
            </div>
          </div>
         <div class="panel-body"></div>
         <div class="panel-footer"></div>
        </div>
       </div>
     </li>
     <li><a href="#" id="LogOut2"><span class="glyphicon glyphicon-user"></span>Logout</a><span class="alert" id="result3"></span></li>
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
                       <li class="active"><a hrerf="#"><h4><b>ITEM CATEGORIES</b></h4></a></li>
                       <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="Asset/icon/food Icon.png" width="22" height="25"><b>FOOD CATEGORIES</b>
                           <ul class="dropdown-menu" style="background:#FFF">
                            <div class="panel-info">
                              <li><a href="#"   id="fruit"><img src="Asset/icon/fruits and vegetable.jpg" width="22" height="25"><b>FRUITS & VEGETABLE.</b></a>
                              <li><a hrerf="#"  id="Meat_fish"><img src="Asset/icon/fish and meat.jpg" width="22" height="25"><b>MEAT & FISH</b></a>
                              <li><a hrerf="#"  id="Dairy_product"><img src="Asset/icon/Dairy products.png" width="22" height="25"><b>DAIRY PRODUCTS</b></a>
                              <li><a hrerf="#"  id="dry_food"><img src="Asset/icon/Dry food icon.png" width="22" height="25"><b>DRY FOOD</b></a>
                            </div>
                            </ul>
                         </li>
                      
                       <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="Asset/icon/bevarage icon.png" width="22" height="25"><b>BEVERAGE</b></a>
                           <ul class="dropdown-menu" style="background:#FFF">
                            <div class="panel-info">
                              <li><a hrerf="#" id="Coffe_Tea"><img src="Asset/icon/Coffe and tea icon.png" width="22" height="25"><b>COFFEE & TEA.</b></a>
                              <li><a hrerf="#" id="SortDrink"><img src="Asset/icon/soft drink icon.png" width="22" height="25"><b>SOFT DRINK</b></a>
                              <li><a hrerf="#" id="Water"><img src="Asset/icon/bottled water.png" width="22" height="25"><b>BOTTLED WATER</b></a>
                              <li><a hrerf="#" id="NonAloholic"><img src="Asset/icon/non alcoholic icon.PNG" width="22" height="25"><b>NON ALCOHOLIC</b></a>
                              <li><a hrerf="#" id="Alcoholic"><img src="Asset/icon/Alcohol.jpg" width="22" height="25"><b>ALCOHOLIC</b></a>
                              
                             </div>
                           </ul>
                       </li>
                       
                       <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="Asset/icon/utility.png" width="22" height="25"><b>UTILITY </b></a>
                       <ul class="dropdown-menu" style="background:#FFF">
                            <div class="panel-info">
                              <li><a hrerf="#" id="CLEANING_UTILITY"><img src="Asset/icon/cleaning utility icon.png" width="22" height="25"><b>CLEANING UTILITY</b></a>
                              <li><a hrerf="#" id="SANITARY_UTILITY"><img src="Asset/icon/sanitary icon.png" width="22" height="25"><b>SANITARY UTILITY</b></a>
                              <li><a hrerf="#" id="KITCHEN_UTILITY"><img src="Asset/icon/kitchen utility.png" width="22" height="25"><b>KITCHEN UTILITY </b></a>
                              <li><a hrerf="#" id="MAINTANANCE"><img src="Asset/icon/Maintanance icon.png" width="22" height="25"><b>MAINTANANCE</b></a>
                              <li><a hrerf="#" id="ENERGY"><img src="Asset/icon/energy.png" width="22" height="25"><b>ENERGY</b></a>
                              <li><a hrerf="#" id="STATIONERY"><img src="Asset/icon/Stationer icon.png" width="22" height="25"><b>STATIONERY</b></a>
                             </div>
                           </ul>
                       
                       
                       </li> 
                     </div>
                     <P></BR></P>
                      <P></BR></P>
             <!--Copy this to supplier page and system admin-->   
                     <div class="nav nav-pills navbar-stacked">
                           <li class="active"><a hrerf="#"><h4><b>QUICK MENU VIEW</b></h4></a></li>
                           <li><a hrerf="#" id="GOOD_COMPARISION"><img src="Asset/icon/comparison icon.png" width="22" height="25"><b>GOOD COMPARISION  </b></a></li>
                           <li><a hrerf="#" id="PURCHASE_HISTORY"><img src="Asset/icon/HistoryIcon.png" width="22" height="25"><b>PURCHASE HISTORY</b></a></li>
                           <li><a hrerf="#" id="TRANSACTION_HISTORY"><img src="Asset/icon/Transaction (1).png" width="22" height="25"><b>TRANSACTION HISTORY</b></a></li>
                           <li><a hrerf="#" id="VIEW_SPECIAL_OFFER"><img src="Asset/icon/sales offer icon.png" width="22" height="25"><b>VIEW SPECIAL OFFER</b></a></li> 
                     </div>
           </div>
           <!--Copy this to all three template-->
       <div class="col-md-8">
          <div class="panel panel-info">
            <div class="panel-heading">SHOPPING CART CHECK OUT</div>
                <div class="panel-body">
                    <!-- Display routed page here-->
                    <span id="result">
                      
                    </span>
                     <div class="table-responsive">          
                        <table id="tableLayout" class="table">
                          <div class='alert alert-warning'>
                          <a href='#' class='close' data-dismis='alert' arial-lable='close' id='CloseTable'>&times</a><b>Close Table</b>
                          </div>
                          <tbody>
                          
                            
                          </tbody>
                        </table>
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
