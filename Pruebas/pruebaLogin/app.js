var app = angular.module('myApp', ['ngRoute']);

/* Configuración de todas las rutas */
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
		}).when('/prueba', {
			templateUrl: 'prueba.html',
			controller: 'pruebaCtrl'
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
			controller: 'cursosDCtrl'

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

		}).when('/inicioI/reconocimientos', {
			resolve: {
				check: function ($location, user) {
					if (user.getRol() != 4) {
						$location.path(user.getPath());
					}
				},
			},
			templateUrl: './vistasI/reconocimientos.html',
			controller: 'reconocimientosICtrl'

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
			controller: 'cursosJCtrl'

		}).otherwise({
			templateUrl: '404.html'
		});

});

app.service('user', function () {
	/*Declaracion de variables para el inicio de sesion */
	var username;
	var loggedin = false;
	var id;
	var rol;
	var idDepartamento;

	/* Obtiene el nombre del usuario que se guardó en el inicio de sesion */
	this.getName = function () {
		if (!!localStorage.getItem('login')) {
			var data = JSON.parse(localStorage.getItem('login'));
			username = data.username;
		}
		return username;
	};

	/* Obtiene el ID del usuario que se guardó en el inicio de sesion */
	this.getIdUsuario = function () {
		if (!!localStorage.getItem('login')) {
			var data = JSON.parse(localStorage.getItem('login'));
			id = data.id;
			// console.log(id);
		}
		return id;
	};

	/* Obtiene el nombre del departamento del usuario que se guardó en el inicio de sesion */
	this.getIdDepartamento = function () {
		if (!!localStorage.getItem('login')) {
			var data = JSON.parse(localStorage.getItem('login'));
			idDepartamento = data.idDepartamento;
			// console.log("idDepto: " + idDepartamento);
		}
		return idDepartamento;
	}

	/* Obtiene el rol del usuario que se guardó en el inicio de sesion */
	this.getRol = function () {
		if (!!localStorage.getItem('login')) {
			var data = JSON.parse(localStorage.getItem('login'));
			rol = data.rol;
		}
		return rol;
	};

	/* Obtiene la ruta de inicio para el usuario, que se guardó en el inicio de sesion */
	this.getPath = function () {
		if (!!localStorage.getItem('login')) {
			var data = JSON.parse(localStorage.getItem('login'));
			path = data.path;
		}
		return path;
	};

	/* Determina si el usuario inicio sesión */
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

	/* Guarda los datos de inicio de sesion */
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

	/* Elimina los datos de inicio de sesión */
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

	/* guarda el ID del curso */
	this.setID = function (cursoID) {
		id = cursoID;
		localStorage.setItem('idCurso', JSON.stringify({
			id: id
		}));
	};

	/* obtiene el ID del curso */
	this.getID = function () {
		if (!!localStorage.getItem('idCurso')) {
			var data = JSON.parse(localStorage.getItem('idCurso'));
			id = data.id;
		}
		return id;
	};

	/* guarda el ID del documento del curso */
	this.setIDdocumento = function (idDocumento) {
		idDoc = idDocumento;
		localStorage.setItem('idDocumento', JSON.stringify({
			id: idDoc
		}));
	};

	/* obtiene el ID del documento del curso */
	this.getIDdocumento = function () {
		if (!!localStorage.getItem('idDocumento')) {
			var data = JSON.parse(localStorage.getItem('idDocumento'));
			idDoc = data.id;
		}
		return idDoc;
	};

});

app.service('constancia', function () {
	var folio;
	var ruta;

	/* Guardar temporalmente folio de la constancia */
	this.setFolio = function (folioCons) {
		folio = folioCons;
	};

	/* Obtener folio de la constancia */
	this.getFolio = function () {
		return folio;
	};

	/* Guardar temporalmente ruta de la constancia */
	this.setRuta = function (rutaCons) {
		ruta = rutaCons;
	};

	/* Obtener ruta de la constancia */
	this.getRuta = function () {
		return ruta;
	};

	/* Guardar ruta y folio de la constancia */
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

	/* guarda el ID del Instructor */
	this.setID = function (InstructorID) {
		id = InstructorID;
		localStorage.setItem('idInstructor', JSON.stringify({
			id: id
		}));
	};

	/* obtiene el ID del Instructor */
	this.getID = function () {
		if (!!localStorage.getItem('idInstructor')) {
			var data = JSON.parse(localStorage.getItem('idInstructor'));
			id = data.id;
		}
		return id;
	};

});

app.service('encuesta', function () {
	var id;

	/* guarda el ID de la encuesta */
	this.setID = function (ide) {
		id = ide;
		localStorage.setItem('idEncuesta', JSON.stringify({
			id: id
		}));
	};

	/* obtiene el ID de la encuesta */
	this.getID = function () {
		if (!!localStorage.getItem('idEncuesta')) {
			var data = JSON.parse(localStorage.getItem('idEncuesta'));
			id = data.id;
		}
		return id;
	};

});

app.service('periodoService', function ($q, $http) {
	/* consultar el periodo actual basádose en la fecha */
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

app.service('fechaService', function ($q, $http) {
	/* Consultar la fecha actual */
	return {
		getFecha: function () {
			return $http({
				method: 'GET',
				url: '/Residencia/Pruebas/pruebaLogin/php/fecha.php'
			}).then(function successCallback(response) {
				return response.data.fecha;
			}, function errorCallback(response) {
				return $q.reject(response.data);
			});
		}
	}
});

app.service('asistenciaService', function ($http, $q) {
	/* Consultar si existen registros de asistencia para X curso 
	   el día de hoy */
	return {
		existe: function (idc) {
			return $http({
				method: 'POST',
				url: '/Residencia/Pruebas/pruebaLogin/php/getRegistroAsistenciaCurso.php',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'idc=' + idc
			}).then(function successCallback(response) {
				return response.data.status;
			}, function errorCallback(response) {
				return $q.reject(response.data);
			});
		}
	}
});

app.service('encuestaService', function ($http, $q) {
	/* Consultar si X docente ya respondió la encuesta de X curso */
	return {
		existe: function (idc,idu) {
			return $http({
				method: 'POST',
				url: '/Residencia/Pruebas/pruebaLogin/php/getRegistroEncuestaUsuarioCurso.php',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'idc=' + idc + '&idu='+idu
			}).then(function successCallback(response) {
				return response.data.status;
			}, function errorCallback(response) {
				return $q.reject(response.data);
			});
		}
	}
});

/* Filtro para hacer confiable una URL */
app.filter('trustAsResourceUrl', ['$sce', function ($sce) {
	return function (val) {
		return $sce.trustAsResourceUrl(val);
	};
}]);


/* Directiva para establecer formato de un input como Número */
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

/* Directiva para establecer formato de un input como fecha */
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

/* Función para validar una CURP */
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

/* Handler para el evento cuando cambia el input */
function validarInputC(input) {

	/* Lleva la CURP a mayúsculas para validarlo */
	var curp = input.value.toUpperCase(),
		resultadoC = document.getElementById("resultadoC"),
		valido = '<div class="alert alert-danger w-100" role="alert" id="curp_ok">CURP no válida</div>';


	/* Comprobar si la CURP es válida */
	if (curpValida(curp)) {
		valido = '<div class="alert alert-success w-100" role="alert" id="curp_ok"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>CURP válida</div>';
		resultadoC.classList.add("ok");
	} else {
		resultadoC.classList.remove("ok");
	}

	resultadoC.innerHTML = " " + valido;
}

/* Función para validar un RFC
	Devuelve el RFC sin espacios ni guiones si es correcto
	Devuelve false si es inválido
  (debe estar en mayúsculas, guiones y espacios intermedios opcionales) */
function rfcValido(rfc, aceptarGenerico = true) {
	const re = /^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/;
	var validado = rfc.match(re);

	/* Coincide con el formato general del regex? */
	if (!validado) 
		return false;

	/* Separa el dígito verificador del resto del RFC */
	const digitoVerificador = validado.pop(),
		rfcSinDigito = validado.slice(1).join(''),
		len = rfcSinDigito.length,

		/* Obtener el digito esperado */
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

	/* El dígito verificador coincide con el esperado?
	   o es un RFC Genérico (ventas a público general)? */
	if ((digitoVerificador != digitoEsperado) &&
		(!aceptarGenerico || rfcSinDigito + digitoVerificador != "XAXX010101000"))
		return false;
	else if (!aceptarGenerico && rfcSinDigito + digitoVerificador == "XEXX010101000")
		return false;
	return rfcSinDigito + digitoVerificador;
}

/* Handler para el evento cuando cambia el input
	-Lleva la RFC a mayúsculas para validarlo
	-Elimina los espacios que pueda tener antes o después */
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

/* Controlador para el inicio de sesión */
app.controller('loginCtrl', function ($scope, $http, $location, user) {

	/* Functión para inicio de sesión */
	$scope.login = function () {
		/* Declaración de variables */
		var username = $scope.username;
		var password = $scope.password;

		/* Peticion HTTP para consultar usuario y contraseña */
		$http({
				url: 'http://localhost/Residencia/Pruebas/pruebaLogin/server.php',
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'username=' + username + '&password=' + password
			}).then(function (response) {
				
				/* Si las credenciales fueron correctas, guarda los 
				   datos de inio de sesión y redirige al menú de 
				   inicio correspondiente */
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
					/* Si las credenciales fueron incorrectas muestra una alerta */
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

/* CONTROLADORES PARA EL USUARIO COORDINADOR*/
app.controller('programaCtrl', function ($scope, $http, $location, $filter, user, curso, periodoService, $timeout) {

	/* Obtener nombre del usuario para ponerlo en la barra del menú */
	$scope.user = user.getName();

	/* Peticion para obtener todos los cursos */
	$scope.getCursos = function () {
		$http({
			method: 'GET',
			url: '/Residencia/Pruebas/pruebaLogin/php/getCursos.php'
		}).then(function successCallback(response) {
			$scope.cursos = response.data;
		});
	}

	/* Peticion para obtener todos los departamentos */
	$scope.getDepartamentos = function () {
		$http({
			method: 'GET',
			url: '/Residencia/Pruebas/pruebaLogin/php/getDepartamentos.php'
		}).then(function successCallback(response) {
			$scope.dptos = response.data;
		});
	}

	/* Peticion para obtener todos los instructores */
	$scope.getInstructores = function () {
		$http({
			method: 'GET',
			url: '/Residencia/Pruebas/pruebaLogin/php/getInstructores.php'
		}).then(function successCallback(response) {
			$scope.instructor = response.data;
		});
	}

	/* Consulta al servicio para obtener el periodo */
	$scope.periodo = periodoService.getPeriodo()
		.then(function (response) {
			$scope.periodo = response;
		});

	/* Peticion para obtener el listado de todos los documentos */
	$scope.getListaDocumentosCurso = function () {
		$http({
			method: 'GET',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getDocumentos.php'
		}).then(function successCallback(response) {
			$scope.documentos = response.data;
		}, function errorCallback(response) {

		});
	}

	/* Peticion para obtener el listado de todos los documentos
	   que se han subido de un curso determinado */
	$scope.getListaDocumentosSubidos = function () {
		var idCurso = curso.getID();
		$timeout(function () { //delay para la ejecución de la consulta
			if (idCurso != undefined) {
				/* Peticion HTTP */
				$http({
					method: 'POST',
					url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getDocsCurso.php',
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded'
					},
					data: 'idCurso=' + idCurso
				}).then(function successCallback(response) {
					$scope.documentosSubidos = response.data;
					/* Delay para ejecución del código */
					$timeout(function () {
						/*  Si existen documentos subidos se analiza si
							tienen algún comentario, en caso de tenerlo
							se oculta el botón "Agregar comentario" y se
							muesta un textarea con el comentario junto a
							un botón para editar el comentario. Cuando no
							hay comentario para el documento sólo se 
							muestra el botón */
						if ($scope.documentosSubidos != null) {
							angular.forEach($scope.documentosSubidos, function (value) {
								if (value.comentario == null) {
									$("#btn" + value.idDocumento).show();
									$("#coment" + value.idDocumento).hide();
								} else {
									$("#btn" + value.idDocumento).hide();
									$("#coment" + value.idDocumento).show();
								}
							});
						}
					}, 100);
				});
			}
		}, 250);
	}

	/* Guardar el ID del curso */
	$scope.cursoID = function (id) {
		curso.setID(id);
	}

	/* Obtener información del curso mediante peticion HTTP */
	$scope.getInfoCurso = function () {
		/* Obtener ID del curso */
		$scope.idCurso = curso.getID();
		/* Validar que no esté vacío */
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
			});
		}
	}

	/* Obtener los datos del curso para su actualización */
	$scope.getCursoAct = function () {
		$scope.idCurso = curso.getID();
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
				/* Determina la modalidad basado en el string */
				if (response.data.modalidad.indexOf("Virtual") !== -1) {
					$scope.actCurso.modalidad = 2;
				} else if (response.data.modalidad.indexOf("Presencial") !== -1) {
					$scope.actCurso.modalidad = 1;
				} else {
					$scope.actCurso.modalidad = 3;
				}
			});
		}
	}

	/* vuelve atrás en el navegador */
	$scope.back = function () {
		window.history.back();
	};

	/* establecer los ID del curso y del documento */
	$scope.verDoc = function (idCurso, idDocumento) {
		curso.setID(idCurso);
		curso.setIDdocumento(idDocumento);
		$scope.getDoc();
	};

	/* Obtiene los datos de un documento de un curso */
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
		});
	}

	/* Retorna el link del documento */
	$scope.getDocumento = function (doc) {
		return 'http://localhost/Residencia/proyecto/files/' + doc;
	};

	/* Función para la creación de un curso */
	$scope.crearCurso = function (datos) {
		/* Obtiene los datos del usuario que lo está creando */
		datos.username = user.getName();
		datos.departamento = user.getIdDepartamento();
		/* Valida que los campos obligatorios no estén vacíos*/
		if (
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
			/* Envía los datos del formulario */
			$http({
				method: 'POST',
				url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/crearCursoC.php',
				headers: {
					'Content-Type': 'application/json'
				},
				data: JSON.stringify(datos)
			}).then(function successCallback(response) {
				/* valida si la inserción se hizo correctamente */
				if (response.data.status == "ok") {
					/* Asigna datos de éxito a la alerta */
					$scope.alert = {
						titulo: 'Creado!',
						tipo: 'success',
						mensaje: 'Curso creado de forma exitosa.'
					};
					/* muestra un toast */
					$(document).ready(function () {
						$('#alerta').toast('show');
					});
					/* Después de 2seg redirecciona al inicio */
					$timeout(function () {
						$location.path("/inicioC");
					}, 2000);
				} else {
					/* Asigna datos de error a la alerta */
					$scope.alert = {
						titulo: 'Error!',
						tipo: 'danger',
						mensaje: 'Ocurrió un error al crear el curso'
					};
					/* muestra un toast */
					$(document).ready(function () {
						$('#alerta').toast('show');
					});
				}
			});
		} else {
			/* Si hay campos obligatorios vacíos muestra la alerta
			   correspondiente  */
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

	/* Declaración del array que almacenará los datos del curso */
	//! ---- Es posible que se innecesario y se pueda borrar ---- !
	$scope.curso = {};

	/* Envía los datos actualizados del curso */
	$scope.actualizarCurso = function (datos) {
		$http({
			method: 'POST',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/actualizarCursoC.php',
			headers: {
				'Content-Type': 'application/json'
			},
			data: JSON.stringify(datos)
		}).then(function successCallback(response) {
			/* Valida si la actualización tuvo éxito, muestra el toast
			   correspondiente y redirige a la pantalla de inicio */
			if (response.data.status != "error") {
				$scope.alert = {
					titulo: 'Error!',
					tipo: 'danger',
					mensaje: 'Ocurrió un error al actualizar el curso'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});
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
		});
	}

	/* Funcion para eliminar un curso que recibe el id del curso */
	$scope.deleteCurso = function (id) {
		$http({
			method: 'POST',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/deleteCurso.php',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			data: 'idCurso=' + id
		}).then(function successCallback(response) {
			if (response.data.status == "ok") {
				/* si la eliminación tuvo exito oculta la ventana modal,
				   muestra el toast correspondiente y recarga los cursos */
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
				/* si la eliminación no tuvo exito muestra el 
				toast correspondiente */
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

	/* Funcion para subir un archivo de X curso */
	$scope.upload = function (idDoc, idCurso) {
		/* creación del objeto */
		var fd = new FormData();
		/* obtencion del archivo cargado */
		var files = document.getElementById('file' + idDoc).files[0];
		/* agregar el archivo y los IDs para su carga al server */
		fd.append('archivo', files);
		fd.append('idCurso', idCurso);
		fd.append('idDocumento', idDoc);

		/* Envío de los datos */
		$http({
			method: 'post',
			url: '/Residencia/Pruebas/pruebaLogin/php/subirArchivo.php',
			data: fd,
			headers: {
				'Content-Type': undefined
			},
		}).then(function successCallback(response) {
			if (response.data.status == 'ok') {
				/* Muestra el toast, oculta la ventana modal,
				   agregar un link para abrir el documento */
				$scope.alert = {
					titulo: 'Archivo subido!',
					tipo: 'success',
					mensaje: 'Archivo subido correctamente'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});

				$('#modal' + idDoc).modal('hide');
				document.getElementById('mensaje' + idDoc).innerHTML = 'Documento guardado';
				$('#linkDocumento' + idDoc).replaceWith('<span id="linkDocumento' + idDoc + '"><a href="/Residencia/Proyecto/files/' + response.data.doc + '" target="_blank">Ver documento</a></span>');
			}
		}, function errorCallback(response) {
			/* Si falla intenta subirlo de nuevo */
			$scope.upload(idDoc, idCurso);
		});
	}

	/* Valida si en la carga de la vista ya hay documentos subidos 
	   para un curso, por cada documento ya existente muestra el link
	   de dicho documento para abrirlo */
	$scope.existeDocumento = function () {
		$timeout(function () {
			$http({
				method: 'post',
				url: '/Residencia/Pruebas/pruebaLogin/php/documentosExistentesCurso.php',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'idc=' + curso.getID()
			}).then(function successCallback(response) {
				if (response.data.status = "existe") {
					angular.forEach(response.data.documentos, function (value, key) {
						$('#linkDocumento' + key).append('<a target="_blank" href="/Residencia/Proyecto/files/' + value + '">Ver documento</a>');
					});
				}
			});
		}, 500);
	}

	/* Agregar comentario a un documento */
	$scope.addComment = function (documento, idDoc, idCurso) {

		/* Valida que el comentario no esté vacío */
		if (documento.comentario != undefined) {
			$http({
				method: 'POST',
				url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/addComentario.php',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'idCurso=' + idCurso + '&idDocumento=' + idDoc + '&comentario=' + documento.comentario
			}).then(function successCallback(response) {
				$("#btn" + idDoc).hide();
				$("#coment" + idDoc).show();
			});
		}
	}

	/* Obtiene la Clave de registro para un nuevo curso */
	$scope.getNuevoFolio = function () {
		/* Si no se ha asignado un departamento para el curso toma
			por defecto el departamento del usuario */
		if ($scope.curso.departamento == undefined) {
			id = user.getIdDepartamento();
		} else {
			id = $scope.curso.departamento;
		}
		$http({
			method: 'POST',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getNuevoFolio.php',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			data: 'idDepartamento=' + id
		}).then(function successCallback(response) {
			$scope.curso.clave = response.data;
		});
	}

	/* Pasa los datos GET para obtener el oficio de creación de un curso */
	$scope.printOficio = function () {
		window.open('http://localhost/Residencia/Pruebas/pruebaLogin/php/getOficioCurso.php?idd=' + user.getIdDepartamento() +
			'&idc=' + $scope.infoCurso.idCurso + '&idu=' + user.getIdUsuario(), '_blank');
	}

	/* valida si hay cursos a los que les falta documentación,
		en caso de que exista un documento faltante muestra un
	    ícono junto al estado de validación del curso*/
	$scope.faltaDocumentacion = function () {
		$timeout(function () {
			$http({
				method: 'GET',
				url: '/Residencia/Pruebas/pruebaLogin/php/numDocsCursos.php',
			}).then(function successCallback(response) {
				angular.forEach(response.data.numDocsCurso, function (value, key) {
					if (value.num_docs < 7) {
						$("#documentacion" + value.idCurso).append('<span class="info_icon" title="Falta documentación"></span>');
					}
				});
			});
		}, 500);
	}

	/* Cambia la validación de un documento */
	$scope.validarDocumento = function (val,id){
		if(curso.getID() != undefined){
			$http({
				method: 'POST',
				url: '/Residencia/Pruebas/pruebaLogin/php/validarDocumentoCurso.php',
				headers: { 'Content-type':'application/x-www-form-urlencoded'},
				data: 'validado='+val+"&idd="+id+"&idc="+curso.getID()
			}).then(function successCallback (response){
				if(response.data.status == 'ok'){
					$scope.alert = {
						titulo: 'Ok!',
						tipo: 'success',
						mensaje: 'La validación del documento aplicada.'
					};
					$(document).ready(function () {
						$('#alerta').toast('show');
					});
					/* Llamamos al método para verificar el estado de validacion
					   de la documentacion */
					   $scope.validacionDocumentos();
				} else {
					$scope.alert = {
						titulo: 'Error!',
						tipo: 'danger',
						mensaje: 'La validación del documento no pudo ser aplicada.'
					};
					$(document).ready(function () {
						$('#alerta').toast('show');
					});
				}
			});
		}
	}	

	/* Validar si todos los documentos del curso están validados 
	   para poder validar el curso */
	$scope.validacionDocumentos = function () {
		if(curso.getID() != undefined){
			$timeout(function(){
				$http({
					method: 'POST',
					url: '/Residencia/Pruebas/pruebaLogin/php/getValidacionDocumentos.php',
					headers: { 'Content-type':'application/x-www-form-urlencoded'},
					data: 'idc='+curso.getID()
				}).then(function successCallback(response){
					/* Si la documentación del curso ya está aprobada
					   y el curso aún no, se nos muestra una alerta para
					   que lo hagamos */
					if(response.data.docs_status == 'validos' && $scope.infoCurso.validado == 'NO'){
						$scope.alert = {
							titulo: 'Atención!',
							tipo: 'secondary',
							mensaje: 'Los documentos están validados. Ya puedes validar el curso.'
						};
						$(document).ready(function () {
							$('#alerta').toast('show');
						});
						$("#curso_validado").attr('disabled',false);
					}
					/* Si se resubió un documento y la documentación pasa a estar 
					   invalidada, se vuelve a poner el curso como "no valido" */
					if(response.data.docs_status == 'invalidos' && $scope.infoCurso.validado == 'SI'){
						$http({
							method: 'POST',
							url: '/Residencia/Pruebas/pruebaLogin/php/validarCurso.php',
							headers: { 'Content-type':'application/x-www-form-urlencoded'},
							data: 'idc='+curso.getID()+"&val="+'NO'
						}).then(function successCallback(response){
							if(response.data.status ==  'ok'){
								$scope.getInfoCurso();
							}
						});
					}
				});
			},1000);
		}
		
	}

	/* Validar el curso */
	$scope.validarCurso = function (){
		if( curso.getID() != undefined ){
			$timeout(function(){
				$http({
					method: 'POST',
					url: '/Residencia/Pruebas/pruebaLogin/php/validarCurso.php',
					headers: { 'Content-type':'application/x-www-form-urlencoded'},
					data: 'idc='+curso.getID()+"&val="+$scope.infoCurso.validado
				}).then(function successCallback(response){
					if(response.data.status ==  'ok'){
						$scope.alert = {
							titulo: 'Actualizado!',
							tipo: 'success',
							mensaje: 'La validación del curso ha sido aplicada.'
						};
						$(document).ready(function () {
							$('#alerta').toast('show');
						});
					}
				});
			},500);
		}
	}

});

app.controller('constanciasCtrl', function ($scope, $http, $location, user, periodoService, curso, constancia) {
	$scope.user = user.getName();

	/* Obtener todas las constancias */
	$scope.getConstancias = function () {
		$http({
			method: 'GET',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getConstancias.php'
		}).then(function successCallback(response) {
			$scope.constancias = response.data;
		});
	}

	/* consultar el periodo */
	$scope.periodo = periodoService.getPeriodo()
		.then(function (response) {
			$scope.periodo = response;
		});

	/* Obtener listado de todos los periodos registrados */
	$scope.getPeriodos = function () {
		$http({
			method: 'GET',
			url: '/Residencia/Pruebas/pruebaLogin/php/getPeriodos.php'
		}).then(function successCallback(response) {
			$scope.periodos = response.data;
		});
	}

	/* Obtener las constancias del periodo actual pasandolo
	   como parámetro en la consulta*/
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
				});
			});
	}

	/** Obtener listado de los cursos del periodo seleccionado */
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

	/** Obtener listado de los participantes del curso seleccionado */
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

	/** Establecer el ID del curso y folio de la constancia */
	$scope.verConstancia = function (folio, idCurso) {
		constancia.setFolio(folio);
		curso.setID(idCurso);
		$scope.getConstancia();
	};

	/* Obtener datos de una constancia */
	$scope.getConstancia = function () {
		/** Recurperar folio y ID  */
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

	/* Retorna la URL del documento */
	$scope.getDocumento = function () {
		return 'http://localhost/Residencia/proyecto/files/' + constancia.getRuta();
	};

	$scope.back = function () {
		window.history.back();
	};

	/* Creación de una constancia */
	$scope.crearConstancia = function () {
	/* se guardan los datos en un json */
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
		/* Manda el json  */
		$http({
			method: 'POST',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/generarConstancia.php',
			headers: {
				'Content-Type': 'application/json'
			},
			data: JSON.stringify(datos)
		}).then(function successCallback(response) {
			/* Valida el éxito de la inserción
			-Insertado: muestra alerta, vacía formulario y recarga listado de constancias
			-No insertado: muestra alerta */
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

	/* Datos que serán usados en la vista */
	$scope.folioConstancia = constancia.getFolio();
	$scope.rutaConstancia = constancia.getRuta();

	/* Llamado a las funciones */
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
		});

	/* Obtiene a los instructores */
	$scope.getInstructores = function () {
		$http({
			method: 'GET',
			url: '/Residencia/Pruebas/pruebaLogin/php/getInstructores.php'
		}).then(function successCallback(response) {
			$scope.instructores = response.data;
		});
	}
	/* Llamado a la funcion */
	$scope.getInstructores();

	/* Obtiene listado de departamentos */
	$scope.getDepartamentos = function () {
		$http({
			method: 'GET',
			url: '/Residencia/Pruebas/pruebaLogin/php/getDepartamentos.php'
		}).then(function successCallback(response) {
			$scope.dptos = response.data;
		});
	}
	/* Llamado a la funcion */
	$scope.getDepartamentos();

	/* Insertar un instructor */
	$scope.agregarInstructor = function (datos) {
		$http({
			method: 'POST',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/agregarInstructor.php',
			headers: {
				'Content-Type': 'application/json'
			},
			data: JSON.stringify(datos)
		}).then(function successCallback(response) {
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
					titulo: 'Error!',
					tipo: 'danger',
					mensaje: 'Ocurrió un error al ingresar instructor'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});
				$timeout(function () {
					$location.path("inicioC/instructores");
				}, 2000);
			}
		});
	}

	/* variable json para instructor */
	$scope.inst = {};

	/* Eliminación de un instructor */
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

	/* Establecer ID del instructor */
	$scope.instructorID = function (id) {
		instructor.setID(id);
	}

	/* Obtener datos del instructor para su actualización */
	$scope.getInstructorAct = function () {
		/* Valida que el ID no esté vacío */
		if (instructor.getID() != "") {
			$http({
				url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getInstructorAct.php',
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'idInstructor=' + instructor.getID()
			}).then(function successCallback(response) {
				$scope.actInstructor = response.data;
				$scope.instructor = response.data;
			});
		}
	}

	$scope.getInstructorAct();

	/* Realizar la modificación de los datos del instructor */
	$scope.actualizarInstructor = function () {
		$http({
			method: 'POST',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/actualizarInstructor.php',
			headers: {
				'Content-Type': 'application/json'
			},
			data: JSON.stringify($scope.actInstructor)
		}).then(function successCallback(response) {
			if (response.data.status != "ok") {
				$scope.alert = {
					titulo: 'Error!',
					tipo: 'danger',
					mensaje: 'Ocurrió un error al agregar'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});
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
		});
	}


});

/* CONTROLADORES PARA EL USUARIO INSTRUCTOR */
app.controller('cursosICtrl', function ($scope, $http, $timeout, user, curso, periodoService) {

	$scope.user = user.getName();

	$scope.periodo = periodoService.getPeriodo()
		.then(function (response) {
			$scope.periodo = response;
		});

	/* Obtiene el listado de los cursos asignados al instructor */
	$scope.getCursos = function () {
		$scope.id = user.getIdUsuario();
		/* valida que el id no esté vacío */
		if ($scope.id != undefined) {
			$http({
				url: '/Residencia/Pruebas/pruebaLogin/php/getCursosInstructor.php',
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'idUsuario=' + $scope.id
			}).then(function successCallback(response) {
				$scope.cursos = response.data;
			});
		}
	}

	/* Obtiene el listado de documentos del curso */
	$scope.getListaDocumentosCurso = function () {
		$http({
			method: 'GET',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getDocumentos.php'
		}).then(function successCallback(response) {
			$scope.documentos = response.data;
		}, function errorCallback(response) {

		});
	}
	/* Establece el id del curso */
	$scope.cursoID = function (id) {
		curso.setID(id);
	}
	/* Obtiene la información del curso siempre y cuando el id no esté vacío */
	$scope.getInfoCurso = function () {
		$scope.idCurso = curso.getID();
		if ($scope.idCurso != undefined) {
			$http({
				url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getInfoCurso.php',
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'idCurso=' + $scope.idCurso
			}).then(function successCallback(response) {
				$scope.infoCurso = response.data;
			});
		}
	}

	/* Funcion para subir un documento, igual a la del usuario Coordinador */
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
			if (response.data.status == 'ok') {
				$scope.alert = {
					titulo: 'Archivo subido!',
					tipo: 'success',
					mensaje: 'Archivo subido correctamente'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});
				$('#modal' + idDoc).modal('hide');
				document.getElementById('mensaje' + idDoc).innerHTML = 'Documento guardado';
				$('#linkDocumento' + idDoc).replaceWith('<span id="linkDocumento' + idDoc + '"><a href="/Residencia/Proyecto/files/' + response.data.doc + '" target="_blank">Ver documento</a></span>');
			}
		});
	}

	/* valida si ya se ha subido un documento antes */
	$scope.existeDocumento = function () {
		$timeout(function () {
			$http({
				method: 'post',
				url: '/Residencia/Pruebas/pruebaLogin/php/documentosExistentesCurso.php',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'idc=' + curso.getID()
			}).then(function successCallback(response) {
				if (response.data.status = "existe") {
					angular.forEach(response.data.documentos, function (value, key) {
						$('#linkDocumento' + key).append('<a target="_blank" href="/Residencia/Proyecto/files/' + value + '">Ver documento</a>');
					});
				}
			});
		}, 500);
	}
	/* Consulta si falta documentación de cada curso */
	$scope.faltaDocumentacion = function () {
		$timeout(function () {
			$http({
				method: 'GET',
				url: '/Residencia/Pruebas/pruebaLogin/php/numDocsCursos.php',
			}).then(function successCallback(response) {
				angular.forEach(response.data.numDocsCurso, function (value, key) {
					if (value.num_docs < 7) {
						$("#documentacion" + value.idCurso).append('<button class="btn bg-white info_icon" title="Falta documentación"></button>');
					}
				});
			});
		}, 500);
	}

	/* Pasa parametros GET para llenado del Oficio del curso y lo abre
	en otra pestaña */
	$scope.printOficio = function () {
		window.open('http://localhost/Residencia/Pruebas/pruebaLogin/php/getOficioCurso.php?idd=' + user.getIdDepartamento() +
			'&idc=' + $scope.infoCurso.idCurso + '&idu=' + user.getIdUsuario(), '_blank');
	}

	/* regresa atrás en el navegador */
	$scope.back = function () {
		window.history.back();
	};

	/* llamado a las funciones */
	$scope.getCursos();
	$scope.getInfoCurso();
});

app.controller('asistenciaICtrl', function ($scope, $http, $location, user, curso, periodoService, fechaService, asistenciaService, $timeout) {

	$scope.user = user.getName();

	$scope.cursoID = function (id) {
		curso.setID(id);
	}

	/* Obtener cursos dirigidos al departamento que pertenece el usuario */
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
		});
	}

	$scope.periodo = periodoService.getPeriodo()
		.then(function (response) {
			$scope.periodo = response;
		});

	$scope.fecha = fechaService.getFecha()
		.then(function (response) {
			$scope.fecha = response;
		});

	/* Obtiene la lista de los docentes inscritos a X curso */

	$scope.getParticipantes = function () {
		$scope.idCurso = curso.getID();
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
			});
		}
	}

	/* limpia los checkbox de asistencia */
	$scope.uncheck = function () {
		$(":checkbox").prop("checked", false);
	}

	/* Declaración del array que almacenará la asistencia de cada participante */
	$scope.listaAlumnos = {};
	/* Function que realiza el registro de la asistencia de un curso */
	$scope.registrarAsistencia = function () {
		/* valida que el id del curso esté establecido */
		if (curso.getID() != undefined) {
			/* Guarda en un json la lista de asistencia, la lista de participantes
			del curso y el id del curso */
			var datos = {
				lista: $scope.listaAlumnos,
				participantes: $scope.participantes,
				idCurso: curso.getID()
			}
			$http({
				url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/addAsistencia.php',
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				data: JSON.stringify(datos)
			}).then(function successCallback(response) {
				/* Si la inserción fue correcta deshabilita los checkbox,
				los botones, oculta el modal, muestra una alerta y redirecciona
				al inicio */
				if (response.data.status == 'ok') {
					$(":checkbox").attr('disabled', true);
					$("#btn_enviar").attr('disabled', true);
					$("#btn_borrar").attr('disabled', true);
					$('#modal').modal('hide');
					$('.modal-backdrop').remove();
					$scope.alerta = {
						titulo: 'Listo!',
						tipo: 'success',
						mensaje: 'La asistencia se registro con éxito. En breve será redireccionado...'
					};
					$(document).ready(function () {
						$('#alerta').toast('show');
					});
					$timeout(function () {
						$location.path('/inicioI');
					}, 1250);
				}
			});
		} else {
			/* Si falla sólo muestra la alerta */
			$scope.alerta = {
				titulo: 'Atención!',
				tipo: 'warning',
				mensaje: 'No se ha podido registrar la asistencia.'
			};
			$(document).ready(function () {
				$('#alerta').toast('show');
				});
	     }
     }

	/* Consulta si la asistencia ya se registro el día de hoy para un curso */
	$scope.existeAsistencia = asistenciaService.existe(curso.getID())
		.then(function (response) {
			$scope.asistencia = response;
		});

	/* Si el registro de asistencia existe deshabilita el formulario y 
	muestra un mensaje */
	$scope.YaSeRegistroAsistencia = function () {
		$timeout(function () {
			if ($scope.asistencia == 'existe') {
				$(":checkbox").attr('disabled', true);
				$("#btn_enviar").attr('disabled', true);
				$("#btn_borrar").attr('disabled', true);
				$("#mensaje").append('Ya tomó asistencia hoy, vuelva mañana.');
			}
		}, 1000);
	}

	/* Llamado al curso */
	$scope.getCursos();
});

app.controller('participantesICtrl', function ($scope, $http, $location, user, curso, periodoService) {

	$scope.user = user.getName();

	$scope.cursoID = function (id) {
		curso.setID(id);
	}

	/* Obtiene participantes de un curso */
	$scope.getParticipantes = function () {
		$scope.idCurso = curso.getID();
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
			});
		}
	}

	/* abre el oficio del curso en otra pestaña */
	$scope.printFormato = function () {
		$scope.idCurso = curso.getID();
		window.open('http://localhost/Residencia/Pruebas/pruebaLogin/php/getFormatoListaAsistencia.php?idc=' + $scope.idCurso, '_blank');
	}

	$scope.printIndicadores = function () {
		$scope.idCurso = curso.getID();
		window.open('http://localhost/Residencia/Pruebas/pruebaLogin/php/getFormatoIndicadores.php?idc=' + $scope.idCurso, '_blank');
	}

	$scope.getParticipantes();
});

app.controller('reconocimientosICtrl', function ($scope, $http, user, curso, periodoService) {

	user.getName();

	$scope.periodo = periodoService.getPeriodo()
		.then(function (response) {
			$scope.periodo = response;
		});
});

/* CONTROLADORES PARA EL USUARIO JEFE */

app.controller('cursosJCtrl', function ($scope, $http, $location, user, curso, periodoService, $timeout) {

	$scope.user = user.getName();

	/* Obtiene cursos del departamento del usuario */
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
		});
	}

	/* Obtiene la información de un curso */
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
			});
		}
	}

	$scope.periodo = periodoService.getPeriodo()
		.then(function (response) {
			$scope.periodo = response;
		});

	/* Lista de documentos */
	$scope.getListaDocumentosCurso = function () {
		$http({
			method: 'GET',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getDocumentos.php'
		}).then(function successCallback(response) {
			$scope.documentos = response.data;
		});
	}
	
	/* Peticion para obtener el listado de todos los documentos
	   que se han subido de un curso determinado */
	   $scope.getListaDocumentosSubidos = function () {
		var idCurso = curso.getID();
		$timeout(function () { //delay para la ejecución de la consulta
			if (idCurso != undefined) {
				/* Peticion HTTP */
				$http({
					method: 'POST',
					url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getDocsCurso.php',
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded'
					},
					data: 'idCurso=' + idCurso
				}).then(function successCallback(response) {
					$scope.documentosSubidos = response.data;
					/* Delay para ejecución del código */
					$timeout(function () {
						/*  Si existen documentos subidos se analiza si
							tienen algún comentario, en caso de tenerlo
							se oculta el botón "Agregar comentario" y se
							muesta un textarea con el comentario junto a
							un botón para editar el comentario. Cuando no
							hay comentario para el documento sólo se 
							muestra el botón */
						if ($scope.documentosSubidos != null) {
							angular.forEach($scope.documentosSubidos, function (value) {
								if (value.comentario == null) {
									$("#btn" + value.idDocumento).show();
									$("#coment" + value.idDocumento).hide();
								} else {
									$("#btn" + value.idDocumento).hide();
									$("#coment" + value.idDocumento).show();
								}
							});
						}
					}, 100);
				});
			}
		}, 250);
	}

	/* Agregar comentario a un documento de un curso */
	$scope.addComment = function (documento, idDoc, idCurso) {

		/* Valida que el comentario no esté vacío */
		if (documento.comentario != undefined) {
			$http({
				method: 'POST',
				url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/addComentario.php',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'idCurso=' + idCurso + '&idDocumento=' + idDoc + '&comentario=' + documento.comentario
			}).then(function successCallback(response) {
				$("#btn" + idDoc).hide();
				$("#coment" + idDoc).show();
			});
		}
	}

	/* Valida si en la carga de la vista ya hay documentos subidos 
	   para un curso, por cada documento ya existente muestra el link
	   de dicho documento para abrirlo */
	   $scope.existeDocumento = function () {
		$timeout(function () {
			$http({
				method: 'post',
				url: '/Residencia/Pruebas/pruebaLogin/php/documentosExistentesCurso.php',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'idc=' + curso.getID()
			}).then(function successCallback(response) {
				if (response.data.status = "existe") {
					angular.forEach(response.data.documentos, function (value, key) {
						$('#linkDocumento' + key).append('<a target="_blank" href="/Residencia/Proyecto/files/' + value + '">Ver documento</a>');
					});
				}
			});
		}, 500);
	}

	/* Valida si en la carga de la vista ya hay documentos subidos 
	   para un curso, por cada documento ya existente muestra el link
	   de dicho documento para abrirlo */
	   $scope.existeDocumento = function () {
		$timeout(function () {
			$http({
				method: 'post',
				url: '/Residencia/Pruebas/pruebaLogin/php/documentosExistentesCurso.php',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'idc=' + curso.getID()
			}).then(function successCallback(response) {
				if (response.data.status = "existe") {
					angular.forEach(response.data.documentos, function (value, key) {
						$('#linkDocumento' + key).append('<a target="_blank" href="/Residencia/Proyecto/files/' + value + '">Ver documento</a>');
					});
				}
			});
		}, 500);
	}

	/* Paso atrás en el navegador */
	$scope.back = function () {
		window.history.back();
	};

	/* Establecer id del curso */
	$scope.cursoID = function (id) {
		curso.setID(id);
	}

	/* Creación del curso */
	$scope.crearCurso = function (datos) {
		datos.username = user.getName();
		if (
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
				url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/crearCursoJ.php',
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

	/* Actualizar datos del curso */
	$scope.actualizarCurso = function (datos) {
		$http({
			method: 'POST',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/actualizarCursoJ.php',
			headers: {
				'Content-Type': 'application/json'
			},
			data: JSON.stringify(datos)
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
			} else {
				$scope.alert = {
					titulo: 'Actualizado!',
					tipo: 'success',
					mensaje: 'Actualización exitosa.'
				};
				$(document).ready(function () {
					$('#alerta').toast('show');
				});
				$timeout(function () {
					$location.path("/inicioJ");
				}, 2000);
			}
		});
	}

	/* Obtener datos del curso para su modificación */
	$scope.getCursoAct = function () {
		$scope.idCurso = curso.getID();
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

				//* 5 -> corresponde al id del departamento "Todos los departamentos"
				if (response.data.departamento == 5) {
					$scope.actCurso.departamento = "0";
				}
				/* Determina la modalidad */
				if (response.data.modalidad.indexOf("Virtual") !== -1) {
					$scope.actCurso.modalidad = 2;
				} else if (response.data.modalidad.indexOf("Presencial") !== -1) {
					$scope.actCurso.modalidad = 1;
				} else {
					$scope.actCurso.modalidad = 3;
				}
			});
		}
	}

	/* Eliminar curso */
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

	/* Obtener departamento del usuario para incluirlo en el 
	select de los formularios */
	$scope.getDepartamento = function () {
		$http({
			method: 'POST',
			url: '/Residencia/Pruebas/pruebaLogin/php/getDepartamento.php',
			headers: {
				'Content-type': 'application/x-www-form-urlencoded'
			},
			data: 'departamento=' + user.getIdDepartamento()
		}).then(function successCallback(response) {
			$scope.dpto = response.data;
			$scope.curso.departamento = $scope.dpto.idDepartamento;
		});
	}

	/* Obtener listado de los instructores */
	$scope.getInstructores = function () {
		$http({
			method: 'GET',
			url: '/Residencia/Pruebas/pruebaLogin/php/getInstructores.php'
		}).then(function successCallback(response) {
			$scope.instructor = response.data;
			// console.log(response.data);
		});
	}

	/* Subir archivo, igual a los anteriores */
	$scope.upload = function (idDoc, idCurso) {
		var fd = new FormData();
		var files = document.getElementById('file' + idDoc).files[0];
		fd.append('archivo', files);
		fd.append('idCurso', idCurso);
		fd.append('idDocumento', idDoc);
		// HTTP request
		$http({
			method: 'post',
			url: '/Residencia/Pruebas/pruebaLogin/php/subirArchivo.php',
			data: fd,
			headers: {
				'Content-Type': undefined
			},
		}).then(function successCallback(response) {
			if (response.data.status == 'ok') {
				$('#modal' + idDoc).modal('hide');
				document.getElementById('mensaje' + idDoc).innerHTML = 'Documento guardado';
				$('#linkDocumento' + idDoc).replaceWith('<span id="linkDocumento' + idDoc + '"><a href="/Residencia/Proyecto/files/' + response.data.doc + '" target="_blank">Ver documento</a></span>');
			}
		});
	}

	/* Validación de la existencia de los documentos del curso */
	$scope.existeDocumento = function () {
		$timeout(function () {
			$http({
				method: 'post',
				url: '/Residencia/Pruebas/pruebaLogin/php/documentosExistentesCurso.php',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'idc=' + curso.getID()
			}).then(function successCallback(response) {
				if (response.data.status = "existe") {
					angular.forEach(response.data.documentos, function (value, key) {
						$('#linkDocumento' + key).append('<a target="_blank" href="/Residencia/Proyecto/files/' + value + '">Ver documento</a>');
					});
				}
			});
		}, 500);
	}

	/* Asignación de la clave de registro del curso */
	$scope.getNuevoFolio = function () {
		if ($scope.curso.departamento == undefined) {
			id = user.getIdDepartamento();
		} else {
			id = $scope.curso.departamento;
		}
		$http({
			method: 'POST',
			url: 'http://localhost/Residencia/Pruebas/pruebaLogin/php/getNuevoFolioJ.php',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			data: 'idDepartamento=' + id
		}).then(function successCallback(response) {
			$scope.curso.clave = response.data;
		});
	}

	/* Generación del oficio de registro en una nueva pestaña */
	$scope.printOficio = function () {
		window.open('http://localhost/Residencia/Pruebas/pruebaLogin/php/getOficioCurso.php?idd=' + user.getIdDepartamento() +
			'&idc=' + curso.getID() + '&idu=' + user.getIdUsuario(), '_blank');
	}

	/* Verifica si falta documentación en los cursos */
	$scope.faltaDocumentacion = function () {
		$timeout(function () {
			$http({
				method: 'GET',
				url: '/Residencia/Pruebas/pruebaLogin/php/numDocsCursos.php',
			}).then(function successCallback(response) {
				angular.forEach(response.data.numDocsCurso, function (value, key) {
					if (value.num_docs < 7) {
						$("#documentacion" + value.idCurso).append('<button class="btn bg-white info_icon" title="Falta documentación"></button>');
					}
				});
			});
		}, 500);
	}

	/* Llamado a las funciones */
	$scope.getCursoAct();
	$scope.getInfoCurso();
	$scope.getCursos();
	$scope.getDepartamento();
	$scope.getInstructores();
	$scope.getListaDocumentosCurso();
	$scope.getListaDocumentosSubidos();
});

app.controller('encuestaJCtrl', function ($scope, $http, $location, user, periodoService) {
	$scope.user = user.getName();
});

/*	CONTROLADORES PARA EL USUARIO DOCENTE */
app.controller('cursosDCtrl', function ($scope, $http, $location, user, curso, encuesta, periodoService, $timeout, encuestaService) {

	$scope.user = user.getName();

	/* Obtener cursos del departamento del docente */
	$scope.getCursos = function () {
		$http({
			method: 'POST',
			url: '/Residencia/Pruebas/pruebaLogin/php/getCursosDocenteDpto.php',
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

	/* Cancelar inscripción a un curso */
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

	/* Inscripción a un curso */
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

	/* Obtener cursos a los que está inscrito */
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
			});
		}
	}

	/* Obtener historial de cursos a los que se ha inscrito */
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
			});
		}
	}

	/* Obtener la información de un curso */
	$scope.getInfoCurso = function () {
		$scope.idCurso = curso.getID();
		if ($scope.idCurso != undefined) {
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
			});
		}
	}
	/* ir a página anterior */
	$scope.back = function () {
		window.history.back();
	};

	/* periodo actual basado en la fecha de hoy */
	$scope.periodo = periodoService.getPeriodo()
		.then(function (response) {
			$scope.periodo = response;
		}, function (error) {
			console.log(response);
		});

	/* validar si el docente ya respondió la encuesta de opinión del curso */
	$scope.encuestaRespondida = encuestaService.existe(curso.getID(),user.getIdUsuario())
		.then(function (response) {
			$scope.encuesta = response;
		});

	/* Si ya respondió la encuesta oculta el formulario y 
	muestra un mensaje en su lugar*/
	$scope.YaRespondioEncuesta = function () {
		$timeout(function () {
			console.log($scope.encuesta);
			if ($scope.encuesta == 'contestada') {
				$("input").attr('disabled', true);
				$("textarea").attr('disabled', true);
				$("#btn_enviar").attr('disabled', true);
				$('#encuestaForm').replaceWith('<div class="text-center align-middle mt-5"><span class="font-italic" style="font-size: 2rem !important;">Ya ha respondido esta encuesta.</span></div>');
			}
		}, 1000);
	}

	/* Establece los id de la encuesta y del curso */
	$scope.getEncuesta = function (ide,idc) {
		encuesta.setID(ide);
		curso.setID(idc)
	}

	/* obtiene las preguntas de la encuesta de opinión */
	$scope.getPreguntasEncuesta = function () {
		if (encuesta.getID() != undefined) {
			$http({
				method: 'POST',
				url: '/Residencia/Pruebas/pruebaLogin/php/getPreguntasEncuesta.php',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'ide=' + encuesta.getID()
			}).then(function successCallback(response) {
				$scope.preguntas = response.data;
			});
		}
	}
	/* declaración del json que contendrá las respuestas */
	$scope.listaRespuestas = {};

	$scope.enviar = function (){
		/* almacena en un json la lista de respuestas, las sugerencias y los ID */
		var datos = {
			respuestas: $scope.listaRespuestas,
			sugerencias: $scope.sugerencias,
			idCurso: curso.getID(),
			idUsuario: user.getIdUsuario(),
			idEncuesta: encuesta.getID()
		};
		/* valida si se han respondido todas las preguntas antes de enviar 
		las respuestas */
		if( Object.keys($scope.listaRespuestas).length == ($scope.preguntas).length){
			$http({
				method: 'POST',
				url: '/Residencia/Pruebas/pruebaLogin/php/registrarRespuestasEncuesta.php',
				headers: {
					'Content-type':'json/application'
				},
				data: JSON.stringify(datos)
			}).then(function successCallback(response){
				console.log(response.data);
				if(response.data.status == 'ok'){
					$scope.alerta = {
						titulo: 'Listo!',
						tipo: 'success',
						mensaje: 'Sus respuestas fueron registradas con éxito. En breve será redireccionado...'
					};
					$(document).ready(function () {
						$('#alerta').toast('show');
					});
					$timeout(function () {
						$location.path(user.getPath());
					}, 1250);
				}
			});
		} else {
			$scope.alerta = {
				titulo: 'Atención!',
				tipo: 'warning',
				mensaje: 'No ha respondido todas las preguntas.'
			};
			$(document).ready(function () {
				$('#alerta').toast('show');
			});
		}
	}
	/* Llamado a funciones */
	$scope.getPreguntasEncuesta();
	$scope.getCursos();
	$scope.getInfoCurso();
	$scope.getMisCursos();
	$scope.getMisCursosConcluidos();
});

app.controller('constanciasDCtrl', function ($scope, $http, $location, user, periodoService) {

	$scope.user = user.getName();
});


/* Controlador para pruebas individuales */
app.controller('pruebaCtrl', function ($scope, $http) {

	$scope.lista = [{
			doc: 'Doc1',
			id: 1
		},
		{
			doc: 'Doc2',
			id: 2
		},
		{
			doc: 'Doc3',
			id: 3
		},
		{
			doc: 'Doc4',
			id: 4
		}
	];

	$scope.addComentario = true

	$scope.add = function (id) {
		$("#txta" + id).show();
		$("#btn" + id).hide();
	}
});