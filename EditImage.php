<?php
session_start();
//Receive image name from invetory.php
$ProductImageName=$_SESSION['ImageName'];
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
      <li class="active"><a href="SystemInvetory.php" id="link1">Return To invetory</a></li>
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
           
           <!--Copy this to all three template-->
       <div class="col-md-8">
          <div class="panel panel-info">
            <div class="panel-heading"><b>IMAGE UPDATE</b></div>
                <div class="panel-body">
                </br>
                   <div class="container">
                        <h4 class='text-primary'><b>EDIT ITEM IMAGE</b></h4>
                       
                      
                    </div>
                     
                     
                </div>
                <p><br/></p>
                <p><br/></p>
                <div align="center">
                  <form  action="php/NowEditImage.php" method="post" enctype="multipart/form-data">
                    <table width="360" border="0" class='table'>
                  <tr>
                    <td width="4"><img src='http://pick2get.com/Asset/image/<?php echo $ProductImageName;?>'style='width:60px' style='width:60px' ></td>
                    <td width="218"><input type='file' name='image'></td>
                    <td width="110"><input id='editImage' class='btn btn-sucess'  type='Submit'  value='submit' ></td>
                  </tr>
                </table>
                  </form>
                </div>                
                <p><br/></p>
                <p><br/></p>
                
                
                 
                    

            <p><br/></p>
                <p><br/></p>
                <div class="panel-footer"><p align="center">Pick2Get All copy rights reserved 2017</p></div>
         
       </div>
       <div class="col-md-1"></div>
   </div>
</div>
</body>
</html>
