var app = angular.module('appPrograma', []);

app.controller('programaController', function($scope, $http) {

    $scope.importar = function() {
        $http({
            method: 'GET',
            //url: '/Residencia/Proyecto/backend/getCursos.php'
            url: '/Residencia/Proyecto/files/cursos.js'
        }).then(function successCallback(response) {
            $scope.cursos = response.data;
            console.log(response.data);
        }, function errorCallback(response) {
            console.log(response);
        });
    }

  $scope.importar();

});