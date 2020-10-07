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


app.controller('constanciasController', ['$scope', '$http', function($scope, $http) {

  $http({
    method: 'GET',
    url: '/Residencia/Proyecto/files/constancias.js'
  }).then(function successCallback(response) {
    $scope.datos = response.data;
  }, function errorCallback(response) {
    console.log(response);
  });

  $scope.folio = "";
  $scope.curso = "";
  
  $scope.ver = function(folio, curso) {

    // $scope.constancia = {
    //   "constancia": [{
    //     "folio": folio,
    //     "curso": curso
    //   }]
    // }

    $scope.folio = folio;
    $scope.curso = curso;
    //console.log($scope.constancia);

  }

}]);