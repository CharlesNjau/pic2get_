//JQuery JavaScript Document
//This is the javascript file for the admin Page

$(document).ready(function() {
//Top Drop down menu button 
var name="";
/*
This is part that deals with notification
*/
//Tranaction History
$("#ChckItemsDeliverd").click(function(event){
	console.log('Check items deliverd');
	//Perform ajax call to invetory.php to edit type 
	$.ajax({
	   url:"php/Notification.php",
	   method:"GET",
	   data:{ChckItemsDeliverd:1},
	   success:function(data){$("#DisplayContent").html(data);console.log(data)},
	   error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }


	});
	
	});
/*
 Sub function associated with the delivery of Item
*/
//Super global variable for delivary
	 var COMPANY_NAME;
	 var PRODUCT_NAME;
	 var QUANTITY='$QUANTITY'; 
	 var UNIT='$UNIT'; 
	 var PRICE_PER_UNIT;
	 var PAYMENT_MODE; 
	 var TOTAL_PRICE;
	 var FROM_CLIENT;
	 var REMARKS;

//Delegate Text Area REmark
$(document).delegate("#Remark","blur",function(event){

   event.preventDefault();

   
   if(REMARKS==='')
   {
     REMARKS='Product has no remarks and assumed accepted';
   }
   else
   {
   	REMARKS=$(this).val();
   }	
	


	console.log("ITEM DELIVERY REMARKS: "+REMARKS+"\n");
	//Make Ajax call
	 
	
     
 
});
//Confirm delivery

$(document).delegate("#ConfirmItemDeliverd","click",function(event){
	
    
    event.preventDefault();
	var COMPANY_NAME=$(this).attr('COMPANY_NAME');
	var PRODUCT_NAME=$(this).attr('PRODUCT_NAME');
	var QUANTITY=$(this).attr('QUANTITY');
	var UNIT=$(this).attr('UNIT');
	var PRICE_PER_UNIT=$(this).attr('PRICE_PER_UNIT');
	var PAYMENT_MODE=$(this).attr('PAYMENT_MODE');
	var TOTAL_PRICE=$(this).attr('TOTAL_PRICE');
	var FROM_CLIENT=$(this).attr('FROM_CLIENT');
	var DELIVERY_STATUS=$(this).attr('DELIVERY_STATUS');
	    REMARKS;
	


	console.log("***data stub test for deliverd items***"+"\n"+
		        "COMPANY_NAME: "+COMPANY_NAME+"\n"+
		        "PRODUCT_NAME: "+PRODUCT_NAME+"\n"+
		        "QUANTITY: "+QUANTITY+"\n"+
		        "UNIT: "+UNIT+"\n"+
		        "PRICE_PER_UNIT: "+PRICE_PER_UNIT+"\n"+
		        "PAYMENT_MODE: "+PAYMENT_MODE+"\n"+
		        "TOTAL_PRICE: "+TOTAL_PRICE+"\n"+
		        "FROM_CLIENT: "+FROM_CLIENT+"\n"+
		        "DELIVERY_STATUS: "+DELIVERY_STATUS+"\n"+
		        "REMARKS: "+REMARKS+"\n"
		    
		        );
	//Make Ajax call
	 
	 
		$.ajax({
			url:"php/DeliveryEngine.php",
			method:"POST",
			data:{ConfirmItemDeliverd:1},
			success:function(data){
				$("#formfeedback").html(data);  
				
			},
			error:function(jqXHR, textStatus, errorThrown)
			{
				$("#formfeedback").html(data); 
				console.log(textStatus, errorThrown);
			}
		});

     
 
});
//Recejct delivery
$(document).delegate("#RejectItemDeliverd","click",function(event){
	
    
    event.preventDefault();
    var DELIVERY_STATUS='REJECTED';
	var COMPANY_NAME=$(this).attr('COMPANY_NAME');
	var PRODUCT_NAME=$(this).attr('PRODUCT_NAME');
	var QUANTITY=$(this).attr('QUANTITY');
	var UNIT=$(this).attr('UNIT');
	var PRICE_PER_UNIT=$(this).attr('PRICE_PER_UNIT');
	var PAYMENT_MODE=$(this).attr('PAYMENT_MODE');
	var TOTAL_PRICE=$(this).attr('TOTAL_PRICE');
	var FROM_CLIENT=$(this).attr('FROM_CLIENT');
	var DELIVERY_STATUS=$(this).attr('DELIVERY_STATUS');

	 
	


	console.log("***data stub test for rejected items***"+"\n"+
		        "COMPANY_NAME: "+COMPANY_NAME+"\n"+
		        "PRODUCT_NAME: "+PRODUCT_NAME+"\n"+
		        "QUANTITY: "+QUANTITY+"\n"+
		        "UNIT: "+UNIT+"\n"+
		        "PRICE_PER_UNIT: "+PRICE_PER_UNIT+"\n"+
		        "PAYMENT_MODE: "+PAYMENT_MODE+"\n"+
		        "TOTAL_PRICE: "+TOTAL_PRICE+"\n"+
		        "FROM_CLIENT: "+FROM_CLIENT+"\n"+
		        "DELIVERY_STATUS: "+DELIVERY_STATUS+"\n"+
		        "REMARKS: "+REMARKS+"\n"
		    
		        );
	//Make Ajax call
	 
	
		$.ajax({
			url:"php/DeliveryEngine.php.php",
			method:"POST",
			data:{RejectItemDeliverd:1,COMPANY_NAME:COMPANY_NAME,REGISTERD_AS:REGISTERD_AS},
			success:function(data){
				$("#formfeedback").html(data);  
				
			},
			error:function(jqXHR, textStatus, errorThrown)
			{
				$("#formfeedback").html(data); 
				console.log(textStatus, errorThrown);
			}
		});

     
 
});





//InboundPayments
$("#InbndPymnt").click(function(event){
	console.log('InbndPymnt');
	//Perform ajax call to invetory.php to edit type
	$.ajax({
	   url:"php/Notification.php",
	   method:"GET",
	   data:{InbndPymnt:1},
	   success:function(data){$("#DisplayContent").html(data);console.log(data)},
	   error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }


	});
	
	});
//OutboundPayments
$("#OutbndPymnt").click(function(event){
	console.log("OutbndPymnt");
	//Perform ajax call to invetory.php to edit type
	$.ajax({
	   url:"php/Notification.php",
	   method:"GET",
	   data:{OutbndPymnt:1},
	   success:function(data){$("#DisplayContent").html(data);console.log(data)},
	   error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }


	});
	
	});
//PendingPayment
$("#PndPymnt").click(function(event){
	console.log("PendingPayment");
	//Perform ajax call to invetory.php to edit type
	$.ajax({
	   url:"php/Notification.php",
	   method:"GET",
	   data:{PndPymnt:1},
	   success:function(data){$("#DisplayContent").html(data);console.log(data)},
	   error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }


	});
	
	});
	
//Canceld Payments
$("#CncldPymnt").click(function(event){
	console.log("CncldPymnt");
	//Perform ajax call to invetory.php to edit type
	$.ajax({
	   url:"php/Notification.php",
	   method:"GET",
	   data:{CncldPymnt:1},
	   success:function(data){$("#DisplayContent").html(data);console.log(data)},
	   error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }


	});
	});
/*This is a sub part associated with the above method*/





/*
This is section will deal with all matters regarding user accounts

*/

//Checks all hotel accounts 
$("#lnk1").click(function(event){

//Perfomr ajax call to display all accounts
	//Perform ajax call to invetory.php to edit type
	$.ajax({
	   url:"php/AccountManager.php",
	   method:"GET",
	   data:{AllAccount:1},
	   success:function(data){$("#DisplayContent").html(data);console.log(data)},
	   error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }


	});
});

//This part checks all supplier accounts
$("#lnk6").click(function(event){

//Perfomr ajax call to display all accounts
	//Perform ajax call to invetory.php to edit type
	$.ajax({
	   url:"php/AccountManager.php",
	   method:"GET",
	   data:{AllSupplierAccount:1},
	   success:function(data){$("#DisplayContent").html(data);console.log(data)},
	   error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }


	});
});

//












/*This is a sub part associated with checking all account*/

//This is part actvate supplier accounts
$(document).delegate("#ActivateAccount","click",function(event){
    
    event.preventDefault();
	var COMPANY_NAME=$(this).attr('COMPANY_NAME');
	var REGISTERD_AS=$(this).attr('REGISTERD_AS');
	ActivateSupplierAccount(COMPANY_NAME,REGISTERD_AS);


	console.log("COMPANY_NAME: "+COMPANY_NAME+"\n"+"REGISTERD_AS: "+REGISTERD_AS);
	//Make Ajax call
	 
	 function ActivateSupplierAccount(COMPANY_NAME,REGISTERD_AS){
		$.ajax({
			url:"php/EditAccount.php",
			method:"POST",
			data:{ActivateSupplier:1,COMPANY_NAME:COMPANY_NAME,REGISTERD_AS:REGISTERD_AS},
			success:function(data){
				$("#Result").html(data);  
				
			},
			error:function(jqXHR, textStatus, errorThrown)
			{
				$("#Result").html(data); 
				console.log(textStatus, errorThrown);
			}
		});
}
     
 
});




//This is part actvate credit accounts
$(document).delegate("#ActivateCredit","click",function(event){

    event.preventDefault();
	var COMPANY_NAME=$(this).attr('COMPANY_NAME');
	var REGISTERD_AS=$(this).attr('REGISTERD_AS');


	console.log("COMPANY_NAME: "+COMPANY_NAME+"\n"+"REGISTERD_AS: "+REGISTERD_AS);
	//Make Ajax call
	 ActivateCreditAccount(COMPANY_NAME,REGISTERD_AS);
     
 
});

//This is part actvate credit accounts
$(document).delegate("#ActivateCash","click",function(event){

    event.preventDefault();
	var COMPANY_NAME=$(this).attr('COMPANY_NAME');
	var REGISTERD_AS=$(this).attr('REGISTERD_AS');

	console.log("COMPANY_NAME: "+COMPANY_NAME+"\n"+"REGISTERD_AS: "+REGISTERD_AS);
	//Make Ajax call
	 ActivateCashAccount(COMPANY_NAME,REGISTERD_AS);
	 

});

//This is part delete accounts
$(document).delegate("#DeleteAccount","click",function(event){
   
    event.preventDefault();
	var COMPANY_NAME=$(this).attr('COMPANY_NAME');
	var REGISTERD_AS=$(this).attr('REGISTERD_AS');

	console.log("COMPANY_NAME: "+COMPANY_NAME+"\n"+"REGISTERD_AS: "+REGISTERD_AS);
	//Make ajax call
	var result=confirm("ARE YOU SURE YOU WANT TO DELETE ACCOUNT OF: "+COMPANY_NAME+"\n"+"REGISTERD AS: "+REGISTERD_AS);
	
	if(result==false){
    $("#Result").html("<div class='alert alert-success'><a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>Canled deleting account" +COMPANY_NAME+ " registerd as " +REGISTERD_AS+" </b></div>");
	}
	else if(result==true){
    DeleteThisAccount(COMPANY_NAME,REGISTERD_AS);
	}

	

});

//Checks all account
$("#lnk2").click(function(event){
	//This is part delete accounts
	event.preventDefault();
	//Make ajax call	
   //Perform ajax call to invetory.php to edit type
	$.ajax({
	   url:"php/AccountManager.php",
	   method:"POST",
	   data:{All:1},
	   success:function(data){$("#DisplayContent").html(data);console.log(data)},
	   error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }


	});

});

//Checks all account logs
$("#lnk3").click(function(event){
event.preventDefault();
	//Make ajax call	
   //Perform ajax call to invetory.php to edit type
	$.ajax({
	   url:"php/AccountManager.php",
	   method:"POST",
	   data:{LogRec:1},
	   success:function(data){$("#DisplayContent").html(data);console.log(data)},
	   error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }


	});


});

//Display all credit account
$(document).delegate("#lnk4","click",function(event){
	
	$.ajax({
	   url:"php/AccountManager.php",
	   method:"POST",
	   data:{CreditOnly:1},
	   success:function(data){$("#DisplayContent").html(data);console.log(data)},
	   error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }


	});


});
//Display all cash account
$(document).delegate("#lnk5","click",function(event){
	
	$.ajax({
	   url:"php/AccountManager.php",
	   method:"POST",
	   data:{CashOnly:1},
	   success:function(data){$("#DisplayContent").html(data);console.log(data)},
	   error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }


	});
});


/*
This is sub part associated with the above part of viewing records
*/

$(document).delegate("#ViewLog","click",function(event){
event.preventDefault();

	var EMAIL=$(this).attr('EMAIL');
	var SESSION_ID=$(this).attr('SESSION_ID');
	var USER_ROLE=$(this).attr('USER_ROLE');
	console.log("USER: "+EMAIL+"\n"+"LOGGED_AS: "+USER_ROLE+"\n"+"SESSION_ID: "+SESSION_ID);
//Check log Record Per individual account

//Make ajax call 
ViewLog(EMAIL,USER_ROLE,SESSION_ID);

});




/*
 This section deals with all sales and purchase repot
*/

$("#ChkcSales").click(function(event){//Checks all sales report
event.preventDefault();
$.ajax({
	   url:"php/SalesReport.php",
	   method:"GET",
	   data:{SalesReport:1},
	   success:function(data){
	   $("#DisplayContent").html(data);
	   console.log(data)},
	   error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }


	});

});

/*
This part generaye sales report for category
*/
$(document).delegate("#SalesReportBtn","click",function(event){
//$("#SalesReportBtn").click(function(event){
//Checks all sales report
//event.preventDefault();
var val=$("#CategorySalesReport :selected").text();
console.log("functional with value: "+val);

$.ajax({
	   url:"php/SalesReport.php",
	   method:"POST",
	   data:{SalesReportBtn:1,val:val},
	   success:function(data){
	   console.log("post data: "+val);
	   $("#Result2").html(data);
	   console.log(data)},
	   error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }


	});

});

//This is part genrate sales report by product
$(document).delegate("#SalesReportProduct","click",function(event){
    event.preventDefault();
	var val=$("#ProductSalesReport :selected").text();
	console.log("functional with value: "+val);

	$.ajax({
	   url:"php/SalesReport.php",
	   method:"POST",
	   data:{SalesReportProduct:1,val:val},
	   success:function(data){
	   console.log("post data: "+val);
	   $("#Result2").html(data);
	   console.log(data)},
	   error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }


	});

});

//This is part genrate weekly sales report 
$(document).delegate("#SalesReportWeekly","click",function(event){
    event.preventDefault();
	console.log("functional with value: ");

	$.ajax({
	   url:"php/SalesReport.php",
	   method:"GET",
	   data:{SalesReportWeekly:1},
	   success:function(data){
	   $("#Result2").html(data);
	   console.log(data)},
	   error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }


	});

});

//This is part genrate monthly sales report

$(document).delegate("#SalesReportMonthly","click",function(event){
    event.preventDefault();
	console.log("functional with value: SalesReportMonthly ");

	$.ajax({
	   url:"php/SalesReport.php",
	   method:"GET",
	   data:{SalesReportMonthly:1},
	   success:function(data){
	   $("#Result2").html(data);
	   console.log(data)},
	   error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }


	});

});

//This is part genrate total sales report

$(document).delegate("#SalesReporTotal","click",function(event){
    event.preventDefault();
	console.log("functional with value: SalesReporTotal ");

	$.ajax({
	   url:"php/SalesReport.php",
	   method:"GET",
	   data:{SalesReporTotal:1},
	   success:function(data){
	   $("#Result2").html(data);
	   console.log(data)},
	   error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }


	});

});



//Checks all purchase report
$("#ChckPurchaseReporrt").click(function(event){//Checks all purchase report
event.preventDefault();
$.ajax({
	   url:"php/PurchaseReport.php",
	   method:"GET",
	   data:{AdminPurchaseReport:1},
	   success:function(data){
	   $("#DisplayContent").html(data);
	   console.log(data)},
	   error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }


	});

});

$("#AuditReport").click(function(event){//Checks all audit report
alert("Checks all audit report");

});

/*
This is part deals with monitoring and making goods purchases 
*/


$("#SendOrder").click(function(event){
//This part sends orders to all suppliers	
alert("send order working");
event.preventDefault();
$.ajax({
	   url:"php/PurchaseOrder.php",
	   method:"GET",
	   data:{MakerOder:1},
	   success:function(data){
	   $("#DisplayContent").html(data);
	   console.log(data)},
	   error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }


	});


});
/*
This is the sub part deals with sending orders to suppliers
*/
//Make order
var ProductName;
var Quantity;
var Unit;

//Product name text field
$(document).delegate("#ProdutName","blur",function(event){

ProductName=$(this).val();
console.log ('Product Name: '+ProductName);
   
});

//Quantity text fielf
$(document).delegate("#QUANTITY","blur",function(event){
Quantity=$(this).val();
console.log ("Quantity: "+Quantity);

});
//image button

$(document).delegate("#ImageButton2","click",function(event){
	alert("this is imagage to be added : "+ProductName);
	//window.location.href="http://pick2get.com/SystemInvetory.php";
	$.ajax({
		url:"php/AddImageToOrder.php",
   		method:"POST",
   		data:{Image:1,ProductName:ProductName,Quantity:Quantity},
   		success:function(data){$("#Result2").html(data);console.log(data)},
   		error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }
	});
});

//Make order button
$(document).delegate("#makeOrder","click",function(event){
	 event.preventDefault();
     var Unit=$("#Unit :selected").text();
     /*var Unit=$("#Unit2 :selected").text();
	 var Unit=$("#Unit3  :selected").text();
	 var Unit=$("#Unit4  :selected").text();
	 var Unit=$("#Unit5  :selected").text();   
	 var Unit=$("#Unit6  :selected").text();
	 var Unit=$("#Unit7  :selected").text();*/         
	alert ('ProductName: '+ProductName+'\n'+"Unit: "+Unit+"\n"+"Quantity: "+Quantity);
   
	console.log('ProductName: '+ProductName+'\n'+"Unit "+Unit+"\n"+"Quantity"+Quantity);

	

});

//Cancel
$(document).delegate("#CancelOrder","click",function(event){
    event.preventDefault();
	var name=$(this).attr('name');
	alert ('Make order'+name);
    event.preventDefault();
	console.log("functional with value: SalesReporTotal "+name);

	

});


























//This part Check The Accepted By the System to Supply to Pick to get
$("#ChckOrder").click(function(event){
//This is part checks all orders and their status 
event.preventDefault();
$.ajax({
	   url:"php/PurchaseOrder.php",
	   method:"GET",
	   data:{GetAcceptedSuuplyOrer:1},
	   success:function(data){
	   $("#DisplayContent").html(data);
	   console.log(data)},
	   error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }


	});


});
/*
This  sub part is associated with the above apart which contains a buttons for initiating payment

*/
$(document).delegate("#BuyItem","click",function(event){

    event.preventDefault();
    //Get table attributes
	var COMPANY_NAME=$(this).attr('COMPANY_NAME');
	var TOTAL_PRICE=$(this).attr('TOTAL_PRICE');
	var CONFIRMED_COUNT=$(this).attr('CONFIRMED_COUNT');
	var ACTUAL_COUNT=$(this).attr('ACTUAL_COUNT');
	var PAYMENT_MODE=$(this).attr('PAYMENT_MODE');
	var FROM_CLIENT=$(this).attr('FROM_CLIENT');
	console.log("TEST EFORE AJAX"+"\n"+"COMPANY_NAME: "+COMPANY_NAME+"\n"+
		        "TOTAL_PRICE"+TOTAL_PRICE+"\n"+
		        "CONFIRMED_COUNT: "+CONFIRMED_COUNT+"\n"+
		        "ACTUAL_COUNT: "+ACTUAL_COUNT+"\n"+
		        "ACCOUNT_TYPE: "+PAYMENT_MODE+"\n"+
		        "FROM_CLIENT: "+FROM_CLIENT+"\n"


		);
	$.ajax({
	   url:"php/PurchaseOrder.php",
	   method:"POST",
	   data:{MakePurChase:PAYMENT_MODE,COMPANY_NAME:COMPANY_NAME,TOTAL_PRICE:TOTAL_PRICE,CONFIRMED_COUNT:CONFIRMED_COUNT,ACTUAL_COUNT:ACTUAL_COUNT,FROM_CLIENT:FROM_CLIENT},
	   success:function(data){
	   $("#Result2").html(data);
	   console.log(data)},
	   error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }


	});

	

});

$("#RateSupplier").click(function(event){
//This is part rates the supplier
alert("Rate supplier working");

});

$("#AddSpecialOffer").click(function(event){
//This is part rates the supplier
alert("AddSpecialOffer");

});

$("#ChckSuply").click(function(event){
//This is part checks the expected time of arrival of goods to be supplied
alert("Eta functional");

});

/*
This is part deals with all goods to be spplied to the client
*/

$("#ItmSuply").click(function(event){
//Checks item to supplied to client 
console.log("Checks item to supplied to client");
$.ajax({
	   url:"php/PurchaseOrder.php",
	   method:"GET",
	   data:{GetItemsToBrSuppliedToClient:1},
	   success:function(data){
	   $("#Result2").html(data);
	   console.log(data)},
	   error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }


	});



});

$("#DlvrStat").click(function(event){
//Checks the delivery status all sent items 
console.log("Delivery status");

$.ajax({
	   url:"php/PurchaseOrder.php",
	   method:"GET",
	   data:{DeliveryStatus:1},
	   success:function(data){
	   $("#Result2").html(data);
	   console.log(data)},
	   error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }


	});

});

$("#PndgOrdr").click(function(event){
//This is part checks for all pending orders
console.log("This is part checks for all pending orders");
$.ajax({
	   url:"php/PurchaseOrder.php",
	   method:"GET",
	   data:{GetItemsToBrSuppliedToUs:1},
	   success:function(data){
	   $("#Result2").html(data);
	   console.log(data)},
	   error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }


	});

});

$("#CncldOrdr").click(function(event){
alert("This is part checks all canceld orders");
});		
/*
This section will deal invetory
*/	

//Adding goods to the system. 
$("#ChckInvtry").click(function(event){
	console.log("Check invetory working");
	window.location.href="http://pick2get.com/SystemInvetory.php";

	});
//Add goods to database

//Reset button
$("#Resetbtn").click(function(event){
 event.preventDefault();
console.log("Reset button working");
});
//Get Items By Category

//Dry goods
$("#dryGoods").click(function(event){
event.preventDefault();
GetDryGoods();
console.log("View Dry goods category working");
});
//Perishable
$("#Perishable").click(function(event){
event.preventDefault();
GetPerishableGoods();
console.log("View Perishable category working");
});
//Wetgoods
$("#WetGoods").click(function(event){
event.preventDefault();
GetWetGoods();
console.log("View WetGoods category working");
});
//Fruits and vegetable
$("#FruitsAndVeggies").click(function(event){
event.preventDefault();
GetFruitsAndVeggies();	
console.log("View FruitsAndVeggies category working");
});
//ACCESORIES
$("#ACCESORIES").click(function(event){
event.preventDefault();	
console.log("View ACCESORIES category working");
GetAccesories();
});
//STAIONERIES
$("#SANITARY").click(function(event){
event.preventDefault();	
console.log("View SANITARY category working");
GetStationeries();
});
//Display all goods 
$("#DisplayAllProducts").click(function(event){
event.preventDefault();
GetAllProducts();	
console.log("View Dry All goods working");
});



//Updating and Deleting Goods from the system.
//for updating table items
$(document).delegate("#ImageUpdate","click",function(event){

	console.log("update delegate functional");
	var ImageName=$(this).attr('ImageName');
    var ProductName=$(this).attr('ProductName');


    console.log("image name: "+ImageName+"\n"+"Product name: "+ProductName+"\n");
    updateImage(ImageName,ProductName);
    
});



//Global variables
var Type;
var Item;
var ProductName;
var Unit;
var Quantity;


//This is for editing the product type
$(document).delegate("#Type","blur",function(event){
event.preventDefault();
var ProductName=$(this).attr('ProductName')
var val=$(this).attr('Type');
var Type=$(this).text();
console.log("This is the Type name: "+Type+"\n" +"This old value: "+val+"\n");

//Perform ajax call to invetory.php to edit type
$.ajax({
   url:"php/invetory.php",
   method:"POST",
   data:{EditType:1,val:val,Type:Type,ProductName:ProductName},
   success:function(data){$("#feedback").html(data);console.log(data)},
   error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


});

});

//This is for editing  the item of the product
$(document).delegate("#Item","blur",function(event){
event.preventDefault();
var ProductName=$(this).attr('ProductName');//Additonal varable to update product in WHERE SQL clause
var Oldval=$(this).attr('Item');
var Item=$(this).text();
console.log("This is the item name: "+ProductName+"\n" +"This old value: "+Oldval+"\n");

//Perform ajax call to invetory.php to edit type
$.ajax({

   url:"php/invetory.php",
   method:"POST",
   data:{EditItem:1,ProductName:ProductName,Oldval:Oldval,Item:Item},
   success:function(data){$("#feedback").html(data);console.log(data);},
   error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


});


});

//This is for editing the product name
$(document).delegate("#ProductName","blur",function(event){
event.preventDefault();
var val=$(this).attr('ProductName');
var ProductName=$(this).text();
console.log("This is the product  name: "+ProductName+"\n" +"This old value: "+val+"\n");
 
//Perform ajax call to invetory.php to edit type
$.ajax({
   url:"php/invetory.php",
   method:"POST",
   data:{EditProductName:1,ProductName:ProductName,val:val},
   success:function(data){$("#feedback").html(data);console.log(data);},
   error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


});

});

//This is for editing the unit of the product
$(document).delegate("#Unit","blur",function(event){
event.preventDefault();
var ProductName=$(this).attr('ProductName');
var val=$(this).attr('Unit');
var Unit=$(this).text();

console.log("This is the unit name: "+Unit+"\n" +"This old value: "+val+"\n");

//Perform ajax call to invetory.php to edit type
$.ajax({
   url:"php/invetory.php",
   method:"POST",
   data:{EditUnit:1,Unit:Unit,val:val,ProductName:ProductName},
   success:function(data){$("#feedback").html(data);console.log(data);},
   error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


});



});

//Thi is is for editing the price per unit
$(document).delegate("#PricePerUnit","blur",function(event){
event.preventDefault();
var ProductName=$(this).attr('ProductName');
var val=$(this).attr('PricePerUnit');
var PricePerUnit=$(this).text();
//alert(PricePerUnit);
console.log("This is the PricePerUnit: "+PricePerUnit+"\n" +"This old value: "+val+"\n");

//Perform ajax call to invetory.php to edit Price per unit
$.ajax({
   url:"php/invetory.php",
   method:"POST",
   data:{EditPricePerUnit:1,PricePerUnit:PricePerUnit,val:val,ProductName:ProductName},
   success:function(data){$("#feedback").html(data);console.log(data);},
   error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


});



});

//This is  for editing Quantity of products
$(document).delegate("#Quantity","blur",function(event){
event.preventDefault();
var ProductName=$(this).attr('ProductName');
var val=$(this).attr('Quantity');
var Quantity=$(this).text();
console.log("This is the Quantity: "+Quantity+"\n" +"This old value: "+val+"\n");

//Perform ajax call to invetory.php to edit Price per unit
$.ajax({
   url:"php/invetory.php",
   method:"POST",
   data:{EditQuantity:1,Quantity:Quantity,val:val,ProductName:ProductName},
   success:function(data){ $("#feedback").html(data);console.log(data);},
   error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


});



});

//for updating table items
/*$(document).delegate("#UpdateItem","click",function(event){
    
event.preventDefault();

	//var Type=$("#Type").text();
	//var Item=$("#Item").text();
	var ProductName=prompt("Enter product name");
	//var Unit=$("#Unit").text();
	//var Quantity=$("#Quantity").text();
	//var PricePerUnit=$("#PricePerUnit").text();
	//var ImageName=$(this).attr('ImageName');
    //var ProductName=$(this).attr('ProductName');
    alert(ProductName);

   /*console.log("This is the product name: "+ProductName+"\n"
    	                     +"item group: "+Item+"\n"         <td contenteditable='true' id='Unit'>$Unit</td>

    	                     +"Unit: "+Unit+"\n"
    	                     +"Quantity: "+Quantity+"\n"
    	                     +"Price per unit: "+PricePerUnit+"\n"



    	                     );
    
    

   // UpdateProducts(Type,Item,ProductName,Unit,Quantity,PricePerUnit);
    
});*/



//for deleting table items
$(document).delegate("#deleteItem","click",function(event){
    event.preventDefault();
	console.log("delegate delegate functional");
	var ImageName=$(this).attr('ImageName');
    var ProductName=$(this).attr('ProductName');
    confirm("Are you sure you want to delete? \n"+" Product name: "+ProductName+"\n");

//Perform ajax call to invetory.php to delete product name
$.ajax({
   url:"php/invetory.php",
   method:"POST",
   data:{DeleteProduct:1,ProductName:ProductName},
   success:function(data){ $("#feedback").html(data);console.log(data);},
   error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


});

   
    


});

//Viewing goods from the database

//Sort by category


/*
 This sis section will deal with managing the stock invetory
*/
/*
 This section will deal managing supplies and transaction from clients
*/
/*
  This section will deal managing sending supply ordesr to suppliers
*/
    
});

//Function definition getting Products

function GetAllProducts()
{

//Make ajax call to be and get goods
$.ajax({
		        url:"php/invetory.php",
		        type: "GET",
		        data:{AllProducts:1} ,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           $("#TblContents").html(data);
		           console.log("Data Entered successfully! :) "+data); 
		           /*This part Calculates the total price*/
		           
					

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });

}

function GetDryGoods(){

$.ajax({
		        url:"php/invetory.php",
		        type: "GET",
		        data:{DryGoods:1},
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		          $("#TblContents2").html(data);
		           console.log("Data Entered successfully! :) "+data); 
		           /*This part Calculates the total price*/
		           
					

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });




}

function GetPerishableGoods(){

$.ajax({
		        url:"php/invetory.php",
		        type: "GET",
		        data:{Perishable:1},
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		    	   $("#TblContents2").html(data);
		           console.log("Data Entered successfully! :) "+data); 
		           /*This part Calculates the total price*/
		           
					

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });




}

function GetWetGoods(){

$.ajax({
		        url:"php/invetory.php",
		        type: "GET",
		        data:{WetGoods:1},
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		          $("#TblContents2").html(data);
		           console.log("Data Entered successfully! :) "+data); 
		           /*This part Calculates the total price*/
		           
					

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });




}


function GetFruitsAndVeggies(){

$.ajax({
		        url:"php/invetory.php",
		        type: "GET",
		        data:{FruitsAndVeggies:1},
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           $("#TblContents2").html(data);
		           console.log("Data Entered successfully! :) "+data); 
		           /*This part Calculates the total price*/
		           
					

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });




}

function GetStationeries(){

$.ajax({
		        url:"php/invetory.php",
		        type: "GET",
		        data:{STAIONERIES:1},
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           $("#TblContents2").html(data);
		           console.log("Data Entered successfully! :) "+data); 
		           /*This part Calculates the total price*/
		           
					

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });




}

function GetAccesories(){

$.ajax({
		        url:"php/invetory.php",
		        type: "GET",
		        data:{ACCESORIES:1},
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           $("#TblContents2").html(data);
		           console.log("Data Entered successfully! :) "+data); 
		           /*This part Calculates the total price*/
		           
					

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });




}

//function to insert goods into databse


function InsertProducts(formData){
	
	$.ajax({

		    url:"php/invetory.php",
		    type: "POST",
		    data:formData,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           console.log("This is the Product name: "+data);
		           console.log("Data Entered successfully! :) \n"+data); 

		           $("#result").html(data);
		           
		           
					

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


});
}

//function update image
function updateImage(img_name,prdt_name){
var imagename=img_name;
var prdtname=prdt_name;
//make ajax to php scpit transistvar script
$.ajax({

		    url:"php/invetory.php",
		    type: "POST",
		    data:{updateimage:1,img_name:imagename,prdt_name:prdtname},
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           console.log("This is  "+data);
		           console.log("Data Entered successfully! :) \n"+data); 
		           //alert("This is ajax data to be trasferesd"+"\n"+" image name: "+imagename+"\n"+"Product name: "+prdtname+"\n");

		           //$("#feedback").html(data);
		           //alert(data);
		           var url=data;
                   //alert(url);
                   window.location.href=url;
		           
		           
					

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


});


}

//function to update goods in the databse


function UpdateProducts(Type,Item,ProductName,Unit,Quantity,PricePerUnit){

	//Local variables

	var A_Type=Type;
	var B_Item=Item;
	var C_ProductName=ProductName;
	var D_Unit=Unit;
	var E_Quantity=Quantity;
	var F_PricePerUnit=PricePerUnit;
	
	$.ajax({

		    url:"php/invetory.php",
		    type: "POST",
		    data:{UpdateProduct:0},
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           console.log("This is the Product name: "+data);
		           console.log("Data Entered successfully! :) \n"+data); 

		           $("#result").html(data);
		           
		           
					

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


});
}
    

//function to activate supplier account
 
function ActivateSupplierAccount(COMPANY_NAME,REGISTERD_AS){
$.ajax({
	url:"php/EditAccount.php",
	method:"POST",
	data:{ActivateSupplier:1,COMPANY_NAME:COMPANY_NAME,REGISTERD_AS:REGISTERD_AS},
	success:function(data){
		$("#Result").html(data);  
		
	},
	error:function(jqXHR, textStatus, errorThrown)
	{
		$("#Result").html(data); 
		console.log(textStatus, errorThrown);
	}
});
}


//function to activate cash account
function ActivateCreditAccount(COMPANY_NAME,REGISTERD_AS){
$.ajax({
	url:"php/EditAccount.php",
	method:"POST",
	data:{ActivateCredit:1,COMPANY_NAME:COMPANY_NAME,REGISTERD_AS:REGISTERD_AS},
	success:function(data){
		$("#Result").html(data);  
		
	},
	error:function(jqXHR, textStatus, errorThrown)
	{
		$("#Result").html(data); 
		console.log(textStatus, errorThrown);
	}
});
}





//function to activate cash account
function ActivateCashAccount(COMPANY_NAME,REGISTERD_AS){
$.ajax({
	url:"php/EditAccount.php",
	method:"POST",
	data:{ActivateCash:1,COMPANY_NAME:COMPANY_NAME,REGISTERD_AS:REGISTERD_AS},
	success:function(data){
		$("#Result").html(data);  
		
	},
	error:function(jqXHR, textStatus, errorThrown){
		$("#Result").html(data); 
		console.log(textStatus, errorThrown);
	}
});
}

//function to activate cash account
function DeleteThisAccount(COMPANY_NAME,REGISTERD_AS){
$.ajax({
	url:"php/EditAccount.php",
	method:"POST",
	data:{DeleteAccount:1,COMPANY_NAME:COMPANY_NAME,REGISTERD_AS:REGISTERD_AS},
	success:function(data){
		$("#Result").html(data); 
		
	},
	error:function(jqXHR, textStatus, errorThrown)
	{
	$("#Result").html(data); 
	console.log(textStatus, errorThrown);
	}
});
}

//function to view log record per invidual

function ViewLog(EMAIL,USER_ROLE,SESSION_ID)
{

$.ajax({
	url:"php/AccountManager.php",
	method:"POST",
	data:{ViewLog:1,EMAIL:EMAIL,USER_ROLE:USER_ROLE,SESSION_ID:SESSION_ID},
	success:function(data){
		$("#DisplayContent").html(data); 
		
	},
	error:function(jqXHR, textStatus, errorThrown)
	{
	$("#DisplayContent").html(data); 
	console.log(textStatus, errorThrown);
	}

});

}