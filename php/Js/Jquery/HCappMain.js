// JavaScript Document//
//HotelClient JQery script
$(document).ready(function(){
//Make ajax call to fetch products with repect to ID

//Table close button
$("#CloseTable").click(function(event){

location.reload();

});
 /*
  This are the global values to be accessd by other function
 */ 

var ProductName;//This is the Product name
var Price;//This is The Product Price
var unit;//This is the products unit(Kg,lt,m,...)
var Quantity;//This is quantity deanded
var DefaulResetvalue=0;//Reset product to zero
var AmountPresent;//Amount present in products table after before purchase
var AmountRemaining;//Amount remaining after purchase
var Total;//Product Total
var SupplierCategory;//Supplier Category
var Image;


//Function definition for adding product to cart

function AddProductToCart(){
//Perform Ajax request




}

//Function definition for removing product to cart

function RemoveProductFromCart(){
//Perform Ajax request



} 

//function To Update Quantity

function AddQuantity(){
//Perform Ajax request


}

//Function to Reset Qantity
function ResetQuantity(){
//Perform Ajax request





}









//Test button
$(document).delegate("#Test","click",function(event){
    event.preventDefault();
    //var y=$(this).attr('price');
    //console.log(y);
   

  });
//Get text value dynamically
$(document).delegate("#TxtQty","blur",function(event){
    event.preventDefault();
    Quantity=$(this).val();
    console.log(Quantity);
    

  });
//Add qunatity of product 
$(document).delegate("#AddQty","click",function(event){

    //console.log(y);
   alert("add quantity WORKING value is: "+Quantity);


  });

 //Reset quantity of product
 $(document).delegate("#RmvQty","click",function(event){
    event.preventDefault();
    //var y=$(this).attr('price');
    //console.log(y);
    /*
		Make an ajax call to purchase engine reset product qunatity to zero
		$_POST['QtyReset']
    */
    var QtyReset=0;
    $.ajax({
             url:"php/PurchaseEngine.php",
             method:"POST",
             data:{QtyReset:0},
             success:function(data){
             	console.log("Quantity Reset to zero with value: "+data);
             },
             error:function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }

    });
   

  }); 
 //Add to cart
 $(document).delegate("#add","click",function(event){
    event.preventDefault();
   
    Price=$(this).attr('price');
    ProductName=$(this).attr('product_name');
    AmountPresent=$(this).attr('amount_present');
    unit=$(this).attr('unit');
    SupplierCategory=$(this).attr('SupplierCategory');
    Image=$(this).attr('Image');
    Quantity;
    AmountRemaining=AmountPresent-Quantity;//Amount remaining after purchase
    Total=Quantity*Price;//Calculate Total in Tsh

    

    //Quick Validate
    if (isNaN(Quantity)===true){
    	alert("Enter a valid number");

    	return Quantity=0;
    }

    
    //Perform Ajax Call to insert goods to Cart table
    $.ajax({
    	url:"php/PurchaseEngine.php",
    	method:"POST",
    	data:{Image:Image,SupplierCategory:SupplierCategory,Price:Price,ProductName:ProductName,AmountPresent:AmountPresent,unit:unit,Quantity:Quantity,AmountRemaining:AmountRemaining,Total:Total},//Ajax data to be sent to cart table and diplayed
    	success:function(data){
    		//alert the user goods added to cart
    		
    		
    		alert(Image);  
    		console.log("Product Name: "+ProductName+"\n"+"Product price:"+Price+"\n"+"Quantity Purchased:"+Quantity+unit+"\n"+"Total price: "+Total+"Tsh"+"\n"+"Current amount after purchase: "+AmountRemaining+unit+"\n"+"SupplierCategory: "+SupplierCategory+"\n"+"Image name is: "+Image);
    		$("#ToCart").html(data);
    	},
    	error:function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }
    });


  });
//function definition for Remove from cart

function RemovefromCart(){
   	 $.ajax({
      url:"php/RemovefromCart.php",
    method:"POST",
      data:{RemoveItem:1,ItemToRemove:ProductName},
   success:function(data){
   
  $("#ToCart").html(data);

   },
     error:function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        },
  


   });
   }


 //Remove from cart
 $(document).delegate("#Rmv","click",function(event){
    event.preventDefault();
    Price=$(this).attr('price');
    ProductName=$(this).attr('product_name');
   
   
   //Perform An Ajax Call
   RemovefromCart();
  

  }); 

 //Display Items on cart
$("#GoCheckOut").click(function(event){
//CHECK ACCOUNT TYPE AND DSPLAY BUTTON IN ACCORDANCE TO ACCOUNT TYPE	
var accountType=$("#GoCheckOut").attr("accounttype");




//pERFORM aJAX cALL
$.ajax({
				  url:"php/CheckOut.php",
		         type: "GET",
		         data:{Buy:1},
		      success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           $("#CheckOutResult").html(data);
		           if(accountType=="CREDIT")
					{
						//alert("This is the user accounttype: "+accountType);
						$("#ThreeGPay").hide();
						
					}
					if(accountType=="CASH"){
					//alert("This is the user accounttype: "+accountType);
					
					$("#CrediPay").hide();
					}
		           console.log("Data Entered successfully! :) "); 
		           /*This part Calculates the total price*/
		           
					

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


});



});

//Make payment with the following button

$(document).delegate("#ThreeGPay","click",function(event){
//Test stub
alert("3G payment button working");	

var PaymentMode="3G";
//Make Ajax Call here to sales table
$.ajax({

				url:"php/sales.php",
		        type: "POST",
		        data:{PaymentMode3g:PaymentMode} ,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           console.log("Data Entered successfully! :) \n"); 
		           alert(data);
		           
					

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


});
});


$(document).delegate("#CrediPay","click",function(event){
//Test stub
var PaymentMode="Credit";
alert("CrediPay payment button working");	
//Make Ajax Call here to sales table
$.ajax({

		url:"php/sales.php",
		        type: "POST",
		        data:{PaymentModeCredit:1,PaymentMode:PaymentMode} ,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           console.log("Data Entered successfully! :) \n"); 
		           console.log(data);
		           
					

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


});
});


$(document).delegate("#PayPal","click",function(event){
//Test stub
var PaymentMode="PayPal";
alert("PayPal payment button working");	
//Make Ajax Call here to sales table
$.ajax({

		url:"php/sales.php",
		        type: "POST",
		        data:{PaymentMode3g:PaymentMode} ,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           console.log("Data Entered successfully! :) \n"); 
		           console.log(data);
		           
					

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


});

});










//Item food category Ajax call
//for fruit and vegitable

$("#fruit").click(function(event){
event.preventDefault();
console.log("Click fruit");
//Make Ajax call

     displayfruits();
	 function displayfruits(){
	 	$.ajax({
		        url:"php/FruitAndVegetable.php",
		        type: "GET",
		        data:"data" ,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           $("#result").html(data);
		           console.log("Data Entered successfully! :) "); 
		           /*This part Calculates the total price*/
		           
					

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });
		
	}

  
	
});

//for Meat_fish
$("#Meat_fish").click(function(event){
event.preventDefault();
console.log("Click  Meat_fish");
$.ajax({
		        url:"php/MeatAndFish.php",
		        type: "GET",
		        data:"data" ,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           $("#result").html(data);
		           console.log("Data Entered successfully! :) ");   
		          

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });	
});


//for Dairy_product
$("#Dairy_product").click(function(event){
event.preventDefault();
console.log("Click Dairy_product");	
$.ajax({
		        url:"php/DairyProducts.php",
		        type: "GET",
		        data:"data" ,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           $("#result").html(data);
		           console.log("Data Entered successfully! :) ");   
		          

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });	
});

//for dry_food
$("#dry_food").click(function(event){
event.preventDefault();
console.log("Click dry_food");
$.ajax({
		        url:"php/DryGoods.php",
		        type: "GET",
		        data:"data" ,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           $("#result").html(data);
		           console.log("Data Entered successfully! :) ");   
		          

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });		
});

//Item Beverage category Ajax call

//#Coffe&Tea
$("#Coffe_Tea").click(function(event){
event.preventDefault();
console.log("Clicked #Coffe_Tea");
$.ajax({
		        url:"php/TeaAndCoffee.php",
		        type: "GET",
		        data:"data" ,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           $("#result").html(data);
		           console.log("Data Entered successfully! :) ");   
		          

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });	
});

//#SoftDrink.php
$("#SortDrink").click(function(event){
event.preventDefault();
console.log("Clicked #SortDrink");
$.ajax({
		        url:"php/SoftDrink.php",
		        type: "GET",
		        data:"data" ,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           $("#result").html(data);
		           console.log("Data Entered successfully! :) ");   
		          

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });	
});

//#Water.php
$("#Water").click(function(event){
event.preventDefault();
console.log("Clicked #Water");
$.ajax({
		        url:"php/Water.php",
		        type: "GET",
		        data:"data" ,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           $("#result").html(data);
		           console.log("Data Entered successfully! :) ");   
		          

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });	
});


//#NonAloholic.php
$("#NonAloholic").click(function(event){
event.preventDefault();
console.log("Clicked #NonAloholic");
$.ajax({
		        url:"php/NonAlcoholic.php",
		        type: "GET",
		        data:"data" ,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           $("#result").html(data);
		           console.log("Data Entered successfully! :) ");   
		          

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });	
});


//#Alcoholic.php
$("#Alcoholic").click(function(event){
event.preventDefault();
console.log("Clicked #Aloholic");
$.ajax({
		        url:"php/Alcoholic.php",
		        type: "GET",
		        data:"data" ,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           $("#result").html(data);
		           console.log("Data Entered successfully! :) ");   
		          

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });	
});


//Utility category Ajax call

//#CLEANING_UTILITY.php
$("#CLEANING_UTILITY").click(function(event){
event.preventDefault();
console.log("Clicked #CLEANING_UTILITY ");
$.ajax({
		        url:"php/CLEANING_UTILITY.php",
		        type: "GET",
		        data:"data" ,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           $("#result").html(data);
		           console.log("Data Entered successfully! :) ");   
		          

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });	
});

//#SANITARY_UTILITY.php
$("#SANITARY_UTILITY").click(function(event){
event.preventDefault();
console.log("Clicked #SANITARY_UTILITY ");
$.ajax({
		        url:"php/SANITARY_UTILITY.php",
		        type: "GET",
		        data:"data" ,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           $("#result").html(data);
		           console.log("Data Entered successfully! :) ");   
		          

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });	
});


//#KITCHEN_UTILITY.php
$("#KITCHEN_UTILITY").click(function(event){
event.preventDefault();
console.log("Clicked #KITCHEN_UTILITY");
$.ajax({
		        url:"php/KITCHEN_UTILITY.php",
		        type: "GET",
		        data:"data" ,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           $("#result").html(data);
		           console.log("Data Entered successfully! :) ");   
		          

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });		
});


//#MAINTANANCE.PHP
$("#MAINTANANCE").click(function(event){
event.preventDefault();
console.log("Clicked #MAINTANANCE");
$.ajax({
		        url:"php/MAINTANANCE.PHP",
		        type: "GET",
		        data:"data" ,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           $("#result").html(data);
		           console.log("Data Entered successfully! :) ");   
		          

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });	
});

//#ENERGY.php
$("#ENERGY").click(function(event){
event.preventDefault();
console.log("Clicked #ENERGY");
$.ajax({
		        url:"php/ENERGY.php",
		        type: "GET",
		        data:"data" ,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           $("#result").html(data);
		           console.log("Data Entered successfully! :) ");   
		          

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });	
});

//#STATIONERY.php
$("#STATIONERY").click(function(event){
event.preventDefault();
console.log("Clicked #STATIONERY");
$.ajax({
		        url:"php/STATIONERY.php",
		        type: "GET",
		        data:"data" ,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           $("#result").html(data);
		           console.log("Data Entered successfully! :) ");   
		          

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });	
});



//Quick menu view item Ajax call	

//#GOOD_COMPARISION.php
$("#GOOD_COMPARISION").click(function(event){
event.preventDefault();
console.log("Clicked GOOD_COMPARISION");
$.ajax({
		        url:"php/",
		        type: "GET",
		        data:"data" ,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           $("#result").html(data);
		           console.log("Data Entered successfully! :) ");   
		          

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });	
});

//#PURCHASE_HISTORY.php
$("#PURCHASE_HISTORY").click(function(event){
event.preventDefault();
console.log("Clicked PURCHASE_HISTORY");
$.ajax({
		        url:"php/",
		        type: "GET",
		        data:"data" ,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           $("#result").html(data);
		           console.log("Data Entered successfully! :) ");   
		          

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });	
});

//#TRANSACTION_HISTORY.php
$("#TRANSACTION_HISTORY").click(function(event){
event.preventDefault();
console.log("Clicked TRANSACTION_HISTORY ");
$.ajax({
		        url:"php/MeatAndFish.php",
		        type: "GET",
		        data:"data" ,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           $("#result").html(data);
		           console.log("Data Entered successfully! :) ");   
		          

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });	
});

//#VIEW_SPECIAL_OFFER.php
$("#VIEW_SPECIAL_OFFER").click(function(event){
event.preventDefault();
console.log("Clicked VIEW_SPECIAL_OFFER");
$.ajax({
		        url:"php/Notification.php",
		        type: "GET",
		        data:{VIEW_SPECIAL_OFFER:1} ,
		        success: function (data) {
		           // you will get response from your php page (what you echo or print) 
		           //$("#result").html(data);
		           $("#result").html(data);
		           console.log("Data Entered successfully! :) ");  /// 
		          

		          

		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }


			    });	
});
	
	
});
//Add Qty
//Reset Qty
//Add to cart Button

console.log("At delegate function");
/*$("body").delegate("#add","click",function(event){
            //var x=$(this).text();
           event.preventDefault(); 
           alert("Add to cart");

  });*/

















//Remove from cart

/*function getVal(val)//Gets product name
		{  
		   var data="";
		   var formdata=val;
		   console.log(formdata);
		   //Get element text input from TxtQty

		    var Quantity=$(this).attr("Txt").val();
			var productName=JSON.stringify(formdata);
				        


		    console.log("The Product name from Current Click is: "+productName);
		    console.log("The Quantity Current Click is: "+Quantity);
			

			$.ajax({
		                url:"php/PurchaseEngine.php",
				        type: "POST",
				        data:{data:productName},
				        success: function (data) {
				           // you will get response from your php page (what you echo or print) 
				           //$("#result").html(data);
				           //$("#result").html(data);

				           console.log("From getVal() data Entered successfully!-> "+data);
				           console.log(data); 
				          

				          

				        },
				        error: function(jqXHR, textStatus, errorThrown) {
				           console.log(textStatus, errorThrown);
				        }


					    });	

		        



		}/*/









function getQty()//Gets Quantity value from text field
{
 
    event.preventDefault();
 	var Qty=$("#TxtQty").val();
 	console.log(Qty);

 	console.log("This is from function getQty()"+Qty);

 	var Quantity="";
 	var Quantity=JSON.stringify(Qty);
 

}

function Reset()//
{

}










/*This This part sends all good to minicart*/
/*This This part sends all good to Cart Check out*/
