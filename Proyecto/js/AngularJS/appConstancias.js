var app = angular.module("appConstancias", []);

app.controller("constanciasController", [
  "$scope",
  function ($scope) {
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
  },
]);
