var app = angular.module("appConstancia", ["ngRoute"]);

app.config(function($routeProvider) {
  $routeProvider
    .when("/ver", {
      templateUrl: "../vistasCoordinador/ver-constancia.html",
      controller: "constanciasController",
    })
    .when("/", {
      templateUrl: "../vistasCoordinador/constancias.html",
      controller: "constanciasController",
    });
});


app.controller('constanciasController', function($scope, $http) {

  $http({
    method: 'GET',
    url: '/Residencia/Proyecto/files/constancias.js'
  }).then(function successCallback(response) {
    $scope.datos = response.data;
  }, function errorCallback(response) {
    console.log(response);
  });

  $scope.ver = function (folio,curso){
    $scope.folioCons = folio;
    $scope.cursoCons = curso;
    console.log(folio+' '+curso);

  }

})