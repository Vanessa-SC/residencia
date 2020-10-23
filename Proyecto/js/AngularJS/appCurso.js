var app = angular.module("appCurso", []);


app.controller('cursoController', function($scope, $http) {

  $scope.cargar = function() {
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

  $scope.cargar();

  $scope.verDoc = function(titulo) {
    $scope.documento = [{"titulo":titulo}];
    console.log($scope.titulo);
  }
});