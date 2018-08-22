$(document).ready(function() {
	//begin all function here
    //Ajax call for for the SignUp form 
    $("#SgnUpbtn1").click(function(event){
       /* Get from elements values */
       
       /*Make Ajax post Call*/

      //$.post($("#Sform").attr("action"),data,function(info){$("#result").html(info);});
      event.preventDefault();
      var data=$("#Sform").serialize();

	  $.ajax({
		        url: "php/SignUp.php",
		        type: "post",
		        data: data,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           $("#result").html(data);
		           console.log("Data Entered successfully! :)"+data);   

		          

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
      event.preventDefault();
      var formData=$("#Lform").serialize();
	  $.ajax({
		        url: "php/log.php",
		        type: "post",
		        data: formData,
		        success: function (data) {
                 
                                  console.log(data);
                                   var url=data;
          						   console.log(url);
        						   window.location.href =url;
		           // you will get response from your php page (what you echo or print) 
		           //$("#logfeedback").html("");
		           
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
	window.location.href="http://localhost:/pick2get/#";
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
