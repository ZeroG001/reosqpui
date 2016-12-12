(function($){
	


	// ------------------------- Ajax Actions -------------------------
	var ajaxResults = null;



	// GET Schedules
	// ------------------------------------
	function getTransactions() {

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


	function getTransactionUsers() {

		$.ajax({
			type: "GET",
			data: {"type": "user_schedules"},
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
			finalHtml = finalHtml +  "<div class='result__order_number'>" + results[i].order_number + "</div>";	
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


	function searchTransactionOrderNumber(string, results) {
		// check if results are in
		if(!ajaxResultsAreIn) {return false;}

		fil = function(ele) {
			if (string == "") {
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
	getTransactions();

	$("#search").keyup(function(){
		console.log($(this).val());
		searchTransactionOrderNumber( $(this).val(), ajaxResults );

	});

	$("#getTransactions").click(function(){
		getTransactions();

	})


	$("#getTransactionUsers").click(function(){
		getTransactionUsers();

	})

})(jQuery)
