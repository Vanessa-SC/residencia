var app = angular.module("appCurso", []);
app.controller("cursoController", function ($scope) {
  $scope.instructor = "ISC Cristabel Armstrong Aramburo";
  $scope.curso =
    "Diplomado para la Formación y Desarrollo de Competencias Docentes";
  $scope.fecha = "21 Agosto 2020";
  $scope.documentos = [
    {
      numero: "1",
      documento: "Diseño del curso (Ficha Tecnica)",
      validado: "ok",
    },
    {
      numero: "2",
      documento: "Currículum",
      validado: "no",
    },
    {
      numero: "3",
      documento: "Programa",
      validado: "ok",
    },
  ];
});
