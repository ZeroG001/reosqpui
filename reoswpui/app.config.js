'use strict';

angular.
	module('REOPayManager').
	config(['$locationProvider', '$routeProvider', 
		function config($locationProvider, $routeProvider) {

			$locationProvider.hashPrefix('!');

			$routeProvider.
				when('/schedules', {
					template: '<schedule-list></schedule-list>'
				}).
				when('/schedules/:scheduleId', {
					template: '<schedule-item-list></schedule-item-list>'
				}).
				when('/customers', {
					template: '<customer-list></customer-list>'
				}).
				otherwise('/schedules', {
					template: '<schedule-list></schedule-list>'
				})
		}

	]);


