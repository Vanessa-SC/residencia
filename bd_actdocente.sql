-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2020 a las 21:12:42
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
  `fecha` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `Usuario_idUsuario` int(11) NOT NULL,
  `Curso_idCurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `idCalificacion` int(11) NOT NULL,
  `calificacion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Usuario_idUsuario` int(11) NOT NULL,
  `Curso_idCurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `constancia`
--

CREATE TABLE `constancia` (
  `idConstancia` int(11) NOT NULL,
  `folio` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `rutaConstancia` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `Curso_idCurso` int(11) NOT NULL,
  `Usuario_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `constancia`
--

INSERT INTO `constancia` (`idConstancia`, `folio`, `rutaConstancia`, `Curso_idCurso`, `Usuario_idUsuario`) VALUES
(1, 'AB1234', 'doc.pdf', 1, 1),
(2, 'DF1234', 'doc.pdf', 2, 3),
(3, 'AB12345', 'doc.pdf', 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `idCurso` int(11) NOT NULL,
  `Folio` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ClaveRegistro` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `nombreCurso` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `periodo` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `duracion` int(11) NOT NULL,
  `horaInicio` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `horaFin` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `fechaInicio` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `fechaFin` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `modalidad` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `lugar` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `destinatarios` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `objetivo` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `observaciones` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `validado` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `Instructor_idInstructor` int(11) NOT NULL,
  `Departamento_idDepartamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`idCurso`, `Folio`, `ClaveRegistro`, `nombreCurso`, `periodo`, `duracion`, `horaInicio`, `horaFin`, `fechaInicio`, `fechaFin`, `modalidad`, `lugar`, `destinatarios`, `objetivo`, `observaciones`, `validado`, `Instructor_idInstructor`, `Departamento_idDepartamento`) VALUES
(1, 'AB18222020', 'DFF2020', 'Diplomado para la Formación y Desarrollo de Competencias Docentes - Módulo II: Planeación del proceso de Aprendizaje', 'Agosto / Diciembre 2020', 30, '09:00', '15:00', '2020-08-18', '2020-08-28', 'Semipresencial', 'Centro de cómputo ITD', 'Docentes del ITD', 'Diseña la planeación por competencias del curso para facilitar el aprendizaje del estudiante a través de la organización y seguimiento de las actividades a desarrollar.', '', 'no', 2, 1),
(2, 'ADC132', 'ADX2020', 'Curso para el desarrollo de habilidades informáticas', 'Agosto / Diciembre 2020', 30, '03:30', '09:30', '2020-11-09', '2020-11-20', 'Virtual', 'meet.google.com/wedc-qwe-csf', ' Todos', 'Ninguno', 'Ninguna', 'no', 3, 2),
(14, 'ADC132', '123456zx', 'Curso para desarrollo académico', 'Agosto / Diciembre 2020', 30, '06:21', '06:24', '2020-11-02', '2020-12-31', 'Virtual', 'meet.google.com/wedc-qwe-csf', ' Docentes del ITD', 'qerdyftgkh', 'rxc', 'no', 11, 2),
(40, 'IT8817', 'TIF1025', 'Diplomado para la formación de Tutores - Módulo II: Programa de Tutorías.', 'Agosto / Diciembre 2020', 30, '04:00', '10:00', '2020-11-16', '2020-11-30', 'Semipresencial', 'Centro de cómputo ITD', ' Docentes del ITD', 'Mejorar el servicio de tutoría para el alumnado', 'Ninguna.', 'no', 8, 1),
(53, 'IT8815', 'TIF1012', 'Diplomado para la formación de Tutores - Módulo II: Programa de Tutorías en línea', 'Agosto / Diciembre 2020', 30, '04:00', '10:00', '2020-11-20', '2020-11-30', 'Virtual', 'itd', ' itd', 'none', 'none', 'no', 3, 2),
(54, 'IT8816', 'TIF1002', 'Diplomado para la formación de Tutores - Módulo II: Programa de Tutorías presencial', 'Agosto / Diciembre 2020', 30, '04:00', '10:00', '2020-11-09', '2020-11-27', 'Presencial', 'Centro de cómputo ITD', ' Docentes del ITD', 'Ninguno', 'Ninguna', 'no', 11, 2),
(65, 'folioqwe', 'clave123', 'Curso para creacion de documento', 'Agosto / Diciembre 2020', 30, '06:00', '07:59', '2020-12-31', '2021-12-31', 'Presencial', 'Zoom', ' all', 'Probar :D', 'ninguna', 'no', 2, 1),
(67, 'AAAA2020', 'ABCD20', 'Diplomado para la Formación y Desarrollo de Competencias Docentes - Módulo II: Planeación del proceso de Aprendizaje', 'Agosto / Diciembre 2020', 30, '04:00', '10:00', '2020-11-09', '2020-11-23', 'Virtual', 'Centro de cómputo ITD', ' Docentes del ITD', 'asda', 'asd', 'no', 1, 1),
(68, 'qwe', 'srdtfgyh', 'srdcfgvhbj', 'Agosto / Diciembre 2019', 30, '09:40', '09:40', '2019-10-19', '2021-12-21', 'Presencial', 'zsxchjk', ' xgcvhb n', 'xcfvghbnjkm', '4rytugihop', 'no', 1, 1),
(69, '1234asd', '12345asd', 'asd12', 'Agosto / Diciembre 2020', 30, '10:26', '12:28', '2020-10-19', '2020-12-20', 'Presencial', '12', ' 1', '23', '1223', 'no', 1, 1),
(70, 'ASD2021', 'IT0180', 'Curso 2', 'Agosto / Diciembre 2020', 30, '12:00', '11:59', '2020-12-31', '2020-12-31', 'Presencial', 'Centro de cómputo ITD', ' Todos', '12', '12', 'no', 2, 1),
(71, '11', '11', '11', 'Agosto / Diciembre 2019', 30, '12:14', '12:17', '2019-10-19', '2020-12-21', 'Presencial', 'Centro de cómputo ITD', ' Docentes del ITD', '12', '12', 'no', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_has_documento`
--

CREATE TABLE `curso_has_documento` (
  `Curso_idCurso` int(11) NOT NULL,
  `Documento_idDocumento` int(11) NOT NULL,
  `rutaArchivo` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estadoVerificado` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `curso_has_documento`
--

INSERT INTO `curso_has_documento` (`Curso_idCurso`, `Documento_idDocumento`, `rutaArchivo`, `estadoVerificado`) VALUES
(1, 1, 'doc1605316652.pdf', 'no'),
(1, 2, 'doc1605295096.pdf', 'no'),
(1, 3, 'doc1605295106.pdf', 'no'),
(1, 4, 'doc1605295118.pdf', 'no'),
(1, 5, 'doc1605295126.pdf', 'no'),
(1, 6, 'doc1605295133.pdf', 'no'),
(1, 7, 'doc1605295140.pdf', 'no'),
(2, 1, 'doc1605298261.pdf', 'no'),
(14, 1, 'doc1605301958.pdf', 'no'),
(14, 2, 'doc1605301979.pdf', 'no'),
(14, 3, 'doc1605301988.pdf', 'no'),
(14, 4, 'doc1605302003.pdf', 'no'),
(14, 5, 'doc1605302009.pdf', 'no'),
(14, 6, 'doc1605302015.pdf', 'no'),
(14, 7, 'doc1605302022.pdf', 'no'),
(9, 1, 'doc1605633414.pdf', 'no'),
(9, 2, 'doc1605633019.pdf', 'no'),
(9, 3, 'doc1605633067.pdf', 'no'),
(9, 6, 'doc1605633377.pdf', 'no'),
(9, 7, 'doc1605633393.pdf', 'no'),
(9, 5, 'doc1605633403.pdf', 'no'),
(9, 4, 'doc1605633461.pdf', 'no'),
(63, 7, 'docaa10d8b8c9af4ff95dfb5d6999351b59.pdf', 'no'),
(64, 7, 'doce6092a2105c90c2b2d7cd2f5067d265a.pdf', 'no'),
(65, 7, 'doca47288fded0d0d1efdc1f3e75a6a21e2.pdf', 'no'),
(66, 7, 'doc14d901fe938884e609159d1183422bf2.pdf', 'no'),
(67, 7, 'doc3f56b066bfc1cdb28b32dc05c444147f.pdf', 'no'),
(68, 7, 'docc45cc533549536f2de322b1d0f886c3f.pdf', 'no'),
(69, 7, 'doc149d0e2b884180aac65c3b8dd9b0a57a.pdf', 'no'),
(70, 7, 'doc5b78029eda720bafe0124ab6a2edd964.pdf', 'no'),
(71, 7, 'doc8f701351f5801143661bb07ac4fc8561.pdf', 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `idDepartamento` int(11) NOT NULL,
  `nombreDepartamento` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Jefe` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`idDepartamento`, `nombreDepartamento`, `Jefe`) VALUES
(1, 'No asignado', 'unknown'),
(2, 'Sistemas y computación', 'Rocío Valadez'),
(3, 'Desarrollo Académico', 'Anapaula Rivas Barraza'),
(4, 'Actualización Docente', 'Mayela Calderon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `idDocumento` int(11) NOT NULL,
  `nombreDocumento` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `fecha` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `sugerencias` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Usuario_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion_has_pregunta`
--

CREATE TABLE `evaluacion_has_pregunta` (
  `Evaluacion_idEvaluacion` int(11) NOT NULL,
  `Pregunta_idPregunta` int(11) NOT NULL,
  `respuesta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructor`
--

CREATE TABLE `instructor` (
  `idInstructor` int(11) NOT NULL,
  `apellidoPaterno` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `apellidoMaterno` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `RFC` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `CURP` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `fechaNacimiento` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `Correo` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `instructor`
--

INSERT INTO `instructor` (`idInstructor`, `apellidoPaterno`, `apellidoMaterno`, `nombre`, `RFC`, `CURP`, `fechaNacimiento`, `telefono`, `Correo`) VALUES
(1, ' ', ' ', 'no asignado', 'UNKNOWN', 'UNKNOWN', '2020-11-02', 'unknown', 'correo@sfac'),
(2, 'Armstrong', 'Aramburo', 'Cristabel', 'AOAC201113UU6', 'AOAC201113MDGRRRA8', '1974-01-01', '6181234567', 'cristabel@correo.mx'),
(3, 'Sifuentes', 'Cisneros', 'Vanessa', 'SICV201107EF1', 'SICV971107MDGFSN04', '1997-11-07', '6181172007', 'vanne.jgs@gmail.com'),
(8, 'Armstrong', 'Aramburo', 'Crisóforo', 'AOAC791230UU6', 'SICV971107MDGFSN04', '1975-02-01', '13298896545', 'cris@email.com'),
(11, 'Cisneros', 'Adame', 'Araceli', 'CIAA7608194Z3', 'CIAA760819MDGSDR09', '1976-08-19', '6182910880', 'cisneros_adame@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `idPregunta` int(11) NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `Departamento_idDepartamento` int(11) NOT NULL,
  `rol` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `nombreUsuario` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `contrasena` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `apellidoPaterno` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `apellidoMaterno` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `Departamento_idDepartamento`, `rol`, `nombreUsuario`, `contrasena`, `apellidoPaterno`, `apellidoMaterno`, `nombre`) VALUES
(1, 3, '2', 'Anapaula', 'da2020', 'Rivas', 'Barraza', 'Anapaula'),
(2, 1, '1', 'admin', 'admin', '1', '2', 'Administrador'),
(3, 2, '3', 'user docente', 'user', 'Bautista', 'Munguia', 'Ana Mayri'),
(4, 1, '4', 'usuario instructor', 'user', 'Sifuentes', 'Cisneros', 'Vanessa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_has_curso`
--

CREATE TABLE `usuario_has_curso` (
  `Usuario_idUsuario` int(11) NOT NULL,
  `Curso_idCurso` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario_has_curso`
--

INSERT INTO `usuario_has_curso` (`Usuario_idUsuario`, `Curso_idCurso`, `estado`) VALUES
(3, 1, 1);

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
  MODIFY `idConstancia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `idCurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `idDepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `idInstructor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
