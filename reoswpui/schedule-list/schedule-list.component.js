angular.module('scheduleList').component( 'scheduleList',{
	templateUrl: "schedule-list/schedule-list.template.html",
	restrict: "E",
	controllerAs: "schedules",
	controller: function($http, $routeParams) {


		// ------------ Schedule Variables ------------
		var schedules = this;
		var postConfig = { headers: {'Content-Type': 'application/x-www-form-urlencoded'} }
		schedules.scheduleProp = "ts_schedule_created_date";


		// ------------ Schedule Functions ------------
		schedules.getScheduleItems = function(scheduleObj) {
			$http.post('getTransactions.php', "type=schedules&scheduleId="+scheduleObj.schedule_id, postConfig).then( function(response) {
			});

		}


		schedules.activateSchedule = function(schedule) {

			var postConfig = { headers: {'Content-Type': 'application/x-www-form-urlencoded'} }


			$http.post('getTransactions.php', "type=activateSchedule&scheduleId=" + schedule.schedule_id , postConfig).then( function(response) {
				

				// Show error message if message is returned
				if(response.data.response.response_desc) {
					alert(response.data.response.response_desc);
				}

				// Updated the schedule list after the update is complete.
				schedules.showSchedules();

			});
		}



		// This function might be a little hard to test
		schedules.getSchedules = function() {

			$http.post('getTransactions.php', "type=schedules", postConfig).then( function(response) {

				schedules.schedules = response.data;
				console.log(response.data);

				// Convert time to a timestamp that can be sorted
				for (i in schedules.schedules.results) {
					schedules.schedules.results[i].ts_schedule_create_date = schedules.parseDate(schedules.schedules.results[i].schedule_created_date);
				}
			});

		}


		schedules.deleteSchedule = function(schedule) {

			console.log("Schedule has been deleted."); 
			var postConfig = { headers: {'Content-Type': 'application/x-www-form-urlencoded'} }

			$http.post('getTransactions.php', "type=deleteSchedule&scheduleId=" + schedule.schedule_id , postConfig).then( function(response) {

				// Show error message if message is returned
				if(response.data.response.response_desc) {
					alert(response.data.response.response_desc);
				}

				schedules.showSchedules();
			});

		}


		schedules.getCustomerSchedules = function(customerId) {

			$http.post('getTransactions.php', "type=customerSchedules&customerId=" + customerId, postConfig).then( function(response) {

				schedules.schedules = response.data;
				console.log(response.data)

				// Convert time to a timestamp that can be sorted
				for (i in schedules.schedules.results) {
					schedules.schedules.results[i].ts_schedule_create_date = schedules.parseDate(schedules.schedules.results[i].schedule_created_date);
				}
			});


		}


		schedules.parseDate = function(dateString) {

			// Test if dat is in correct format
			dateRegex = /\d{4}\-\d{2}\-\d{2}[T]\d{2}:\d{2}:\d{2}/i;

			if(!dateRegex.test(dateString)) {
				console.log("Date format received is incorrect. See if forte payment system has changed the date settings");
				return false;
			}

			dateTimeSplit = dateString.split("T");
			  
			  date = dateTimeSplit[0];
			  time = dateTimeSplit[1];
			  
			  dateSplit = date.split("-");
			  year = dateSplit[0];
			  month = dateSplit[1];
			  day = dateSplit[2];
			  
			  timeSplit = time.split(":");
			  hour = timeSplit[0];
			  minute = timeSplit[1];
			  second = timeSplit[2].split(".")[0];
			  
			  date = new Date(year, month, day, hour, minute, second);
			  timeStamp = date.getTime() / 1000;
			  return timeStamp;

			}



			schedules.showSchedules = function() {

				if($routeParams.customerId) {
					schedules.getCustomerSchedules($routeParams.customerId)
				} else {
					schedules.getSchedules();
					
				}

			}


		// ------------ Schedules Main Event ------------

		// If a customer id is coming from the route params they get the schedules for that person


		schedules.showSchedules();



	}
});
