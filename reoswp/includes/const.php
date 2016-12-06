<?php

# Set UTC time. If time isn't correct tranaction will not work send.
date_default_timezone_set('UTC');

// Test Keys
define("APIKEY", "y62W6EUoi5");
define("TKEY", "2nR8S4lC"); # Transaction Key


/*

Switching Between DEV and Procuction
Go to reoswp.php and use the following script (depending on whether you're in production or testing)
		
		Production
		<script type="text/javascript" src="https://checkout.forte.net/v1/js"> </script>

		Testing
		<script type="text/javascript" src="https://sandbox.forte.net/checkout/v1/js"> </script>

*/


?>
