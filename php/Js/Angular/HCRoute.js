//Route configaration for hotel client page

app.config(function($routeProvider) {
    $routeProvider
    .when("/food", {
        templateUrl : "food.php",
        call:alert("hello food")
    })
    .when("/beverage", {
        templateUrl : "beverage.php"
    })
    .when("/utility", {
        templateUrl : "utility.php"
    })
    .when("/Purchase Record", {
        templateUrl : "Purchase Record.php"
    })
    .when("/Transaction History", {
        templateUrl : "Transaction History.php"
    })
    .when("/Compare Products", {
        templateUrl : "Compare Products.php"
    });
});

