var app = angular.module("appPrograma", []);

app.controller("programaController", [
  "$scope",
  function ($scope) {
    $scope.periodo = "Agosto/Diciembre 2020";
    $scope.curso = [
      {
        val: "red",
        maestro: "I.S.C. Cristabel Armstrong Aramburo",
        curso:
          "Diplomado para la Formación y Desarrollo de Competencias Docentes",
        horario: "18 a 22 de Junio de 2019, 9:00 - 15:00",
      },
      {
        val: "green",
        maestro: "Dra. Dora Luz Gonzalez",
        curso: "Diplomado para la formación de tutores",
        horario: "18 a 22 de Junio de 2019, 9:00 - 15:00",
      },
    ];
  },
]);
