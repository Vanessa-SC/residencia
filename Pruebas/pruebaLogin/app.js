var app = angular.module('myApp', ['ngRoute']);

app.config(function($routeProvider, $locationProvider) {
	$routeProvider.when('/', {
			resolve: {
				check: function($location, user) {
					if (user.isUserLoggedIn()) {
						$location.path(user.getPath());
					}

				},
			},
			templateUrl: 'login.html',
			controller: 'loginCtrl'
		}).when('/logout', {
			resolve: {
				deadResolve: function($location, user) {
					user.clearData();
					$location.path('/');
				}
			}
		}).when('/login', {
			resolve: {
				check: function($location, user) {
					if (user.isUserLoggedIn()) {
						$location.path(user.getPath());
					}

				},
			},
			templateUrl: 'login.html',
			controller: 'loginCtrl'
		}).when('/inicio', {
			resolve: {
				check: function($location, user) {
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
				check: function($location, user) {
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
				check: function($location, user) {
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
				check: function($location, user) {
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
				check: function($location, user) {
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
			template: '<div class="text-center"><h1>Próximamente</h1></div>',
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


app.service('user', function() {
	var username;
	var loggedin = false;
	var id;
	var rol;

	this.setName = function(name) {
		username = name;
	};

	this.getName = function() {
		return username;
	};

	this.setID = function(userID) {
		id = userID;
	};

	this.getID = function() {
		return id;
	};

	this.getRol = function() {
		if (!!localStorage.getItem('login')) {
			var data = JSON.parse(localStorage.getItem('login'));
			rol = data.rol;
		}
		return rol;
	};

	this.getPath = function() {
		if (!!localStorage.getItem('login')) {
			var data = JSON.parse(localStorage.getItem('login'));
			path = data.path;
		}
		return path;
	};

	this.isUserLoggedIn = function() {
		if (!!localStorage.getItem('login')) {
			loggedin = true;
			var data = JSON.parse(localStorage.getItem('login'));
			username = data.username;
			id = data.idUsuario;
			rol = data.rol;
		}
		return loggedin;
	};

	this.userLoggedIn = function() {
		loggedin = true;
	};

	this.saveData = function(data, ruta) {
		username = data.user;
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

	this.clearData = function() {
		localStorage.removeItem('login');
		username = "";
		id = "";
		loggedin = false;
	}
});

app.controller('loginCtrl', function($scope, $http, $location, user) {
	$scope.gotoInicio = function() {
		$location.path('/inicio');
	}

	$scope.login = function() {
		var username = $scope.username;
		var password = $scope.password;

		$http({
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/server.php',
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			data: 'username=' + username + '&password=' + password
		}).then(function(response) {
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

app.controller('inicioCtrl', function($scope, $http, $location, user) {

	$scope.user = user.getName();

	$scope.salir = function() {
		$location.path('/logout');
	}

	$scope.goTo = function(path) {
		$location.path(path);
	}
});

/* CONTROLADORES PARA EL USUARIO COORDINADOR*/

app.controller('programaCtrl', function($scope, $http, $location, user) {

	$scope.getCursos = function() {
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

	$scope.getCursos();

	$scope.getDocumentosCurso = function() {
		$http({
			method: 'GET',
			url: '/Residencia/Proyecto/files/docsCurso.js'
		}).then(function successCallback(response) {
			$scope.datos = response.data;
			console.log(response.data);
		}, function errorCallback(response) {
			alert("No hay datos.")
		});
	}

	$scope.getDocumentosCurso();

});

app.controller('constanciasCtrl', function($scope, $http, $location, user) {

});

app.controller('convocatoriaCtrl', function($scope, $http, $location, user) {

});

/* CONTROLADORES PARA EL USUARIO INSTRUCTOR */
app.controller('cursosICtrl', function($scope, $http, $location, user) {

	$scope.periodo = "Agosto/Diciembre 2020";
	$scope.curso = [{
		val: "red",
		curso: "Diplomado para la Formación y Desarrollo de Competencias Docentes",
		horario: "18 a 22 de Junio de 2019, 9:00 - 15:00",
	}, {
		val: "green",
		curso: "Diplomado para la formación de tutores",
		horario: "18 a 22 de Junio de 2019, 9:00 - 15:00",
	}, ];

	$scope.getDocumentos = function() {
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

app.controller('asistenciaICtrl', function($scope, $http, $location, user) {

});

app.controller('participantesICtrl', function($scope, $http, $location, user) {

});

/* CONTROLADORES PARA EL USUARIO JEFE */

app.controller('cursosJCtrl', function($scope, $http, $location, user) {

	$scope.getCursos = function() {
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


	$scope.getDocumentos = function() {
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

app.controller('encuestaJCtrl', function($scope, $http, $location, user) {

});

/*	CONTROLADORES PARA EL USUARIO DOCENTE */
app.controller('cursosDCtrl', function($scope, $http, $location, user) {
	$scope.periodo = "Agosto/Diciembre 2020";
	$scope.curso = [{
		val: "red",
		curso: "Diplomado para la Formación y Desarrollo de Competencias Docentes",
		horario: "18 a 22 de Junio de 2019, 9:00 - 15:00",
	}, {
		val: "green",
		curso: "Diplomado para la formación de tutores",
		horario: "18 a 22 de Junio de 2019, 9:00 - 15:00",
	}, ];

	$scope.getDocumentos = function() {
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

app.controller('encuestaDCtrl', function($scope, $http, $location, user) {

});

app.controller('misCursosDCtrl', function($scope, $http, $location, user) {

});

app.controller('constanciasDCtrl', function($scope, $http, $location, user) {

});