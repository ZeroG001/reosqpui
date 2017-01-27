angular.module('transactionList').component('transactionList', {
	templateUrl: "transaction-list/transaction-list.template.html",
	restrict: "E",
	controllerAs: "transactions",
	controller: ['$http', '$routeParams',
	function($http, $routeParams) {

		var transactions = this;
		this.transactionId = $routeParams.transactionId;

		var postConfig = { headers: {'Content-Type': 'application/x-www-form-urlencoded'} }



		transactions.getTransactions = function() {

			

			$http.post('getTransactions.php', "type=transactions", postConfig).then( function(response) {

				transactions.transactions = response.data;
				console.log(response.data);

				// Convert time to a timestamp that can be sorted
				// for (i in transactions.schedules.results) {
				// 	transactions.schedules.results[i].ts_schedule_create_date = transactions.parseDate(transactions.schedules.results[i].schedule_created_date);
				// }
			});

		}


		transactions.getCustomerTransactions = function(customerId) {

			$http.post('getTransactions.php', "type=customerTransactions&customerId=" + customerId, postConfig).then( function(response) {

				transactions.transactions = response.data;
				console.log(response.data)
			});


		}



		transactions.refindTransactions = function(customerId) {

			$http.post('getTransactions.php', "type=customerTransactions&customerId=" + customerId, postConfig).then( function(response) {

				transactions.transactions = response.data;
				console.log(response.data)
			});


		}





			transactions.showTransactions = function() {

				if($routeParams.customerId) {
					console.log("re go route params");
					transactions.getCustomerTransactions($routeParams.customerId)
				} else {
					transactions.getTransactions();
					
				}

			}


			transactions.showTransactions();


		


	}
]
})
