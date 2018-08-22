#!/usr/local/bin/php.cli
<?php

echo"realx";
exit();
//GetSupplyOrder();



/*function GetSupplyOrder(){

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

                                           echo"COMPANY_NAME ".$COMPANY_NAME."# "."TOTAL_PRICE ".$TOTAL_PRICE."# "."SUPPLIER_CATEGORY ".$SUPPLIER_CATEGORY."# "."HOTEL_EMAIL: ".$HOTEL_EMAIL."<BR>";
                                          
                                          

                                           

                        
                      }

                      //Copy Data to table AcceptedSupplyList
                                          $MoveToAcceptedSupplyList="INSERT INTO AcceptedSupplyList(COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                          ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL)SELECT COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                          ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL FROM ConfirmedSupplyQueList";

                                          if (mysqli_query($conn, $MoveToAcceptedSupplyList))
                                           {
                                              echo "New record created successfully"."<BR>";
                                          } else
                                           {
                                              echo "Error: " . $MoveToAcceptedSupplyList . "<br>" . mysqli_error($conn);
                                          }
                                          return true;
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

                                           echo"COMPANY_NAME ".$COMPANY_NAME."# "."TOTAL_PRICE ".$TOTAL_PRICE."# "."SUPPLIER_CATEGORY ".$SUPPLIER_CATEGORY."# "."HOTEL_EMAIL: ".$HOTEL_EMAIL."<BR>";
                                         //Copy Data to table AcceptedSupplyList



                          
                        }
                       //Copy Data to table AcceptedSupplyList
                                          $MoveToAcceptedSupplyList="INSERT INTO AcceptedSupplyList(COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                          ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL)SELECT COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                          ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL FROM ConfirmedSupplyQueList";

                                          if (mysqli_query($conn, $MoveToAcceptedSupplyList))
                                           {
                                              echo "New record created successfully"."<BR>";
                                          } else
                                           {
                                              echo "Error: " . $MoveToAcceptedSupplyList . "<br>" . mysqli_error($conn);
                                          }
                        return true;
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

                                           echo"COMPANY_NAME ".$COMPANY_NAME."# "."TOTAL_PRICE ".$TOTAL_PRICE."# "."SUPPLIER_CATEGORY ".$SUPPLIER_CATEGORY."# "."HOTEL_EMAIL: ".$HOTEL_EMAIL."<BR>";
                                            //Copy Data to table AcceptedSupplyList


                        
                      }
                      //Copy Data to table AcceptedSupplyList
                                          $MoveToAcceptedSupplyList="INSERT INTO AcceptedSupplyList(COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                          ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL)SELECT COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                          ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL FROM ConfirmedSupplyQueList";

                                          if (mysqli_query($conn, $MoveToAcceptedSupplyList))
                                           {
                                              echo "New record created successfully"."<BR>";
                                          } else
                                           {
                                              echo "Error: " . $MoveToAcceptedSupplyList . "<br>" . mysqli_error($conn);
                                          }
                                          return true;
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

                                           echo"COMPANY_NAME ".$COMPANY_NAME."# "."TOTAL_PRICE ".$TOTAL_PRICE."# "."SUPPLIER_CATEGORY ".$SUPPLIER_CATEGORY."# "."HOTEL_EMAIL: ".$HOTEL_EMAIL."<BR>";
                                            //Copy Data to table AcceptedSupplyList

                                           


                        
                      }
                      //Copy Data to table AcceptedSupplyList
                                          $MoveToAcceptedSupplyList="INSERT INTO AcceptedSupplyList(COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                          ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL)SELECT COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                          ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL FROM ConfirmedSupplyQueList";

                                          if (mysqli_query($conn, $MoveToAcceptedSupplyList))
                                           {
                                              echo "New record created successfully"."<BR>";
                                          } else
                                           {
                                              echo "Error: " . $MoveToAcceptedSupplyList . "<br>" . mysqli_error($conn);
                                          }
                                          return true;
                                          exit();
               
            }
           else //(mysqli_num_rows($result4<=0))
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

                                           echo"COMPANY_NAME ".$COMPANY_NAME."# "."TOTAL_PRICE ".$TOTAL_PRICE."# "."SUPPLIER_CATEGORY ".$SUPPLIER_CATEGORY."# "."HOTEL_EMAIL: ".$HOTEL_EMAIL."<BR>";
                                           //Copy Data to table AcceptedSupplyList




                        
                      }
                      //Copy Data to table AcceptedSupplyList
                                          $MoveToAcceptedSupplyList="INSERT INTO AcceptedSupplyList(COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                          ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL)SELECT COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                          ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL FROM ConfirmedSupplyQueList";

                                          if (mysqli_query($conn, $MoveToAcceptedSupplyList))
                                           {
                                              echo "New record created successfully"."<BR>";
                                          } else
                                           {
                                              echo "Error: " . $MoveToAcceptedSupplyList . "<br>" . mysqli_error($conn);
                                          }
                                          return true;
              exit();  
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

                                           echo"COMPANY_NAME ".$COMPANY_NAME."# "."TOTAL_PRICE ".$TOTAL_PRICE."# "."SUPPLIER_CATEGORY ".$SUPPLIER_CATEGORY."# "."HOTEL_EMAIL: ".$HOTEL_EMAIL."<BR>";
                                            //Copy Data to table AcceptedSupplyList


                        
                      }
                      //Copy Data to table AcceptedSupplyList
                                          $MoveToAcceptedSupplyList="INSERT INTO AcceptedSupplyList(COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                          ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL)SELECT COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                          ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL FROM ConfirmedSupplyQueList";

                                          if (mysqli_query($conn, $MoveToAcceptedSupplyList))
                                           {
                                              echo "New record created successfully"."<BR>";
                                          } else
                                           {
                                              echo "Error: " . $MoveToAcceptedSupplyList . "<br>" . mysqli_error($conn);
                                          }
                                          return true;
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

                                           echo"COMPANY_NAME ".$COMPANY_NAME."# "."TOTAL_PRICE ".$TOTAL_PRICE."# "."SUPPLIER_CATEGORY ".$SUPPLIER_CATEGORY."# "."HOTEL_EMAIL: ".$HOTEL_EMAIL."<BR>";
                                            //Copy Data to table AcceptedSupplyList



                        
                      }
                      //Copy Data to table AcceptedSupplyList
                                          $MoveToAcceptedSupplyList="INSERT INTO AcceptedSupplyList(COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                          ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL)SELECT COMPANY_NAME,TOTAL_PRICE,CONFIRMED_COUNT,
                                          ACTUAL_COUNT,SUPPLIER_CATEGORY,HOTEL_EMAIL FROM ConfirmedSupplyQueList";

                                          if (mysqli_query($conn, $MoveToAcceptedSupplyList))
                                           {
                                              echo "New record created successfully"."<BR>";
                                          } else
                                           {
                                              echo "Error: " . $MoveToAcceptedSupplyList . "<br>" . mysqli_error($conn);
                                          }
                                          return true;
              exit();  
            }
            else//f(mysqli_num_rows($result7 <=0))
            {
               echo"No Confirmed Supplies UTILITY_SUPPLIER"."<br>";
               return false;
            }

}
function BackUp(){
  }
//mysqli_close($conn);*/
?>