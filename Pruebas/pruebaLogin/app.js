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
			templateUrl: './vistasC/programa.html',
			controller: 'programaCtrl'
		}).when('/inicioC/generarCurso', {
			resolve: {
				/* Comprueba el rol del usuario para
				que no pueda acceder secciones que no 
				le corresponden */
				check: function ($location, user) {
					if (user.getRol() != 1) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasC/generar-curso.html',
			controller: 'programaCtrl'

		}).when('/inicioC/actualizarCurso', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 1) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasC/actualizar-curso.html',
			controller: 'programaCtrl'

		}).when('/inicioC/infoCurso', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 1) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasC/info-curso.html',
			controller: 'programaCtrl'

		}).when('/inicioC/documentosCurso', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 1) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasC/docs-curso.html',
			controller: 'programaCtrl'

		}).when('/inicioC/verDocumento', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 1) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasC/ver-doc.html',
			controller: 'programaCtrl'

		}).when('/inicioC/subirDocumentos', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 1) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasC/subir-docscurso.html',
			controller: 'programaCtrl'

		}).when('/inicioC/constancias', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 1) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasC/constancias.html',
			controller: 'constanciasCtrl'

		}).when('/inicioC/constancias/ver', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 1) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasC/ver-constancia.html',
			controller: 'constanciasCtrl'

		}).when('/inicioC/constancias/generar', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 1) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasC/generar-constancia.html',
			controller: 'constanciasCtrl'

		}).when('/inicioC/convocatorias', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 1) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasC/convocatoria.html',
			controller: 'convocatoriaCtrl'

		}).when('/inicioC/convocatorias/generar', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 1) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasC/generar-convocatoria.html',
			controller: 'convocatoriaCtrl'

		}).when('/inicioC/instructores', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 1) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasC/instructores.html',
			controller: 'instructoresCtrl'

		}).when('/inicioC/instructores/agregarInstructor', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 1) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasC/agregar-instructor.html',
			controller: 'instructoresCtrl'

		}).when('/inicioC/instructores/actualizarInstructor', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 1) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasC/actualizar-instructor.html',
			controller: 'instructoresCtrl'
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
			templateUrl: './vistasD/cursos.html',
			controller: 'cursosDCtrl'
		}).when('/inicioD/encuesta', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 3) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasD/encuesta.html',
			controller: 'encuestaDCtrl'

		}).when('/inicioD/misCursos', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 3) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasD/misCursos.html',
			controller: 'cursosDCtrl'

		}).when('/inicioD/constancias', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 3) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasD/constancias.html',
			controller: 'constanciasDCtrl'

		}).when('/inicioD/constancias/descargar', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 3) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasD/descargarConstancia.html',
			controller: 'constanciasDCtrl'

		}).when('/inicioD/cursos/informacion', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 3) {
						$location.path(user.getPath());
					}
				},
			},
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
			templateUrl: './vistasI/cursos.html',
			controller: 'cursosICtrl'

		}).when('/inicioI/cursos/infoCurso', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 4) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasI/info-curso.html',
			controller: 'cursosICtrl'

		}).when('/inicioI/subirDocumentos', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 4) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasI/subir-docscurso.html',
			controller: 'cursosICtrl'

		}).when('/inicioI/asistencia', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 4) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasI/asistencia.html',
			controller: 'asistenciaICtrl'

		}).when('/inicioI/participantes', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 4) {
						$location.path(user.getPath());
					}
				},
			},
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
			templateUrl: './vistasJ/cursos.html',
			controller: 'cursosJCtrl'

		}).when('/inicioJ/cursos', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 2) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasJ/cursos.html',
			controller: 'cursosJCtrl'

		}).when('/inicioJ/cursos/generar', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 2) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasJ/generar-curso.html',
			controller: 'cursosJCtrl'

		}).when('/inicioJ/actualizarCurso', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 2) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasJ/actualizar-cursoJ.html',
			controller: 'cursosJCtrl'

		}).when('/inicioJ/cursos/infoCurso', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 2) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasJ/info-curso.html',
			controller: 'cursosJCtrl'

		}).when('/inicioJ/cursos/subirDocumentos', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 2) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasJ/subir-docscurso.html',
			controller: 'cursosJCtrl'

		}).when('/inicioJ/cursos/validarDocumentos', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 2) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasJ/validarDoc.html',
			controller: 'cursosJCtrl'

		}).when('/inicioJ/encuesta', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 2) {
						$location.path(user.getPath());
					}
				},
			},
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
		if (!!localStorage.getItem('login')) {
			var data = JSON.parse(localStorage.getItem('login'));
			username = data.username;
		}
		return username;
	};

	this.setID = function (userID) {
		id = userID;
	};

	this.getID = function () {
		return id;
	};

	this.getIdDepartamento = function () {
		if (!!localStorage.getItem('login')) {
			var data = JSON.parse(localStorage.getItem('login'));
			idDepartamento = data.idDepartamento;
			// console.log("idDepto: " + idDepartamento);
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
			// console.log(id);
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
		username = data.user;
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
		// console.log('idCurso: ' + id);
	};

	this.getID = function () {
		return id;
	};

	this.setIDdocumento = function (idDocumento) {
		idDoc = idDocumento;
		// console.log('idDoc: ' + idDoc);
	};

	this.getIDdocumento = function () {
		return idDoc;
	};

});

app.service('constancia', function () {
	var folio;
	var ruta;

	this.setFolio = function (folioCons) {
		folio = folioCons;
	};

	this.getFolio = function () {
		// if (!!localStorage.getItem('constancia')) {
		// 	var data = JSON.parse(localStorage.getItem('constancia'));
		// 	folio = data.folio;
		// }
		return folio;
	};

	this.setRuta = function (rutaCons) {
		ruta = rutaCons;
	};

	this.getRuta = function () {
		// if (!!localStorage.getItem('constancia')) {
		// 	var data = JSON.parse(localStorage.getItem('constancia'));
		// 	ruta = data.ruta;
		// }
		return ruta;
	};

	this.saveData = function (data) {
		ruta = data.rutaConstancia;
		folio = data.folio;

		loggedin = true;
		localStorage.setItem('constancia', JSON.stringify({
			ruta: ruta,
			folio: folio
		}));
	};
});

app.service('instructor', function () {
	var id;

	this.setID = function (instructorID) {
		id = instructorID;
		console.log('idInstructor: ' + id);
	};

	this.getID = function () {
		return id;
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
});

app.filter('trustAsResourceUrl', ['$sce', function ($sce) {
	return function (val) {
		return $sce.trustAsResourceUrl(val);
	};
}]);


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

//Función para validar una CURP
function curpValida(curp) {
	var re = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
		validado = curp.match(re);

	if (!validado) //Coincide con el formato general?
		return false;

	//Validar que coincida el dígito verificador
	function digitoVerificador(curp17) {
		var diccionario = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ",
			lngSuma = 0.0,
			lngDigito = 0.0;
		for (var i = 0; i < 17; i++)
			lngSuma = lngSuma + diccionario.indexOf(curp17.charAt(i)) * (18 - i);
		lngDigito = 10 - lngSuma % 10;
		if (lngDigito == 10) return 0;
		return lngDigito;
	}

	if (validado[2] != digitoVerificador(validado[1]))
		return false;

	return true; //Validado
}

//Handler para el evento cuando cambia el input
//Lleva la CURP a mayúsculas para validarlo
function validarInputC(input) {
	var curp = input.value.toUpperCase(),
		resultadoC = document.getElementById("resultadoC"),
		valido = '<div class="alert alert-danger w-100" role="alert" id="curp_ok">CURP no válida</div>';


	if (curpValida(curp)) { // Comprobación
		valido = '<div class="alert alert-success w-100" role="alert" id="curp_ok"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>CURP válida</div>';
		resultadoC.classList.add("ok");
	} else {
		resultadoC.classList.remove("ok");
	}

	resultadoC.innerHTML = " " + valido;
}

//Función para validar un RFC
// Devuelve el RFC sin espacios ni guiones si es correcto
// Devuelve false si es inválido
// (debe estar en mayúsculas, guiones y espacios intermedios opcionales)
function rfcValido(rfc, aceptarGenerico = true) {
	const re = /^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/;
	var validado = rfc.match(re);

	if (!validado) //Coincide con el formato general del regex?
		return false;

	//Separar el dígito verificador del resto del RFC
	const digitoVerificador = validado.pop(),
		rfcSinDigito = validado.slice(1).join(''),
		len = rfcSinDigito.length,

		//Obtener el digito esperado
		diccionario = "0123456789ABCDEFGHIJKLMN&OPQRSTUVWXYZ Ñ",
		indice = len + 1;
	var suma,
		digitoEsperado;

	if (len == 12) suma = 0
	else suma = 481; //Ajuste para persona moral

	for (var i = 0; i < len; i++)
		suma += diccionario.indexOf(rfcSinDigito.charAt(i)) * (indice - i);
	digitoEsperado = 11 - suma % 11;
	if (digitoEsperado == 11) digitoEsperado = 0;
	else if (digitoEsperado == 10) digitoEsperado = "A";

	//El dígito verificador coincide con el esperado?
	// o es un RFC Genérico (ventas a público general)?
	if ((digitoVerificador != digitoEsperado) &&
		(!aceptarGenerico || rfcSinDigito + digitoVerificador != "XAXX010101000"))
		return false;
	else if (!aceptarGenerico && rfcSinDigito + digitoVerificador == "XEXX010101000")
		return false;
	return rfcSinDigito + digitoVerificador;
}


//Handler para el evento cuando cambia el input
// -Lleva la RFC a mayúsculas para validarlo
// -Elimina los espacios que pueda tener antes o después
function validarInputR(input) {
	var rfc = input.value.trim().toUpperCase(),
		resultadoR = document.getElementById("resultadoR"),
		valido;

	var rfcCorrecto = rfcValido(rfc); // Comprobación

	if (rfcCorrecto) {
		valido = '<div class="alert alert-success w-100" role="alert" id="rfc_ok"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>RFC válido</div>';
		resultadoR.classList.add("ok");
	} else {
		valido = '<div class="alert alert-danger w-100" role="alert" id="rfc">RFC no válido</div>';
		resultadoR.classList.remove("ok");
	}

	resultadoR.innerHTML = " " + valido;
}


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
				// console.log(response.data);
				if (response.data.status == 'loggedin') {

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
					$scope.alert = {
						titulo: 'Error!',
						tipo: 'danger',
						mensaje: 'Verifique que sus datos sean correctos.'
					};
					$(document).ready(function () {
						$('#alerta').toast('show');
					});
				}
			}),
			function errorCallback(response) {
				return false;
			}
	}
});

app.controller('inicioCtrl', function ($scope, $location, user, periodoService) {

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

app.controller('programaCtrl', function ($scope, $http, $location, $filter, user, curso, periodoService, $timeout) {

	$scope.user = user.getName();

	$scope.getCursos = function () {
		$http({
			method: 'GET',
			url: '/Residencia/Pruebas/pruebaLogin/php/getCursos.php'
		}).then(function successCallback(response) {
			$scope.cursos = response.data;
		}, function errorCallback(response) {
			console.log(response);
		});
	}

	$scope.getDepartamentos = function () {
		$http({
			method: 'GET',
			url: '/Residencia/Pruebas/pruebaLogin/php/getDepartamentos.php'
		}).then(function successCallback(response) {
			$scope.dptos = response.data;
		}, function errorCallback(response) {
			console.log(response);
		});
	}

	$scope.getInstructores = function () {
		$http({
			method: 'GET',
			url: '/Residencia/Pruebas/pruebaLogin/php/getInstructores.php'
		}).then(function successCallback(response) {
			$scope.instructor = response.data;
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
		}, function errorCallback(response) {

		});
	}

	$scope.getListaDocumentosSubidos = function () {
		var idCurso = curso.getID();
		$http({
			method: 'POST',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getDocsCurso.php',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			data: 'idCurso=' + idCurso
		}).then(function successCallback(response) {
			$scope.documentosSubidos = response.data;
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

				if (response.data.modalidad.indexOf("Virtual") !== -1) {
					$scope.actCurso.modalidad = 2;
				} else if (response.data.modalidad.indexOf("Presencial") !== -1) {
					$scope.actCurso.modalidad = 1;
				} else {
					$scope.actCurso.modalidad = 3;
				}
				$scope.curso = $scope.actCurso;
				// console.log($scope.curso);
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
			// console.log("No hay datos.");
		});
	}

	$scope.getDocumento = function (doc) {
		return 'http://localhost/Residencia/proyecto/files/' + doc;
	};

	$scope.crearCurso = function (datos) {
		datos.username = user.getName();
		datos.departamento = user.getIdDepartamento();
		console.log(datos);
		if (
			datos.folio != undefined &&
			datos.clave != undefined &&
			datos.nombre != undefined &&
			datos.duracion != undefined &&
			datos.horaInicio != "" &&
			datos.horaFin != "" &&
			datos.fechaInicio != "" &&
			datos.fechaFin != "" &&
			datos.modalidad != undefined &&
			datos.lugar != undefined &&
			datos.destinatarios != undefined &&
			datos.Objetivo != undefined &&
			datos.departamento != undefined &&
			datos.instructor != undefined
		) {
			$http({
				method: 'POST',
				url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/crearCursoC.php',
				headers: {
					'Content-Type': 'application/json'
				},
				data: JSON.stringify(datos)
			}).then(function successCallback(response) {
				console.log(response.data);
				if (response.data.status == "ok") {
					$scope.alert = {
						titulo: 'Creado!',
						tipo: 'success',
						mensaje: 'Curso creado de forma exitosa.'
					};
					$(document).ready(function () {
						$('#alerta').toast('show');
					});
					$timeout(function () {
						$location.path("/inicioC");
					}, 2000);
				} else {
					$scope.alert = {
						titulo: 'Error!',
						tipo: 'danger',
						mensaje: 'Ocurrió un error al crear el curso'
					};
					$(document).ready(function () {
						$('#alerta').toast('show');
					});
				}
			});
		} else {
			$scope.alert = {
				titulo: 'Hey!',
				tipo: 'warning',
				mensaje: 'Verifica que todos los campos estén llenos.'
			};
			$(document).ready(function () {
				$('#alerta').toast('show');
			});
		}
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
				$scope.alert = {
					titulo: 'Error!',
					tipo: 'danger',
					mensaje: 'Ocurrió un error al actualizar el curso'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});
				$timeout(function () {
					$location.path("/inicioC");
				}, 2000);
			}
			if (response.data.status == "ok") {
				$scope.alert = {
					titulo: 'Actualizado!',
					tipo: 'success',
					mensaje: 'Actualización exitosa.'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});
				$timeout(function () {
					$location.path("/inicioC");
				}, 2000);
			}
		}, function errorCallback(response) {
			// console.log("No hay datos.");
		});
	}

	$scope.deleteCurso = function (id, nombreCurso) {
		$http({
			method: 'POST',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/deleteCurso.php',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			data: 'idCurso=' + id
		}).then(function successCallback(response) {
			if (response.data.status == "ok") {
				$('#modal' + id).modal('hide');
				$('.modal-backdrop').remove();

				$scope.alert = {
					titulo: 'Eliminado!',
					tipo: 'success',
					mensaje: 'Curso eliminado correctamente'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});
				$scope.getCursos();
			} else {
				$scope.alert = {
					titulo: 'Error!',
					tipo: 'danger',
					mensaje: 'No se pudo eliminar el curso.'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});
			}
		}, function errorCallback(response) {
			return false;
		});
	}

	$scope.upload = function (idDoc, idCurso) {

		var fd = new FormData();
		var files = document.getElementById('file' + idDoc).files[0];
		fd.append('archivo', files);
		fd.append('idCurso', idCurso);
		fd.append('idDocumento', idDoc);

		$http({
			method: 'post',
			url: '/Residencia/Pruebas/pruebaLogin/php/subirArchivo.php',
			data: fd,
			headers: {
				'Content-Type': undefined
			},
		}).then(function successCallback(response) {
			$scope.response = response.data;

			if (response.data.status != undefined) {
				$scope.alert = {
					titulo: 'Archivo subido!',
					tipo: 'success',
					mensaje: 'Archivo subido correctamente'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});

				$('#modal' + idDoc).modal('hide');
				document.getElementById('mensaje' + idDoc).innerHTML = 'Documento subido';
			}
		}, function errorCallback(response) {
			$scope.upload(idDoc, idCurso);
		});
	}

	$scope.addComment = function (documento, id) {
		$scope.alert = {
			titulo: 'Holi!',
			tipo: 'info',
			mensaje: 'Aún no hago nada, pero el comentario es: "' + documento.comentario + '" y el idDocumento es: ' + id
		};
		$(document).ready(function () {
			$('#alerta').toast('show');
		});
		documento.comentario = "";
	}



	$scope.getDoc();
	$scope.getListaDocumentosCurso();
	$scope.getListaDocumentosSubidos();
	$scope.getCursos();
	$scope.getInstructores();
	$scope.getDepartamentos();
	$scope.getInfoCurso();
	$scope.getCursoAct();
});

app.controller('constanciasCtrl', function ($scope, $http, $location, user, periodoService, curso, constancia) {
	$scope.user = user.getName();

	$scope.getConstancias = function () {
		$http({
			method: 'GET',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getConstancias.php'
		}).then(function successCallback(response) {
			$scope.constancias = response.data;
		});
	}

	$scope.periodo = periodoService.getPeriodo()
		.then(function (response) {
			$scope.periodo = response;
		}, function (error) {
			console.log(response);
		});

	$scope.getPeriodos = function () {
		$http({
			method: 'GET',
			url: '/Residencia/Pruebas/pruebaLogin/php/getPeriodos.php'
		}).then(function successCallback(response) {
			$scope.periodos = response.data;
		});
	}

	$scope.getConstanciasPeriodoActual = function () {
		$scope.periodoActual = periodoService.getPeriodo()
			.then(function (response) {
				$scope.periodoActual = response;

				$http({
					url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getConstanciasPeriodoActual.php',
					method: 'POST',
					headers: {
						'Content-Type': 'application/json'
					},
					data: JSON.stringify($scope.periodoActual)
				}).then(function successCallback(response) {
					$scope.constanciasPeriodoActual = response.data;
					// console.log($scope.constanciasPeriodoActual);
				});
			}, function (error) {
				console.log(response);
			});
	}

	$scope.getCursosDelPeriodo = function (periodo) {
		$http({
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getCursosPorPeriodo.php',
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			data: 'periodo=' + periodo.periodo
		}).then(function successCallback(response) {
			$scope.cursosPeriodo = response.data;
		});
	}

	$scope.cursoSeleccionado = function (curso) {
		$http({
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getParticipantes.php',
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			data: 'idCurso=' + curso.idCurso
		}).then(function successCallback(response) {
			$scope.participantesCurso = response.data;
		});



	}

	$scope.verConstancia = function (folio, idCurso) {
		constancia.setFolio(folio);
		curso.setID(idCurso);
		$scope.getConstancia();
	};



	$scope.getConstancia = function () {
		var idCurso = curso.getID();
		var folio = constancia.getFolio();
		$http({
			method: 'POST',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getConstancia.php',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			data: 'idCurso=' + idCurso + '&folio=' + folio
		}).then(function successCallback(response) {
			$scope.constancia = response.data;
		});
	}

	$scope.getDocumento = function () {
		return 'http://localhost/Residencia/proyecto/files/' + constancia.getRuta();
	};

	$scope.back = function () {
		window.history.back();
	};

	$scope.crearConstancia = function () {

		var datos = {
			'folio': $scope.constancia.folio,
			'participante': $scope.constancia.participante.nombre,
			'idUsuario': $scope.constancia.participante.idUsuario,
			'rol': $scope.constancia.participante.rol,
			'curso': $scope.constancia.curso.curso,
			'idCurso': $scope.constancia.curso.idCurso,
			'fecha': $scope.constancia.curso.fecha,
			'duracion': $scope.constancia.curso.duracion
		}
		$http({
			method: 'POST',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/generarConstancia.php',
			headers: {
				'Content-Type': 'application/json'
			},
			data: JSON.stringify(datos)
		}).then(function successCallback(response) {
			console.log(response.data);
			if (response.data.status == "ok") {
				$scope.alert = {
					titulo: 'Listo!',
					tipo: 'success',
					mensaje: 'Constancia generada con éxito.'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});
				$scope.getConstanciasPeriodoActual();
				$scope.constancia = {};
			} else {
				$scope.alert = {
					titulo: 'Oops!',
					tipo: 'danger',
					mensaje: 'Ocurrió un error al generar la constancia.'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});
			}
		});
	}

	$scope.folioConstancia = constancia.getFolio();
	$scope.rutaConstancia = constancia.getRuta();

	$scope.getConstancia();
	$scope.getConstancias();
	$scope.getPeriodos();
	$scope.getConstanciasPeriodoActual();
});

app.controller('convocatoriaCtrl', function ($scope, $http, $location, user, periodoService) {
	$scope.user = user.getName();
});

app.controller('instructoresCtrl', function ($scope, $http, $location, user, periodoService, instructor, $timeout) {
	$scope.user = user.getName();
	$scope.periodo = periodoService.getPeriodo()
		.then(function (response) {
			$scope.periodo = response;
		}, function (error) {
			console.log(response);
		});

	$scope.getInstructores = function () {
		$http({
			method: 'GET',
			url: '/Residencia/Pruebas/pruebaLogin/php/getInstructores.php'
		}).then(function successCallback(response) {
			$scope.instructores = response.data;
			// console.log(response.data);
		}, function errorCallback(response) {
			console.log(response);
		});
	}

	$scope.getInstructores();

	$scope.getDepartamentos = function () {
		$http({
			method: 'GET',
			url: '/Residencia/Pruebas/pruebaLogin/php/getDepartamentos.php'
		}).then(function successCallback(response) {
			$scope.dptos = response.data;
		}, function errorCallback(response) {
			console.log(response);
		});
	}

	$scope.getDepartamentos();

	$scope.agregarInstructor = function (datos) {
		console.log(datos);
		$http({
			method: 'POST',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/agregarInstructor.php',
			headers: {
				'Content-Type': 'application/json'
			},
			data: JSON.stringify(datos)
		}).then(function successCallback(response) {
			console.log(response.data);
			if (response.data.status == "ok") {
				$scope.alert = {
					titulo: 'Creado!',
					tipo: 'success',
					mensaje: 'Instructor agregado de forma exitosa.'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});
				$timeout(function () {
					$location.path("inicioC/instructores");
				}, 2000);
			} else {
				$scope.alert = {
					titulo: 'Creado!',
					tipo: 'success',
					mensaje: 'Ocurrió un error al ingresar instructor'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});
				$timeout(function () {
					$location.path("inicioC/instructores");
				}, 2000);
			}
		}, function errorCallback(response) {
			// console.log("No hay datos.");
		});
	}

	$scope.inst = {};

	$scope.deleteInstructor = function (id, nombreInstructor) {
		$http({
			method: 'POST',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/deleteInstructor.php',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			data: 'idInstructor=' + id
		}).then(function successCallback(response) {
			if (response.data.status == "ok") {
				$('#modal' + id).modal('hide');
				$('.modal-backdrop').remove();

				$scope.alert = {
					titulo: 'Eliminado!',
					tipo: 'success',
					mensaje: 'Instructor eliminado correctamente'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});
				$scope.getInstructores();
			} else {
				$scope.alert = {
					titulo: 'Error!',
					tipo: 'danger',
					mensaje: 'No se pudo eliminar al instructor.'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});
			}
		}, function errorCallback(response) {
			return false;
		});
	}

	$scope.instructorID = function (id) {
		instructor.setID(id);
	}

	$scope.getInstructorAct = function () {

		$scope.idInstructor = instructor.getID();
		console.log($scope.idInstructor);

		if ($scope.idInstructor != "") {
			$http({
				url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getInstructorAct.php',
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'idInstructor=' + $scope.idInstructor
			}).then(function successCallback(response) {
				$scope.actInstructor = response.data;
				$scope.instructor = response.data;
				//  console.log(response.data);
			}, function errorCallback(response) {

			});
		}

	}

	$scope.getInstructorAct();

	$scope.actualizarInstructor = function () {
		$http({
			method: 'POST',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/actualizarInstructor.php',
			headers: {
				'Content-Type': 'application/json'
			},
			data: JSON.stringify($scope.instructor)
		}).then(function successCallback(response) {
			if (response.data.status != "ok") {
				$scope.alert = {
					titulo: 'Error!',
					tipo: 'danger',
					mensaje: 'Ocurrió un error al crear el curso'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});
				$timeout(function () {
					$location.path("/inicioC/instructores");
				}, 2000);
			} else {
				$scope.alert = {
					titulo: 'Creado!',
					tipo: 'success',
					mensaje: 'Actualización exitosa.'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});
				$timeout(function () {
					$location.path("/inicioC/instructores");
				}, 2000);
			}
		}, function errorCallback(response) {
			console.log("No hay datos.");
		});
	}
});

/* CONTROLADORES PARA EL USUARIO INSTRUCTOR */
app.controller('cursosICtrl', function ($scope, $http, $location, user, curso, periodoService) {
	$scope.user = user.getName();
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

	$scope.getListaDocumentosCurso = function () {
		$http({
			method: 'GET',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getDocumentos.php'
		}).then(function successCallback(response) {
			$scope.documentos = response.data;
		}, function errorCallback(response) {

		});
	}

	$scope.cursoID = function (id) {
		curso.setID(id);
	}

	$scope.getInfoCurso = function () {
		$scope.idCurso = curso.getID();
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
			});
		}
	}

	$scope.upload = function (idDoc, idCurso) {
		var fd = new FormData();
		var files = document.getElementById('file' + idDoc).files[0];
		fd.append('archivo', files);
		fd.append('idCurso', idCurso);
		fd.append('idDocumento', idDoc);
		$http({
			method: 'post',
			url: '/Residencia/Pruebas/pruebaLogin/php/subirArchivo.php',
			data: fd,
			headers: {
				'Content-Type': undefined
			},
		}).then(function successCallback(response) {
			$scope.response = response.data;

			if (response.data.status != undefined) {
				$scope.alert = {
					titulo: 'Archivo subido!',
					tipo: 'success',
					mensaje: 'Archivo subido correctamente'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});
				$('#modal' + idDoc).modal('hide');
				document.getElementById('mensaje' + idDoc).innerHTML = 'Documento subido';
			}
		});
	}

	$scope.back = function () {
		window.history.back();
	};

	$scope.getListaDocumentosCurso();
	$scope.getCursos();
	$scope.getInfoCurso();

});

app.controller('asistenciaICtrl', function ($scope, $http, $location, user, curso, periodoService) {
	$scope.user = user.getName();
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

app.controller('participantesICtrl', function ($scope, $http, $location, user, curso, periodoService) {
	$scope.user = user.getName();
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

app.controller('cursosJCtrl', function ($scope, $http, $location, user, curso, periodoService, $timeout) {
	$scope.user = user.getName();
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
		console.log(curso.getID() + "hola");
	}

	$scope.crearCurso = function (datos) {
		console.log(datos);
		if (datos.objetivo != "") {
			$http({
				method: 'POST',
				url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/crearCursoC.php',
				headers: {
					'Content-Type': 'application/json'
				},
				data: JSON.stringify(datos)
			}).then(function successCallback(response) {
				console.log(response.data);
				if (response.data.status == "ok") {
					$scope.alert = {
						titulo: 'Creado!',
						tipo: 'success',
						mensaje: 'Curso creado de forma exitosa.'
					};
					$(document).ready(function () {
						$('#alerta').toast('show');
					});
					$timeout(function () {
						$location.path("/inicioJ/cursos");
					}, 2000);
				} else {
					$scope.alert = {
						titulo: 'Creado!',
						tipo: 'success',
						mensaje: 'Ocurrió un error al crear el curso'
					};
					$(document).ready(function () {
						$('#alerta').toast('show');
					});
					$timeout(function () {
						$location.path("/inicioJ/cursos");
					}, 2000);
				}
			}, function errorCallback(response) {
				// console.log("No hay datos.");
			});
		}
	}
	$scope.curso = {};

	$scope.actualizarCurso = function () {


		$http({
			method: 'POST',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/actualizarCursoJ.php',
			headers: {
				'Content-Type': 'application/json'
			},
			data: JSON.stringify($scope.curso)
		}).then(function successCallback(response) {
			if (response.data.status != "ok") {
				$scope.alert = {
					titulo: 'Error!',
					tipo: 'danger',
					mensaje: 'Ocurrió un error al crear el curso'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});
				$timeout(function () {
					$location.path("/inicioC");
				}, 2000);
			} else {
				$scope.alert = {
					titulo: 'Creado!',
					tipo: 'success',
					mensaje: 'Actualización exitosa.'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});
				$timeout(function () {
					$location.path("/inicioC");
				}, 3000);
			}
		}, function errorCallback(response) {
			// console.log("No hay datos.");
		});
	}


	$scope.getCursoAct = function () {

		$scope.idCurso = curso.getID();
		//console.log($scope.idCurso);

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

				if (response.data.modalidad.indexOf("Virtual") !== -1) {
					$scope.actCurso.modalidad = 2;
				} else if (response.data.modalidad.indexOf("Presencial") !== -1) {
					$scope.actCurso.modalidad = 1;
				} else {
					$scope.actCurso.modalidad = 3;
				}
				$scope.curso = $scope.actCurso;
				console.log($scope.curso);
			}, function errorCallback(response) {

			});
		}

	}


	$scope.deleteCurso = function (id, nombreCurso) {
		$http({
			method: 'POST',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/deleteCurso.php',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			data: 'idCurso=' + id
		}).then(function successCallback(response) {
			if (response.data.status == "ok") {
				$('#modal' + id).modal('hide');
				$('.modal-backdrop').remove();

				$scope.alert = {
					titulo: 'Eliminado!',
					tipo: 'success',
					mensaje: 'Curso eliminado correctamente'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});
				$scope.getCursos();
			} else {
				$scope.alert = {
					titulo: 'Error!',
					tipo: 'danger',
					mensaje: 'No se pudo eliminar el curso.'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});
			}
		}, function errorCallback(response) {
			return false;
		});
	}

	$scope.getDepartamentos = function () {
		$http({
			method: 'GET',
			url: '/Residencia/Pruebas/pruebaLogin/php/getDepartamentos.php'
		}).then(function successCallback(response) {
			$scope.dptos = response.data;
			// console.log(response.data);
		}, function errorCallback(response) {
			console.log(response);
		});
	}

	$scope.getInstructores = function () {
		$http({
			method: 'GET',
			url: '/Residencia/Pruebas/pruebaLogin/php/getInstructores.php'
		}).then(function successCallback(response) {
			$scope.instructor = response.data;
			// console.log(response.data);
		}, function errorCallback(response) {
			console.log(response);
		});
	}

	$scope.upload = function (idDoc, idCurso) {

		var fd = new FormData();
		var files = document.getElementById('file' + idDoc).files[0];
		fd.append('archivo', files);
		fd.append('idCurso', idCurso);
		fd.append('idDocumento', idDoc);
		// AJAX request
		$http({
			method: 'post',
			url: '/Residencia/Pruebas/pruebaLogin/php/subirArchivo.php',
			data: fd,
			headers: {
				'Content-Type': undefined
			},
		}).then(function successCallback(response) {
			if (response.data.status != undefined) {
				alert(response.data.status);
				$('#modal' + idDoc).modal('hide');
				document.getElementById('mensaje' + idDoc).innerHTML = 'Documento subido';
			}
		});
	}

	$scope.getCursoAct();

	$scope.getInfoCurso();
	$scope.getCursos();
	$scope.getDepartamentos();
	$scope.getInstructores();
	$scope.getListaDocumentosCurso();
});

app.controller('encuestaJCtrl', function ($scope, $http, $location, user, periodoService) {
	$scope.user = user.getName();
});

/*	CONTROLADORES PARA EL USUARIO DOCENTE */
app.controller('cursosDCtrl', function ($scope, $http, $location, user, curso, periodoService) {
	$scope.user = user.getName();
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
	$scope.cursoID = function (id) {
		curso.setID(id);
	}


	$scope.salirCurso = function (id) {
		$scope.idUsuario = user.getIdUsuario();

		$http({
			method: 'POST',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/salirCurso.php',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			data: 'idCurso=' + id + '&idUsuario=' + $scope.idUsuario
		}).then(function successCallback(response) {
			if (response.data.status == "ok") {
				$('#modal1' + id).modal('hide');
				$('.modal-backdrop').remove();

				$scope.alerta = {
					titulo: '¡Has salido!',
					tipo: 'success',
					mensaje: 'Has salido del curso correctamente'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});
				$scope.getCursos();
				$scope.getMisCursos();
			} else {
				$scope.alerta = {
					titulo: 'Error!',
					tipo: 'danger',
					mensaje: 'No se pudo salir del curso.'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});
			}
		}, function errorCallback(response) {
			return false;
		});
	}

	$scope.inscribirCurso = function (id) {
		$scope.idUsuario = user.getIdUsuario();

		$http({
			method: 'POST',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/inscribirCurso.php',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			data: 'idCurso=' + id + '&idUsuario=' + $scope.idUsuario
		}).then(function successCallback(response) {
				if (response.data.status == "ok") {
					$('#modal' + id).modal('hide');
					$('.modal-backdrop').remove();

					$scope.alert = {
						titulo: '¡Estás inscrito!',
						tipo: 'success',
						mensaje: 'Te has inscrito al curso correctamente'
					};
					$(document).ready(function () {
						$('#alerta').toast('show');
					});
					$scope.getCursos();
					$scope.getMisCursos();
				} else if (response.data.status == "Ya existe") {
					$scope.alert = {
						titulo: '¡Ya estás inscrito!',
						tipo: 'warning',
						mensaje: 'Intenta inscribirte a otro curso, en este ya estás.'
					};
					$(document).ready(function () {
						$('#alerta').toast('show');
					});
				} else {
					$scope.alert = {
						titulo: 'Error!',
						tipo: 'danger',
						mensaje: 'No se pudo inscribir del curso.'
					};
					$(document).ready(function () {
						$('#alerta').toast('show');
					});
				}
			},
			function errorCallback(response) {
				return false;
			});
	}

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

	$scope.getMisCursosConcluidos = function () {

		$scope.id = user.getIdUsuario();

		if ($scope.id != undefined) {
			$http({
				url: '/Residencia/Pruebas/pruebaLogin/php/getMisCursosConcluidos.php',
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'idUsuario=' + $scope.id
			}).then(function successCallback(response) {
				$scope.misCursosC = response.data;
				//console.log(response.data);
			}, function errorCallback(response) {
				//console.log(response.data);
			});
		}

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
	$scope.getMisCursosConcluidos();
	// $scope.periodo();
});

app.controller('encuestaDCtrl', function ($scope, $http, $location, user, periodoService) {
	$scope.user = user.getName();
});

app.controller('constanciasDCtrl', function ($scope, $http, $location, user, periodoService) {
	$scope.user = user.getName();
});