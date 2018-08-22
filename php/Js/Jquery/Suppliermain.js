$(document).ready(function(){

//This sis the script for prcessing ordesfrom suppliers with reference to their category
 //View TranactionStatus
 $("#TranactionStatus").click(function(event){
   event.preventDefault();
     console.log("TranactionStatus");
 });

 //View NewOrders
 $("#NewOrders").click(function(event){
   event.preventDefault();
   $.ajax({
     url:"php/AutomaticPurchaseOrder.php",//Display orders genereated  from sales
     method:"GET",
     data:{GetOrder:1},
     success:function(data){
     $("#DisplayOrderListContent").html(data);

    // timer();
    
     console.log(data)},
     error: function(jqXHR, textStatus, errorThrown) {
                 console.log(textStatus, errorThrown);
              }


  });
   
var day;
var hours;
var minutes;
var seconds;
function timer(){

  //Alert supplier
 //Set the date we're counting down to
var countDownDate = new Date().getTime()+(59*60*1000);


// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
        //hide order
        $("#formOder").hide();
        return true;
    }
    else if(distance>0){
     // timer();
      return false

    }
}, 1000);

}



});
  
      //This sub part is concenrd with counting the number of cofrimed 
      //orders
   
    var PRODUCT_NAME;
    var UNIT; 
    var QUANTITY;
    var count=0;
    var Recount=0;
    var PRICE_PER_UNIT;
    var TOTAL;
    var TOTAL_PRICE;
 

$(document).delegate("#UnitPrice","blur",function(event){

PRICE_PER_UNIT=$(this).text();
console.log ('This is the price per unit '+PRICE_PER_UNIT);
   
});

 console.log ("\n"+'Outside function vLUE This is the price per unit '+PRICE_PER_UNIT);
   $(document).delegate("#ItemConfirm","click",function(event){

        day=0;
        hours=0;
        minutes=0;
        seconds=0;
        
        PRICE_PER_UNIT;
        PRODUCT_NAME=$(this).attr('PRODUCT_NAME');
        var Image=$(this).attr('Image');
        QUANTITY=$(this).attr('QUANTITY');
        UNIT=$(this).attr('UNIT');
        TOTAL_PRICE=PRICE_PER_UNIT*QUANTITY;
        //TOTAL_PRICE=$(this).attr('TOTAL_PRICE');



        //Make ajax call to data base 
        $.ajax({
               url:"php/AutomaticPurchaseOrder.php",//Display orders genereated  from sales
               method:"POST",
               data:{AddToPurchaseList:1,Image:Image,TOTAL_PRICE:TOTAL_PRICE,PRICE_PER_UNIT:PRICE_PER_UNIT,PRODUCT_NAME:PRODUCT_NAME,QUANTITY:QUANTITY,UNIT:UNIT},
               success:function(data){
               $("#FormFeedBack").html(data);
               //Cancel or reset clock time to zero

               //timer(day,hours,minutes,seconds);
               console.log(data)},
               error: function(jqXHR, textStatus, errorThrown) {
                           console.log(textStatus, errorThrown);
                        }


        });
       
     console.log("Adding  supply of item: "+PRODUCT_NAME+"\n"+"Quantity: "+QUANTITY+"\n"+"Unit "+ UNIT+" ITEM NO:"+count+"\n"+"Recount: "+Recount+"\n"+"The price per unit "+PRICE_PER_UNIT+"\n"+"Total price"+TOTAL_PRICE);
       
      
   
          


 });

$(document).delegate("#ItemUnConfirm","click",function(event){
        
        PRICE_PER_UNIT;
        PRODUCT_NAME=$(this).attr('PRODUCT_NAME');
        QUANTITY=$(this).attr('QUANTITY');
        UNIT=$(this).attr('UNIT');
        TOTAL_PRICE=PRICE_PER_UNIT*QUANTITY;

        //Make ajax call to data base 
        $.ajax({
               url:"php/AutomaticPurchaseOrder.php",//Display orders genereated  from sales
               method:"POST",
               data:{RemoveFromPurchaseList:1,TOTAL_PRICE:TOTAL_PRICE,PRICE_PER_UNIT:PRICE_PER_UNIT,PRODUCT_NAME:PRODUCT_NAME,QUANTITY:QUANTITY,UNIT:UNIT},
               success:function(data){
               $("#FormFeedBack").html(data);
               console.log(data)},
               error: function(jqXHR, textStatus, errorThrown) {
                           console.log(textStatus, errorThrown);
                        }


        });
       
console.log("Removing  item: "+PRODUCT_NAME+"\n"+"Quantity: "+QUANTITY+"\n"+"Unit "+ UNIT+" ITEM NO:"+count+"\n"+"Recount: "+Recount+"The price per unit "+PRICE_PER_UNIT+"\n"+"Total price"+TOTAL_PRICE);
       
      
   
          


 });

//Button to confirm order
$(document).delegate("#btnConfirm","click",function(event){
event.preventDefault();
//Perform an ajax request to count the number of rows were CONFIRMED AND RETURN MAXIMUM COLUMN
console.log("confirm order");
 //Make ajax call to data base 
        $.ajax({
               url:"php/AutomaticPurchaseOrder.php",//Display orders genereated  from sales
               method:"POST",
               data:{btnConfirm:1,PRODUCT_NAME:PRODUCT_NAME,QUANTITY:QUANTITY,UNIT:UNIT},
               success:function(data){
               $("#DisplayOrderListContent").html(data);
               console.log(data)},
               error: function(jqXHR, textStatus, errorThrown) {
                           console.log(textStatus, errorThrown);
                        }


        });

});

//Button to reject order
$(document).delegate("#btnReject","click",function(event){
//perform an ajax reques to store this as rejected order
event.preventDefault();

console.log("reject order");
 //Make ajax call to data base 
        $.ajax({
               url:"php/AutomaticPurchaseOrder.php",//Display orders genereated  from sales
               method:"GET",
               data:{btnReject:1},
               success:function(data){
               $("#DisplayOrderListContent").html("<div class='alert alert-warning'><a href='#' class='close' data-dismis='alert' arial-lable='close'>&times</a><b>SUPPLY ORDER DELETED WAITIG FOR NEW ORDER LIST </b></div>");
               console.log(data)},
               error: function(jqXHR, textStatus, errorThrown) {
                           console.log(textStatus, errorThrown);
                        }


        });

});


  

 //View Transactionhistory
 $("#Transactionhistory").click(function(event){
   event.preventDefault();
   console.log("Transactionhistory");
   $.ajax({
               url:"php/AutomaticPurchaseOrder.php",//Display orders genereated  from sales
               method:"GET",
               data:{GetTransactionHistory:1},
               success:function(data){
               $("#DisplayOrderListContent").html(data);
               console.log(data)},
               error: function(jqXHR, textStatus, errorThrown) {
                           console.log(textStatus, errorThrown);
                        }


        });

 });

 //View InboundPayments
 $("#ConfirmedSupply").click(function(event){
   event.preventDefault();
   console.log("ConfirmedSupply");
   $.ajax({
               url:"php/AutomaticPurchaseOrder.php",//Display orders genereated  from sales
               method:"GET",
               data:{GetConfirmedSupplyOrder:1},
               success:function(data){
               $("#DisplayOrderListContent").html(data);
               console.log(data)},
               error: function(jqXHR, textStatus, errorThrown) {
                           console.log(textStatus, errorThrown);
                        }


        });

 });

 //View PendingPayment
 $("#PendingPayment").click(function(event){
   event.preventDefault();
   console.log("PendingPayment");

 });

 //View CanceledPayments
 $("#CanceledPayments").click(function(event){
   event.preventDefault();
   console.log("CanceledPayments");

    $.ajax({
               url:"php/AutomaticPurchaseOrder.php",//Display orders genereated  from sales
               method:"GET",
               data:{CanceledPayments:1},
               success:function(data){
               $("#DisplayOrderListContent").html(data);
               console.log(data)},
               error: function(jqXHR, textStatus, errorThrown) {
                           console.log(textStatus, errorThrown);
                        }


        });

 });




});