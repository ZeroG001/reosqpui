<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="swpui.css">
	</head>

	<body>

		<div class="container" ng-app="REOPayManager">

		<p> {{ 1 + 2 }}</p>

		<div class="results" ng-controller="ReoPayManagerController as schedules"> 
			{{ schedules.schedules}}
		</div>
		

		</div>

	</body>

</html>
<!--  <script type="text/javascript" src="http://10.9.63.109/reoswp/reoswp/js/vendor/jquery/jquery.min.js"></script> -->
<script type="text/javascript" src="http://10.9.63.109/reoswp/angular/angular.min.js"></script>
<script type="text/javascript" src="http://10.9.63.109/reoswp/swpui.js"></script>
