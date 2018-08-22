<?php
session_start();
if(isset($_POST['Image'])){

  $_SESSION['ProductName']=$ProductName=$_POST["ProductName"];
  $_SESSION['Quantity']=$Quantity=$_POST['Quantity'];
	echo"
	<h2><B>ADD IMAGE OF $ProductName TO ORDER LIST</B></h2>  
	 <form  action='php/NowAddImageToOrder.php' method='post' enctype='multipart/form-data'>
	<table width='360' border='0' class='table'>
                  <tr>
                    <td width='4'><img src='http://pick2get.com/Asset/image/<?php echo $ProductImageName;?>'style='width:60px' style='width:60px' ></td>
                    <td width='218'><input type='file' name='image'></td>
                    <td width='110'><input id='editImage' class='btn btn-success'  type='Submit'  value='submit' ></td>
                  </tr>
                </table>
                  </form>";
}
     

?>