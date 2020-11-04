-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2020 a las 02:04:18
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_actdocente`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `idAsistencia` int(11) NOT NULL,
  `fecha` varchar(45) NOT NULL,
  `Usuario_idUsuario` int(11) NOT NULL,
  `Curso_idCurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `idCalificacion` int(11) NOT NULL,
  `calificacion` varchar(45) DEFAULT NULL,
  `Usuario_idUsuario` int(11) NOT NULL,
  `Curso_idCurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `constancia`
--

CREATE TABLE `constancia` (
  `idConstancia` int(11) NOT NULL,
  `folio` varchar(45) NOT NULL,
  `Curso_idCurso` int(11) NOT NULL,
  `Usuario_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `constancia`
--

INSERT INTO `constancia` (`idConstancia`, `folio`, `Curso_idCurso`, `Usuario_idUsuario`) VALUES
(1, 'AB1234', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `idCurso` int(11) NOT NULL,
  `Folio` varchar(45) NOT NULL,
  `ClaveRegistro` varchar(45) NOT NULL,
  `nombreCurso` varchar(250) NOT NULL,
  `periodo` varchar(45) NOT NULL,
  `duracion` int(11) NOT NULL,
  `horario` varchar(45) NOT NULL,
  `fechaInicio` varchar(45) NOT NULL,
  `fechaFin` varchar(45) NOT NULL,
  `modalidad` varchar(45) NOT NULL,
  `lugar` varchar(150) NOT NULL,
  `destinatarios` varchar(45) NOT NULL,
  `objetivo` varchar(300) NOT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  `validado` varchar(45) NOT NULL,
  `Instructor_idInstructor` int(11) NOT NULL,
  `Departamento_idDepartamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`idCurso`, `Folio`, `ClaveRegistro`, `nombreCurso`, `periodo`, `duracion`, `horario`, `fechaInicio`, `fechaFin`, `modalidad`, `lugar`, `destinatarios`, `objetivo`, `observaciones`, `validado`, `Instructor_idInstructor`, `Departamento_idDepartamento`) VALUES
(1, 'AB18222020', 'DFF2020', 'Diplomado para la Formación y Desarrollo de Competencias Docentes - Módulo II: Planeación del proceso de Aprendizaje', 'Agosto - Diciembre 2019', 30, '9:00 - 15:00', '18-Junio-2019', '22-Junio-2019', 'Presencial', 'Centro de cómputo ITD', 'Docentes del ITD', 'Diseña la planeación por competencias del curso para facilitar el aprendizaje del estudiante a través de la organización y seguimiento de las actividades a desarrollar.', NULL, 'no', 1, 2),
(2, 'AAAA2020', 'ABCD20', 'Curso de prueba', 'Enero - Junio 2021', 30, '8:00 - 14:00', '12 Enero 2021', '19 Enero 2021', 'Virtual', 'ITD', 'Personal docente', 'Probar algo', 'Ninguna observación', 'no', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_has_documento`
--

CREATE TABLE `curso_has_documento` (
  `Curso_idCurso` int(11) NOT NULL,
  `Documento_idDocumento` int(11) NOT NULL,
  `rutaArchivo` varchar(200) DEFAULT NULL,
  `estadoVerificado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `curso_has_documento`
--

INSERT INTO `curso_has_documento` (`Curso_idCurso`, `Documento_idDocumento`, `rutaArchivo`, `estadoVerificado`) VALUES
(1, 1, 'doc.pdf', 'no'),
(1, 2, 'doc.pdf', NULL),
(1, 3, 'doc.pdf', NULL),
(1, 4, 'doc.pdf', NULL),
(1, 5, 'doc.pdf', NULL),
(1, 6, 'doc.pdf', NULL),
(1, 7, 'doc.pdf', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `idDepartamento` int(11) NOT NULL,
  `nombreDepartamento` varchar(200) NOT NULL,
  `Jefe` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`idDepartamento`, `nombreDepartamento`, `Jefe`) VALUES
(1, 'Desarrollo Académico', 'Anapaula Rivas Barraza'),
(2, 'Sistemas y computación', 'Rocío Valadez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `idDocumento` int(11) NOT NULL,
  `nombreDocumento` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`idDocumento`, `nombreDocumento`) VALUES
(1, 'Diseño del curso (Ficha técnica)'),
(2, 'Currículum'),
(3, 'Tabla de cronograma'),
(4, 'Evidencias'),
(5, 'Oficio de comisión de participantes'),
(6, 'Evaluación del instructor'),
(7, 'Oficio de registro de curso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

CREATE TABLE `evaluacion` (
  `idEvaluacion` int(11) NOT NULL,
  `fecha` varchar(45) NOT NULL,
  `sugerencias` varchar(200) DEFAULT NULL,
  `Usuario_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion_has_pregunta`
--

CREATE TABLE `evaluacion_has_pregunta` (
  `Evaluacion_idEvaluacion` int(11) NOT NULL,
  `Pregunta_idPregunta` int(11) NOT NULL,
  `respuesta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructor`
--

CREATE TABLE `instructor` (
  `idInstructor` int(11) NOT NULL,
  `nombreInstructor` varchar(45) NOT NULL,
  `RFC` varchar(45) NOT NULL,
  `CURP` varchar(45) NOT NULL,
  `fechaNacimiento` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `Correo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `instructor`
--

INSERT INTO `instructor` (`idInstructor`, `nombreInstructor`, `RFC`, `CURP`, `fechaNacimiento`, `telefono`, `Correo`) VALUES
(1, 'I.S.C. Cristabel Armstrong Aramburo', 'ARACxxxxxx', 'ARACxxxxxxxxxxx', 'xx-xx-xxxx', '618xxxxxxx', 'cristabel@correo.mx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `idPregunta` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `Departamento_idDepartamento` int(11) NOT NULL,
  `rol` varchar(45) NOT NULL,
  `nombreUsuario` varchar(45) NOT NULL,
  `contrasena` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `Departamento_idDepartamento`, `rol`, `nombreUsuario`, `contrasena`) VALUES
(1, 1, '2', 'Anapaula Rivas Barraza', 'da2020'),
(2, 1, '1', 'admin', 'admin'),
(3, 1, '3', 'user docente', 'user'),
(4, 1, '4', 'usuario instructor', 'user');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_has_curso`
--

CREATE TABLE `usuario_has_curso` (
  `Usuario_idUsuario` int(11) NOT NULL,
  `Curso_idCurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario_has_curso`
--

INSERT INTO `usuario_has_curso` (`Usuario_idUsuario`, `Curso_idCurso`) VALUES
(3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`idAsistencia`,`Usuario_idUsuario`,`Curso_idCurso`);

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`idCalificacion`,`Usuario_idUsuario`,`Curso_idCurso`);

--
-- Indices de la tabla `constancia`
--
ALTER TABLE `constancia`
  ADD PRIMARY KEY (`idConstancia`,`Curso_idCurso`,`Usuario_idUsuario`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`idCurso`,`Instructor_idInstructor`,`Departamento_idDepartamento`);

--
-- Indices de la tabla `curso_has_documento`
--
ALTER TABLE `curso_has_documento`
  ADD PRIMARY KEY (`Curso_idCurso`,`Documento_idDocumento`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`idDepartamento`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`idDocumento`);

--
-- Indices de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD PRIMARY KEY (`idEvaluacion`,`Usuario_idUsuario`);

--
-- Indices de la tabla `evaluacion_has_pregunta`
--
ALTER TABLE `evaluacion_has_pregunta`
  ADD PRIMARY KEY (`Evaluacion_idEvaluacion`,`Pregunta_idPregunta`);

--
-- Indices de la tabla `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`idInstructor`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`idPregunta`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`,`Departamento_idDepartamento`);

--
-- Indices de la tabla `usuario_has_curso`
--
ALTER TABLE `usuario_has_curso`
  ADD PRIMARY KEY (`Usuario_idUsuario`,`Curso_idCurso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `idAsistencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `idCalificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `constancia`
--
ALTER TABLE `constancia`
  MODIFY `idConstancia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `idCurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `idDepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `idDocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  MODIFY `idEvaluacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `instructor`
--
ALTER TABLE `instructor`
  MODIFY `idInstructor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `idPregunta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
