<?php
include_once("conn3.php");
$sql='select * from userdetail';
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
echo"\n";
echo"S/NO"."   |   "."NAME"."   |  "."AGE"."  |  "."ROLE"."  |  "."TIME REGISTERED"."</br>";
 while($row = $result->fetch_assoc()) {
        
        echo $row['S/NO']." ###".$row['NAME']." ###   ".$row['AGE']." ###   ".$row['ROLE']." ###   ".$row['TIME REGISTERED']."</br>";
          
    }

}
else {
    echo "0 results";
}
$conn->close();
?>