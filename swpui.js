(function($){
	


	// ------------------------- Ajax Actions -------------------------
	var ajaxResults = null;



	// GET Schedules
	// ------------------------------------
	function getSchedules() {

		$.ajax({
			type: "POST",
			data: {"type": "schedules"},
			url: "swpuiactions/getTransactions.php",
			beforeSend: function() {
				ajaxResults = [];
				// Show some sort of loading thing.
				$(".result").text("loading");
			},
			success: function(response) {

				console.log(JSON.parse(response));
				var resultsJSON = JSON.parse(response);
				var results = resultsJSON.results;
				ajaxResults = results;
				showResults(results);
				
			}
		})
	}



	function getScheduleItems(scheduleId) {

		$.ajax({
			type: "POST",
			data: {"type": "scheduleitems", "scheduleId" : scheduleId},
			url: "swpuiactions/getTransactions.php",
			beforeSend: function() {
				ajaxResults = [];
				// Show some sort of loading thing.
				$(".result").text("loading");
			},
			success: function(response) {

				console.log(JSON.parse(response));
				var resultsJSON = JSON.parse(response);
				var results = resultsJSON.results;
				ajaxResults = results;
				showResults(results);

			}
		})
	}



	function getCustomers() {

		$.ajax({
			type: "POST",
			data: {"type": "customers"},
			url: "swpuiactions/getTransactions.php",
			beforeSend: function() {
				ajaxResults = [];
				// Show some sort of loading thing.
				$(".result").text("loading");
			},
			success: function(response) {

				console.log(JSON.parse(response));
				var resultsJSON = JSON.parse(response);
				var results = resultsJSON.results;
				ajaxResults = results;
				showResults(results);

			}
		})
	}
	
	
		
	// Should only take the results array from the API response
	function showResults(results = ajaxResults) {

		finalHtml = "";

		console.log(results);
		
		for (i in results) {

			if( results[i].order_number ) {
				finalHtml = finalHtml + "<div class='result__order_number'>" + results[i].order_number + "</div>";
			}


			if( results[i].links.scheduleitems ) {
				actionUrl = parseUrlForScheduleItems(results[i].links.scheduleitems);
				finalHtml = finalHtml + "<button value='" + actionUrl + "' class='result__order_number result__scheduleitems'> Click Here </button>";
			}


			if( results[i].first_name && results[i].last_name ) {
				finalHtml = finalHtml + "<div class='result__order_number'>" + results[i].first_name + " " + results[i].last_name + "</div>";
			}
			
		}

		$(".result").html(finalHtml);

	}



	function ajaxResultsAreIn() {
		if(ajaxResults  == null ) {
			return false;
		} else {
			return true;
		}
	}



	function parseUrlForScheduleItems(url) {

	    myFilter = function(ele) {
	      regex = /[sch]+_[\w||+?-]+/i;
	      return regex.test(ele);
	    }

			var urlArr = url.split("/");
			filteredArray =	urlArr.filter(myFilter);
	  		return filteredArray[0]
	 
	}



	function searchTransactionOrderNumber(string, results) {
		// check if results are in
		if(!ajaxResultsAreIn) {return false;}

		fil = function(ele) {

			if ( string == "" ) {
				return true;
			}

			return ele.order_number.includes(string)
		}

		finalArray = results.filter(fil);
		showResults(finalArray);
	}


	function followLink() {
		// for this method I want to send a url as the data, then use this data to get information on that specific link
		// so if I clicke on https://sandbox.forte.net/API/v3/schedules/sch_bfe64af4-6e40-4156-85b1-c26757df1b2a/scheduleitems. It would show me the data and everything for that link.
	}

	function cancelSchedule() {}

	function deleteSchedule() {}


	// Search Schedules
	// ------------------------------------	




	// -------------------- Main Event --------------------------
	// Get All Transactions
	getSchedules();
	

	$("#search").keyup(function(){
		console.log($(this).val());
		searchTransactionOrderNumber( $(this).val(), ajaxResults );
	});



	$("#getTransactions").click(function() {
		getSchedules();
	})






	$("#getTransactionUsers").click(function() {
		getCustomers();
	})

})(jQuery)
