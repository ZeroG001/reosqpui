
// -------------------- Secure Web Pay Callbacks -------------------- //
function oncallback_sale(response) {

console.log(response);

	message = JSON.parse( response.data );


	// ABORTED TRANSACTION PROCESS
	if ( message.event === "abort" ) {
		// Alert div element shows how the event went. Then closes
		// $('.pay-flash-message').attr('class','pay-flash-message');
		$('.pay-flash-message').css('display', 'inline');
		$('.pay-flash-message').addClass('flash-message-notice');
		$('.pay-flash-message').addClass('slide-in-out');
		$('.pay-flash-message').text('Transaction Canceled');

		setTimeout(function(){
			$('pay-flash-message').removeClass("flash-message-notice");
			$('.pay-flash-message').css("display", "none");
		}, 5000);
	}


	// SUCCESSFUL TRANSACTION
	if ( message.event === "success" ) {

		responseData = {

			"trace_number" : message.trace_number, 
			"total_amount" : message.total_amount, 
			"response_description" : message.response_description,
			"order_number" : message.order_number,
			"last_4" : message.last_4,
			"method_used" : message.method_used,
			"xdata_3" : message.xdata_3
		}

		webPayMailer.sendEmail(responseData);


		//Send Confirmation Email

		// Alert div element shows how the event went. Then closes
		// $('.pay-flash-message').attr('class', 'pay-flash-message');
		$('.pay-flash-message').css('display', 'inline');
		$('.pay-flash-message').addClass('flash-message-success');
		$('.pay-flash-message').addClass('slide-in-out');
		$('.modal-input-field.email_address').val("");
		$('.pay-flash-message').html('<img src="img/checkmark_green.png" alt="success" /> <p> Thank You - Payment has been sent </p>');
		
		setTimeout(function(){
			$('.pay-flash-message').css("display", "none");
			$('.pay-flash-message').removeClass("flash-message-success");
		}, 5000);
	}


	// FAILED TRANSACTION
	if ( message.event === "failure" ) {

		// Alert div element shows how the event went. Then closes
		// $('.pay-flash-message').attr('class', 'pay-flash-message');
		$('.pay-flash-message').css('display', 'inline');
		$('.pay-flash-message').addClass('flash-message-warning');
		$('.pay-flash-message').addClass('slide-in-out');
		$('.pay-flash-message').html('<p> Payment Failed' + message.response_description + '. Payment was NOT processed</p>');

		setTimeout(function(){
	
			$('.pay-flash-message').removeClass("flash-message-warning");
			$('.pay-flash-message').css("display", "none");
		}, 5000);
	}

} //oncallback_sale End


function oncallback_sale_cust(response) {
	console.log(response);
}



function oncallback_schedule(response) {
}


var webPayMailer = {
"email" : "",
"sendEmail" : function (responseData) {
		responseData.email_address = $("#xdata_email_address").val();
		$.ajax({
			"method" : "POST",
			"data" : responseData,
			"url" : "reoswp/includes/sendEmail.php",
			"success" : function(response) {
				document.getElementById("ajax-response-body").innerHTML = response;
			}
		});
	}
};






(function($) {

	// ----------- Mini Validation ------------- //
	// Ensures the users are actually entering numbers

	var email_address_var = "bholland@realestateone.com";

	var validate = {
		"paynumFormat" : /\d{5}/i,
		"paynumber" : function(string) {
				//Ensure that we deal with a string
				string = string.toString();
				return string.match(this.paynumFormat) ? true : false;
		},

		"licenseFormat" : /\d{6}/i,
		"license_number" : function(string) {
			//Convert input to string 
			string = string.toString();
			return string.match(this.licenseFormat) ? true : false;
		},

		"emailFormat" : /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i,
		"emailAddress" : function(string) {
			//Convert input to string 
			string = string.toString();
			return string.match(this.emailFormat) ? true : false;
		},

		"enableButton" : function() {
			$('.swp-modal-button').attr('disabled', false);
			$('.swp-modal-button').css('cursor', 'pointer');
		},

		"disableButton" : function() {
			$('.swp-modal-button').attr('disabled', true);
			$('.swp-modal-button').css('cursor', 'not-allowed');
		}


	}

//


// ------------------- Payment Modal ------------------------


// ---- Modal Open ----
$('.swp-modal-open').click(function(){
	$(this).next('.swp-modal-popup').addClass('fade-in');
});



// ---- Modal Close ---
$('.swp-modal_close').click(function(){
	$('.swp-modal-popup').removeClass("fade-in");

	// Clear all form fields
	$('.modal-input-field.xdata_1').val("");
	$('.modal-input-field.xdata_2').val("");
	$('.modal-input-field.xdata_3').val("");
	$('.modal-input-field.email_address').val("");

	//Disabled the Buy now button
	$('.swp-modal-button').attr('disabled', true);
	$('.swp-modal-button').css('cursor','not-allowed');
});


// ------------- Quick Field Validation -------------
$(".modal-input-field").keyup(function(){

	if( ( validate.license_number($("#xdata_1").val()) || validate.paynumber($("#xdata_2").val()) ) && validate.emailAddress($("#xdata_email_address").val()) ) {
		validate.enableButton();

	} else {
		validate.disableButton();
	}

});


$(".modal-input-field").blur(function(){

	if( ( validate.license_number($("#xdata_1").val()) || validate.paynumber($("#xdata_2").val()) ) && validate.emailAddress($("#xdata_email_address").val()) ) {
		validate.enableButton();

	} else {
		validate.disableButton();
	}

});




// When you enter text in modal popup, that info is carried over to the forte button
$('.modal-input-field.xdata_1').one('focus', function() {
	$(this).keyup(function( e ) {
		$('.swp-modal-button').attr('xdata_1', $(this).val());
	});

});

$('.modal-input-field.xdata_2').one('focus', function() {
	$(this).keyup(function( e ) {
		$('.swp-modal-button').attr('xdata_2', $(this).val());
	});
});

$('.modal-input-field.xdata_3').one('focus', function() {
	$(this).keyup(function( e ) {
		$('.swp-modal-button').attr('xdata_3', $(this).val());	
	});
});


// ---- Modal Next Step ----
// When the next or buy button is clicked. Forte's modal shows
// Clean up the form before switching over
$('.swp-modal-button').click(function(event){


	$('.swp-modal-popup').removeClass("fade-in");

	$('.swp-modal-button').attr('disabled', true);
	$('.swp-modal-button').css('cursor','not-allowed');

	// Clear all modal input fields
	$('.modal-input-field.xdata_1').val("");
	$('.modal-input-field.xdata_2').val("");
	$('.modal-input-field.xdata_3').val("");
});




//----------------------------------------------------

})(jQuery);



