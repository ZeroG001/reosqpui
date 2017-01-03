angular.module('scheduleItemList').component( 'scheduleItemList', {
	templateUrl: "schedule-item-list/schedule-item-list.template.html",
	restrict: "E",
	controllerAs: "scheduleItems",
	controller: ['$http', '$routeParams', 
	function scheduleItemsController($http, $routeParams) {

		var scheduleItems = this;
		this.scheduleId = $routeParams.scheduleId;

		var postConfig = { headers: {'Content-Type': 'application/x-www-form-urlencoded'} }


		$http.post('getTransactions.php', "type=scheduleItems&scheduleId=" + scheduleItems.scheduleId , postConfig).then( function(response) {
			scheduleItems.scheduleItems = response.data;
			console.log(scheduleItems.scheduleItems.results);
		});
		

	}

]
});



