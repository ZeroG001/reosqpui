angular.module('scheduleList').component( 'scheduleList',{
	templateUrl: "schedule-list/schedule-list.template.html",
	restrict: "E",
	controllerAs: "schedules",
	controller: function($http) {



// action, customer_token, links, location_id, order_number, paymethod_token, schedule_amount, schedule_created_date, 
// schedule_frequency, schedule_id, schedule_quantity, schedule_start_date, schedule_status, sec_code, ts_schedule_create_date



		// ------------ Schedule Variables ------------
		var schedules = this;
		var postConfig = { headers: {'Content-Type': 'application/x-www-form-urlencoded'} }
		schedules.scheduleProp = "ts_schedule_created_date";


		// ------------ Schedule Functions ------------
		schedules.getScheduleItems = function(scheduleObj) {
			console.log(scheduleObj);
			$http.post('getTransactions.php', "type=schedules&scheduleId="+scheduleObj.schedule_id, postConfig).then( function(response) {
			});

		}



		schedules.activateSchedule = function(schedule) {

			var postConfig = { headers: {'Content-Type': 'application/x-www-form-urlencoded'} }

			console.log(schedule);


			$http.post('getTransactions.php', "type=activateSchedule&scheduleId=" + schedule.schedule_id , postConfig).then( function(response) {
				
				console.log("beginning to activate schedule");
	

				// Updated the schedule list after the update is complete.
				schedules.getSchedules();
				console.log("updating to active complete?");
				console.log(response.data);
			});
		}
	// https://auth.leadingre.com/intralink.aspx?COID=2543&UniqueID=244496
	// https://access.leadingre.com/intralink.aspx?COID=2543&UniqueID=244496


		// This function might be a little hard to test
		schedules.getSchedules = function() {

			$http.post('getTransactions.php', "type=schedules", postConfig).then( function(response) {

				schedules.schedules = response.data;
				console.log(response.data)

				// Convert time to a timestamp that can be sorted
				for (i in schedules.schedules.results) {
					schedules.schedules.results[i].ts_schedule_create_date = schedules.parseDate(schedules.schedules.results[i].schedule_created_date);
				}
			});

		}



		schedules.deleteSchedule = function(schedule) {

			console.log("schedule has been deleted."); 
			var postConfig = { headers: {'Content-Type': 'application/x-www-form-urlencoded'} }

			console.log(schedule);

			$http.post('getTransactions.php', "type=deleteSchedule&scheduleId=" + schedule.schedule_id , postConfig).then( function(response) {
				console.log("was the item deleted?");
				console.log(response.data);
				schedules.getSchedules();
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
			  console.log(parseInt(timeStamp));
			  return timeStamp;

			}


		// ------------ Schedules Main Event ------------

		schedules.getSchedules();


	}
})
