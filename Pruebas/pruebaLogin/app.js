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
			controller: 'misCursosDCtrl'

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
			template: './vistasJ/generar-Curso.html',
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
	var idUsuario;

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

		loggedin = true;
		localStorage.setItem('login', JSON.stringify({
			username: username,
			id: id,
			rol: rol,
			path: path
		}));
	};

	this.clearData = function () {
		localStorage.removeItem('login');
		username = "";
		id = "";
		loggedin = false;
	}
});

app.service('curso', function () {
	var id;
	var idDoc;

	this.setID = function (cursoID) {
		id = cursoID;
	};

	this.getID = function () {
		return id;
	};

	this.setIDdocumento = function (idDocumento) {
		idDoc = idDocumento;
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

	$scope.verDoc = function (idCurso, idDocumento) {
		curso.setID(idCurso);
		curso.setIDdocumento(idDocumento);
	};

	$scope.getDoc = function () {
		$http({
			method: 'GET',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getDocumentosCurso.php'
		}).then(function successCallback(response) {
			$scope.documentoCurso = response.data;
			console.log(response.data);
		}, function errorCallback(response) {
			alert("No hay datos.")
		});
	}

	// $scope.getDoc();
	$scope.getListaDocumentosCurso();
	$scope.getCursos();
	$scope.getInfoCurso();
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

	$scope.getConstancias();

});

app.controller('convocatoriaCtrl', function ($scope, $http, $location, user, periodoService) {

});

/* CONTROLADORES PARA EL USUARIO INSTRUCTOR */
app.controller('cursosICtrl', function ($scope, $http, $location, user, periodoService) {

	$scope.periodo = periodoService.getPeriodo()
		.then(function (response) {
			$scope.periodo = response;
		}, function (error) {
			console.log(response);
		});

	$scope.curso = [{
		val: "red",
		curso: "Diplomado para la Formación y Desarrollo de Competencias Docentes",
		horario: "18 a 22 de Junio de 2019, 9:00 - 15:00",
	}, {
		val: "green",
		curso: "Diplomado para la formación de tutores",
		horario: "18 a 22 de Junio de 2019, 9:00 - 15:00",
	}, ];

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

	$scope.getDocumentos();

});

app.controller('asistenciaICtrl', function ($scope, $http, $location, user, periodoService) {

});

app.controller('participantesICtrl', function ($scope, $http, $location, user, periodoService) {

});

/* CONTROLADORES PARA EL USUARIO JEFE */

app.controller('cursosJCtrl', function ($scope, $http, $location, user, periodoService) {

	$scope.getCursos = function () {
		$http({
			method: 'GET',
			url: '/Residencia/Proyecto/files/cursos.js'
		}).then(function successCallback(response) {
			$scope.cursos = response.data;
			console.log(response.data);
		}, function errorCallback(response) {
			alert("No hay datos.")
		});
	}

	$scope.getCursos();


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

	$scope.getDocumentos();
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
			console.log(response);
		});
	}

	// $scope.cursoIdUsuario = function (idUsuario) {
	// 	user.setIdUsuario(idUsuario);
	// }

	$scope.getMisCursos = function () {

		$scope.id = user.getIdUsuario();

		if ($scope.id != undefined ) {
			$http({
				url: '/Residencia/Pruebas/pruebaLogin/php/getMisCursos.php',
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'idUsuario=' + $scope.id
			}).then(function successCallback(response) {
				$scope.misCursos = response.data;
				console.log(response.data);
			}, function errorCallback(response) {
				console.log(response.data);
			});
		}

	}

	$scope.cursoID = function (id) {
		curso.setID(id);
	}

	$scope.getInfoCurso = function () {

		$scope.idCurso = curso.getID();
		console.log($scope.idCurso);

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
				console.log(response.data);
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
	// $scope.getInfoCurso();
	$scope.getMisCursos();
	// $scope.periodo();
});

app.controller('encuestaDCtrl', function ($scope, $http, $location, user, periodoService) {

});

app.controller('misCursosDCtrl', function ($scope, $http, $location, user, periodoService) {

});

app.controller('constanciasDCtrl', function ($scope, $http, $location, user, periodoService) {

});