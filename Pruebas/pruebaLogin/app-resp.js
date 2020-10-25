var app = angular.module('myApp', ['ngRoute']);

app.config(function($routeProvider, $locationProvider) {
	$routeProvider.when('/', {
		templateUrl: 'login.html',
		controller: 'loginCtrl'
	}).when('/login', {
		templateUrl: 'login.html',
		controller: 'loginCtrl'
	}).when('/inicio', {
		resolve: {
			check: function($location, user) {
				if (!user.isUserLoggedIn()) {
					$location.path('/login');
				}
			}
		},
		templateUrl: 'inicio.html',
		controller: 'inicioCtrl'
	}).otherwise({
		templateUrl: '404.html'
	});
	// $locationProvider.hashPrefix('');
	// $locationProvider.html5Mode({enabled:true, baseUrl:false});
});


app.service('user', function() {
	var username;
	var loggedin = false;
	var id;

	this.setName = function(name) {
		username = name;
	}
	this.getName = function() {
		return username;
	}

	this.setID = function(userID) {
		id = userID;
	}
	this.getID = function() {
		return id;
	}

	this.isUserLoggedIn = function() {
		return loggedin;
	}
	this.userLoggedIn = function() {
		loggedin = true;
	}
});



app.controller('loginCtrl', function($scope, $http, $location, user) {
	$scope.gotoInicio = function() {
		$location.path('/inicio');
	}

	$scope.login = function() {
		var username = $scope.username;
		var password = $scope.password;

		$http({
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/server.php',
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			data: 'username=' + username + '&password=' + password
		}).then(function(response) {
			if (response.data.status == 'loggedin') {
				user.userLoggedIn();
				user.setName(response.data.user);
				$location.path('/inicio');
			} else {
				alert('Verifique que sus datos sean correctos');
			}
		});
	}
});


app.controller('inicioCtrl', function($scope, $http, $location, user) {

	$scope.user = user.getName();
});