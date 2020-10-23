var app = angular.module("appConstancia", []);

app.controller('constanciasController', ['$scope', '$http', function($scope, $http) {

  $http({
    method: 'GET',
    url: '/Residencia/Proyecto/files/constancias.js'
  }).then(function successCallback(response) {
    $scope.datos = response.data;
    console.log(response.data);
  }, function errorCallback(response) {
    console.log(response);
  });

  $scope.folio = "";
  $scope.curso = "";
  
  $scope.ver = function(folio, curso) {

    $scope.folio = folio;
    $scope.curso = curso;
    console.log($scope.constancia);

  }

}]);