-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2020 a las 07:05:59
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `horaInicio` varchar(50) NOT NULL,
  `horaFin` varchar(50) NOT NULL,
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

INSERT INTO `curso` (`idCurso`, `Folio`, `ClaveRegistro`, `nombreCurso`, `periodo`, `duracion`, `horaInicio`, `horaFin`, `fechaInicio`, `fechaFin`, `modalidad`, `lugar`, `destinatarios`, `objetivo`, `observaciones`, `validado`, `Instructor_idInstructor`, `Departamento_idDepartamento`) VALUES
(1, 'AB18222020', 'DFF2020', 'Diplomado para la Formación y Desarrollo de Competencias Docentes - Módulo II: Planeación del proceso de Aprendizaje', 'Agosto / Diciembre', 30, '13:00', '14:00', '2020-06-20', '2020-06-26', 'Presencial', 'Centro de cómputo ITD', 'Docentes del ITD', 'Diseña la planeación por competencias del curso para facilitar el aprendizaje del estudiante a través de la organización y seguimiento de las actividades a desarrollar.', 'no', 'no', 1, 2),
(2, 'AAAA2020', 'ABCD20', 'Diplomado para la Formación de Tutores - Módulo II: Programa de Tutorias Presencial', 'Enero - Junio 2021', 30, '', '', '2020-07-20', '2020-07-26', 'Virtual', 'ITD', 'Personal docente', 'Probar algo', 'Ninguna observación', 'no', 3, 1),
(3, 'AAAA', 'ADDD1', 'Diplomado para la Formación de Tutores - Módulo II: Programa de Tutorías en línea', 'Agosto / Diciembre 2020', 30, '09:00', '10:00', '2020-10-09', '2020-10-15', 'Presencial', 'Centro de Cómputo', ' Docentes', 'Objetivo', 'No', 'no', 1, 1);

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
(1, 7, 'doc.pdf', NULL),
(2, 1, 'doc1605235078.pdf', 'no');

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
(2, 'Sistemas y Computación', 'Rocío Valadez'),
(4, 'Ciencias Básicas', 'Héctor Flores Cabral'),
(5, 'Ciencias de la Tierra', 'José de León Soto García');

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
  `idUsuario` int(11) NOT NULL,
  `apellidoPaterno` varchar(45) NOT NULL,
  `apellidoMaterno` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `RFC` varchar(45) NOT NULL,
  `CURP` varchar(45) NOT NULL,
  `fechaNacimiento` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `Correo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `instructor`
--

INSERT INTO `instructor` (`idInstructor`, `idUsuario`, `apellidoPaterno`, `apellidoMaterno`, `nombre`, `RFC`, `CURP`, `fechaNacimiento`, `telefono`, `Correo`) VALUES
(1, 0, 'Armstrong', 'Aramburo', 'Cristabel', 'ARACXXXXXX', 'ARACXXXXXXXXXXX', '1979-12-30', '6181242500', 'cristabel@correo.mx'),
(3, 0, 'Avitia', 'Rocha', 'Brenda', 'GBDLxxxxxx', 'GBDLxxxxxxxxxxx', '1968-02-20', '6182957145', 'dora@gmail.com'),
(4, 0, 'Bautista', 'Munguia', 'Ana Mayri', 'BAMA980114JG3', ' BAMA980114MDGTNN09', '1998-01-01', '6182958640', 'MayriBautista@gmail.com'),
(5, 0, 'Munguía', 'de León', 'Marisela', 'MULM690817JG3', ' MULM690817MDGNNR05', '1969-08-17', '6181132560', 'marisela@gmail.com'),
(9, 9, 'Bautista', 'Saénz', 'Ricardo', 'BASR740403G71', 'BASR740403HDGTNC06', '1974-04-03', '6181413245', 'ricardo@gmail.com');

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
  `apellidoPaterno` varchar(45) NOT NULL,
  `apellidoMaterno` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `nombreUsuario` varchar(45) NOT NULL,
  `contrasena` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `Departamento_idDepartamento`, `rol`, `apellidoPaterno`, `apellidoMaterno`, `nombre`, `nombreUsuario`, `contrasena`) VALUES
(1, 2, '2', 'Bautista', 'Munguía', 'Ana Mayri', 'Mayri', 'admin123'),
(2, 2, '1', 'Sifuentes', 'Cisneros', 'Vanessa', 'Vanessa', 'a123'),
(3, 2, '3', 'Flores', 'Patiño', 'Iriam Jazmín', 'Iriam', 'i123'),
(4, 2, '4', 'Herrera', 'Hernández', 'Ana', 'Ana', 'a123'),
(5, 1, '1', 'Rivas', 'Barraza', 'Anapaula', 'Anapaula', 'admin123'),
(9, 4, '4', 'Bautista', 'Saénz', 'Ricardo', 'Ricardo', 'r123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_has_curso`
--

CREATE TABLE `usuario_has_curso` (
  `Usuario_idUsuario` int(11) NOT NULL,
  `Curso_idCurso` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario_has_curso`
--

INSERT INTO `usuario_has_curso` (`Usuario_idUsuario`, `Curso_idCurso`, `estado`) VALUES
(3, 1, 1),
(3, 2, 1),
(3, 3, 1);

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
  MODIFY `idCurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `idDepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `idInstructor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `idPregunta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
