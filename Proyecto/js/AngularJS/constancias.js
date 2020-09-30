var app = angular.module("appConstancia", ["ngRoute"]);

app.config(function ($routeProvider) {
  $routeProvider
    .when("/ver", {
      templateUrl: "../vistasCoordinador/ver-constancia.html",
      controller: "constanciaController",
    })
    .when("/", {
      templateUrl: "../vistasCoordinador/constancias.html",
      controller: "constanciaController",
    });
});

app.controller("constanciaController", function ($scope) {
  $scope.constancia = [
    {
      folio: "AB3214",
      curso:
        "Diplomado para la Formación y Desarrollo de Competencias Docentes",
      fecha: "18 a 22 de Junio de 2019, 9:00 - 15:00",
    },
    {
      folio: "AB3220",
      curso: "Diplomado para la formación de tutores",
      fecha: "18 a 22 de Junio de 2019, 9:00 - 15:00",
    },
  ];

  $scope.ver = function(folio){
    console.log(folio);
  }
});
