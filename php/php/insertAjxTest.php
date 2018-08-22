<?PHP
	    include_once("conn3.php");
		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);

		// Check connection
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}
		$name=$_POST['name'];
		$age=$_POST['age'];
		$role=$_POST['role'];

		//Validate user


        if(isset($_POST['name']) && !empty($_POST['name']) AND isset($_POST['email']) && !empty($_POST['email']))
	    {
	        // Form Submited

	        //echo "plexcase fill the form fileds"; 
	    }
       

		$sql = "INSERT INTO userdetail (name, age, role)
		VALUES ('$name', '$age', '$role')";

		if (mysqli_query($conn, $sql))
		{
		    //echo "New record created successfully";
		} 
		else 
		{
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		$sql2="SELECT * FROM userdetail WHERE name='$name' AND role='$role'";
		$result=mysqli_query($conn,$sql2);
		 if(mysqli_num_rows($result)>0)
		 {  
		 	while($row = $result->fetch_assoc()) 
		 	{
      
             $val=$row['ROLE'];
             //echo $val;
             if($val=='Programmer')
             {
                 $string1='http://localhost/CCWeb/Programmer.php';
                 echo "\n".$string1;
             }
             if($val=='Telecom'){
                 $string2='http://localhost/CCWeb/Telecomm.php';
                 echo $string2;
             }
            }
		 }

		mysqli_close($conn);

?>