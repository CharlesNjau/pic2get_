#!/usr/local/bin/php.cli
<?php
include_once('conn2.php');
//$SUPPLIER_CATEGORY= $_SESSION['SUPPLIER_CATEGORY'];
$REGISTERD_AS=$_SESSION['ROLE'];
$EMAIL=$_SESSION['EMAIL'];
$GLOBALS['COMPANY_NAME'];

//This is the logic control for tht ecron job
/*
Remeber to uncomment of the part for deleting the active table after 12hours


*/

if(GetSupplyOrder()===true)//Step Check if there is a higest supplier
{
  
  echo"No Duplicate data found.Data Back Up and Data Migration Commnecing"."<br>";
  //exit();

  //Begin moving Data to BaCk Up tables
  //Clear PurChase order table
  if(ClearPurchaseOrder()===true){
   echo"PurChase order table Cleared Backed Up to RecordedPurchaseOrderTable"."<br>";
  }
  else if(ClearPurchaseOrder()===false){
   echo"Error in Clearing PurChase order"."<br>";
  }
  //Clear Quelist
  if(ClearQueList()===true){
   echo"ConfirmedSupplyQueList table Cleared Backed Up to RecordedConfirmedSupplyQueList"."<br>";
  }
  elseif(ClearQueList()===false){
    echo"Error in Clearing ConfirmedSupplyQueList "."<br>";
  }
  //Clear ConfirmedPurChaseOrdeList
  if(ClearConfirmedPurchaseList()===true){
   echo"ConfirmedPurChaseOrdeList table Cleared Backed Up to RecordedConfirmedPurchaseList"."<br>";
  }
  else if(ClearConfirmedPurchaseList()===false){
    echo"Error in Clearing ConfirmedPurChaseOrdeList"."<br>";

  }

}
else if(GetSupplyOrder()===false)
{
  echo"DUPLICATE LOCATED COMMENCING BACKUP OF OTHER TABLES"."<br>";
 // exit();
  //Begin moving Data without AcceptedSupplyList
  if(ClearPurchaseOrder()===true){
   echo"PurChase order table Cleared Backed Up to RecordedPurchaseOrderTable"."<br>";
  }
  else if(ClearPurchaseOrder()===false){
   echo"Error in Clearing PurChase order"."<br>";
  }
  //Clear Quelist
  if(ClearQueList()===true){
   echo"ConfirmedSupplyQueList table Cleared Backed Up to RecordedConfirmedSupplyQueList"."<br>";
  }
  elseif(ClearQueList()===false){
    echo"Error in Clearing ConfirmedSupplyQueList "."<br>";
  }
  //Clear ConfirmedPurChaseOrdeList
  if(ClearConfirmedPurchaseList()===true){
   echo"ConfirmedPurChaseOrdeList table Cleared Backed Up to RecordedConfirmedPurchaseList"."<br>";
  }
  else if(ClearConfirmedPurchaseList()===false){
    echo"Error in Clearing ConfirmedPurChaseOrdeList"."<br>";

  }


}

/*
The purpose of this function is to get the supplier who has supplied the most item and select
*/
//function toselect the highest count per supplier category




function GetSupplyOrder()
{

define("DB_SERVER", "195.8.222.39");
define("DB_USER", "pick2get");
define("DB_PASSWORD", "3DZX5J8k");
define("DB_DATABASE", "pick2get");


$servername = "localhost";
$username = "pick2get";
$password = "3DZX5J8k";
$dbname = "pick2get_pick2get";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


  $GetHighestMeatSupplier="SELECT HOTEL_EMAIL,COMPANY_NAME,TOTAL_PRICE FROM ConfirmedSupplyQueList WHERE SUPPLIER_CATEGORY='MEAT_SUPPLIER' GROUP BY CONFIRMED_COUNT ORDER BY MAX(CONFIRMED_COUNT) DESC";
  $result1=mysqli_query($conn,$GetHighestMeatSupplier);

            if(mysqli_num_rows($result1) >0)
            {
            //IF ITEM Is PRESENT DISPLAY IN TABLE FORMAT                   
                      while($row = mysqli_fetch_assoc($result1)) 
                      {
                                           $COMPANY_NAME=$row['COMPANY_NAME'];
                                           $TOTAL_PRICE=$row['TOTAL_PRICE'];
                                           $SUPPLIER_CATEGORY=$row['SUPPLIER_CATEGORY'];
                                           $HOTEL_EMAIL=$row['HOTEL_EMAIL'];
                                           //Store return value in single array
                                           //Test Stub 1
                                          # echo"COMPANY_NAME ".$COMPANY_NAME."# "."TOTAL_PRICE ".$TOTAL_PRICE."# "."SUPPLIER_CATEGORY ".$SUPPLIER_CATEGORY."# "."HOTEL_EMAIL: ".$HOTEL_EMAIL."<BR>";

                                         

                                          
                                          

                                           

                        
                      }
                        //Copy Data to table AcceptedSupplyList

                        //First Check for Duplicate Entry to prevent over loading database

                        $ArraySize=CountSize();
                        //Minor Test Stub
                        # echo "ArraySize".$ArraySize."<br>";

                            for ($i=0; $i <=$ArraySize ; $i++)
                            { 
                                          # code...
                                          if(CheckDuplicateEntry($COMPANY_NAME,$HOTEL_EMAIL,$TOTAL_PRICE)===true)
                                          {
                                               #echo"Duplicate Entry"."<BR>";
                                               return false;
                                               exit();
                                          }
                                          else if(CheckDuplicateEntry($COMPANY_NAME,$HOTEL_EMAIL,$TOTAL_PRICE)===false)
                                          {

                                              $MoveToAcceptedSupplyList="INSERT INTO AcceptedSupplyList(COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                              ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL)SELECT COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                              ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL FROM ConfirmedSupplyQueList";

                                              if (mysqli_query($conn, $MoveToAcceptedSupplyList))
                                               {
                                                  //Test Stub 3
                                                  #echo "New record created successfully"."<BR>";
                                                  return true;
                                              } 
                                              else
                                               {
                                                  //Test Stub 4
                                                  echo "Error: " . $MoveToAcceptedSupplyList . "<br>" . mysqli_error($conn);
                                                  return false;
                                              }
                                              



                                          }
                            }

                                         
                                          

                      
                                          
                                          exit();
              
            }
            else if(mysqli_num_rows($result1 <=0))
            {
               echo"No Confirmed Supplies MEAT_SUPPLIER"."<br>";
               return false;

            }

  


  
  $GetHighestFishSupplier="SELECT HOTEL_EMAIL,COMPANY_NAME,TOTAL_PRICE FROM ConfirmedSupplyQueList WHERE SUPPLIER_CATEGORY='FISH_SUPPLIER' GROUP BY CONFIRMED_COUNT ORDER BY MAX(CONFIRMED_COUNT) DESC";
  $result2=mysqli_query($conn,$GetHighestFishSupplier);
  if(mysqli_num_rows($result2) >0)
              {
              //IF ITEM Is PRESENT DISPLAY IN TABLE FORMAT                   
                        while($row = mysqli_fetch_assoc($result2)) 
                        {
                                             $COMPANY_NAME=$row['COMPANY_NAME'];
                                             $TOTAL_PRICE=$row['TOTAL_PRICE'];
                                             $SUPPLIER_CATEGORY=$row['SUPPLIER_CATEGORY'];
                                             $HOTEL_EMAIL=$row['HOTEL_EMAIL'];
                                           //Store return value in single array

                                           #echo"COMPANY_NAME ".$COMPANY_NAME."# "."TOTAL_PRICE ".$TOTAL_PRICE."# "."SUPPLIER_CATEGORY ".$SUPPLIER_CATEGORY."# "."HOTEL_EMAIL: ".$HOTEL_EMAIL."<BR>";
                                         //Copy Data to table AcceptedSupplyList



                          
                        }
                        
                        //Copy Data to table AcceptedSupplyList

                        //First Check for Duplicate Entry to prevent over loading database

                        $ArraySize=CountSize();
                        //Minor Test Stub
                        # echo "ArraySize".$ArraySize."<br>";

                            for ($i=0; $i <=$ArraySize ; $i++)
                            { 
                                          # code...
                                          if(CheckDuplicateEntry($COMPANY_NAME,$HOTEL_EMAIL,$TOTAL_PRICE)===true)
                                          {
                                               #echo"Duplicate Entry"."<BR>";
                                               return false;
                                               exit();
                                          }
                                          else if(CheckDuplicateEntry($COMPANY_NAME,$HOTEL_EMAIL,$TOTAL_PRICE)===false)
                                          {

                                              $MoveToAcceptedSupplyList="INSERT INTO AcceptedSupplyList(COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                              ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL)SELECT COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                              ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL FROM ConfirmedSupplyQueList";

                                              if (mysqli_query($conn, $MoveToAcceptedSupplyList))
                                               {
                                                  //Test Stub 3
                                                  #echo "New record created successfully"."<BR>";
                                                  return true;
                                              } 
                                              else
                                               {
                                                  //Test Stub 4
                                                  echo "Error: " . $MoveToAcceptedSupplyList . "<br>" . mysqli_error($conn);
                                                  return false;
                                              }
                                              



                                          }
                            }

                                         
                                          

                      
                                          
                                         
                                          
                       
                        exit();
                  
              }
           else if(mysqli_num_rows($result2)<=0)
            {
               echo"No Confirmed Supplies for FISH_SUPPLIER"."<br>";
               return false;
            }

  $GetHighestFruitAndVegetable="SELECT HOTEL_EMAIL,COMPANY_NAME,TOTAL_PRICE FROM ConfirmedSupplyQueList WHERE SUPPLIER_CATEGORY='FRUITS_AND_VEGETABLE' GROUP BY CONFIRMED_COUNT ORDER BY MAX(CONFIRMED_COUNT) DESC";
  $result3=mysqli_query($conn,$GetHighestFruitAndVegetable);
  if(mysqli_num_rows($result3) >0)
            {
            //IF ITEM Is PRESENT DISPLAY IN TABLE FORMAT                   
                      while($row = mysqli_fetch_assoc($result3)) 
                      {
                                           $COMPANY_NAME=$row['COMPANY_NAME'];
                                           $TOTAL_PRICE=$row['TOTAL_PRICE'];
                                           $SUPPLIER_CATEGORY=$row['SUPPLIER_CATEGORY'];
                                           $HOTEL_EMAIL=$row['HOTEL_EMAIL'];
                                           //Store return value in single array

                                           #echo"COMPANY_NAME ".$COMPANY_NAME."# "."TOTAL_PRICE ".$TOTAL_PRICE."# "."SUPPLIER_CATEGORY ".$SUPPLIER_CATEGORY."# "."HOTEL_EMAIL: ".$HOTEL_EMAIL."<BR>";
                                            //Copy Data to table AcceptedSupplyList


                        
                      }
                        //Copy Data to table AcceptedSupplyList

                        //First Check for Duplicate Entry to prevent over loading database

                        $ArraySize=CountSize();
                        //Minor Test Stub
                        # echo "ArraySize".$ArraySize."<br>";

                            for ($i=0; $i <=$ArraySize ; $i++)
                            { 
                                          # code...
                                          if(CheckDuplicateEntry($COMPANY_NAME,$HOTEL_EMAIL,$TOTAL_PRICE)===true)
                                          {
                                               #echo"Duplicate Entry"."<BR>";
                                               return false;
                                               exit();
                                          }
                                          else if(CheckDuplicateEntry($COMPANY_NAME,$HOTEL_EMAIL,$TOTAL_PRICE)===false)
                                          {

                                              $MoveToAcceptedSupplyList="INSERT INTO AcceptedSupplyList(COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                              ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL)SELECT COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                              ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL FROM ConfirmedSupplyQueList";

                                              if (mysqli_query($conn, $MoveToAcceptedSupplyList))
                                               {
                                                  //Test Stub 3
                                                  #echo "New record created successfully"."<BR>";
                                                  return true;
                                              } 
                                              else
                                               {
                                                  //Test Stub 4
                                                  echo "Error: " . $MoveToAcceptedSupplyList . "<br>" . mysqli_error($conn);
                                                  return false;
                                              }
                                              



                                          }
                            }
                                          
                                          exit();

                
            }
            else if(mysqli_num_rows($result3)<=0)
            {
               echo"No Confirmed Supplies  for FRUITS_AND_VEGETABLE"."<br>";
               return false;
            }
  
  $GetHighestDryFoodSupplier="SELECT HOTEL_EMAIL,COMPANY_NAME,TOTAL_PRICE FROM ConfirmedSupplyQueList WHERE SUPPLIER_CATEGORY='DRY_FOOD_SUPPLIER' GROUP BY CONFIRMED_COUNT ORDER BY MAX(CONFIRMED_COUNT) DESC";
  $result4=mysqli_query($conn,$GetHighestDryFoodSupplier);
  if(mysqli_num_rows($result4) >0)
            {
            //IF ITEM Is PRESENT DISPLAY IN TABLE FORMAT                   
                      while($row = mysqli_fetch_assoc($result4)) 
                      {
                                           $COMPANY_NAME=$row['COMPANY_NAME'];
                                           $TOTAL_PRICE=$row['TOTAL_PRICE'];
                                           $SUPPLIER_CATEGORY=$row['SUPPLIER_CATEGORY'];
                                           $HOTEL_EMAIL=$row['HOTEL_EMAIL'];
                                           //Store return value in single array

                                           #echo"COMPANY_NAME ".$COMPANY_NAME."# "."TOTAL_PRICE ".$TOTAL_PRICE."# "."SUPPLIER_CATEGORY ".$SUPPLIER_CATEGORY."# "."HOTEL_EMAIL: ".$HOTEL_EMAIL."<BR>";
                                            //Copy Data to table AcceptedSupplyList

                                           


                        
                      }
                      
                        //Copy Data to table AcceptedSupplyList

                        //First Check for Duplicate Entry to prevent over loading database

                        $ArraySize=CountSize();
                        //Minor Test Stub
                        # echo "ArraySize".$ArraySize."<br>";

                            for ($i=0; $i <=$ArraySize ; $i++)
                            { 
                                          # code...
                                          if(CheckDuplicateEntry($COMPANY_NAME,$HOTEL_EMAIL,$TOTAL_PRICE)===true)
                                          {
                                               #echo"Duplicate Entry"."<BR>";
                                               return false;
                                               exit();
                                          }
                                          else if(CheckDuplicateEntry($COMPANY_NAME,$HOTEL_EMAIL,$TOTAL_PRICE)===false)
                                          {

                                              $MoveToAcceptedSupplyList="INSERT INTO AcceptedSupplyList(COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                              ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL)SELECT COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                              ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL FROM ConfirmedSupplyQueList";

                                              if (mysqli_query($conn, $MoveToAcceptedSupplyList))
                                               {
                                                  //Test Stub 3
                                                  #echo "New record created successfully"."<BR>";
                                                  return true;
                                              } 
                                              else
                                               {
                                                  //Test Stub 4
                                                  echo "Error: " . $MoveToAcceptedSupplyList . "<br>" . mysqli_error($conn);
                                                  return false;
                                              }
                                              



                                          }
                            }
                            exit();
               
            }
           else if (mysqli_num_rows($result4<=0))
              {
                echo"No Confirmed Supplies for DRY_FOOD_SUPPLIER"."<br>";
                return false;
              }
                              
  $GetHighestAlcoholicSupplier="SELECT HOTEL_EMAIL,COMPANY_NAME,TOTAL_PRICE FROM ConfirmedSupplyQueList WHERE SUPPLIER_CATEGORY='ALOHOLIC_SUPPLIER' GROUP BY CONFIRMED_COUNT ORDER BY MAX(CONFIRMED_COUNT) DESC";
  $result5=mysqli_query($conn,$GetHighestAlcoholicSupplier);
  if(mysqli_num_rows($result5) >0)
            {
            //IF ITEM Is PRESENT DISPLAY IN TABLE FORMAT                   
                      while($row = mysqli_fetch_assoc($result5)) 
                      {
                                           $COMPANY_NAME=$row['COMPANY_NAME'];
                                           $TOTAL_PRICE=$row['TOTAL_PRICE'];
                                           $SUPPLIER_CATEGORY=$row['SUPPLIER_CATEGORY'];
                                           $HOTEL_EMAIL=$row['HOTEL_EMAIL'];
                                           //Store return value in single array

                                           #echo"COMPANY_NAME ".$COMPANY_NAME."# "."TOTAL_PRICE ".$TOTAL_PRICE."# "."SUPPLIER_CATEGORY ".$SUPPLIER_CATEGORY."# "."HOTEL_EMAIL: ".$HOTEL_EMAIL."<BR>";
                                           //Copy Data to table AcceptedSupplyList




                        
                      }
                     
                        //Copy Data to table AcceptedSupplyList

                        //First Check for Duplicate Entry to prevent over loading database

                        $ArraySize=CountSize();
                        //Minor Test Stub
                        # echo "ArraySize".$ArraySize."<br>";

                            for ($i=0; $i <=$ArraySize ; $i++)
                            { 
                                          # code...
                                          if(CheckDuplicateEntry($COMPANY_NAME,$HOTEL_EMAIL,$TOTAL_PRICE)===true)
                                          {
                                               #echo"Duplicate Entry"."<BR>";
                                               return false;
                                               exit();
                                          }
                                          else if(CheckDuplicateEntry($COMPANY_NAME,$HOTEL_EMAIL,$TOTAL_PRICE)===false)
                                          {

                                              $MoveToAcceptedSupplyList="INSERT INTO AcceptedSupplyList(COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                              ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL)SELECT COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                              ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL FROM ConfirmedSupplyQueList";

                                              if (mysqli_query($conn, $MoveToAcceptedSupplyList))
                                               {
                                                  //Test Stub 3
                                                  #echo "New record created successfully"."<BR>";
                                                  return true;
                                              } 
                                              else
                                               {
                                                  //Test Stub 4
                                                  echo "Error: " . $MoveToAcceptedSupplyList . "<br>" . mysqli_error($conn);
                                                  return false;
                                              }
                                              



                                          }
                            }
            }
             else if(mysqli_num_rows($result5)<=0)
              {
                echo"No Confirmed Supplies ALCOHOLIC_SUPPLIER"."<br>";
                return false;
              }
                              

  $GetHighestNonAlcoholSupplier="SELECT HOTEL_EMAIL,COMPANY_NAME,TOTAL_PRICE FROM ConfirmedSupplyQueList WHERE SUPPLIER_CATEGORY='NON_ALCOHOLIC_SUPPLIER' GROUP BY CONFIRMED_COUNT ORDER BY MAX(CONFIRMED_COUNT) DESC";
  $result6=mysqli_query($conn,$GetHighestNonAlcoholSupplier);
            if(mysqli_num_rows($result6) >0)
            {
            //IF ITEM Is PRESENT DISPLAY IN TABLE FORMAT                   
                      while($row = mysqli_fetch_assoc($result6)) 
                      {
                                           $COMPANY_NAME=$row['COMPANY_NAME'];
                                           $TOTAL_PRICE=$row['TOTAL_PRICE'];
                                           $SUPPLIER_CATEGORY=$row['SUPPLIER_CATEGORY'];
                                           $HOTEL_EMAIL=$row['HOTEL_EMAIL'];
                                           //Store return value in single array

                                           #echo"COMPANY_NAME ".$COMPANY_NAME."# "."TOTAL_PRICE ".$TOTAL_PRICE."# "."SUPPLIER_CATEGORY ".$SUPPLIER_CATEGORY."# "."HOTEL_EMAIL: ".$HOTEL_EMAIL."<BR>";
                                            //Copy Data to table AcceptedSupplyList


                        
                      }
                      //Copy Data to table AcceptedSupplyList

                        //First Check for Duplicate Entry to prevent over loading database

                        $ArraySize=CountSize();
                        //Minor Test Stub
                        # echo "ArraySize".$ArraySize."<br>";

                            for ($i=0; $i <=$ArraySize ; $i++)
                            { 
                                          # code...
                                          if(CheckDuplicateEntry($COMPANY_NAME,$HOTEL_EMAIL,$TOTAL_PRICE)===true)
                                          {
                                               #echo"Duplicate Entry"."<BR>";
                                               return false;
                                               exit();
                                          }
                                          else if(CheckDuplicateEntry($COMPANY_NAME,$HOTEL_EMAIL,$TOTAL_PRICE)===false)
                                          {

                                              $MoveToAcceptedSupplyList="INSERT INTO AcceptedSupplyList(COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                              ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL)SELECT COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                              ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL FROM ConfirmedSupplyQueList";

                                              if (mysqli_query($conn, $MoveToAcceptedSupplyList))
                                               {
                                                  //Test Stub 3
                                                  #echo "New record created successfully"."<BR>";
                                                  return true;
                                              } 
                                              else
                                               {
                                                  //Test Stub 4
                                                  echo "Error: " . $MoveToAcceptedSupplyList . "<br>" . mysqli_error($conn);
                                                  return false;
                                              }
                                              



                                          }
                            }
              exit();  
            }
            else if(mysqli_num_rows($result6) <=0)
            {
               echo"No Confirmed Supplies NON_ALCOHOLIC_SUPPLIER"."<br>";
               return false;
            }

  $GetHighestUtility="SELECT HOTEL_EMAIL,COMPANY_NAME,TOTAL_PRICE FROM ConfirmedSupplyQueList WHERE SUPPLIER_CATEGORY='UTILITY_SUPPLIER' GROUP BY CONFIRMED_COUNT ORDER BY MAX(CONFIRMED_COUNT) DESC";
  $result7=mysqli_query($conn,$GetHighestUtility);
  if(mysqli_num_rows($result7) >0)
            {
            //IF ITEM Is PRESENT DISPLAY IN TABLE FORMAT                   
                      while($row = mysqli_fetch_assoc($result7)) 
                      {
                                           $COMPANY_NAME=$row['COMPANY_NAME'];
                                           $TOTAL_PRICE=$row['TOTAL_PRICE'];
                                           $SUPPLIER_CATEGORY=$row['SUPPLIER_CATEGORY'];
                                           $HOTEL_EMAIL=$row['HOTEL_EMAIL'];
                                           //Store return value in single array

                                           #echo"COMPANY_NAME ".$COMPANY_NAME."# "."TOTAL_PRICE ".$TOTAL_PRICE."# "."SUPPLIER_CATEGORY ".$SUPPLIER_CATEGORY."# "."HOTEL_EMAIL: ".$HOTEL_EMAIL."<BR>";
                                            //Copy Data to table AcceptedSupplyList



                        
                      }
                      
                       //Copy Data to table AcceptedSupplyList

                        //First Check for Duplicate Entry to prevent over loading database

                        $ArraySize=CountSize();
                        //Minor Test Stub
                        # echo "ArraySize".$ArraySize."<br>";

                            for ($i=0; $i <=$ArraySize ; $i++)
                            { 
                                          # code...
                                          if(CheckDuplicateEntry($COMPANY_NAME,$HOTEL_EMAIL,$TOTAL_PRICE)===true)
                                          {
                                               #echo"Duplicate Entry"."<BR>";
                                               return false;
                                               exit();
                                          }
                                          else if(CheckDuplicateEntry($COMPANY_NAME,$HOTEL_EMAIL,$TOTAL_PRICE)===false)
                                          {

                                              $MoveToAcceptedSupplyList="INSERT INTO AcceptedSupplyList(COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                              ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL)SELECT COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                              ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL FROM ConfirmedSupplyQueList";

                                              if (mysqli_query($conn, $MoveToAcceptedSupplyList))
                                               {
                                                  //Test Stub 3
                                                  #echo "New record created successfully"."<BR>";
                                                  return true;
                                              } 
                                              else
                                               {
                                                  //Test Stub 4
                                                  echo "Error: " . $MoveToAcceptedSupplyList . "<br>" . mysqli_error($conn);
                                                  return false;
                                              }
                                              



                                          }
                            }
              exit();  
            }
            else//f(mysqli_num_rows($result7 <=0))
            {
               echo"No Confirmed Supplies UTILITY_SUPPLIER"."<br>";
               return false;
            }

}





/*
$GetPriceAndTotal="SELECT SUM(TOTAL_PRICE) AS TOTAL_PRICE FROM ConfirmedPurchaseList WHERE COMPANY_NAME='$COMPANY_NAME'" ;







$sql="SELECT SUM(TOTAL_PRICE) AS TOTAL_PRICE FROM ConfirmedPurchaseList WHERE COMPANY_NAME='$COMPANY_NAME'" ;

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result))
{ 
   echo "This". $total=$row['TOTAL_PRICE']."<br>";
   $sum = money_format("Tsh %i",$row['TOTAL_PRICE']);

echo $sum;
}
 



} else {
    echo "0 results";
}

mysqli_close($conn);

exit();


/*$age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");


$values = array_values($age);
$keys = array_keys($age);


foreach($values as $values) 
{

    echo($values)."  ";
    
}

foreach($keys as $keys)
    {
      echo($keys);
    }




if( CheckDuplicateEntry($CONFIRMED_COUNT,$COMPANY_NAME)===true){
	echo"There is duplilcate entry ! "."<br>";
	$prime="7";
}
else if(CheckDuplicateEntry($CONFIRMED_COUNT,$COMPANY_NAME)===false)
{
	echo "There is no duplicate entry bro chill out :)!";
}
    $agem= array();

    $agem=getSupply($SUPPLIER_CATEGORY);

    $values = array_values($agem);



		foreach($values as $values) 
		{

		    echo"This is the selected company: "." ".$values."<br>";
		    echo "SUPPLIER_CATEGORY: ".$agem["SUPPLIER_CATEGORY"]."<br>";
		    echo"COMPANY_NAME: ".$agem["COMPANY_NAME"]."<br>";
        echo"HOTEL_EMAIL: ".$age["HOTEL_EMAIL"]."<BR>";
		    exit();


		    
		}
*/

/*
The purpose of this function is to check for any duplicate entry in the data ConfirmedSupplyQueList
to prevent the same company entering supply order more than once in the same category
*/	

function CheckDuplicateEntry($COMPANY_NAME,$HOTEL_EMAIL,$TOTAL_PRICE){


define("DB_SERVER", "195.8.222.39");
define("DB_USER", "pick2get");
define("DB_PASSWORD", "3DZX5J8k");
define("DB_DATABASE", "pick2get");


$servername = "localhost";
$username = "pick2get";
$password = "3DZX5J8k";
$dbname = "pick2get_pick2get";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);



  $CheckDuplicate="SELECT * FROM AcceptedSupplyList WHERE COMPANY_NAME='$COMPANY_NAME'  AND HOTEL_EMAIL='$HOTEL_EMAIL' AND TOTAL_PRICE='$TOTAL_PRICE' AND PAYMENT_APPROVAL_STATUS=''";

  $DuplicateResult=mysqli_query($conn,$CheckDuplicate);

  
  if(mysqli_num_rows($DuplicateResult) >0)
           { 
             while ($row = mysqli_fetch_assoc($DuplicateResult)) {
               $COMPANY_NAME=$row["COMPANY_NAME"];
               $HOTEL_EMAIL=$row["HOTEL_EMAIL"];
               $TOTAL_PRICE=$row["TOTAL_PRICE"];
               $SUPPLIER_CATEGORY=$row["SUPPLIER_CATEGORY"];

               echo"DUPLICATE VALUE "."COMPANY_NAME ".$COMPANY_NAME."HOTEL_EMAIL ".$HOTEL_EMAIL." TOTAL_PRICE ".$TOTAL_PRICE." SUPPLIER_CATEGORY ".$SUPPLIER_CATEGORY."<BR>"."<br>";

             }

           	return true;

           }
            else{
            	return false;
            }
    

}
/*
The purpose of this function is to Clear the ConfirmedPurchaseList order list table after 24 hour

*/
//ConfirmedSupplyQueList
function ClearConfirmedPurchaseList(){

define("DB_SERVER", "195.8.222.39");
define("DB_USER", "pick2get");
define("DB_PASSWORD", "3DZX5J8k");
define("DB_DATABASE", "pick2get");


$servername = "localhost";
$username = "pick2get";
$password = "3DZX5J8k";
$dbname = "pick2get_pick2get";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
    /*
      Additional column added in table RecordedConfirmedPurchaseList and ConfirmedPurchaseList 
      this table is for the account type 
    */
	  $CopyToRecordedConfirmedPurchaseList="INSERT INTO RecordedConfirmedPurchaseList(COMPANY_NAME,HOTEL_EMAIL,PRODUCT_NAME,PRODUCT_IMAGE,QUANTITY,UNIT,PRICE_PER_UNIT,TOTAL_PRICE,CONFIRMATION,CONFIRM_STATUS,ACCOUNT_TYPE) SELECT  COMPANY_NAME, HOTEL_EMAIL, PRODUCT_NAME, PRODUCT_IMAGE, QUANTITY, UNIT, PRICE_PER_UNIT, TOTAL_PRICE, CONFIRMATION, CONFIRM_STATUS,ACCOUNT_TYPE FROM ConfirmedPurchaseList ";




                if ($conn->query($CopyToRecordedConfirmedPurchaseList) === TRUE) 
                {
                echo "Purging ConfirmedPurchaseList successfully"."<br>";

                    /*$ClearConfirmedPurchaseList="DELETE  FROM ConfirmedPurchaseList";
                    if ($conn->query($ClearConfirmedPurchaseList) === TRUE) 
                    {
                    
                    echo "Record Deleted"."\n";


                              

                    } else 
                    {
                    echo "Error: " . $ClearConfirmedPurchaseList . "<br>" . $conn->error;
                    }*/
                  
                  return true;
                    
                } else 
                {
                echo "Error:from ClearConfirmedPurchaseList " . $CopyToRecordedConfirmedPurchaseList . "<br>" . $conn->error;
                return false;
                }
}
/*
The purpose of this function is clear PurchaseOrderTable by copying all items from the PurchaseOrderTable
and moving the to the RecordedPurchaseOrderTable for record and report generation

*/
//function to Clear PurchaseOrderTable after 24 hours and move item to RecordedPurchaseOrderTable
function ClearPurchaseOrder(){

define("DB_SERVER", "195.8.222.39");
define("DB_USER", "pick2get");
define("DB_PASSWORD", "3DZX5J8k");
define("DB_DATABASE", "pick2get");


$servername = "localhost";
$username = "pick2get";
$password = "3DZX5J8k";
$dbname = "pick2get_pick2get";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//Clear purchase order table

$CopyToPurchaseOrderTable="INSERT INTO RecordedPurchaseOrderTable(HOTEL_EMAIL,PRODUCT_NAME,PRODUCT_IMAGE,QUANTITY,UNIT,SUPPLIER_CATEGORY,TIME_ORDER_RECEIVED) SELECT HOTEL_EMAIL,PRODUCT_NAME,PRODUCT_IMAGE,QUANTITY,UNIT,SUPPLIER_CATEGORY,TIME_ORDER_RECEIVED FROM PurchaseOrderTable ";




                if ($conn->query($CopyToPurchaseOrderTable) === TRUE) 
                {
                echo"Purging table PurchaseOrderTable successfully"."<br>";
                     /* $ClearPurchaseOrder="DELETE  FROM PurchaseOrderTable";
                    if ($conn->query($ClearPurchaseOrder) === TRUE) 
                    {
                    echo "PurChaseOrderTable Cleared Backed Up"."<br>";


                              

                    } else 
                    {
                    echo "Error deleting PurChaseOrderTable " . $InesrtTosale2 . "<br>" . $conn->error;
                    }*/
                  
                return true;
                    
                } else 
                {
                echo "Error: from ClearPurchaseOrder  " . $InesrtTosale . "<br>" . $conn->error;
                return false;
                }


          }

/*
The purpose of this function is to clear ConfirmedPurchaseList and ConfirmedSupplyQueList after 24 hours 
and move them to the RecordedConfirmedPurchaseList and RecordedConfirmedSupplyQueList
*/
//function to clear ConfirmedSupplyQueList and ConfirmedPurchaseList

function ClearQueList(){
define("DB_SERVER", "195.8.222.39");
define("DB_USER", "pick2get");
define("DB_PASSWORD", "3DZX5J8k");
define("DB_DATABASE", "pick2get");


$servername = "localhost";
$username = "pick2get";
$password = "3DZX5J8k";
$dbname = "pick2get_pick2get";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Clear purchase order table

$CopyToRecordedConfirmedSupplyQueList="INSERT INTO RecordedConfirmedSupplyQueList(COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL) SELECT COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL FROM ConfirmedSupplyQueList ";




                if ($conn->query($CopyToRecordedConfirmedSupplyQueList) === TRUE) 
                {
                 echo "Purging ConfirmedSupplyQueList  successfully"."<br>";
                    /*$ClearConfirmedSupplyQueList="DELETE * FROM ConfirmedSupplyQueList";
                    if ($conn->query($ClearConfirmedSupplyQueList) === TRUE) 
                    {
                    
                    echo "Record Deleted"."\n";


                              

                    } else 
                    {
                    echo "Error: " . $ClearPurchaseOrder . "<br>" . $conn->error;
                    }*/
                  
                return true;
                    
                } else 
                {
                echo "Error from ClearQueList " . $CopyToPurchaseOrderTable . "<br>" . $conn->error;
                return false;
                }


          


}
/*
The purpose of this function is to get column count of  AcceptedSupplyList
*/
//

function CountSize(){
define("DB_SERVER", "195.8.222.39");
define("DB_USER", "pick2get");
define("DB_PASSWORD", "3DZX5J8k");
define("DB_DATABASE", "pick2get");


$servername = "localhost";
$username = "pick2get";
$password = "3DZX5J8k";
$dbname = "pick2get_pick2get";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

  $GetItemCount="SELECT COUNT(COMPANY_NAME) FROM AcceptedSupplyList";

  $rs = mysqli_query($conn,$GetItemCount);
                 //-----------^  need to run query here

                 $num = mysqli_fetch_array($rs);
                 //here you can echo the result of query
                  $CONFIRMED_COUNT=$num[0];
                  return $CONFIRMED_COUNT;

}




?>