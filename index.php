<?php
session_start();
if( isset($_SESSION['ROLE'])&& $_SESSION['ROLE']=='Hotel')
{

   header("location:http://localhost/pick2get/Hotel Client.php");
}
if( isset($_SESSION['ROLE'])&& $_SESSION['ROLE']=='Supplier')
{

   header("location:http://localhost/pick2get/Supplier.php");
}
if( isset($_SESSION['ROLE'])&& $_SESSION['ROLE']=='Admin')
{

   header("location:http://localhost/pick2get/Admin.php");
}


?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>HomePage</title>
<link rel="icon" href="http://pick2get.com/Asset/icon/download.png">
<link rel="stylesheet" href="BootStrap/css/bootstrap.min.css" />
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="BootStrap/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="Jquery/jqueryv3.js"></script>

<!-- Latest compiled JavaScript -->
<script src="BootStrap/js/bootstrap.min.js"></script>

<!-- main.js -->
<script src="Js/Jquery/JQmain.js"></script>



</head>

<body>
<div class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <img class="navbar-brand" src="Asset/icon/download.png" />
      <a class="navbar-brand" href="#" ><span>Pick2Get</span></a>
   </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php" id="link1">Home</a></li>
    </ul>
    <!--right panel content-->
    
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
                       <li class="active"><a hrerf="#"><h4>ADVERTISE 1#</h4></a></li>
                       <li><a hrerf="#">CATEGORIES</a></li>
                       <li><a hrerf="#">CATEGORIES</a></li>
                       <li><a hrerf="#">CATEGORIES</a></li> 
                     </div>
             <!--Copy this to supplier page and system admin-->   
                     <div class="nav nav-pills navbar-stacked">
                           <li class="active"><a hrerf="#"><h4>ADVERTISE 2#</h4></a></li>
                           <li><a hrerf="#">CATEGORIES</a></li>
                           <li><a hrerf="#">CATEGORIES</a></li>
                           <li><a hrerf="#">CATEGORIES</a></li> 
                           
                     </div>
           </div>
           <!--Copy this to all three template-->
       <div class="col-md-8">
          <div class="panel panel-info">
            <div class="panel-heading">HOME PAGE</div>
                <div class="panel-body">
                <h1 class="info" align="center"><img src="Asset/icon/download.png"></h1>
                <h1 class="info" align="center">Pick2Get</h1>
                <h3 class="text-primary">Dear estimmed customer welcome to our site ,please kindly register an account to join our services </h3>
                </br>
                 <h3 class="text-primary">
                Sign up Form 
                </h3> 
                     <span class="alert" id="result"></span>
                     <form style="swidth:600px" id="Sform" action="php/SignUp.php" method="post">
                     <lable for="cpny_name">Company name</lable>
                     <input type="text" class="form-control"  id="cpny_name" name="cpny_name" value="" required/>
                     <lable for="email">Email</lable>
                     <input type="email" class="form-control" id="email" name="email" value=""  required/>
                     <lable for="password">Password</lable>
                     <input type="password" class="form-control" id="pswd1"  name="pswd1" value=""  required/>
                     <lable for="type_registr">Register As</lable>
                     <select class="form-control" id="rgstr" name="rgstr" required>
                           <option>--Please select an option--</option>
                           <option value="Supplier">Supplier</option>
                           <option value="Hotel">Hotel</option>
                     </select>
                     <lable for="type_registr">Supplier Category (For Suppliers only) </lable>
                     <select class="form-control" id="SupplierCtgry" name="SupplierCtgry"  >
                           <option>--Please select an option--</option>
                        <option value='FISH_AND_MEAT'>FISH_AND_MEAT</option>
                                                <option value='FRUITS_AND _VEGETABLE'>FRUITS_AND _VEGETABLE</option>
                                                <option value='DAIRY_PRODUCTS'>DAIRY_PRODUCTS</option>
                                                <option value='DRY_FOOD'>DRY_FOOD</option>
                                                <option value='ALCOHOL'>ALCOHOL</option>
                                                <option value='NON_ALCOHOL'>NON_ALCOHOL</option>
                                                <option value='CLEANING_SUPPLY'>CLEANING_SUPPLY</option>
                                                <option value='SANITARY_UTILITY'>SANITARY_UTILITY</option>
                                                <option value='KITCHEN_UTILITY'>KITCHEN_UTILITY</option>
                                                <option value='MAINATANCE'>MAINATANCE</option>
                                                <option value='STATIONERY_SUPPLIER'>STATIONERY_SUPPLIER</option>

                     </select>

                     <p><br/></p>
                     
                     
                     <div align='center'>
                                                   
                                                   <input type="submit" class="btn btn-success"  value="SignUp" id="SgnUpbtn1">
                                                   
                                                   <input type="reset" class="btn btn-success" value="Reset" id="SgnUpbtn2">
                                                   
                          </div>
                     </form>
                     
                     <p><br/></p>
                     <p><br/></p>
                     
                     
                      
                    
                    
                    <div class="container">
                       <h2 class="text-primary"> Login if already registered</h2>
                       <input type="button" class="btn btn-info" data-toggle="collapse" data-target="#Logform" align='center' width='200 px' value='login'>
                       <span class="alert" id="result2"></span>
                        
                        <div class="collapse" id="Logform">
                        
                          <form style="width:200px"      id="Lform" action="php/log.php" method="post">
                             
                             <lable for="email">Email</lable>
                             <input type="email" class="form-control" id="email" name="email" required/>
                             <lable for="password">Password</lable>
                             <input type="password" class="form-control" id="pswd" name="pswd" required/>
                             <lable for="type_registr">Login As</lable>
                             <fieldset class="ui-field-contain">
                             <select class="form-control" id="logas" name="logas" required>
                              <option>--Please select an option--</option>
                               <option value="Admin">Admin</option>
                               <option value="Supplier">Supplier</option>
                               <option value="Hotel">Hotel</option>
                             </select>
                             </fieldset>
                         <p><br/></p>
                          

                          <div align='center'>
                                                   
                                                   <input style='align:right' type="submit" class="btn btn-success" id="Lbtn1" value="Login" >
                                                   
                                                   <input style='align:left' type="reset" class="btn btn-warning"  id="Reset" value="Reset">
                                                   
                          </div>
                          
                          
                          </form>
                        </div>
                               
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
