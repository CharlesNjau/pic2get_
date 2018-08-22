<?php
//PurchaseReport(Admin)
/*
This is script will generate a simple table showing all purchase report
*/
//Database connnection file

session_start();
include_once('conn2.php');
if (isset($_GET['AdminPurchaseReport'])) 
{
	$_GET['AdminPurchaseReport']='1';
	
		 echo'<br>'."
<h2 align='center'><B>PURCHASE REPORT</B></h2>

<form id='PurchaseReportform'  action='php/PurchaseReport.php' method='POST'>
<table class='table' width='914' border='0'>
  <tr>
    <td width='298'><b>GENERATE PURCHASE REPORT BY CATEGORY</b></td>
    <td width='300'>&nbsp;</td>
    <td width='288'>&nbsp;</td>
  </tr>
  <tr>
    <td><select class='form-control' id='CategoryPurchaseReport' name='1PCtgry' style='width:300px'>
      <option >--Select an option to get report--</option>
      <option value='CASH PURCHASE'>CASH PURCHASE</option>
      <option value='CASH PURCHASE'>CREDIT PURCHASE</option>
      <option value='ALCOHOL PURCHASE'>ALCOHOL PURCHASE</option>
      <option value='NON ALCOHOL PURCHASE'>NON ALCOHOL PURCHASE</option>
      <option value='DRY GOODS PURCHASE'>DRY GOODS PURCHASE</option>
      <option value='WET GOODS'>WET GOODS</option>
      <option value='PERISHABLE'>PERISHABLE</option>
      <option value='UTILITIES'>UTILITIES</option>
    </select></td>
    <td><input type='button' style='width:300px' class='btn btn-info' id='PurchaseReportBtn' value='GENERATE PURCHASE REPORT' /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><b>GENERATE PURCHASE REPORT BY PRODUCT</b></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><select class='form-control' id='ProductPurchaseReport' name='2PCtgry' style='width:300px'>
      <option>--Please select category of the goods--</option>";

      $sql = "SELECT PRODUCT_NAME FROM Products";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) 
      {
         $ProductName=$row["PRODUCT_NAME"];
        echo"<option value='$ProductName'>$ProductName</option>";
      }
      } 
      else {
          echo "0 results";
      }
      $conn->close();

      
    echo"</select></td>
    <td><input type='button' style='width:300px' class='btn btn-info' id='PurchaseReportProduct' value='REPORT BY PRODUCT NAME' /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type='button' style='width:350px' class='btn btn-info' align='left' id='PurchaseReportWeekly' value='GENERATE WEEKLY PURCHASE REPORT' /></td>
    <td><input type='button' style='width:350px' class='btn btn-info' align='middle' id='PurchaseReportMonthly' value='GENERATE MONTHLY PURCHASE REPORT' /></td>
    <td><input type='button' style='width:350px' class='btn btn-info' align='right' id='PurchaseReporTOTAL_PRICE' value='TOTAL_PRICE PURCHASE REPORT' /></td>
  </tr>
</table>
</form>
";
   
//mysqli_close($conn);
exit();
}

//purchase report section  ############start################
//for genearting RecordedConfirmedPurchaseList report per category

/*
Restructure this  sub part by accomidating self joins to fit the missing column
usin the stub template 
"SELECT RecordedConfirmedPurchaseList.PRODUCT_NAME,RecordedConfirmedPurchaseList.QUANTITY,RecordedConfirmedPurchaseList.UNIT,RecordedConfirmedPurchaseList.PRICE_PER_UNIT,RecordedConfirmedPurchaseList.TOTAL_PRICE,AcceptedSupplyList.MODE_OF_PAYMENT FROM RecordedConfirmedPurchaseList,AcceptedSupplyList WHERE RecordedConfirmedPurchaseList.HOTEL_EMAIL=AcceptedSupplyList.HOTEL_EMAIL HAVING MODE_OF_PAYMENT='CREDIT'"

*/
if(isset($_POST['PurchaseReportBtn'] ))
{
           //$report=$_POST['RecordedConfirmedPurchaseListReportBtn'];
         $report=$_POST['val'];
         //echo"This is the ajax data ".$report;
         //exit();//Test stub one cash purchases

         
        ###########################################################################################################################

    if($report==='CASH PURCHASE')
    {
          /*
        Cash Query Template
        */

        $CashRecordedConfirmedPurchaseList="SELECT RecordedConfirmedPurchaseList.PRODUCT_NAME,RecordedConfirmedPurchaseList.QUANTITY,RecordedConfirmedPurchaseList.UNIT,RecordedConfirmedPurchaseList.PRICE_PER_UNIT,RecordedConfirmedPurchaseList.TOTAL_PRICE,AcceptedSupplyList.MODE_OF_PAYMENT FROM RecordedConfirmedPurchaseList,AcceptedSupplyList WHERE RecordedConfirmedPurchaseList.HOTEL_EMAIL=AcceptedSupplyList.HOTEL_EMAIL HAVING MODE_OF_PAYMENT='CASH'";
                $result1 = mysqli_query($conn, $CashRecordedConfirmedPurchaseList);

                //run query for cash RecordedConfirmedPurchaseList

                if (mysqli_num_rows($result1) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B>CASH PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result1)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";

        } 
        else {
          echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>CURRENTLY NO CASH PURCHASE RECORD</b>
 </div>";
 //exit();
          
        }


                
        $HighestCashSale="SELECT RecordedConfirmedPurchaseList.PRODUCT_NAME,RecordedConfirmedPurchaseList.QUANTITY,RecordedConfirmedPurchaseList.UNIT,RecordedConfirmedPurchaseList.PRICE_PER_UNIT,MAX(RecordedConfirmedPurchaseList.TOTAL_PRICE),AcceptedSupplyList.MODE_OF_PAYMENT FROM RecordedConfirmedPurchaseList,AcceptedSupplyList WHERE RecordedConfirmedPurchaseList.HOTEL_EMAIL=AcceptedSupplyList.HOTEL_EMAIL HAVING MODE_OF_PAYMENT='CASH'";
        $result2 = mysqli_query($conn, $HighestCashSale);


        //run query for h cash RecordedConfirmedPurchaseList

                if (mysqli_num_rows($result2) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B>HIGHEST CASH PURCHASE REPORT</B></h2>
              <form id='tableform' action='php/editimage.php' method='post' enctype='multipart/form-data'>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result2)) {
                
                                       
                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];

                         
                     







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
        } else {
            echo "0 results";
        }



               

        $LowestCashSale="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MIN(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH'";
        $result3 = mysqli_query($conn, $LowestCashSale);

          //run query for l cash RecordedConfirmedPurchaseList

                if (mysqli_num_rows($result3) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B>LOWEST CASH PURCHASE REPORT</B></h2>
              <form id='tableform' action='php/editimage.php' method='post' enctype='multipart/form-data'>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result3)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
        } else {
            echo "0 results";
        }


        $TOTAL_PRICECashSale="SELECT ID,SUM(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH'";
        $result4 = mysqli_query($conn, $TOTAL_PRICECashSale);

          //run query for h cash RecordedConfirmedPurchaseList

                if (mysqli_num_rows($result4) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B>TOTAL_PRICE CASH PURCHASE REPORT</B></h2>
              <form id='tableform' action='php/editimage.php' method='post' enctype='multipart/form-data'>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>TOTAL_PRICE CASH</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result4)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                         <td><B>$ID</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
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
    /*CREDIT RecordedConfirmedPurchaseList*/



    if($report==='CREDIT PURCHASE')
    {
        /*
        CREDIT Query Template
        */

        $CashRecordedConfirmedPurchaseList="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT' ";
                $result1 = mysqli_query($conn, $CashRecordedConfirmedPurchaseList);

                //run query for cash RecordedConfirmedPurchaseList

                if (mysqli_num_rows($result1) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B>CREDIT PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result1)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";

        } else {
            echo "0 results";
        }
                
        $HighestCashSale="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MAX(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT'";
        $result2 = mysqli_query($conn, $HighestCashSale);


        //run query for h cash RecordedConfirmedPurchaseList

                if (mysqli_num_rows($result2) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B>HIGHEST CREDIT PURCHASE REPORT</B></h2>
              <form id='tableform' action='php/editimage.php' method='post' enctype='multipart/form-data'>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result2)) {
                
                                       
                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];

                         
                     







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
        } else {
            echo "0 results";
        }



               

        $LowestCashSale="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MIN(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT'";
        $result3 = mysqli_query($conn, $LowestCashSale);

          //run query for l cash RecordedConfirmedPurchaseList

                if (mysqli_num_rows($result3) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B>LOWEST CREDIT PURCHASE REPORT</B></h2>
              <form id='tableform' action='php/editimage.php' method='post' enctype='multipart/form-data'>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result3)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
        } else {
            echo "0 results";
        }


        $TOTAL_PRICECashSale="SELECT ID,SUM(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT'";
        $result4 = mysqli_query($conn, $TOTAL_PRICECashSale);

          //run query for h cash RecordedConfirmedPurchaseList

                if (mysqli_num_rows($result4) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B>TOTAL_PRICE CREDIT PURCHASE REPORT</B></h2>
              <form id='tableform' action='php/editimage.php' method='post' enctype='multipart/form-data'>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>TOTAL_PRICE CASH</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result4)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                         <td><B>$ID</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
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

        $CashRecordedConfirmedPurchaseList="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH'";

        $HighestCreditSale="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MAX(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH'";

        $LowestCashSale="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MIN(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH'";

        $TOTAL_PRICECashSale="SELECT ID,SUM(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH'";

        #########################################################################################################################
        /*
        Credit Query Template
        */

        $CreditSaleReport="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT'";

        $HighestCredtSale="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MAX(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT'";

        $LowestCreditSale="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MIN(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT'";

        $TOTAL_PRICECreditSale="SELECT ID,SUM(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT'";


        ########################################################################################################################
        /*
        Products Query Template
        */

        //General product RecordedConfirmedPurchaseList report
        $ProductRecordedConfirmedPurchaseListReport="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH' AND PRODUCT_NAME='$report'";
                //HighestSaleProductCas 
        $HighestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MAX(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH' AND PRODUCT_NAME='$report'";
                //LowestSaleProductCash
        $LowestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MIN(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH' AND PRODUCT_NAME='$report'";
        //$HighestSaleProductCredit
        $HighestSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MAX(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT' AND PRODUCT_NAME='$report'";
                //$LowetSaleProductCredit
        $LowetSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MIN(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT' AND PRODUCT_NAME='$report'";
                //$GrandTOTAL_PRICECash
        $GrandTOTAL_PRICECash="SELECT ID,PRODUCT_NAME, SUM(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH' AND PRODUCT_NAME='$report'";
               //$GrandTOTAL_PRICECredit
        $GrandTOTAL_PRICECredit="SELECT ID,PRODUCT_NAME, SUM(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT' AND PRODUCT_NAME='$report'";
        ###########################################################################################################################
 
 exit();

}

if(isset($_POST['PurchaseReportProduct']))
{
 $report=$_POST['val'];
 
 /*
        Products Query Template
        */

        //General product RecordedConfirmedPurchaseList report
        #start
        $ProductRecordedConfirmedPurchaseListReport="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE  PRODUCT_NAME='$report'";

         $result1 = mysqli_query($conn, $ProductRecordedConfirmedPurchaseListReport);

                //run query for cash RecordedConfirmedPurchaseList

                if (mysqli_num_rows($result1) > 0) {
            // output data of each row 
            echo'<br>'."
              
              <h2 align='center'><B> ".strtoupper($report)." PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result1)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
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
        #$SaleProductReport="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT,TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH' AND  PRODUCT_NAME='$report'";


        #End StartHighestSaleProductCash 


                //HighestSaleProductCash 
        $HighestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MAX(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH' AND PRODUCT_NAME='$report'";


         $result2 = mysqli_query($conn, $HighestSaleProductCash);

                //run query for cash RecordedConfirmedPurchaseList

                if (mysqli_num_rows($result2) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B>".strtoupper($report)." HIGHEST CASH PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result2)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
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
        $LowestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MIN(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH' AND PRODUCT_NAME='$report'";

         $result3 = mysqli_query($conn, $LowestSaleProductCash);

                //run query for cash RecordedConfirmedPurchaseList

                if (mysqli_num_rows($result3) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B>".strtoupper($report)." LOWEST CASH PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result3)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
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
        $HighestSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MAX(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT' AND PRODUCT_NAME='$report'";

        $result4 = mysqli_query($conn, $HighestSaleProductCredit);
        if (mysqli_num_rows($result4) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B>". strtoupper($report)." HIGHEST CREDIT PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result4)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
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
        $LowetSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MIN(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT' AND PRODUCT_NAME='$report'";

        $result5=mysqli_query($conn, $LowetSaleProductCredit);
        if (mysqli_num_rows($result5) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B>".strtoupper($report)." LOWEST CREDIT PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result5)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";

        } else {
            echo "0 results";
        }
        #end
                //$GrandTOTAL_PRICECash
                #Start
        
        $GrandTOTAL_PRICECash="SELECT ID,PRODUCT_NAME, SUM(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH' AND PRODUCT_NAME='$report'";
        $result6=mysqli_query($conn, $GrandTOTAL_PRICECash);
        if (mysqli_num_rows($result6) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B>".strtoupper($report)." TOTAL_PRICE CASH PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result6)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         






                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";

        } else {
            echo "0 results";
        }
        #end
               //$GrandTOTAL_PRICECredit
        #star
        $GrandTOTAL_PRICECredit="SELECT ID,PRODUCT_NAME, SUM(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT' AND PRODUCT_NAME='$report'";
        $result7=mysqli_query($conn, $GrandTOTAL_PRICECredit);
        if (mysqli_num_rows($result7) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B>".strtoupper($report)." TOTAL_PRICE CREDIT PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result7)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         






                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
                         

        } else {
            echo "0 results";
        }
        #end
        //$GrandTOTAL_PRICECredit
        #star
        $GrandTOTAL_PRICE="SELECT ID,PRODUCT_NAME, SUM(TOTAL_PRICE) AS TOTAL_PRICE FROM RecordedConfirmedPurchaseList WHERE  PRODUCT_NAME='$report'";
        $result8=mysqli_query($conn, $GrandTOTAL_PRICE);
        if (mysqli_num_rows($result8) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B>".strtoupper($report)." GRAND TOTAL_PRICE PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                     </thead>
              ";
            while($row=mysqli_fetch_assoc($result8)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         






                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
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
//General product RecordedConfirmedPurchaseList report
        $ProductRecordedConfirmedPurchaseListReport="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH' BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()";
                //HighestSaleProductCas 
        $HighestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MAX(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH' BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() ";
                //LowestSaleProductCash
        $LowestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MIN(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH'BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() ";
        //$HighestSaleProductCredit
        $HighestSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MAX(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT' BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() ";
                //$LowetSaleProductCredit
        $LowetSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MIN(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT'BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() ";
                //$GrandTOTAL_PRICECash
        $GrandTOTAL_PRICECash="SELECT ID,PRODUCT_NAME, SUM(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH' BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()";
               //$GrandTOTAL_PRICECredit
        $GrandTOTAL_PRICECredit="SELECT ID,PRODUCT_NAME, SUM(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT' BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()";
####################################################################################################################################

if(isset($_GET['RecordedConfirmedPurchaseListReportWeekly']))
{
 $report=$_GET['RecordedConfirmedPurchaseListReportWeekly'];

//Get TOTAL_PRICE Weekly Cash RecordedConfirmedPurchaseList report
#StartCode  
 $ProductRecordedConfirmedPurchaseListReport="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH' BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()";
$result1=mysqli_query($conn, $ProductRecordedConfirmedPurchaseListReport);
if (mysqli_num_rows($result1) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B> WEEKLY CASH PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result1)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
               
        } else {
            echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash RecordedConfirmedPurchaseList report </b>
 </div>";
        }
        #end
#endCode

#Start
//HighestSaleProductCas 
        $HighestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MAX(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH' BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() ";
        $result2=mysqli_query($conn, $HighestSaleProductCash);
if (mysqli_num_rows($result2) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B> WEEKLY HIGHEST CASH PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result2)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
               
        } else {
            echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash RecordedConfirmedPurchaseList report </b>
 </div>";
        }
#end

#Start
         //LowestSaleProductCash
        $LowestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MIN(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH'BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() ";
        $result3=mysqli_query($conn, $LowestSaleProductCash);
if (mysqli_num_rows($result3) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B> WEEKLY LOWEST CASH PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result3)) {
                

                     
                         $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
               
        } else {
            echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash RecordedConfirmedPurchaseList report </b>
 </div>";
        }
              



#end
#start
        //$HighestSaleProductCredit
        $HighestSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MAX(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT' BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() ";
        $result4=mysqli_query($conn, $HighestSaleProductCredit);
if (mysqli_num_rows($result4) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B> WEEKLY HIGEST CREDIT PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result4)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
               
        } else {
            echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash RecordedConfirmedPurchaseList report </b>
 </div>";
        }
                  
#end
#start
        //$LowetSaleProductCredit
        $LowetSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MIN(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT'BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() ";
        $result5=mysqli_query($conn, $LowetSaleProductCredit);
if (mysqli_num_rows($result5) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B> WEEKLY LOWEST CREDIT PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result5)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
               
        } else {
            echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash RecordedConfirmedPurchaseList report </b>
 </div>";
        }
               
#end
#start
         //$GrandTOTAL_PRICECash
        $GrandTOTAL_PRICECash="SELECT ID,PRODUCT_NAME, SUM(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH' BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()";
        $result6=mysqli_query($conn, $GrandTOTAL_PRICECash);
if (mysqli_num_rows($result6) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B> WEEKLY TOTAL_PRICE CASH PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result6)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
               
        } else {
            echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash RecordedConfirmedPurchaseList report </b>
 </div>";
        }
               
#end
#start
        //$GrandTOTAL_PRICECredit
        $GrandTOTAL_PRICECredit="SELECT ID,PRODUCT_NAME, SUM(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT' BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()";
        $result7=mysqli_query($conn, $GrandTOTAL_PRICECredit);
if (mysqli_num_rows($result7) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B> WEEKLY TOTAL_PRICE CREDIT PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result7)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
               
        } else {
            echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash RecordedConfirmedPurchaseList report </b>
 </div>";
        }
#end        


 
 
 exit();
}

if(isset($_GET['RecordedConfirmedPurchaseListReportMonthly']))
{
/*
Get monthly report
*/
//Get TOTAL_PRICE Weekly Cash RecordedConfirmedPurchaseList report
#StartCode  
 $ProductRecordedConfirmedPurchaseListReport="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH' BETWEEN DATE_SUB(NOW(),INTERVAL 1 MONTH) AND NOW()";
$result1=mysqli_query($conn, $ProductRecordedConfirmedPurchaseListReport);
if (mysqli_num_rows($result1) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B> MONTHLY CASH PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result1)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
               
        } else {
            echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash RecordedConfirmedPurchaseList report </b>
 </div>";
        }
        #end
#endCode

#Start
//HighestSaleProductCas 
        $HighestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MAX(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH' BETWEEN DATE_SUB(NOW(), INTERVAL 1 MONTH) AND NOW() ";
        $result2=mysqli_query($conn, $HighestSaleProductCash);
if (mysqli_num_rows($result2) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B> MONTHLY HIGHEST CASH PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result2)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
               
        } else {
            echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash RecordedConfirmedPurchaseList report </b>
 </div>";
        }
#end

#Start
         //LowestSaleProductCash
        $LowestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MIN(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH'BETWEEN DATE_SUB(NOW(), INTERVAL 1 MONTH) AND NOW() ";
        $result3=mysqli_query($conn, $LowestSaleProductCash);
if (mysqli_num_rows($result3) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B> MONTHLY LOWEST CASH PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result3)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
               
        } else {
            echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash RecordedConfirmedPurchaseList report </b>
 </div>";
        }
              



#end
#start
        //$HighestSaleProductCredit
        $HighestSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MAX(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT' BETWEEN DATE_SUB(NOW(), INTERVAL 1 MONTH) AND NOW() ";
        $result4=mysqli_query($conn, $HighestSaleProductCredit);
if (mysqli_num_rows($result4) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B> MONTHLY HIGEST CREDIT PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result4)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
               
        } else {
            echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash RecordedConfirmedPurchaseList report </b>
 </div>";
        }
                  
#end
#start
        //$LowetSaleProductCredit
        $LowetSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MIN(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT'BETWEEN DATE_SUB(NOW(), INTERVAL 1 MONTH) AND NOW() ";
        $result5=mysqli_query($conn, $LowetSaleProductCredit);
if (mysqli_num_rows($result5) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B> MONTHLY LOWEST CREDIT PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result5)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
               
        } else {
            echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash RecordedConfirmedPurchaseList report </b>
 </div>";
        }
               
#end
#start
         //$GrandTOTAL_PRICECash
        $GrandTOTAL_PRICECash="SELECT ID,PRODUCT_NAME, SUM(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH' BETWEEN DATE_SUB(NOW(), INTERVAL 1 MONTH) AND NOW()";
        $result6=mysqli_query($conn, $GrandTOTAL_PRICECash);
if (mysqli_num_rows($result6) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B> MONTHLY TOTAL_PRICE CASH PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result6)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
               
        } else {
            echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash RecordedConfirmedPurchaseList report </b>
 </div>";
        }
               
#end
#start
        //$GrandTOTAL_PRICECredit
        $GrandTOTAL_PRICECredit="SELECT ID,PRODUCT_NAME, SUM(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT' BETWEEN DATE_SUB(NOW(),INTERVAL 1 MONTH) AND NOW()";
        $result7=mysqli_query($conn, $GrandTOTAL_PRICECredit);
if (mysqli_num_rows($result7) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B> MONTHLY TOTAL_PRICE CREDIT PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result7)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
               
        } else {
            echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash RecordedConfirmedPurchaseList report </b>
 </div>";
        }
#end        


 
 
 exit();
 
}
/*
TEMPLATE FOR TOTAL_PRICE YEARLY RecordedConfirmedPurchaseList REPORT 
*/
//SELECT * FROM USER_LOG_RECORDS WHERE YEAR(PRODUCT_NAME) = YEAR(CURDATE())
####################################################################################################################################
/*
This is will be  mysql template report for generating yearly report
*/
        //General product RecordedConfirmedPurchaseList report
        $ProductRecordedConfirmedPurchaseListReport="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH' YEAR(PRODUCT_NAME) = YEAR(CURDATE())";
                //HighestSaleProductCas 
        $HighestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MAX(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH' YEAR(PRODUCT_NAME) = YEAR(CURDATE())";
                //LowestSaleProductCash
        $LowestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MIN(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH'YEAR(PRODUCT_NAME) = YEAR(CURDATE()) ";
        //$HighestSaleProductCredit
        $HighestSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MAX(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT' YEAR(PRODUCT_NAME) = YEAR(CURDATE())";
                //$LowetSaleProductCredit
        $LowetSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MIN(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT' YEAR(PRODUCT_NAME) = YEAR(CURDATE())";
                //$GrandTOTAL_PRICECash
        $GrandTOTAL_PRICECash="SELECT ID,PRODUCT_NAME, SUM(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH' YEAR(PRODUCT_NAME) = YEAR(CURDATE())";
               //$GrandTOTAL_PRICECredit
        $GrandTOTAL_PRICECredit="SELECT ID,PRODUCT_NAME, SUM(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE FROM RecordedConfirmedPurchaseList WHERE YEAR(PRODUCT_NAME) = YEAR(CURDATE())";

####################################################################################################################################
if(isset($_GET['RecordedConfirmedPurchaseListReporTOTAL_PRICE']))
{
 //$report=$_GET['RecordedConfirmedPurchaseListReporTOTAL_PRICE'];
 /*
Get monthly report
*/
//Get TOTAL_PRICE Weekly Cash RecordedConfirmedPurchaseList report
#StartCode  
 //General product RecordedConfirmedPurchaseList report
        $ProductRecordedConfirmedPurchaseListReport="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH' AND YEAR(PRODUCT_NAME) = YEAR(CURDATE())";
$result1=mysqli_query($conn, $ProductRecordedConfirmedPurchaseListReport);
if (mysqli_num_rows($result1) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B> YEARLY CASH PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result1)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
               
        } else {
            echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash RecordedConfirmedPurchaseList report </b>
 </div>";
        }
        #end
#endCode

#Start
 //HighestSaleProductCas 
        $HighestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MAX(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH' AND YEAR(PRODUCT_NAME) = YEAR(CURDATE())";
        $result2=mysqli_query($conn, $HighestSaleProductCash);
if (mysqli_num_rows($result2) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B> YEARLY HIGHEST CASH PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result2)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
               
        } else {
            echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash RecordedConfirmedPurchaseList report </b>
 </div>";
        }
#end

#Start
         //LowestSaleProductCash
        $LowestSaleProductCash="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MIN(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH' AND YEAR(PRODUCT_NAME) = YEAR(CURDATE()) ";
        $result3=mysqli_query($conn, $LowestSaleProductCash);
if (mysqli_num_rows($result3) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B> YEARLY LOWEST CASH PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result3)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
               
        } else {
            echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash RecordedConfirmedPurchaseList report </b>
 </div>";
        }
              



#end
#start
        //$HighestSaleProductCredit
        $HighestSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MAX(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT' AND YEAR(PRODUCT_NAME) = YEAR(CURDATE())";
               
        $result4=mysqli_query($conn, $HighestSaleProductCredit);
if (mysqli_num_rows($result4) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B> YEARLY HIGEST CREDIT PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result4)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
               
        } else {
            echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash RecordedConfirmedPurchaseList report </b>
 </div>";
        }
                  
#end
#start
        
         //$LowetSaleProductCredit
        $LowetSaleProductCredit="SELECT ID,PRODUCT_NAME, QUANTITY, UNIT, PRICE_PER_UNIT, MIN(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE, RECORDED_TIME, COMPANY_NAME FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CREDIT' AND YEAR(PRODUCT_NAME) = YEAR(CURDATE())";               
        $result5=mysqli_query($conn, $LowetSaleProductCredit);
if (mysqli_num_rows($result5) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B> YEARLY LOWEST CREDIT PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result5)) {
                

                     
                         $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
               
        } else {
            echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash RecordedConfirmedPurchaseList report </b>
 </div>";
        }
               
#end
#start
      //$GrandTOTAL_PRICECash
        $GrandTOTAL_PRICECash="SELECT ID,PRODUCT_NAME, SUM(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE FROM RecordedConfirmedPurchaseList WHERE ACCOUNT_TYPE='CASH' AND  YEAR(PRODUCT_NAME) = YEAR(CURDATE())";
        $result6=mysqli_query($conn, $GrandTOTAL_PRICECash);
if (mysqli_num_rows($result6) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B> YEARLY TOTAL_PRICE CASH PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result6)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
               
        } else {
            echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash RecordedConfirmedPurchaseList report </b>
 </div>";
        }
               
#end
#start
        
        //$GrandTOTAL_PRICECredit
        $GrandTOTAL_PRICECredit="SELECT ID,PRODUCT_NAME, SUM(TOTAL_PRICE) AS TOTAL_PRICE, ACCOUNT_TYPE FROM RecordedConfirmedPurchaseList WHERE YEAR(PRODUCT_NAME) = YEAR(CURDATE())";
        $result7=mysqli_query($conn, $GrandTOTAL_PRICECredit);
if (mysqli_num_rows($result7) > 0) {
            // output data of each row
            echo'<br>'."
              
              <h2 align='center'><B> YEARLY TOTAL_PRICE CREDIT PURCHASE REPORT</B></h2>
              <table class='table'>
                     <tbody>
                     <thead>
                         <td><B>ID</B></td>
                         <td><B>PRODUCT_NAME</B></td>
                         <td><B>QUANTITY</B></td>
                         <td><B>UNIT</B></td>
                         <td><B>PRICE_PER_UNIT</B></td>
                         <td><B>TOTAL_PRICE</B></td>
                         <td><B>ACCOUNT_TYPE</B></td>
                         <td><B>RECORDED_TIME</B></td>
                         <td><B>COMPANY_NAME</B></td>
                     </thead>
              ";
            while($row = mysqli_fetch_assoc($result7)) {
                

                     
                                       $ID=$row['ID'];
                         $PRODUCT_NAME=$row['PRODUCT_NAME'];
                         $QUANTITY=$row['QUANTITY'];
                         $UNIT=$row['UNIT'];
                         $PRICE_PER_UNIT=$row['PRICE_PER_UNIT'];
                         $TOTAL_PRICE=$row['TOTAL_PRICE'];
                         $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];
                         $RECORDED_TIME=$row['RECORDED_TIME'];
                         $COMPANY_NAME=$row['COMPANY_NAME'];







                echo "         <tr>
                               <td><B>$ID</B></td>
                         <td><B>$PRODUCT_NAME</B></td>
                         <td><B>$QUANTITY</B></td>
                         <td><B>$UNIT</B></td>
                         <td><B>$PRICE_PER_UNIT</B></td>
                         <td><B>$TOTAL_PRICE</B></td>
                         <td><B>$ACCOUNT_TYPE</B></td>
                         <td><B>$RECORDED_TIME</B></td>
                         <td><B>$COMPANY_NAME</B></td>
                         </tr>";
            }
            echo" </tbody>
                        </table>
                        
                        ";
               
        } else {
            echo "<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error getting weekly cash RecordedConfirmedPurchaseList report </b>
 </div>";
        }
#end        


 
 
 exit();
 

}
                           #############end#################

?>