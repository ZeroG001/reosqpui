( function() {

	var app = angular.module('REOPayManager', []);

	app.controller("ReoPayManagerController", ['$http', '$log', function($http,$log){
		var payManager = this;

		this.name = "blayne"


		payManager.schedules = [];
		payManager.customers = [];

		this.schedules = $http.post('http://10.9.63.109/reoswp/swpuiactions/getTransactions.php', {"type": "schedules"}).then(function(response){
			payManager.schedules = response
		}) ;


	}]);



})();



