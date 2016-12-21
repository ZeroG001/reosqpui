angular.module('scheduleList').component( 'scheduleList',{
	templateUrl: "schedule-list/schedule-list.template.html",
	restrict: "E",
	controllerAs: "schedules",
	controller: function($http) {

		var schedules = this;

		var postConfig = {
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}

		$http.post('http://10.9.63.109/reoswp/swpuiactions/getTransactions.php', "type=schedules", postConfig).then( function(response) {
			schedules.schedules = response.data;
			console.log(schedules.schedules.results);
		});

	}
})






