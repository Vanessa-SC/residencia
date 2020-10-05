var app = angular.module('prueba', []);

app.controller('pruebaCtrl', function($scope, $http) {

	$scope.importar = function() {
		$http({
			method: 'GET',
			url: 'cursos.js'
		}).then(function successCallback(response) {
			$scope.cursos = response.data;
			console.log(response.data);
		}, function errorCallback(response) {
			alert("No hay datos.")
		});
	}

	$scope.importar();

});