//Main Angular JS app for Hotel Client

var app = angular.module('HCapp', ["ngRoute"]);
app.controller('HCCtrl', function($location,$scope) {
    console.log("HCappMain Active");
	        var page='food';		
			$scope.go=function(){
				 $location.path('/' + page);
				
				}
	
});

