<?php


//                 Import Secure Web Pay Code (Required)                   //
// ======================================================================= //     
	require_once('reoswp/includes/const.php');
	require_once('reoswp/includes/transaction.php');
// ======================================================================= //


	 
	# Sorry I had to repeat a bunch of code. If the programmer after me can refacotr this, that would be great.
?>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

	<head> 
		<title>REO Payment System</title>

		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" type="text/css" href="reoswp/css/vendor/sk_grid.css"> <!-- Docs. - http://getskeleton.com/ -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="reoswp/css/main.css" /> 


		<!-- <script type="text/javascript" src="https://checkout.forte.net/v1/js"> </script> -->
		<script type="text/javascript" src="https://sandbox.forte.net/checkout/v1/js"> </script>

	</head>

	

	<body>

		<noscript> Please enable Javascript to properly use this site </noscript>

	    <!-- Don't forget to activate on launch -->
	    <?php # require_once('analyticstracking.js'); ?>


		<div class="i_container">

		
			<div class="sk-container">


				<div class="pay-flash-message"> 
					<!-- When transaction is complete user will see flash message --> 
					heeelo I am a flash message
				</div>


				<section class="pay_category">

					<h1 style="color: #006DCC"> Online Payment </h1>

					<p class="pay-section-description">
						Real Estate One is proud to offer another payment alternative for our Sales Associates. 
						Please note that by using any of the payment options listed below, you agree to the <a href="#terms-section"> Terms and Conditions </a> listed at the bottom of this page.
					</p>

					<p>
						Please note that we&#39;ve recently changed payment processors and no longer use Paypal for accepting payments.  
						Current subscription payments will continue through Paypal until further notice.   
						Real Estate One does not collect or store the credit card information you enter.  
					</p>


					<div class="row">

						<div class="four columns">

							

							<div class="pay-content-box box-small">
								<!-- Pay Now -->
								<h3> Quick Pay </h3>


								<!-- 
									swp-modal-popup *HAS* to be "next" for any of this to work :/	
								-->
								<button class="swp-modal-open">
									Click Here
								</button>

								<div class="swp-modal-popup">
								
									<div class="swp-modal-content">
										<div class="swp-modal-header">
										<h4>REO Online Payment</h4>
										<button class="swp-modal_close">×</button>
										</div>

										<div class="swp-modal-body">
											<div class="legend">
												<span> Please enter your info </span>
											</div>
											<input type="text" class="modal-input-field xdata_1" id="xdata_1" placeholder="6 Digit License Number" maxlength="6" />
											<input type="text" class="modal-input-field xdata_2" id="xdata_2" placeholder="5 Digit Pay Number As Shown On Your Invoice" maxlength="5" />
											<input type="text" class="modal-input-field email_address" id="xdata_email_address" placeholder="Email address *" maxlength="50" />
											<textarea class="modal-input-field xdata_3" id="xdata_3" maxlength="80" placeholder="Special Instructions (80 Characters)"></textarea>
										</div>

										<div class="swp-modal-footer">
											<button api_login_id="<?php echo APIKEY ?>"
												class="swp-modal-button"
												method="sale"
												billing_company_name_attr="hide"
												billing_street_line2_attr="hide"
												version_number="1.0"
												utc_time="<?php echo $quick_pay->utc_time ?>"
												hash_method="md5"
												signature="<?php echo $quick_pay->create_signature() ?>"
												callback="oncallback_sale"
												total_amount=""
												order_number="<?php echo $quick_pay->order_number ?>"
												xdata_1="n/a"
												xdata_2="n/a"
												xdata_3=""
												disabled>
											    </span>Next<span>
											</button>

										</div>

									</div>

								</div> <!-- Modal Popup End -->

							</div> <!-- Content box end -->

						</div>

						<div class="eight columns">

							<h2 class="pay-section-header"> One-Time Payment </h2>

							<p>
								Make a payment on your account. 
								Enter the AMOUNT DUE, as shown on the Real Estate One Invoice/Statement, in the box below and click the Pay Now button. 
								Additionally, payments greater than the amount due are also accepted (pay in advance, carry a credit balance, and not worry about due dates, late fees and interest). 
								See additional <a href="#terms-section"> Terms and Conditions </a> below. 
							</p>

						</div>

					</div>

				</section>


				<section class="pay_category">	

					<div class="row">

						<div class="four columns">

							
							<div class="pay-content-box box-small">
								<!-- Pay Now -->
								<h3> Recurring Payment </h3>


								<!-- 
									swp-modal-popup *HAS* to be "next" for any of this to work :/	
								-->
									<button api_login_id="<?php echo APIKEY ?>"
										class=" swp-modal-open"
										method="schedule"
										billing_company_name_attr="hide"
										billing_street_line2_attr="hide"
										version_number="1.0"
										utc_time="<?php echo $plan_custom->utc_time ?>"
										hash_method="md5"
										signature="<?php echo $plan_custom->create_signature() ?>"
										callback="oncallback_sale"
										total_amount=""
										schedule_start_date="<?php echo $schedule_begin ?>"
										schedule_frequency="weekly"
										schedule_continuous="true"
										order_number="<?php echo $plan_custom ->order_number ?>"
										xdata_1="n/a"
										xdata_2="n/a"
										xdata_3=""
										>
									    </span>Start<span>
									</button>


							</div> <!-- Content box end -->

						</div>

						<div class="eight columns">

							<h2 class="pay-section-header"> One-Time Payment </h2>

							<p>
								Make a payment on your account. 
								Enter the AMOUNT DUE, as shown on the Real Estate One Invoice/Statement, in the box below and click the Pay Now button. 
								Additionally, payments greater than the amount due are also accepted (pay in advance, carry a credit balance, and not worry about due dates, late fees and interest). 
								See additional <a href="#terms-section"> Terms and Conditions </a> below. 
							</p>

						</div>

					</div>

				</section>







			</div> <!-- Skeleton Container End -->


			<div class="swp-section-wrap">
				<section class="pay_category" id="terms-section">

					<h2 class="pay-section-header"> Terms and Conditions </h2>

					<ol class="terms-conditions-list">
						<li> All payments are processed through an independent third party pay system (Forte Payment Systems).  Accordingly, Real Estate One does not retain any confidential credit card information. </li>
						<li> Payments will be applied to REO Sales Associate's A/R when received from third party pay system (generally the same day). <strong> Payments received by 3:00 p.m. Monday - Friday will be applied the same day. Payments received after 3:00 p.m. Monday - Friday or on weekends or holidays will be applied the following business day. </strong> </li>
						<li> Late fees and interest will be charged to past due accounts in accordance with Company policy.  While auto pay may reduce the risk of becoming past due, Sales Associates are responsible for reviewing monthly statements and ensuring that the account is paid current.  Real Estate One is not responsible for rejected credit card payments, NSF fees, or other costs. </li>
					</ol>

				</section>
			</div>
		</div>

		<div id="ajax-response-body">
			something should appear in her
		</div>


	</body>

	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"> </script>
	<script type="text/javascript" src="reoswp/js/app.js"> </script>

</html>