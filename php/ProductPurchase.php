<?php
session_start();
//Check if session is set if not redirec user to index.php
//if(!isset($_SESSION['EMAIL']) || !isset($_SESSION['UID']) || !isset($_SESSION['ROLE'])|| $_SESSION['ROLE']!='Admin')
//{

    //header("location:http://pick2get.com/");
//}

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
     <li style="width:280px;left: 10px;top: 10px;">PURCHASE PAGE</li>
    </ul>
  </div>
</div>
<p><br/></p>
<p><br/></p>
<div class="container-fluid">
  
           <!--Display results-->
       
                <div class="panel-footer"><p align="center">Pick2Get All copy rights reserved 2017</p></div>
         </div>
       </div>
       <div class="col-md-1"></div>
  </div>
</div>
</body>
</html>