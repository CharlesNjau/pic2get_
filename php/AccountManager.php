<?php
/*
This script deals with management of all 
user accout from viewing, removing ,to updating 
*/

//Database connnection file

session_start();
include_once("conn2.php");

//Display all hotel accounts
if (isset($_GET['AllAccount'])) 
{
    //Begin displaying table content
  //select every thing from databse
  $getAllClient="SELECT * FROM useregistration WHERE REGISTERD_AS='Hotel' AND ACTIVATION_STATUS='0' ";
  $result=mysqli_query($conn,$getAllClient);

    echo'<br>'."
<span id='feedback'></span>
<h2 align='center'><B>LIST OF ALL HOTEL ACCOUNT TO BE APPROVED</B></h2>
<form id='tableform' action='php/AccountManager.php' method='POST'>
<table class='table'>
       <tbody>
       <thead>
           <td><B>ID</B></td>
           <td><B>COMPANY NAME</B></td>
           <td><B>EMAIL</B></td>
           <td><B>PASSWORD</B></td>
           <td><B>REGISTERD AS</B></td>
           <td><B>REGISTRATION DATE</B></td>
           <td><B>STATUS</B></td>
           <td><B>ACCOUNT TYPE</B></td>
           <td><B>ACTIVATE AS CASH</B></td>
           <td><B>ACTIVATE AS CREDIT</B></td>
           <td><B>DELETE</B></td>

       </thead>
";
if(mysqli_num_rows($result) > 0)
{  


    
   while($row = $result->fetch_assoc()) 
    {
        
        $ID=$row['ID'];
        $COMPANYNAME=$row['COMPANY_NAME'];
        $EMAIL=$row['EMAIL'];
        $PASSWORD=$row['PASSWORD'];
        $REGISTERD_AS=$row['REGISTERD_AS'];
        $REGISTRATION_DATE=$row['REGISTRATION_DATE'];
        $ACTIVATION_STATUS=$row['ACTIVATION_STATUS'];
        $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];

        echo"
            
            <tr>
            <td>".$ID."</td>
            <td>".$COMPANYNAME."</td>
            <td>".$EMAIL."</td>
            <td> ".$PASSWORD."</td>
            <td> ".$REGISTERD_AS."</td>
            <td>".$REGISTRATION_DATE."</td>
            <td>".$ACTIVATION_STATUS."</td>
            <td>".$ACCOUNT_TYPE."</td>
            <td>
            <input type='button'id='ActivateCredit'  COMPANY_NAME='$COMPANYNAME' ACTIVATION_STATUS='$ACTIVATION_STATUS' ACCOUNT_TYPE='$ACCOUNT_TYPE' REGISTERD_AS='$REGISTERD_AS'  class='btn btn-info' value='ACTIVATE AS CREDIT'>
            </td>
            <td>
            <input type='button'id='ActivateCash'  COMPANY_NAME='$COMPANYNAME' ACTIVATION_STATUS='$ACTIVATION_STATUS' ACCOUNT_TYPE='$ACCOUNT_TYPE' REGISTERD_AS='$REGISTERD_AS' class='btn btn-info' value='ACTIVATE AS CASH'>
            </td>
            <td>
            <input type='button'id='DeleteAccount' ' COMPANY_NAME='$COMPANYNAME' ACTIVATION_STATUS='$ACTIVATION_STATUS' ACCOUNT_TYPE='$ACCOUNT_TYPE' REGISTERD_AS='$REGISTERD_AS'  class='btn btn-info' value='DELETE ACCOUNT'>
            </td>
            </tr>
            ";
          

        
        
    }
     echo" </tbody>
                        </table>
                          </form>
                        ";
  

}
else if(mysqli_num_rows($result) == 0)
{
    
echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>NO NEW RECORD!</b>
 </div>";
}
  $conn->close();    
   exit();
}

//This part display all Supplier Accounts


if (isset($_GET['AllSupplierAccount'])) 
{
  //Begin displaying table content

  #Dummy variable
  $_GET['AllSupplierAccount']='1';

  //select every thing from databse
  $getAllClient="SELECT * FROM useregistration WHERE REGISTERD_AS='Supplier' AND ACTIVATION_STATUS='0' ";
  $result=mysqli_query($conn,$getAllClient);

    echo'<br>'."
<span id='feedback'></span>
<h2 align='center'><B>LIST OF ALL SUPPLIER ACCOUNT TO BE APPROVED</B></h2>
<form id='tableform' action='php/AccountManager.php' method='POST'>
<table class='table'>
       <tbody>
       <thead>
           <td><B>ID</B></td>
           <td><B>COMPANY NAME</B></td>
           <td><B>EMAIL</B></td>
           <td><B>PASSWORD</B></td>
           <td><B>REGISTERD AS</B></td>
           <td><B>REGISTRATION DATE</B></td>
           <td><B>STATUS</B></td>
           <td><B>ACTIVATE CASH ACCOUNT</B></td>
           <td></B>ACTIVATE CREDIT ACCOUNT</B></td>
           <td><B>ACTIVATE ACCOUNT</B></td>
           <td><B>DELETE</B></td>
           

       </thead>
";
if(mysqli_num_rows($result) > 0)
{  


    
   while($row = $result->fetch_assoc()) 
    {
        
        $ID=$row['ID'];
        $COMPANYNAME=$row['COMPANY_NAME'];
        $EMAIL=$row['EMAIL'];
        $PASSWORD=$row['PASSWORD'];
        $REGISTERD_AS=$row['REGISTERD_AS'];
        $REGISTRATION_DATE=$row['REGISTRATION_DATE'];
        $ACTIVATION_STATUS=$row['ACTIVATION_STATUS'];
        $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];

        echo"
            
            <tr>
            <td>".$ID."</td>
            <td>".$COMPANYNAME."</td>
            <td>".$EMAIL."</td>
            <td> ".$PASSWORD."</td>
            <td> ".$REGISTERD_AS."</td>
            <td>".$REGISTRATION_DATE."</td>
            <td>".$ACTIVATION_STATUS."</td>
            <td>
            <input type='button'id='ActivateCash'  COMPANY_NAME='$COMPANYNAME' ACTIVATION_STATUS='$ACTIVATION_STATUS' ACCOUNT_TYPE='$ACCOUNT_TYPE' REGISTERD_AS='$REGISTERD_AS' class='btn btn-info' value='ACTIVATE AS CASH'>
            </td>
            <td>
            <input type='button'id='DeleteAccount' ' COMPANY_NAME='$COMPANYNAME' ACTIVATION_STATUS='$ACTIVATION_STATUS' ACCOUNT_TYPE='$ACCOUNT_TYPE' REGISTERD_AS='$REGISTERD_AS'  class='btn btn-info' value='ACTIVATE AS CREDIT'>
            </td>
            <td>
            <input type='button'id='ActivateAccount'  COMPANY_NAME='$COMPANYNAME' ACTIVATION_STATUS='$ACTIVATION_STATUS' ACCOUNT_TYPE='$ACCOUNT_TYPE' REGISTERD_AS='$REGISTERD_AS' class='btn btn-info' value='ACTIVATE ACCOUNT'>
            </td>
            <td>
            <input type='button'id='DeleteAccount' ' COMPANY_NAME='$COMPANYNAME' ACTIVATION_STATUS='$ACTIVATION_STATUS' ACCOUNT_TYPE='$ACCOUNT_TYPE' REGISTERD_AS='$REGISTERD_AS'  class='btn btn-info' value='DELETE ACCOUNT'>
            </td>
            </tr>
            ";
          

        
        
    }
     echo" </tbody>
                        </table>
                          </form>
                        ";
  

}
else if(mysqli_num_rows($result) == 0)
{
    
echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>NO NEW RECORD!</b>
 </div>";
}
  $conn->close();    
   exit();
}






//This is the part displays all account

//Display all hotel accounts
if (isset($_POST['All'])) 
{
    //Begin displaying table content
  //select every thing from databse
  $getAllClient="SELECT * FROM useregistration  ";
  $result=mysqli_query($conn,$getAllClient);

    echo'<br>'."
<span id='feedback'></span>
<h2 align='center'><B>LIST OF ALL ACCOUNTS</B></h2>
<form id='tableform' action='php/AccountManager.php' method='POST'>
<table class='table'>
       <tbody>
       <thead>
           <td><B>ID</B></td>
           <td><B>COMPANY NAME</B></td>
           <td><B>EMAIL</B></td>
           <td><B>PASSWORD</B></td>
           <td><B>REGISTERD AS</B></td>
           <td><B>REGISTRATION DATE</B></td>
           <td><B>STATUS</B></td>
           <td><B>ACCOUNT TYPE</B></td>
           <td><B>DELETE</B></td>

       </thead>
";
if(mysqli_num_rows($result) > 0)
{  


    
   while($row = $result->fetch_assoc()) 
    {
        
        $ID=$row['ID'];
        $COMPANYNAME=$row['COMPANY_NAME'];
        $EMAIL=$row['EMAIL'];
        $PASSWORD=$row['PASSWORD'];
        $REGISTERD_AS=$row['REGISTERD_AS'];
        $REGISTRATION_DATE=$row['REGISTRATION_DATE'];
        $ACTIVATION_STATUS=$row['ACTIVATION_STATUS'];
        $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];

        echo"
            
            <tr>
            <td>".$ID."</td>
            <td>".$COMPANYNAME."</td>
            <td>".$EMAIL."</td>
            <td> ".$PASSWORD."</td>
            <td> ".$REGISTERD_AS."</td>
            <td>".$REGISTRATION_DATE."</td>
            <td>".$ACTIVATION_STATUS."</td>
            <td>".$ACCOUNT_TYPE."</td>
            <td>
            <input type='button'id='DeleteAccount' ' COMPANY_NAME='$COMPANYNAME' ACTIVATION_STATUS='$ACTIVATION_STATUS' ACCOUNT_TYPE='$ACCOUNT_TYPE' REGISTERD_AS='$REGISTERD_AS'  class='btn btn-info' value='DELETE ACCOUNT'>
            </td>
            </tr>
            ";
          

        
        
    }
     echo" </tbody>
                        </table>
                          </form>
                        ";
  

}
else 
{
    
echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error Fetching Data</b>
 </div>";
}
  $conn->close();    
   exit();
}

//This is the part that deals with showing all log records
if (isset($_POST['LogRec'])) 
{
    //Begin displaying table content
  //select every thing from databse
  $getAllClient="SELECT * FROM USER_LOG_RECORDS";
  $result=mysqli_query($conn,$getAllClient);

    echo'<br>'."
<span id='feedback'></span>
<h2 align='center'><B>LIST OF ALL USER LOGS</B></h2>
<form id='tableform' action='php/AccountManager.php' method='POST'>
<table class='table'>
       <tbody>
       <thead>
           <td><B>ID</B></td>
           <td><B>EMAIL</B></td>
           <td><B>PASSWORD</B></td>
           <td><B>SESSION_ID</B></td>
           <td><B>LOGIN_TIME</B></td>
           <td><B>LOGOUT_TIME</B></td>
           <td><B>USER_ROLE</B></td>
           <td><B>USER_IP</B></td>
           <td><B>DEVICE</B></td>
           <td><B>ACTION</B></td>
           

       </thead>
";
if(mysqli_num_rows($result) > 0)
{  


    
   while($row = $result->fetch_assoc()) 
    {
        
        $ID=$row['ID'];
        $EMAIL=$row['EMAIL'];
        $PASSWORD=$row['PASSWORD'];
        $SESSION_ID=$row['SESSION_ID'];
        $LOGIN_TIME=$row['LOGIN_TIME'];
        $LOGOUT_TIME=$row['LOGOUT_TIME'];
        $USER_ROLE=$row['USER_ROLE'];
        $USER_IP=$row['USER_IP'];
        $DEVICE=$row['DEVICE'];

        echo"
            
            <tr>
            <td>".$ID."</td>
            <td>".$EMAIL."</td>
            <td>".$PASSWORD."</td>
            <td>".$SESSION_ID."</td>
            <td>".$LOGIN_TIME."</td>
            <td>".$LOGOUT_TIME."</td>
            <td>".$USER_ROLE."</td>
            <td>".$USER_IP."</td>
            <td>".$DEVICE."</td>
            <td>
            <input type='button'id='ViewLog' ' EMAIL='$EMAIL' SESSION_ID='$SESSION_ID' USER_ROLE='$USER_ROLE'  class='btn btn-info' value='VIEW LOG RECORD'>
            </td>
            </tr>
            ";
          

        
        
    }
     echo" </tbody>
                        </table>
                        </form>
                        ";
  

}
else 
{
    
echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error Fetching Data</b>
 </div>";
}
  $conn->close();    
   exit();
}

//This is part checks the log record per individual account
if (isset($_POST['ViewLog'])) 
{
    
  
  
  $EMAIL=$_POST['EMAIL'];
  $USER_ROLE=$_POST['USER_ROLE'];
  $SESSION_ID=$_POST['SESSION_ID'];
  echo "This is the user: ".$EMAIL."\n"."logged as :".$USER_ROLE."\n"."with session id: $SESSION_ID";
  

  

  //Begin displaying table content
  //select every thing from databse
  $getAllClient="SELECT * FROM USER_LOG_RECORDS  WHERE EMAIL='$EMAIL' AND USER_ROLE='$USER_ROLE' AND SESSION_ID='$SESSION_ID'";
  $result=mysqli_query($conn,$getAllClient);

    echo'<br>'."
<h2 align='center'><B>LOG RECORD FOR USER $EMAIL REGISTERD_AS AS $USER_ROLE</B></h2>
<table class='table'>
       <tbody>
       <thead>
           <td><B>ID</B></td>
           <td><B>EMAIL</B></td>
           <td><B>PASSWORD</B></td>
           <td><B>SESSION_ID</B></td>
           <td><B>LOGIN_TIME</B></td>
           <td><B>LOGOUT_TIME</B></td>
           <td><B>USER_ROLE</B></td>
           <td><B>USER_IP</B></td>
           <td><B>DEVICE</B></td>
           

       </thead>
";
if(mysqli_num_rows($result) > 0)
{  


    
   while($row = $result->fetch_assoc()) 
    {
        
        $ID=$row['ID'];
        $EMAIL=$row['EMAIL'];
        $PASSWORD=$row['PASSWORD'];
        $SESSION_ID=$row['SESSION_ID'];
        $LOGIN_TIME=$row['LOGIN_TIME'];
        $LOGOUT_TIME=$row['LOGOUT_TIME'];
        $USER_ROLE=$row['USER_ROLE'];
        $USER_IP=$row['USER_IP'];
        $DEVICE=$row['DEVICE'];

        echo"
            
            <tr>
            <td>".$ID."</td>
            <td>".$EMAIL."</td>
            <td>".$PASSWORD."</td>
            <td>".$SESSION_ID."</td>
            <td>".$LOGIN_TIME."</td>
            <td>".$LOGOUT_TIME."</td>
            <td>".$USER_ROLE."</td>
            <td>".$USER_IP."</td>
            <td>".$DEVICE."</td>
            
            </tr>
            ";
          

        
        
    }
     echo" </tbody>
                        </table>
                        
                        ";
  

}
else 
{
    
echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error Fetching Data</b>
 </div>";
}
  $conn->close();    
   exit();
}


//Diplay only credit account
if (isset($_POST['CreditOnly'])) 
{
    //Begin displaying table content
  //select every thing from databse
  $getAllClient="SELECT * FROM useregistration WHERE ACCOUNT_TYPE='CREDIT' ";
  $result=mysqli_query($conn,$getAllClient);

    echo'<br>'."
<h2 align='center'><B>LIST OF ALL CREDIT ACCOUNTS</B></h2>
<form id='tableform' action='php/AccountManager.php' method='POST'>
<table class='table'>
       <tbody>
       <thead>
           <td><B>ID</B></td>
           <td><B>COMPANY NAME</B></td>
           <td><B>EMAIL</B></td>
           <td><B>PASSWORD</B></td>
           <td><B>REGISTERD AS</B></td>
           <td><B>REGISTRATION DATE</B></td>
           <td><B>STATUS</B></td>
           <td><B>ACCOUNT TYPE</B></td>
           <td><B>DELETE</B></td>

       </thead>
";
if(mysqli_num_rows($result) > 0)
{  


    
   while($row = $result->fetch_assoc()) 
    {
        
        $ID=$row['ID'];
        $COMPANYNAME=$row['COMPANY_NAME'];
        $EMAIL=$row['EMAIL'];
        $PASSWORD=$row['PASSWORD'];
        $REGISTERD_AS=$row['REGISTERD_AS'];
        $REGISTRATION_DATE=$row['REGISTRATION_DATE'];
        $ACTIVATION_STATUS=$row['ACTIVATION_STATUS'];
        $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];

        echo"
            
            <tr>
            <td>".$ID."</td>
            <td>".$COMPANYNAME."</td>
            <td>".$EMAIL."</td>
            <td> ".$PASSWORD."</td>
            <td> ".$REGISTERD_AS."</td>
            <td>".$REGISTRATION_DATE."</td>
            <td>".$ACTIVATION_STATUS."</td>
            <td>".$ACCOUNT_TYPE."</td>
            <td>
            <input type='button'id='DeleteAccount' ' COMPANY_NAME='$COMPANYNAME' ACTIVATION_STATUS='$ACTIVATION_STATUS' ACCOUNT_TYPE='$ACCOUNT_TYPE' REGISTERD_AS='$REGISTERD_AS'  class='btn btn-info' value='DELETE ACCOUNT'>
            </td>
            </tr>
            ";
          

        
        
    }
     echo" </tbody>
                        </table>
                          </form>
                        ";
  

}
else 
{
    
echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error Fetching Data</b>
 </div>";
}
  $conn->close();    
   exit();
}

//Display only cash account
if (isset($_POST['CashOnly'])) 
{
    //Begin displaying table content
  //select every thing from databse
  $getAllClient="SELECT * FROM useregistration WHERE ACCOUNT_TYPE='CASH'  ";
  $result=mysqli_query($conn,$getAllClient);

    echo'<br>'."
<h2 align='center'><B>LIST OF ALL CASH ACCOUNTS</B></h2>
<form id='tableform' action='php/AccountManager.php' method='POST'>
<table class='table'>
       <tbody>
       <thead>
           <td><B>ID</B></td>
           <td><B>COMPANY NAME</B></td>
           <td><B>EMAIL</B></td>
           <td><B>PASSWORD</B></td>
           <td><B>REGISTERD AS</B></td>
           <td><B>REGISTRATION DATE</B></td>
           <td><B>STATUS</B></td>
           <td><B>ACCOUNT TYPE</B></td>
           <td><B>DELETE</B></td>

       </thead>
";
if(mysqli_num_rows($result) > 0)
{  


    
   while($row = $result->fetch_assoc()) 
    {
        
        $ID=$row['ID'];
        $COMPANYNAME=$row['COMPANY_NAME'];
        $EMAIL=$row['EMAIL'];
        $PASSWORD=$row['PASSWORD'];
        $REGISTERD_AS=$row['REGISTERD_AS'];
        $REGISTRATION_DATE=$row['REGISTRATION_DATE'];
        $ACTIVATION_STATUS=$row['ACTIVATION_STATUS'];
        $ACCOUNT_TYPE=$row['ACCOUNT_TYPE'];

        echo"
            
            <tr>
            <td>".$ID."</td>
            <td>".$COMPANYNAME."</td>
            <td>".$EMAIL."</td>
            <td> ".$PASSWORD."</td>
            <td> ".$REGISTERD_AS."</td>
            <td>".$REGISTRATION_DATE."</td>
            <td>".$ACTIVATION_STATUS."</td>
            <td>".$ACCOUNT_TYPE."</td>
            <td>
            <input type='button'id='DeleteAccount' ' COMPANY_NAME='$COMPANYNAME' ACTIVATION_STATUS='$ACTIVATION_STATUS' ACCOUNT_TYPE='$ACCOUNT_TYPE' REGISTERD_AS='$REGISTERD_AS'  class='btn btn-info' value='DELETE ACCOUNT'>
            </td>
            </tr>
            ";
          

        
        
    }
     echo" </tbody>
                        </table>
                          </form>
                        ";
  

}
else 
{
    
echo"<div class='alert alert-warning'>
<a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Error Fetching Data</b>
 </div>";
}
  $conn->close();    
   exit();
}



?>