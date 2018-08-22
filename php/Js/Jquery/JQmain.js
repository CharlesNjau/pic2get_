$(document).ready(function() {
	//begin all function here
    //Ajax call for for the SignUp form 
    $("#SgnUpbtn1").click(function(event){
       /* Get from elements values */
       
       /*Make Ajax post Call*/

      //$.post($("#Sform").attr("action"),data,function(info){$("#result").html(info);});
      event.preventDefault();
      var data=$("#Sform").serialize()

	  $.ajax({
		        url: "php/SignUp.php",
		        type: "post",
		        data: data,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           console.log("Data Entered successfully! :)"+" "+data);
               var check=data;

               if(check==="1"){
               var Errormsg="<div class='alert alert-warning'><a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Please fill in the Fields</b></div>";
               $("#result").html(Errormsg);
               }
               else if(check==="2")
               {
                var Errormsg="<div class='alert alert-warning'><a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Enter a valid name</b></div>";
               $("#result").html(Errormsg);
               }
               else if(check==="3")
               {
                var Errormsg="<div class='alert alert-warning'><a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b></b>Enter a valid email</div>";
               $("#result").html(Errormsg);
               }
               else if(check==="4")
               {
                var Errormsg="<div class='alert alert-warning'><a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b></b>Please Choose Type of registration</div>";
               $("#result").html(Errormsg);
               }   
               else
               {
                 
               $("#result").html(check);
               }
		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });
	clearInput();
    });
   //Reset Button of SignUp Form
    $("#SgnUpbtn2").click(function(event){
        //
    	location.reload();
    });

    //Reset Button of Login Form
    $("#Reset").click(function(event){
        //
    	location.reload();
    });

     $("#Lbtn1").click(function(event){
       /* Get from elements values */
       
       /*Make Ajax post Call*/

      //$.post($("#Sform").attr("action"),data,function(info){$("#result").html(info);});
      event.preventDefault();
      var formData=$("#Lform").serialize();

	  $.ajax({
		        url: "php/log.php",
		        type: "post",
		        data: formData,
		        success: function (data) {
                 
                                  //console.log(data);
                                   var url=data;
                                   var logged='3';
                                   //window.location.href =url;
          						   console.log("value : "+url);
                         
                          

                         if(url==1){
                          $("#result2").html("Enter Fill in the Fields");
                         }if(url==2){
                          $("#result2").html("Please enter a valid email");
                         }
                         if(url==3){
                           $("#result2").html("Acount is already Used");

                         }
                         if(url=='User not registered')
                         {
                          $("#result2").html(url);

                         }
                         window.location.href=url;
           // you will get response from your php page (what you echo or print) 
          // $("#result2").html(data);
		           
        			 },
        						   
                    
		        

		      
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });
	  clearInput2();
	
    });
//Logout Admin     
$('#LogOut1').click(function(event){
    event.preventDefault();
    //console.log("Click Working");
	LogMeout();
});
//Logout Client 
$('#LogOut2').click(function(event){
    event.preventDefault();
	LogMeout();
});
//Logout Supplier 
$('#LogOut3').click(function(event){
    event.preventDefault();
	LogMeout();
});

//logout

function LogMeout(){
//Make an ajax call to logout.php

$.ajax(
{
url:"php/logout.php",
data:"data",
type:"GET",
success:function(response){
	var url2=response;
	alert("YOUR ARE ABOUT TO LOGOUT ");
	console.log(url2);
	window.location.href="http://pick2get.com";
},
error:function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }
});

}




 	function clearInput2(){

          $("#Lform:input").each(function(){

           $(this).val('');

          });

		 }
 	function clearInput(){

          $("#Sform:input").each(function(){

           $(this).val('');

          });

		 }
    
   
    }); 
