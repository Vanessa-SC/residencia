var app = angular.module("app", []);

app.controller("userCtrl", function($scope, $http) {
	$scope.ingresar = function() {

		$http({
			method: 'POST',
			url: '/Residencia/Proyecto/backend/login.php'
		}).then(function successCallback(response) {
			location.url("/Residencia/Proyecto/vistasCoordinador/inicio.html");
		}, function errorCallback(response) {
			alert("Datos incorrectos");
			location.reload();
		});
	};
});