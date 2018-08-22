<?php
/*
Offline PHP class for activating email

*/
class ActivateUser{
//First Check user if present in the database
	function CheckUser($email){
	
   //Create database connection
    $servername = "localhost";
    $dbname="pick2get";
	$username = "root";
	$password = "";

	

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$email="Hyatt@hq.com";

echo "This is email we are looking for: ".$email;

$sql = "SELECT email FROM  useregistration WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["email"].  "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

	}



function __construct(){
    
        // Generate a random id between 1 and 1000000

   	    
        //echo $name="From constructor Charles"."\n";
        //d();

       
    
    }
    



}


$Emailobj= new ActivateUser();

$Emailobj->CheckUser($email);


?>