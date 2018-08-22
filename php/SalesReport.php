<?php
//Sales report(Admin&Supplier)
/*
This is script will generate a simple table showing all sales report
*/
//Database connnection file

session_start();
include_once('conn2.php');
if (isset($_GET['SalesReport'])) 
{
				$_GET['report']='1';
				
				
					 echo'<br>'."
			<h2 align='center'><B>SALES REPORT</B></h2>

			<form id='salesReportform'  action='php/SalesReport.php' method='POST'>
			<table class='table' width='914' border='0'>
			  <tr>
			    <td width='298'><b>GENERATE SALES REPORT BY CATEGORY</b></td>
			    <td width='300'>&nbsp;</td>
			    <td width='288'>&nbsp;</td>
			  </tr>
			  <tr>
			    <td><select class='form-control' id='CategorySalesReport' name='1PCtgry' style='width:300px'>
			      <option >--Select an option to get report--</option>
			      <option id='CASH SALES' value='CASH SALES'>CASH SALES</option>
			      <option id='CREDIT SALES' value='CREDIT SALES'>CREDIT SALES</option>
			    </select></td>
			    <td><input type='button' style='width:300px' getoption='value' class='btn btn-info' id='SalesReportBtn' value='GENERATE SALES REPORT' /></td>
			    <td>&nbsp;</td>
			  </tr>
			  <tr>
			    <td><b>GENERATE SALES REPORT BY PRODUCT</b></td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			  </tr>
			  <tr>";
			    
                //Stat
				//This will dynamically generate product name
				$GetAllProduct="select PRODUCT_NAME from Products ORDER BY PRODUCT_NAME ASC";


				$result=mysqli_query($conn,$GetAllProduct);

				if(mysqli_num_rows($result) > 0)
				{  

                    echo"<td>
			    <select class='form-control' id='ProductSalesReport' name='2PCtgry' style='width:300px'>
			    <option>--Please select category of the goods--</option>";
				    
				   while($row = $result->fetch_assoc()) 
				    {
				         
				         $ProductName=$row['PRODUCT_NAME'];
				         

				       
			      echo"<option value='$ProductName'>$ProductName</option>";
			      
			    
                   }
                   echo"</select></td>";
				    //exit();
				     
				  

				}
				else 
				{
				    
				return 0;
				}


				//end/ of line dynamically generating  product name

               
			   echo" <td><input type='button' style='width:300px' class='btn btn-info' id='SalesReportProduct' value='REPORT BY PRODUCT NAME' /></td>
			    <td>&nbsp;</td>
			  </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			  </tr>
			  <tr>
			    <td><input type='button' style='width:350px' class='btn btn-info' align='left' id='SalesReportWeekly' value='GENERATE WEEKLY SALES REPORT' /></td>
			    <td><input type='button' style='width:350px' class='btn btn-info' align='middle' id='SalesReportMonthly' value='GENERATE MONTHLY SALES REPORT' /></td>
			    <td><input type='button' style='width:350px' class='btn btn-info' align='right' id='SalesReporTotal' value='TOTAL SALES REPORT' /></td>
			  </tr>
			</table>
			</form>
			";
			    //exit();
			    //$GetSalesReport='SELECT * FROM  sales';

				//$result = mysqli_query($conn, $GetSalesReport);

				//if (mysqli_num_rows($result) > 0) {
				    // output data of each row
				  //  while($row = mysqli_fetch_assoc($result)) {
				        //echo 'id: ' . $row['id']. ' - Name: ' . $row['firstname']. ' ' . $row['lastname']. '<br>';
				//    }
				//} else {
				  //  echo '0 results';
				//}

			exit();
}


//for genearting sales report per category
if(isset($_POST['SalesReportBtn'] ))
{
					 //$report=$_POST['SalesReportBtn'];
				 $report=$_POST['val'];

				 
				###########################################################################################################################

		if($report==='CASH SALES')
		{
					/*
				Cash Query Template
				*/

				$CashSales="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G' ";
                $result1 = mysqli_query($conn, $CashSales);

                //run query for cash sales

                if (mysqli_num_rows($result1) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B>CASH SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result1)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";

				} else {
				    echo "0 results";
				}
                
				$HighestCashSale="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MAX(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G'";
				$result2 = mysqli_query($conn, $HighestCashSale);


				//run query for h cash sales

                if (mysqli_num_rows($result2) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B>HIGHEST CASH SALES REPORT</B></h2>
							<form id='tableform' action='php/editimage.php' method='post' enctype='multipart/form-data'>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result2)) {
				        
                                       
                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];

							           
                     







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
				} else {
				    echo "0 results";
				}



               

				$LowestCashSale="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MIN(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G'";
				$result3 = mysqli_query($conn, $LowestCashSale);

					//run query for l cash sales

                if (mysqli_num_rows($result3) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B>LOWEST CASH SALES REPORT</B></h2>
							<form id='tableform' action='php/editimage.php' method='post' enctype='multipart/form-data'>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result3)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
				} else {
				    echo "0 results";
				}


				$TotalCashSale="SELECT ID,SUM(TOTAL) AS TOTAL, PAYMENT_MODE FROM sales WHERE PAYMENT_MODE='3G'";
				$result4 = mysqli_query($conn, $TotalCashSale);

					//run query for h cash sales

                if (mysqli_num_rows($result4) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B>TOTAL CASH SALES REPORT</B></h2>
							<form id='tableform' action='php/editimage.php' method='post' enctype='multipart/form-data'>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>TOTAL CASH</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result4)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				        			   <td><B>$ID</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           </tr>
							           ";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
				} else {
				    echo "0 results";
				}

				

				mysqli_close($conn);					

			}
		/*CREDIT SALES*/



		if($report==='CREDIT SALES')
		{
				/*
				CREDIT Query Template
				*/

				$CashSales="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='CREDIT' ";
                $result1 = mysqli_query($conn, $CashSales);

                //run query for cash sales

                if (mysqli_num_rows($result1) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B>CREDIT SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result1)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";

				} else {
				    echo "0 results";
				}
                
				$HighestCashSale="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MAX(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='CREDIT'";
				$result2 = mysqli_query($conn, $HighestCashSale);


				//run query for h cash sales

                if (mysqli_num_rows($result2) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B>HIGHEST CREDIT SALES REPORT</B></h2>
							<form id='tableform' action='php/editimage.php' method='post' enctype='multipart/form-data'>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result2)) {
				        
                                       
                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];

							           
                     







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
				} else {
				    echo "0 results";
				}



               

				$LowestCashSale="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MIN(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='CREDIT'";
				$result3 = mysqli_query($conn, $LowestCashSale);

					//run query for l cash sales

                if (mysqli_num_rows($result3) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B>LOWEST CREDIT SALES REPORT</B></h2>
							<form id='tableform' action='php/editimage.php' method='post' enctype='multipart/form-data'>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result3)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
				} else {
				    echo "0 results";
				}


				$TotalCashSale="SELECT ID,SUM(TOTAL) AS TOTAL, PAYMENT_MODE FROM sales WHERE PAYMENT_MODE='CREDIT'";
				$result4 = mysqli_query($conn, $TotalCashSale);

					//run query for h cash sales

                if (mysqli_num_rows($result4) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B>TOTAL CREDIT SALES REPORT</B></h2>
							<form id='tableform' action='php/editimage.php' method='post' enctype='multipart/form-data'>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>TOTAL CASH</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result4)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				        			   <td><B>$ID</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           </tr>
							           ";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
				} else {
				    echo "0 results";
				}

				

				mysqli_close($conn);					

			}
		



				/*
				Cash Query Template
				*/

				$CashSales="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G'";

				$HighestCreditSale="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MAX(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G'";

				$LowestCashSale="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MIN(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G'";

				$TotalCashSale="SELECT ID,SUM(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G'";

				#########################################################################################################################
				/*
				Credit Query Template
				*/

				$CreditSaleReport="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='CREDIT'";

				$HighestCredtSale="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MAX(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='CREDIT'";

				$LowestCreditSale="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MIN(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='CREDIT'";

				$TotalCreditSale="SELECT ID,SUM(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='CREDIT'";


				########################################################################################################################
				/*
				Products Query Template
				*/

				//General product sales report
				$ProductSalesReport="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G' AND PRODUCT_NAME='$report'";
                //HighestSaleProductCas 
				$HighestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MAX(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G' AND PRODUCT_NAME='$report'";
                //LowestSaleProductCash
				$LowestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MIN(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G' AND PRODUCT_NAME='$report'";
				//$HighestSaleProductCredit
				$HighestSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MAX(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='CREDIT' AND PRODUCT_NAME='$report'";
                //$LowetSaleProductCredit
				$LowetSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MIN(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='CREDIT' AND PRODUCT_NAME='$report'";
                //$GrandTotalCash
				$GrandTotalCash="SELECT ID,PRODUCT_NAME, SUM(TOTAL) AS TOTAL, PAYMENT_MODE FROM sales WHERE PAYMENT_MODE='3G' AND PRODUCT_NAME='$report'";
               //$GrandTotalCredit
				$GrandTotalCredit="SELECT ID,PRODUCT_NAME, SUM(TOTAL) AS TOTAL, PAYMENT_MODE FROM sales WHERE PAYMENT_MODE='CREDIT' AND PRODUCT_NAME='$report'";
				###########################################################################################################################
 
 exit();

}

if(isset($_POST['SalesReportProduct']))
{
 $report=$_POST['val'];
 
 /*
				Products Query Template
				*/

				//General product sales report
				#start
				$ProductSalesReport="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE  PRODUCT_NAME='$report'";

				 $result1 = mysqli_query($conn, $ProductSalesReport);

                //run query for cash sales

                if (mysqli_num_rows($result1) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B>".strtoupper($report)." SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result1)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";

				} else {
				    echo "0 results";
				}
				#end















                #StartHighestSaleProductCash 
				#$SaleProductReport="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE,TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G' AND  PRODUCT_NAME='$report'";


				#End StartHighestSaleProductCash 


                //HighestSaleProductCash 
				$HighestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MAX(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G' AND PRODUCT_NAME='$report'";


				 $result2 = mysqli_query($conn, $HighestSaleProductCash);

                //run query for cash sales

                if (mysqli_num_rows($result2) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B>".strtoupper($report)." HIGHEST CASH SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result2)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";

				} else {
				    echo "0 results";
				}
				#end
				//end HighestSaleProductCash
                //LowestSaleProductCash
                #start
				$LowestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MIN(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G' AND PRODUCT_NAME='$report'";

				 $result3 = mysqli_query($conn, $LowestSaleProductCash);

                //run query for cash sales

                if (mysqli_num_rows($result3) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B>".strtoupper($report)." LOWEST CASH SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result3)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";

				} else {
				    echo "0 results";
				}

				#end
				//$HighestSaleProductCredit
				#start
				$HighestSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MAX(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='CREDIT' AND PRODUCT_NAME='$report'";

				$result4 = mysqli_query($conn, $HighestSaleProductCredit);
				if (mysqli_num_rows($result4) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B>".strtoupper($report)." HIGHEST CREDIT SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result4)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";

				} else {
				    echo "0 results";
				}
				#end
				#end
                //$LowetSaleProductCredit
                #start
				$LowetSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MIN(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='CREDIT' AND PRODUCT_NAME='$report'";

				$result5=mysqli_query($conn, $LowetSaleProductCredit);
				if (mysqli_num_rows($result5) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B>".strtoupper($report)." LOWEST CREDIT SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result5)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";

				} else {
				    echo "0 results";
				}
				#end
                //$GrandTotalCash
                #Start
				
				$GrandTotalCash="SELECT ID,PRODUCT_NAME, SUM(TOTAL) AS TOTAL, PAYMENT_MODE FROM sales WHERE PAYMENT_MODE='3G' AND PRODUCT_NAME='$report'";
				$result6=mysqli_query($conn, $GrandTotalCash);
				if (mysqli_num_rows($result6) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B>" .strtoupper($report)." TOTAL CASH SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>TOTAL</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result6)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $TOTAL=$row['TOTAL'];
							           






				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$TOTAL</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";

				} else {
				    echo "0 results";
				}
				#end
               //$GrandTotalCredit
				#star
				$GrandTotalCredit="SELECT ID,PRODUCT_NAME, SUM(TOTAL) AS TOTAL, PAYMENT_MODE FROM sales WHERE PAYMENT_MODE='CREDIT' AND PRODUCT_NAME='$report'";
				$result7=mysqli_query($conn, $GrandTotalCredit);
				if (mysqli_num_rows($result7) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B> ".strtoupper($report)." TOTAL CREDIT SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>TOTAL</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result7)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $TOTAL=$row['TOTAL'];
							           






				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$TOTAL</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
                         

				} else {
				    echo "0 results";
				}
				#end
				//$GrandTotalCredit
				#star
				$GrandTotal="SELECT ID,PRODUCT_NAME, SUM(TOTAL) AS TOTAL FROM sales WHERE  PRODUCT_NAME='$report'";
				$result8=mysqli_query($conn, $GrandTotal);
				if (mysqli_num_rows($result8) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B> ".strtoupper($report) ." GRAND TOTAL SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>TOTAL</B></td>
							       </thead>
							";
				    while($row=mysqli_fetch_assoc($result8)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $TOTAL=$row['TOTAL'];
							           






				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$TOTAL</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";

				} else {
				    echo "Error".mysql_error();
				}
				#end
 

 //mysql_close();
 exit();
 
}
####################################################################################################################################
/*
This is will be  mysql template report for generating weekly and monthly report
*/
//General product sales report
				$ProductSalesReport="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G' BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()";
                //HighestSaleProductCas 
				$HighestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MAX(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G' BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() ";
                //LowestSaleProductCash
				$LowestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MIN(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G'BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() ";
				//$HighestSaleProductCredit
				$HighestSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MAX(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='CREDIT' BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() ";
                //$LowetSaleProductCredit
				$LowetSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MIN(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='CREDIT'BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() ";
                //$GrandTotalCash
				$GrandTotalCash="SELECT ID,PRODUCT_NAME, SUM(TOTAL) AS TOTAL, PAYMENT_MODE FROM sales WHERE PAYMENT_MODE='3G' BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()";
               //$GrandTotalCredit
				$GrandTotalCredit="SELECT ID,PRODUCT_NAME, SUM(TOTAL) AS TOTAL, PAYMENT_MODE FROM sales WHERE PAYMENT_MODE='CREDIT' BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()";
####################################################################################################################################

if(isset($_GET['SalesReportWeekly']))
{
 $report=$_GET['SalesReportWeekly'];

//Get Total Weekly Cash sales report
#StartCode  
 $ProductSalesReport="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G' BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()";
$result1=mysqli_query($conn, $ProductSalesReport);
if (mysqli_num_rows($result1) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B> WEEKLY CASH SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result1)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
               
				} else {
				    echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash sales report </b>
 </div>";
				}
				#end
#endCode

#Start
//HighestSaleProductCas 
				$HighestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MAX(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G' BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() ";
				$result2=mysqli_query($conn, $HighestSaleProductCash);
if (mysqli_num_rows($result2) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B> WEEKLY HIGHEST CASH SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result2)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
               
				} else {
				    echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash sales report </b>
 </div>";
				}
#end

#Start
				 //LowestSaleProductCash
				$LowestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MIN(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G'BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() ";
				$result3=mysqli_query($conn, $LowestSaleProductCash);
if (mysqli_num_rows($result3) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B> WEEKLY LOWEST CASH SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result3)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
               
				} else {
				    echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash sales report </b>
 </div>";
				}
							



#end
#start
				//$HighestSaleProductCredit
				$HighestSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MAX(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='CREDIT' BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() ";
				$result4=mysqli_query($conn, $HighestSaleProductCredit);
if (mysqli_num_rows($result4) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B> WEEKLY HIGEST CREDIT SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result4)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
               
				} else {
				    echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash sales report </b>
 </div>";
				}
                	
#end
#start
				//$LowetSaleProductCredit
				$LowetSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MIN(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='CREDIT'BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() ";
				$result5=mysqli_query($conn, $LowetSaleProductCredit);
if (mysqli_num_rows($result5) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B> WEEKLY LOWEST CREDIT SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result5)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
               
				} else {
				    echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash sales report </b>
 </div>";
				}
               
#end
#start
				 //$GrandTotalCash
				$GrandTotalCash="SELECT ID,PRODUCT_NAME, SUM(TOTAL) AS TOTAL, PAYMENT_MODE FROM sales WHERE PAYMENT_MODE='3G' BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()";
				$result6=mysqli_query($conn, $GrandTotalCash);
if (mysqli_num_rows($result6) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B> WEEKLY TOTAL CASH SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result6)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
               
				} else {
				    echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash sales report </b>
 </div>";
				}
               
#end
#start
				//$GrandTotalCredit
				$GrandTotalCredit="SELECT ID,PRODUCT_NAME, SUM(TOTAL) AS TOTAL, PAYMENT_MODE FROM sales WHERE PAYMENT_MODE='CREDIT' BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()";
				$result7=mysqli_query($conn, $GrandTotalCredit);
if (mysqli_num_rows($result7) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B> WEEKLY TOTAL CREDIT SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result7)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
               
				} else {
				    echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash sales report </b>
 </div>";
				}
#end				


 
 
 exit();
}

if(isset($_GET['SalesReportMonthly']))
{
/*
Get monthly report
*/
//Get Total Weekly Cash sales report
#StartCode  
 $ProductSalesReport="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G' BETWEEN DATE_SUB(NOW(),INTERVAL 1 MONTH) AND NOW()";
$result1=mysqli_query($conn, $ProductSalesReport);
if (mysqli_num_rows($result1) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B> MONTHLY CASH SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result1)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
               
				} else {
				    echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash sales report </b>
 </div>";
				}
				#end
#endCode

#Start
//HighestSaleProductCas 
				$HighestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MAX(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G' BETWEEN DATE_SUB(NOW(), INTERVAL 1 MONTH) AND NOW() ";
				$result2=mysqli_query($conn, $HighestSaleProductCash);
if (mysqli_num_rows($result2) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B> MONTHLY HIGHEST CASH SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result2)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
               
				} else {
				    echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash sales report </b>
 </div>";
				}
#end

#Start
				 //LowestSaleProductCash
				$LowestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MIN(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G'BETWEEN DATE_SUB(NOW(), INTERVAL 1 MONTH) AND NOW() ";
				$result3=mysqli_query($conn, $LowestSaleProductCash);
if (mysqli_num_rows($result3) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B> MONTHLY LOWEST CASH SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result3)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
               
				} else {
				    echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash sales report </b>
 </div>";
				}
							



#end
#start
				//$HighestSaleProductCredit
				$HighestSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MAX(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='CREDIT' BETWEEN DATE_SUB(NOW(), INTERVAL 1 MONTH) AND NOW() ";
				$result4=mysqli_query($conn, $HighestSaleProductCredit);
if (mysqli_num_rows($result4) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B> MONTHLY HIGEST CREDIT SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result4)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
               
				} else {
				    echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash sales report </b>
 </div>";
				}
                	
#end
#start
				//$LowetSaleProductCredit
				$LowetSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MIN(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='CREDIT'BETWEEN DATE_SUB(NOW(), INTERVAL 1 MONTH) AND NOW() ";
				$result5=mysqli_query($conn, $LowetSaleProductCredit);
if (mysqli_num_rows($result5) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B> MONTHLY LOWEST CREDIT SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result5)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
               
				} else {
				    echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash sales report </b>
 </div>";
				}
               
#end
#start
				 //$GrandTotalCash
				$GrandTotalCash="SELECT ID,PRODUCT_NAME, SUM(TOTAL) AS TOTAL, PAYMENT_MODE FROM sales WHERE PAYMENT_MODE='3G' BETWEEN DATE_SUB(NOW(), INTERVAL 1 MONTH) AND NOW()";
				$result6=mysqli_query($conn, $GrandTotalCash);
if (mysqli_num_rows($result6) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B> MONTHLY TOTAL CASH SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result6)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
               
				} else {
				    echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash sales report </b>
 </div>";
				}
               
#end
#start
				//$GrandTotalCredit
				$GrandTotalCredit="SELECT ID,PRODUCT_NAME, SUM(TOTAL) AS TOTAL, PAYMENT_MODE FROM sales WHERE PAYMENT_MODE='CREDIT' BETWEEN DATE_SUB(NOW(),INTERVAL 1 MONTH) AND NOW()";
				$result7=mysqli_query($conn, $GrandTotalCredit);
if (mysqli_num_rows($result7) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B> MONTHLY TOTAL CREDIT SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result7)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
               
				} else {
				    echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash sales report </b>
 </div>";
				}
#end				


 
 
 exit();
 
}
/*
TEMPLATE FOR TOTAL YEARLY SALES REPORT 
*/
//SELECT * FROM USER_LOG_RECORDS WHERE YEAR(PRODUCT_NAME) = YEAR(CURDATE())
####################################################################################################################################
/*
This is will be  mysql template report for generating yearly report
*/
				//General product sales report
				$ProductSalesReport="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G' YEAR(PRODUCT_NAME) = YEAR(CURDATE())";
                //HighestSaleProductCas 
				$HighestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MAX(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G' YEAR(PRODUCT_NAME) = YEAR(CURDATE())";
                //LowestSaleProductCash
				$LowestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MIN(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G'YEAR(PRODUCT_NAME) = YEAR(CURDATE()) ";
				//$HighestSaleProductCredit
				$HighestSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MAX(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='CREDIT' YEAR(PRODUCT_NAME) = YEAR(CURDATE())";
                //$LowetSaleProductCredit
				$LowetSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MIN(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='CREDIT' YEAR(PRODUCT_NAME) = YEAR(CURDATE())";
                //$GrandTotalCash
				$GrandTotalCash="SELECT ID,PRODUCT_NAME, SUM(TOTAL) AS TOTAL, PAYMENT_MODE FROM sales WHERE PAYMENT_MODE='3G' YEAR(PRODUCT_NAME) = YEAR(CURDATE())";
               //$GrandTotalCredit
				$GrandTotalCredit="SELECT ID,PRODUCT_NAME, SUM(TOTAL) AS TOTAL, PAYMENT_MODE FROM sales WHERE YEAR(PRODUCT_NAME) = YEAR(CURDATE())";

####################################################################################################################################
if(isset($_GET['SalesReporTotal']))
{
 //$report=$_GET['SalesReporTotal'];
 /*
Get monthly report
*/
//Get Total Weekly Cash sales report
#StartCode  
 //General product sales report
				$ProductSalesReport="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G' AND YEAR(PRODUCT_NAME) = YEAR(CURDATE())";
$result1=mysqli_query($conn, $ProductSalesReport);
if (mysqli_num_rows($result1) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B> YEARLY CASH SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result1)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
               
				} else {
				    echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash sales report </b>
 </div>";
				}
				#end
#endCode

#Start
 //HighestSaleProductCas 
				$HighestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MAX(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G' AND YEAR(PRODUCT_NAME) = YEAR(CURDATE())";
				$result2=mysqli_query($conn, $HighestSaleProductCash);
if (mysqli_num_rows($result2) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B> YEARLY HIGHEST CASH SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result2)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
               
				} else {
				    echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash sales report </b>
 </div>";
				}
#end

#Start
				 //LowestSaleProductCash
				$LowestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MIN(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='3G' AND YEAR(PRODUCT_NAME) = YEAR(CURDATE()) ";
				$result3=mysqli_query($conn, $LowestSaleProductCash);
if (mysqli_num_rows($result3) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B> YEARLY LOWEST CASH SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result3)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
               
				} else {
				    echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash sales report </b>
 </div>";
				}
							



#end
#start
				//$HighestSaleProductCredit
				$HighestSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MAX(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='CREDIT' AND YEAR(PRODUCT_NAME) = YEAR(CURDATE())";
               
				$result4=mysqli_query($conn, $HighestSaleProductCredit);
if (mysqli_num_rows($result4) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B> YEARLY HIGEST CREDIT SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result4)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
               
				} else {
				    echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash sales report </b>
 </div>";
				}
                	
#end
#start
				
				 //$LowetSaleProductCredit
				$LowetSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, UNIT_PRICE, MIN(TOTAL) AS TOTAL, PAYMENT_MODE, TRANS_ACTION_TIME, DEVICE FROM sales WHERE PAYMENT_MODE='CREDIT' AND YEAR(PRODUCT_NAME) = YEAR(CURDATE())";               
				$result5=mysqli_query($conn, $LowetSaleProductCredit);
if (mysqli_num_rows($result5) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B> YEARLY LOWEST CREDIT SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result5)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
               
				} else {
				    echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash sales report </b>
 </div>";
				}
               
#end
#start
			//$GrandTotalCash
				$GrandTotalCash="SELECT ID,PRODUCT_NAME, SUM(TOTAL) AS TOTAL, PAYMENT_MODE FROM sales WHERE PAYMENT_MODE='3G' AND  YEAR(PRODUCT_NAME) = YEAR(CURDATE())";
				$result6=mysqli_query($conn, $GrandTotalCash);
if (mysqli_num_rows($result6) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B> YEARLY TOTAL CASH SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result6)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
               
				} else {
				    echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash sales report </b>
 </div>";
				}
               
#end
#start
				
				//$GrandTotalCredit
				$GrandTotalCredit="SELECT ID,PRODUCT_NAME, SUM(TOTAL) AS TOTAL, PAYMENT_MODE FROM sales WHERE YEAR(PRODUCT_NAME) = YEAR(CURDATE())";
				$result7=mysqli_query($conn, $GrandTotalCredit);
if (mysqli_num_rows($result7) > 0) {
				    // output data of each row
				    echo'<br>'."
							
							<h2 align='center'><B> YEARLY TOTAL CREDIT SALES REPORT</B></h2>
							<table class='table'>
							       <tbody>
							       <thead>
							           <td><B>ID</B></td>
							           <td><B>PRODUCT_NAME</B></td>
							           <td><B>QUANTITY</B></td>
							           <td><B>UNIT</B></td>
							           <td><B>UNIT_PRICE</B></td>
							           <td><B>TOTAL</B></td>
							           <td><B>PAYMENT_MODE</B></td>
							           <td><B>TRANS_ACTION_TIME</B></td>
							           <td><B>DEVICE</B></td>
							       </thead>
							";
				    while($row = mysqli_fetch_assoc($result7)) {
				        

                     
                                       $ID=$row['ID'];
							           $PRODUCT_NAME=$row['PRODUCT_NAME'];
							           $QUANTITY=$row['QUANTITY'];
							           $UNIT=$row['UNIT'];
							           $UNIT_PRICE=$row['UNIT_PRICE'];
							           $TOTAL=$row['TOTAL'];
							           $PAYMENT_MODE=$row['PAYMENT_MODE'];
							           $TRANS_ACTION_TIME=$row['TRANS_ACTION_TIME'];
							           $DEVICE=$row['DEVICE'];







				        echo "         <tr>
				                       <td><B>$ID</B></td>
							           <td><B>$PRODUCT_NAME</B></td>
							           <td><B>$QUANTITY</B></td>
							           <td><B>$UNIT</B></td>
							           <td><B>$UNIT_PRICE</B></td>
							           <td><B>$TOTAL</B></td>
							           <td><B>$PAYMENT_MODE</B></td>
							           <td><B>$TRANS_ACTION_TIME</B></td>
							           <td><B>$DEVICE</B></td>
							           </tr>";
				    }
				    echo" </tbody>
                        </table>
                        
                        ";
               
				} else {
				    echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash sales report </b>
 </div>";
				}
#end				


 
 
 exit();
 

}


?>