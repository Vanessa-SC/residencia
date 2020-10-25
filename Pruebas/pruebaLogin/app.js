var app = angular.module('myApp', ['ngRoute']);

app.config(function($routeProvider, $locationProvider) {
	$routeProvider.when('/', {
		templateUrl: 'login.html',
		controller: 'loginCtrl'
	}).when('/logout',{
		resolve: {
			deadResolve: function($location, user) {
				user.clearData();
				$location.path('/');
			}
		}
	}).when('/login', {
		templateUrl: 'login.html',
		controller: 'loginCtrl'
	}).when('/inicio', {
		resolve: {
			check: function($location, user) {
				if(!user.isUserLoggedIn()) {
					$location.path('/login');
				}
			},
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
	};

	this.getName = function() {
		return username;
	};

	this.setID = function(userID) {
		id = userID;
	};
	
	this.getID = function() {
		return id;
	};

	this.isUserLoggedIn = function() {
		if(!!localStorage.getItem('login')) {
			loggedin = true;
			var data = JSON.parse(localStorage.getItem('login'));
			username = data.username;
			id = data.id;
		}
		return loggedin;
	};

	this.userLoggedIn = function() {
		loggedin = true;
	};

	this.saveData = function(data) {
		username = data.user;
		id = data.id;
		loggedin = true;
		localStorage.setItem('login', JSON.stringify({
			username: username,
			id: id
		}));
	};

	this.clearData = function() {
		localStorage.removeItem('login');
		username = "";
		id = "";
		loggedin = false;
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
				// user.userLoggedIn();
				// user.setName(response.data.user);
				user.saveData(response.data);
				$location.path('/inicio');
			} else {
				alert('Verifique que sus datos sean correctos');
			}
		});
	}
});


app.controller('inicioCtrl', function($scope, $http, $location, user) {

	$scope.user = user.getName();

	$scope.salir = function(){
		$location.path('/logout');
	}
});