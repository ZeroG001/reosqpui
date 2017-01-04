angular.module('scheduleItemList').component( 'scheduleItemList', {
	templateUrl: "schedule-item-list/schedule-item-list.template.html",
	restrict: "E",
	controllerAs: "scheduleItems",
	controller: ['$http', '$routeParams', 
	function scheduleItemsController($http, $routeParams) {

		var scheduleItems = this;
		this.scheduleId = $routeParams.scheduleId;



		// Suspend Schedule Item 
		// ------------------------------------
		scheduleItems.suspendScheduleItem = function(scheduleItem) {

			var postConfig = { headers: {'Content-Type': 'application/x-www-form-urlencoded'} }

			$http.post('getTransactions.php', "type=suspendScheduleItem&scheduleItemId=" + scheduleItem.schedule_item_id , postConfig).then( function(response) {
				console.log("was the item suspended?");
				console.log(response.data);

				scheduleItems.getScheduleItems(scheduleItems.scheduleId);
			});

		}



		// Activate Schedule Item
		// ------------------------------------
		scheduleItems.activateScheduleItem = function(scheduleItem) {

			var postConfig = { headers: {'Content-Type': 'application/x-www-form-urlencoded'} }

			$http.post('getTransactions.php', "type=activateScheduleItem&scheduleItemId=" + scheduleItem.schedule_item_id , postConfig).then( function(response) {
				console.log("was the schedule activated?");
				console.log(response.data);
				scheduleItems.getScheduleItems(scheduleItems.scheduleId);
			});

		}



		// Get Schedule Items
		// ------------------------------------
		scheduleItems.getScheduleItems = function(scheduleId) {

			var postConfig = { headers: {'Content-Type': 'application/x-www-form-urlencoded'} }

			$http.post('getTransactions.php', "type=scheduleItems&scheduleId=" + scheduleId , postConfig).then( function(response) {
				scheduleItems.scheduleItems = response.data;
				console.log(scheduleItems.scheduleItems.results);
			});
		}




		// Controller Main Action 
		// -----------------------------------
		scheduleItems.getScheduleItems(scheduleItems.scheduleId);
	
		
	}
]
});
