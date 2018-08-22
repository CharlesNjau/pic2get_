<?php

//Create database connection
    $servername = "localhost";
    $dbname="pick2get";
	$username = "root";
	$password = "";

	

// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
//if ($conn->connect_error) {
  //  die("Connection failed: " . $conn->connect_error);
//} 

//$sql = "SELECT email FROM  useregistration";
//$result = $conn->query($sql);

//if ($result->num_rows > 0) {
    // output data of each row
  //  while($row = $result->fetch_assoc()) {
    //    echo "email: ".$row["email"]. "<br>";
    //}
//} else {
  //  echo "0 results";
//}
//$conn->close();

/*

Testing select withn PDO statement


echo "<table class='table'>";
echo "<tr><th>Email</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 



include_once("conn.php");




try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT email FROM useregistration"); 
    $stmt->execute();

    
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null

*/
Class Register{

/*This is class is reposible for registering user and activating user account via email*/
	function InserData(){

	}
	function validateData(){

	}
	function SendEmailConfirmation(){

	}
}

?>