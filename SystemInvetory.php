<?php
session_start();

//Check if session is set if not redirec user to index.php
if(!isset($_SESSION['EMAIL']) || !isset($_SESSION['UID']) || !isset($_SESSION['ROLE'])|| $_SESSION['ROLE']!='Admin')
{

    header("location:http://pick2get.com/");
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Invetory</title>
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
      <li class="active"><a href="Admin.php" id="link1">Return To Admin</a></li>
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
                       <li class="active"><a hrerf="#"><B>SELECT GOODS BY TYPE </B></a></li>
                       <li><a hrerf="#" id="dryGoods" class='btn btn-info' data-toggle='collapse' data-target='#DisplayTbl2'><B>DRY GOODS</B></a></li>
                       <li><a hrerf="#" id="Perishable" class='btn btn-info' data-toggle='collapse' data-target='#DisplayTbl2'><B>MEAT&FISH</B></a></li>
                       <li><a hrerf="#" id="WetGoods" class='btn btn-info' data-toggle='collapse' data-target='#DisplayTbl2'><B>WET GOODS</B></a></li>
                       <li><a hrerf="#" id="FruitsAndVeggies" class='btn btn-info' data-toggle='collapse' data-target='#DisplayTbl2'><B>FRUITS&VEGETABLE</B></a></li>
                       <li><a hrerf="#" id="SANITARY" class='btn btn-info' data-toggle='collapse' data-target='#DisplayTbl2'><B>SANITARY</B></a></li> 
                        <li><a hrerf="#" id="ACCESORIES" class='btn btn-info' data-toggle='collapse' data-target='#DisplayTbl2'><B>ACCESORIES</B></a></li> 
                      </div>
           </div>
           <!--Copy this to all three template-->
       <div class="col-md-8">
          <div class="panel panel-info">
            <div class="panel-heading"><b>INVETORY</b></div>
                <div class="panel-body">
                </br>
                   <div class="container">
                        <h4 class='text-primary'><b>ENTER NEW GOODS INTO DATABASE</b></h4>
                       <button type='button'  class='btn btn-info' data-toggle='collapse' data-target='#Logform'><b>ADD NEW GOODS</b></button>
                       
                        
                        <div class='collapse' id='Logform'>
                          <span class='alert' id='result'></span>
                          </br></br>
                      <form style='width:350px' action='php/Addproduct.php' method='post' enctype="multipart/form-data">
                             
                             <lable for='Produt Name'>Produt Name</lable>
                             <input type='Text' class='form-control' id='Pname' name='Pname' required/>
                             <br/>
                             <lable for='Product Image'>Product Image</lable>
                             <input type='file' class='form-control' id='Pimg' name='image' required/>
                             <br/>
                             <lable for='Unit'>Unit</lable>
                             <input type='Text' class='form-control' id='Unit' name='Unit' required/>
                             <br/>
                             <lable for='Quantity'>Quantity</lable>
                             <input type='Text' class='form-control' id='Qnty' name='Qnty' required/>
                             <br/>
                             <lable for='Quantity'>Price per unit</lable>
                             <input type='Text' class='form-control' id='Prc_Unit' name='Price' required/>
                             <br/>
                             <lable for='type_registr'>Item group</lable>
                             <fieldset class='ui-field-contain'>
                             <select class='form-control' id='logas' name='ItmGrp' required>
                              <option>--Please select an Item group--</option>
                               <option value='Dry goods'>Dry goods</option>
                               <option value='Perishable'>Perishable</option>
                               <option value='Utilities'>Utilities</option>
                               <option value='Wet goods'>Wet goods</option>
                               <option value='Fruits and Vegetable'>Fruits and Vegetable</option>
                               </select>
                             </fieldset>
                             </br>
                              <lable for='ProdutName'>Product 
                              Category</lable>
                            <fieldset class='ui-field-contain'>
                            <select class='form-control' id='logas' name='PCtgry' required>
                              <option>--Please select category of the goods--</option>
                               <option value='Fruits'>Fruits</option>
                               <option value='Vegetable'>Vegetable</option>
                               <option value='Red Wine'>Red Wine</option>
                               <option value='White Wine'>White Wine</option>
                               <option value='Rose Wine'>Rose Wine</option>
                               <option value='Whisky'>Whisky</option>
                               <option value='Tequilla'>Tequilla</option>
                               <option value='Vodka'>Vodka</option>
                               <option value='Rum'>Rum</option>
                               <option value='Liquors'>Liquors</option>
                               <option value='Gin'>Gin</option>
                               <option value='Cognanc'>Cognanc</option>
                               <option value='Champangne'>Champangne</option>
                               <option value='Beer'>Beer</option>
                               <option value='Water'>Water</option>
                               <option value='Juice'>Juice</option>
                               <option value='Soft Drinks'>Soft Drinks</option>
                               <option value='Energy'>Energy</option>
                               <option value='Services Supplies'>Services Supplies</option>
                               <option value='Cleaning Supplies'>Cleaning Supplies</option>
                               <option value='Kitchen fuel'>Kitchen fuel</option>
                               <option value='Stationaries'>Stationaries</option>
                               <option value='Meats'>Meats</option>
                               <option value='Dairy products'>Dairy products</option>
                               <option value='Tea/Coffee'>Tea/Coffee</option>
                               <option value='Syrups'>Syrups</option>
                               <option value='Sugar'>Sugar</option>
                               <option value='Spices'>Spices</option>
                               <option value='Rice'>Rice</option>
                               <option value='Pulses'>Pulses</option>
                               <option value='Pre_Mix'>Pre_Mix</option>
                               <option value='Powder'>Powder</option>
                               <option value='Pasta'>Pasta</option>
                               <option value='Oils'>Oils</option>
                               <option value='Food Flavour'>Food Flavour</option>
                               <option value='Food colur'>Dry goods</option>
                               <option value='Flours'>Flours</option>
                               <option value='Dry  Fruits/Nuts'>Dry  Fruits/Nuts</option>
                               <option value='Tinned/Bottled/Packet'>Tinned/Bottled/Packet</option>
                               
                               
                               
                               
                               
                               
                               
                               </select>
                             </fieldset>
                    
                  <p><br/></p>
                  <input type='submit' class='btn btn-info' style='float:left' id='Inserbtn1' value='Add Goods' name='Inserbtn1'>
                  <input type='reset' class='btn btn-info' style='float:right' id='Resetbtn' value='Reset' name='Resetbtn'>
                          
                          
                          </form>
                    </div>
                     
                     
                </div>
                <p><br/></p>
                <p><br/></p>
                <div class='collapse' id='DisplayTbl2'>
                      <div class="table-responsive">

                         <span id="TblContents2">
                         <span id='feedback'></span>
                          <!--Table Content per category With insert Delete Button goes here-->
                         
                         
                          
                        </span>
                    </div>
                </div>
                <p><br/></p>
                <p><br/></p>
                
                 <button type='button' id='DisplayAllProducts' class='btn btn-info' data-toggle='collapse' data-target='#DisplayTbl'><b>EDIT GOODS</b></button>
                    
                     <div class='collapse' id='DisplayTbl'>
                    
                        
                        <div class="table-responsive">


                         <span id="TblContents">

                          <!--Table Content With insert Delete Button goes here-->
                         
                         
                          
                        </span>
                       
                      
                     </div>
                    
                 </div>

                <p><br/></p>
                <p><br/></p>
                <div class="panel-footer"><p align="center">Pick2Get All copy rights reserved 2017</p></div>
         
       </div>
       <div class="col-md-1"></div>
   </div>
</div>
</body>
</html>
