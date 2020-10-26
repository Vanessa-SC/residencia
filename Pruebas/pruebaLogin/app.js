var app = angular.module('myApp', ['ngRoute']);

app.config(function($routeProvider, $locationProvider) {
	$routeProvider.when('/', {
		templateUrl: 'login.html',
		controller: 'loginCtrl'
	}).when('/logout', {
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
				if (!user.isUserLoggedIn()) {
					$location.path('/login');
				}
			},
		},
		templateUrl: 'inicio.html',
		controller: 'inicioCtrl'
	}).when('/inicioC', {
		resolve: {
			check: function($location, user) {
				if (!user.isUserLoggedIn()) {
					$location.path('/login');
				}
			},
		},
		templateUrl: './vistasC/inicio.html',
		controller: 'inicioCtrl'
	}).when('/inicioD', {
		resolve: {
			check: function($location, user) {
				if (!user.isUserLoggedIn()) {
					$location.path('/login');
				}
			},
		},
		templateUrl: './vistasD/inicio.html',
		controller: 'inicioCtrl'
	}).when('/inicioI', {
		resolve: {
			check: function($location, user) {
				if (!user.isUserLoggedIn()) {
					$location.path('/login');
				}
			},
		},
		templateUrl: './vistasI/inicio.html',
		controller: 'inicioCtrl'
	}).when('/inicioJ', {
		resolve: {
			check: function($location, user) {
				if (!user.isUserLoggedIn()) {
					$location.path('/login');
				}
			},
		},
		templateUrl: './vistasJ/inicio.html',
		controller: 'inicioCtrl'
	}).otherwise({
		templateUrl: '404.html'
	});
	
});


app.service('user', function() {
	var username;
	var loggedin = false;
	var id;
	var tipoUser;

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

	this.setTipo = function(tipoUsuario) {
		tipoUser = tipoUsuario;
	};

	this.getTipo = function() {
		return id;
	};

	this.isUserLoggedIn = function() {
		if (!!localStorage.getItem('login')) {
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

				if (response.data.rol == 1) {
					$location.path('/inicioC');
				} else if (response.data.rol == 2) {
					$location.path('/inicioJ');
				} else if (response.data.rol == 3) {
					$location.path('/inicioD');
				} else if (response.data.rol == 4) {
					$location.path('/inicioI');
				}

			} else {
				alert('Verifique que sus datos sean correctos');
			}
		});
	}
});


app.controller('inicioCtrl', function($scope, $http, $location, user) {

	$scope.user = user.getName();

	$scope.salir = function() {
		$location.path('/logout');
	}
});