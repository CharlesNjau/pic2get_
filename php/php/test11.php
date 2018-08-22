<?php
class Activate{

  public $name="Charles";



  function  __get($name){
  	echo $name;
  }

  function  __set($name,$value){
  	switch($name){
        
            case "name":
                $this->name = $value="Thomas";
                break;
                default : 
                echo $name . "Not Found";
  }

}

  function d(){
    
				  	for($i=0;$i<=5;$i++){
		for($j=1;$j<=$i;$j++){
		echo "*&nbsp;";
		}
		echo "<br>";
		}
  	}


  

   function __construct(){
    
        // Generate a random id between 1 and 1000000

   	    
        //echo $name="From constructor Charles"."\n";
        //d();

       
    
    }
    
    
    
   
    
}

$obj1= new Activate();
$obj2= new Activate();

echo $obj2->name;

$obj1->d();


?>