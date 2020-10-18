var app = angular.module("appJefe", []);

app.controller("cursosCtrl", ["$scope", "$http", function($scope, $http) {

	$scope.getData = function() {
		$http({
			method: 'GET',
			url: '/Residencia/Proyecto/files/cursos.js'
		}).then(function successCallback(response) {
			$scope.datos = response.data;
			console.log(response.data);
		}, function errorCallback(response) {
			alert("No hay datos.")
		});
	}

	$scope.getData();

}]);

app.controller("docsCtrl", ["$scope", "$http", function($scope, $http) {

	$scope.getData = function() {
		$http({
			method: 'GET',
			url: '/Residencia/Proyecto/files/docsCurso.js'
		}).then(function successCallback(response) {
			$scope.datos = response.data;
			console.log(response.data);
		}, function errorCallback(response) {
			alert("No hay datos.")
		});
	}

	$scope.getData();

}]);