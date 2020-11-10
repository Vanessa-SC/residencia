var app = angular.module('myApp', ['ngRoute']);

app.config(function ($routeProvider, $locationProvider) {
	$routeProvider.when('/', {
			/* Comprobar si el usuario está loggeado 
			para redireccionar a su template correspondiente*/
			resolve: {
				check: function ($location, user) {
					if (user.isUserLoggedIn()) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: 'login.html',
			controller: 'loginCtrl'
		}).when('/logout', {
			/* Limpia las variables que autentican al usuario */
			resolve: {
				deadResolve: function ($location, user) {
					user.clearData();
					$location.path('/');
				}
			}
		}).when('/login', {
			/* Evita que el usuario vaya al login si está loggeado */
			resolve: {
				check: function ($location, user) {
					if (user.isUserLoggedIn()) {
						$location.path(user.getPath());
					}

				},
			},
			templateUrl: 'login.html',
			controller: 'loginCtrl'
		}).when('/inicio', {
			/* Verifica si está loggeado, sino lo manda a su template de inicio */
			resolve: {
				check: function ($location, user) {
					if (!user.isUserLoggedIn()) {
						$location.path('/login');
					} else {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: 'inicio.html',
			controller: 'inicioCtrl'
		})
		/*  RUTAS PARA EL USUARIO COORDINADOR */
		.when('/inicioC', {
			resolve: {
				check: function ($location, user) {
					if (!user.isUserLoggedIn()) {
						$location.path('/login');
					}
					if (user.isUserLoggedIn()) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasC/inicio.html',
			controller: 'inicioCtrl'
		}).when('/inicioC/programa', {
			templateUrl: './vistasC/programa.html',
			controller: 'programaCtrl'

		}).when('/inicioC/programa/generar', {
			templateUrl: './vistasC/generar-curso.html',
			controller: 'programaCtrl'

		}).when('/inicioC/programa/actualizar', {
			templateUrl: './vistasC/actualizar-curso.html',
			controller: 'programaCtrl'

		}).when('/inicioC/programa/infoCurso', {
			templateUrl: './vistasC/info-curso.html',
			controller: 'programaCtrl'

		}).when('/inicioC/programa/documentosCurso', {
			templateUrl: './vistasC/docs-curso.html',
			controller: 'programaCtrl'

		}).when('/inicioC/programa/verDocumento', {
			templateUrl: './vistasC/ver-doc.html',
			controller: 'programaCtrl'

		}).when('/inicioC/constancias', {
			templateUrl: './vistasC/constancias.html',
			controller: 'constanciasCtrl'

		}).when('/inicioC/constancias/ver', {
			templateUrl: './vistasC/ver-constancia.html',
			controller: 'constanciasCtrl'

		}).when('/inicioC/constancias/generar', {
			templateUrl: './vistasC/generar-constancia.html',
			controller: 'constanciasCtrl'

		}).when('/inicioC/convocatorias', {
			templateUrl: './vistasC/convocatoria.html',
			controller: 'convocatoriaCtrl'

		}).when('/inicioC/convocatorias/generar', {
			templateUrl: './vistasC/generar-convocatoria.html',
			controller: 'convocatoriaCtrl'
		})

		/*  RUTAS PARA EL USUARIO DOCENTE */
		.when('/inicioD', {
			resolve: {
				check: function ($location, user) {
					if (!user.isUserLoggedIn()) {
						$location.path('/login');
					}
					if (user.isUserLoggedIn()) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasD/inicio.html',
			controller: 'inicioCtrl'
		}).when('/inicioD/cursos', {
			templateUrl: './vistasD/cursos.html',
			controller: 'cursosDCtrl'

		}).when('/inicioD/cursos/encuesta', {
			templateUrl: './vistasD/encuesta.html',
			controller: 'encuestaDCtrl'

		}).when('/inicioD/misCursos', {
			templateUrl: './vistasD/misCursos.html',
			controller: 'cursosDCtrl'

		}).when('/inicioD/constancias', {
			templateUrl: './vistasD/constancias.html',
			controller: 'constanciasDCtrl'

		}).when('/inicioD/constancias/descargar', {
			templateUrl: './vistasD/descargarConstancia.html',
			controller: 'constanciasDCtrl'

		}).when('/inicioD/cursos/informacion', {
			templateUrl: './vistasD/info-curso.html',
			controller: 'cursosDCtrl'

		})
		/*  RUTAS PARA EL USUARIO INSTRUCTOR */
		.when('/inicioI', {
			resolve: {
				check: function ($location, user) {
					if (!user.isUserLoggedIn()) {
						$location.path('/login');
					}
					if (user.isUserLoggedIn()) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasI/inicio.html',
			controller: 'inicioCtrl'

		}).when('/inicioI/cursos', {
			templateUrl: './vistasI/cursos.html',
			controller: 'cursosICtrl'

		}).when('/inicioI/cursos/infoCurso', {
			templateUrl: './vistasI/info-curso.html',
			controller: 'cursosICtrl'

		})
		.when('/inicioI/cursos/subir-docscurso', {
			templateUrl: './vistasI/subir-docscurso.html',
			controller: 'cursosICtrl'

		})
		.when('/inicioI/cursos/infoCurso', {
			templateUrl: './vistasI/info-curso.html',
			controller: 'cursosICtrl'

		})
		.when('/inicioI/cursos/infoCurso', {
			templateUrl: './vistasI/info-curso.html',
			controller: 'cursosICtrl'

		}).when('/inicioI/cursos/asistencia', {
			templateUrl: './vistasI/asistencia.html',
			controller: 'asistenciaICtrl'

		}).when('/inicioI/cursos/participantes', {
			templateUrl: './vistasI/participantes.html',
			controller: 'participantesICtrl'

		})
		/*  RUTAS PARA EL USUARIO JEFE DE DOCENCIA */
		.when('/inicioJ', {
			resolve: {
				check: function ($location, user) {
					if (!user.isUserLoggedIn()) {
						$location.path('/login');
					}
					if (user.isUserLoggedIn()) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasJ/inicio.html',
			controller: 'inicioCtrl'

		}).when('/inicioJ/cursos', {
			templateUrl: './vistasJ/cursos.html',
			controller: 'cursosJCtrl'

		}).when('/inicioJ/cursos/generar', {
			templateUrl: './vistasJ/generar-curso.html',
			controller: 'cursosJCtrl'

		}).when('/inicioJ/cursos/infoCurso', {
			templateUrl: './vistasJ/info-curso.html',
			controller: 'cursosJCtrl'

		}).when('/inicioJ/cursos/subirDocumentos', {
			templateUrl: './vistasJ/subir-docscurso.html',
			controller: 'cursosJCtrl'

		}).when('/inicioJ/cursos/validarDocumentos', {
			templateUrl: './vistasJ/validarDoc.html',
			controller: 'cursosJCtrl'

		}).when('/inicioJ/encuesta', {
			templateUrl: './vistasJ/encuesta.html',
			controller: 'encuestaJCtrl'

		}).otherwise({
			templateUrl: '404.html'
		});

});


app.service('user', function () {
	var username;
	var loggedin = false;
	var id;
	var rol;
	var idDepartamento;

	this.setName = function (name) {
		username = name;
	};

	this.getName = function () {
		return username;
	};

	this.setID = function (userID) {
		id = userID;
	};

	this.getID = function () {
		return id;
	};

	this.getIdDepartamento = function(){
		if (!!localStorage.getItem('login')) {
			var data = JSON.parse(localStorage.getItem('login'));
			idDepartamento = data.idDepartamento;
			console.log("idDepto: "+idDepartamento);
		}
		return idDepartamento;
	}

	this.setIdUsuario = function (idUsuario) {
		id = idUsuario;
	};

	this.getRol = function () {
		if (!!localStorage.getItem('login')) {
			var data = JSON.parse(localStorage.getItem('login'));
			rol = data.rol;
		}
		return rol;
	};

	this.getIdUsuario = function () {
		if (!!localStorage.getItem('login')) {
			var data = JSON.parse(localStorage.getItem('login'));
			id = data.id;
			console.log(id);
		}
		return id;
	};

	this.getPath = function () {
		if (!!localStorage.getItem('login')) {
			var data = JSON.parse(localStorage.getItem('login'));
			path = data.path;
		}
		return path;
	};

	this.isUserLoggedIn = function () {
		if (!!localStorage.getItem('login')) {
			loggedin = true;
			var data = JSON.parse(localStorage.getItem('login'));
			username = data.username;
			id = data.idUsuario;
			rol = data.rol;
		}
		return loggedin;
	};

	this.userLoggedIn = function () {
		loggedin = true;
	};

	this.saveData = function (data, ruta) {
		username = data.nombreUsuario;
		id = data.idUsuario;
		rol = data.rol;
		path = ruta;
		idDepartamento = data.Departamento_idDepartamento;

		loggedin = true;
		localStorage.setItem('login', JSON.stringify({
			username: username,
			id: id,
			rol: rol,
			path: path,
			idDepartamento: idDepartamento 
		}));
	};

	this.clearData = function () {
		localStorage.removeItem('login');
		username = "";
		id = "";
		idDepartamento = "";
		loggedin = false;
	}
});

app.service('curso', function () {
	var id;
	var idDoc;

	this.setID = function (cursoID) {
		id = cursoID;
		console.log('idCurso: ' + id);
	};

	this.getID = function () {
		return id;
	};

	this.setIDdocumento = function (idDocumento) {
		idDoc = idDocumento;
		console.log('idDoc: ' + idDoc);
	};

	this.getIDdocumento = function () {
		return idDoc;
	};

});

app.service('periodoService', function ($q, $http) {

	return {
		getPeriodo: function () {
			return $http({
				method: 'GET',
				url: '/Residencia/Pruebas/pruebaLogin/php/periodoActual.php'
			}).then(function successCallback(response) {
				return response.data.periodo;
			}, function errorCallback(response) {
				return $q.reject(response.data);
			});
		}
	}
})

/* PARA SUBIR ARCHIVOS */
app.directive("fileInput", function ($parse) {
	return {
		link: function ($scope, element, attrs) {
			element.on("change", function (event) {
				var files = event.target.files;
				// console.log(files[0].name);
				$parse(attrs.fileInput).assign(element[0].files);
				$scope.$apply();
			});
		}
	}
});

/* FORMATO NUMERO */
app.directive('stringToNumber', function () {
	return {
		require: 'ngModel',
		link: function (scope, element, attrs, ngModel) {
			ngModel.$parsers.push(function (value) {
				return '' + value;
			});
			ngModel.$formatters.push(function (value) {
				return parseFloat(value);
			});
		}
	};
});

/* FORMATO DE FECHA */
app.directive('asDate', function () {
    return {
        require: '^ngModel',
        restrict: 'A',
        link: function (scope, element, attrs, ctrl) {
            ctrl.$formatters.splice(0, ctrl.$formatters.length);
            ctrl.$parsers.splice(0, ctrl.$parsers.length);
            ctrl.$formatters.push(function (modelValue) {
                if (!modelValue) {
                    return;
                }
                return new Date(modelValue);
            });
            ctrl.$parsers.push(function (modelValue) {
                return modelValue;
            });
        }
    };
});

app.controller('loginCtrl', function ($scope, $http, $location, user) {
	$scope.gotoInicio = function () {
		$location.path('/inicio');
	}

	$scope.login = function () {
		var username = $scope.username;
		var password = $scope.password;

		$http({
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/server.php',
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			data: 'username=' + username + '&password=' + password
		}).then(function (response) {
			console.log(response.data);
			if (response.data.status == 'loggedin') {
				// user.userLoggedIn();
				// user.setName(response.data.user);
				// user.saveData(response.data, '');

				if (response.data.rol == 1) {
					user.saveData(response.data, '/inicioC');
					$location.path('/inicioC');
				} else if (response.data.rol == 2) {
					user.saveData(response.data, '/inicioJ');
					$location.path('/inicioJ');
				} else if (response.data.rol == 3) {
					user.saveData(response.data, '/inicioD');
					$location.path('/inicioD');
				} else if (response.data.rol == 4) {
					user.saveData(response.data, '/inicioI');
					$location.path('/inicioI');
				}

			} else {
				alert('Verifique que sus datos sean correctos');
			}
		});
	}
});

app.controller('inicioCtrl', function ($scope, $http, $location, user, periodoService) {

	$scope.user = user.getName();

	$scope.salir = function () {
		$location.path('/logout');
	}

	$scope.goTo = function (path) {
		$location.path(path);
	}

	$scope.periodo = periodoService.getPeriodo()
		.then(function (response) {
			$scope.periodo = response;
		}, function (error) {
			console.log(response);
		});

});

/* CONTROLADORES PARA EL USUARIO COORDINADOR*/

app.controller('programaCtrl', function ($scope, $http, $location, user, curso, periodoService) {

	$scope.getCursos = function () {
		$http({
			method: 'GET',
			url: '/Residencia/Pruebas/pruebaLogin/php/getCursos.php'
		}).then(function successCallback(response) {
			$scope.cursos = response.data;
			// console.log(response.data);
		}, function errorCallback(response) {
			console.log(response);
		});
	}

	$scope.periodo = periodoService.getPeriodo()
		.then(function (response) {
			$scope.periodo = response;
		}, function (error) {
			console.log(response);
		});

	$scope.getListaDocumentosCurso = function () {
		$http({
			method: 'GET',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getDocumentos.php'
		}).then(function successCallback(response) {
			$scope.documentos = response.data;
			// console.log(response.data);
		}, function errorCallback(response) {

		});
	}


	$scope.cursoID = function (id) {
		curso.setID(id);
	}

	$scope.getInfoCurso = function () {

		$scope.idCurso = curso.getID();
		// console.log($scope.idCurso);

		if ($scope.idCurso != "") {
			$http({
				url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getInfoCurso.php',
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'idCurso=' + $scope.idCurso
			}).then(function successCallback(response) {
				$scope.infoCurso = response.data;
				//  console.log(response.data);
			}, function errorCallback(response) {

			});
		}

	}

	$scope.getCursoAct = function () {

		$scope.idCurso = curso.getID();
		// console.log($scope.idCurso);

		if ($scope.idCurso != "") {
			$http({
				url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getCursoAct.php',
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'idCurso=' + $scope.idCurso
			}).then(function successCallback(response) {
				$scope.actCurso = response.data;
				$scope.curso = response.data;
				console.log(response.data);
			}, function errorCallback(response) {

			});
		}

	}

	$scope.back = function () {
		window.history.back();
	};

	$scope.verDoc = function (idCurso, idDocumento) {
		curso.setID(idCurso);
		curso.setIDdocumento(idDocumento);
		$scope.getDoc();
	};

	$scope.getDoc = function () {
		var idCurso = curso.getID();
		var idDoc = curso.getIDdocumento();
		$http({
			method: 'POST',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getDocumentosCurso.php',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			data: 'idCurso=' + idCurso + '&idDocumento=' + idDoc
		}).then(function successCallback(response) {
			$scope.documentoCurso = response.data;
			// console.log(response.data);
		}, function errorCallback(response) {
			console.log("No hay datos.");
		});
	}

	$scope.crearCurso = function (datos) {
		console.log(datos);
		$http({
			method: 'POST',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/crearCursoC.php',
			headers: {
				'Content-Type': 'application/json'
			},
			data: JSON.stringify(datos)
		}).then(function successCallback(response) {
			console.log(response.data);
			if (response.data.status != "ok") {
				alert("Ocurrió un error al crear el curso");
			} else {
				alert("Curso creado correctamente.");
				$location.path("/inicioC/programa");
			}
		}, function errorCallback(response) {
			console.log("No hay datos.");
		});
	}
	$scope.curso = {};

	$scope.actualizarCurso = function () {
		$http({
			method: 'POST',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/actualizarCursoC.php',
			headers: {
				'Content-Type': 'application/json'
			},
			data: JSON.stringify($scope.curso)
		}).then(function successCallback(response) {
			if (response.data.status != "ok") {
				alert("Ocurrió un error al modificar el curso");
			} else {
				alert("Curso actualizado correctamente.");
				$location.path("/inicioC/programa");
			}
		}, function errorCallback(response) {
			console.log("No hay datos.");
		});
	}

	$scope.deleteCurso = function (id, nombreCurso) {
		if (confirm('¿Está seguro de que quiere eliminar el curso "' + nombreCurso + '"?')) {
			$http({
				method: 'POST',
				url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/deleteCurso.php',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'idCurso=' + id
			}).then(function successCallback(response) {
				if (response.data.status == "ok") {
					alert("Curso eliminado correctamente.");
					$scope.getCursos();
				} else {
					alert("Error al eliminar el curso");
				}
			}, function errorCallback(response) {
				return false;
			});
		} else {
			return false;
		}
	}



	$scope.getDoc();
	$scope.getListaDocumentosCurso();
	$scope.getCursos();
	$scope.getInfoCurso();
	$scope.getCursoAct();
});

app.controller('constanciasCtrl', function ($scope, $http, $location, user, periodoService) {


	$scope.getConstancias = function () {
		$http({
			method: 'GET',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getConstancias.php'
		}).then(function successCallback(response) {
			$scope.constancias = response.data;
			console.log(response.data);
		}, function errorCallback(response) {
			alert("No hay datos.")
		});
	}

	$scope.periodo = periodoService.getPeriodo()
		.then(function (response) {
			$scope.periodo = response;
		}, function (error) {
			console.log(response);
		});

	$scope.folio = "";
	$scope.curso = "";

	$scope.ver = function (folio, curso) {

		$scope.folio = folio;
		$scope.curso = curso;
		console.log($scope.constancia);

	}

	$scope.rutaArchivo = "doc.pdf";

	$scope.getConstancias();

});

app.controller('convocatoriaCtrl', function ($scope, $http, $location, user, periodoService) {

});

/* CONTROLADORES PARA EL USUARIO INSTRUCTOR */
app.controller('cursosICtrl', function ($scope, $http, $location, user, curso, periodoService) {

	$scope.periodo = periodoService.getPeriodo()
		.then(function (response) {
			$scope.periodo = response;
		}, function (error) {
			console.log(response);
		});

	$scope.getCursos = function () {
		$http({
			method: 'GET',
			url: '/Residencia/Pruebas/pruebaLogin/php/getCursos.php'
		}).then(function successCallback(response) {
			$scope.cursos = response.data;
			// console.log(response.data);
		}, function errorCallback(response) {
			console.log(response);
		});
	}

	$scope.getDocumentos = function () {
		$http({
			method: 'GET',
			url: '/Residencia/Proyecto/files/docsCurso.js'
		}).then(function successCallback(response) {
			$scope.documentos = response.data;
			console.log(response.data);
		}, function errorCallback(response) {
			alert("No hay datos.")
		});
	}

	$scope.cursoID = function (id) {
		curso.setID(id);
	}

	$scope.getInfoCurso = function () {

		$scope.idCurso = curso.getID();
		// console.log($scope.idCurso);

		if ($scope.idCurso != "") {
			$http({
				url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getInfoCurso.php',
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'idCurso=' + $scope.idCurso
			}).then(function successCallback(response) {
				$scope.infoCurso = response.data;
				// console.log(response.data);
			}, function errorCallback(response) {

			});
		}

	}

	$scope.back = function () {
		window.history.back();
	};

	$scope.getDocumentos();
	$scope.getCursos();
	$scope.getInfoCurso();

});

app.controller('asistenciaICtrl', function ($scope, $http, $location, user, periodoService) {

});

app.controller('participantesICtrl', function ($scope, $http, $location, user, curso, periodoService) {
	$scope.cursoID = function (id) {
		curso.setID(id);
	}

	$scope.getParticipantes = function () {

		$scope.idCurso = curso.getID();
		// console.log($scope.idCurso);

		if ($scope.idCurso != "") {
			$http({
				url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getParticipantes.php',
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'idCurso=' + $scope.idCurso
			}).then(function successCallback(response) {
				$scope.participantes = response.data;
				// console.log(response.data);
			}, function errorCallback(response) {

			});
		}

	}

	$scope.getParticipantes();
});

/* CONTROLADORES PARA EL USUARIO JEFE */

app.controller('cursosJCtrl', function ($scope, $http, $location, user, curso, periodoService) {

	$scope.getCursos = function () {
		$http({
			method: 'POST',
			url: '/Residencia/Pruebas/pruebaLogin/php/getCursosDepartamento.php',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			data: 'idDepartamento=' + user.getIdDepartamento()
		}).then(function successCallback(response) {
			$scope.cursos = response.data;
		}, function errorCallback(response) {
			
		});
	}

	$scope.cursoID = function (id) {
		curso.setID(id);
	}

	$scope.getInfoCurso = function () {

		$scope.idCurso = curso.getID();
		// console.log($scope.idCurso);

		if ($scope.idCurso != "") {
			$http({
				url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getInfoCurso.php',
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'idCurso=' + $scope.idCurso
			}).then(function successCallback(response) {
				$scope.infoCurso = response.data;
				// console.log(response.data);
			}, function errorCallback(response) {

			});
		}

	}

	$scope.periodo = periodoService.getPeriodo()
		.then(function (response) {
			$scope.periodo = response;
		}, function (error) {
			console.log(response);
		});

	$scope.getListaDocumentosCurso = function () {
		$http({
			method: 'GET',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getDocumentos.php'
		}).then(function successCallback(response) {
			$scope.documentos = response.data;
			// console.log(response.data);
		}, function errorCallback(response) {
			alert("No hay datos.")
		});
	}

	$scope.back = function () {
		window.history.back();
	};

	$scope.cursoID = function (id) {
		curso.setID(id);
	}

	$scope.deleteCurso = function (id, nombreCurso) {
		if (confirm('¿Está seguro de que quiere eliminar el curso "' + nombreCurso + '"?')) {
			$http({
				method: 'POST',
				url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/deleteCurso.php',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'idCurso=' + id
			}).then(function successCallback(response) {
				if (response.data.status == "ok") {
					alert("Curso eliminado correctamente.");
					$scope.getCursos();
				} else {
					alert("Error al eliminar el curso");
				}
			}, function errorCallback(response) {
				return false;
			});
		} else {
			return false;
		}
	}

	// $scope.uploadFile = function () {
	// 	var form_data = new FormData();

	// 	angular.foreach($scope.files, function (file) {
	// 		form_data.append('file', file);
	// 	});

	// 	$http({
	// 		url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/subirDocumentoCurso.php',
	// 		method: 'POST',
	// 		headers: {
	// 			'Content-Type': undefined
	// 		},
	// 		data: form_data
	// 	}).then(function successCallback(response) {
	// 		$scope.response = response.data;;
	// 	}, function errorCallback(response) {

	// 	});
	// }

	// $scope.upload = function (value) {
	// 	var fd = new FormData();
	// 	angular.forEach($scope.uploadfiles, function (file) {
	// 		fd.append('file', file);
	// 	});

	// 	$http({
	// 		url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/subirDocumentoCurso.php',
	// 		method: 'POST',
	// 		headers: {
	// 			'Content-Type': undefined
	// 		},
	// 		data: fd
	// 	}).then(function successCallback(response) {
	// 		$scope.response = response.data;;
	// 	});
	// }



	$scope.getInfoCurso();
	$scope.getCursos();
	$scope.getListaDocumentosCurso();
});

app.controller('encuestaJCtrl', function ($scope, $http, $location, user, periodoService) {

});

/*	CONTROLADORES PARA EL USUARIO DOCENTE */
app.controller('cursosDCtrl', function ($scope, $http, $location, user, curso, periodoService) {

	$scope.getCursos = function () {
		$http({
			method: 'GET',
			url: '/Residencia/Pruebas/pruebaLogin/php/getCursos.php'
		}).then(function successCallback(response) {
			$scope.cursos = response.data;
			// console.log(response.data);
		}, function errorCallback(response) {
			//console.log(response);
		});
	}

	// $scope.cursoIdUsuario = function (idUsuario) {
	// 	user.setIdUsuario(idUsuario);
	// }

	$scope.getMisCursos = function () {

		$scope.id = user.getIdUsuario();

		if ($scope.id != undefined) {
			$http({
				url: '/Residencia/Pruebas/pruebaLogin/php/getMisCursos.php',
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'idUsuario=' + $scope.id
			}).then(function successCallback(response) {
				$scope.misCursos = response.data;
				//console.log(response.data);
			}, function errorCallback(response) {
				//console.log(response.data);
			});
		}

	}

	$scope.cursoID = function (id) {
		curso.setID(id);
	}

	$scope.getInfoCurso = function () {

		$scope.idCurso = curso.getID();
		//console.log($scope.idCurso);

		if ($scope.idCurso != "") {
			$http({
				url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getInfoCurso.php',
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'idCurso=' + $scope.idCurso
			}).then(function successCallback(response) {
				$scope.infoCurso = response.data;
				//console.log(response.data);
			}, function errorCallback(response) {

			});
		}

	}

	$scope.back = function () {
		window.history.back();
	};

	$scope.periodo = periodoService.getPeriodo()
		.then(function (response) {
			$scope.periodo = response;
		}, function (error) {
			console.log(response);
		});


	// $scope.reload();
	//$scope.getDocumentosCurso();
	$scope.getCursos();
	$scope.getInfoCurso();
	$scope.getMisCursos();
	// $scope.periodo();
});

app.controller('encuestaDCtrl', function ($scope, $http, $location, user, periodoService) {

});

app.controller('misCursosDCtrl', function ($scope, $http, $location, user, periodoService) {

});

app.controller('constanciasDCtrl', function ($scope, $http, $location, user, periodoService) {

});