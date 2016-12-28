angular.module('customerList').component('customerList', {
	templateUrl: "customer-list/customer-list.template.html",
	restrict: "E",
	controllerAs: "customers",
	controller: function($http) {

		var customers = this;

		var postConfig = { headers: {'Content-Type': 'application/x-www-form-urlencoded'} }

		$http.post('getTransactions.php', "type=customers", postConfig).then( function(response) {
			customers.customers = response.data;
			console.log(customers.customers.results);
		});

	}

});