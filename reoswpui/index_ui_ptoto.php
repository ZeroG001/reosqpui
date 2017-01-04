<!DOCTYPE html>
<html>
	<head>

		<title></title>
		<!-- <link rel="stylesheet" type="text/css" href="swpui.css"> -->
	    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
	    <link rel="stylesheet" href="assets/css/Sidebar-Menu.css">
	    <link rel="stylesheet" href="assets/css/Sidebar-Menu1.css">
	    <link rel="stylesheet" href="assets/css/styles.css">

	</head>

	<body  ng-app="REOPayManager">

	    <div id="wrapper">
	        <div id="sidebar-wrapper">
	            <ul class="sidebar-nav">
	                <li> <a href="#">Home </a></li>
	                <li> <a href="#">Schedules </a></li>
	                <li> <a href="#">Users </a></li>
	            </ul>
	        </div>
	        <div class="page-content-wrapper">
	            <div class="container-fluid"><a class="btn btn-link" role="button" href="#menu-toggle" id="menu-toggle"><i class="fa fa-bars"></i></a>
	                <div class="row">
	                    <div class="col-md-12">
	                        <div class="page-header">
	                            <h1>Test <small>Manage Payments?</small></h1></div>
	                    </div>
	                    <div ng-view> </div>
	                </div>
	            </div>
	        </div>
	    </div>

	</body>

</html>
<!--  <script type="text/javascript" src="http://10.9.63.109/reoswp/reoswp/js/vendor/jquery/jquery.min.js"></script> -->
<script type="text/javascript" src="bower_components/angular/angular.min.js"></script>
<script type="text/javascript" src="bower_components/angular-route/angular-route.min.js"></script>

<!-- Other assets -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/Sidebar-Menu.js"></script>

<script type="text/javascript" src="app.module.js"></script>
<script type="text/javascript" src="app.config.js"> </script>
<script type="text/javascript" src="schedule-list/schedule-list.module.js"></script>
<script type="text/javascript" src="schedule-list/schedule-list.component.js"></script>
<script type="text/javascript" src="customer-list/customer-list.module.js"> </script>
<script type="text/javascript" src="customer-list/customer-list.component.js"></script>
<script type="text/javascript" src="schedule-item-list/schedule-item-list.module.js"></script>
<script type="text/javascript" src="schedule-item-list/schedule-item-list.component.js"></script>



