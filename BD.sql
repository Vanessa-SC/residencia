-- MySQL Script generated by MySQL Workbench
-- Thu Dec  3 14:00:03 2020
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema bd_actDocente
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bd_actDocente
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bd_actDocente` DEFAULT CHARACTER SET utf8 ;
USE `bd_actDocente` ;

-- -----------------------------------------------------
-- Table `bd_actDocente`.`Departamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_actDocente`.`Departamento` (
  `idDepartamento` INT NOT NULL AUTO_INCREMENT,
  `nombreDepartamento` VARCHAR(150) NOT NULL,
  `Jefe` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`idDepartamento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_actDocente`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_actDocente`.`Usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `Departamento_idDepartamento` INT NOT NULL,
  `rol` VARCHAR(45) NOT NULL,
  `nombreUsuario` VARCHAR(45) NOT NULL,
  `contrasena` VARCHAR(45) NOT NULL,
  `apellidoParterno` VARCHAR(45) NULL,
  `apellidoMaterno` VARCHAR(45) NULL,
  `nombre` VARCHAR(45) NULL,
  PRIMARY KEY (`idUsuario`, `Departamento_idDepartamento`),
  INDEX `fk_Usuario_Departamento1_idx` (`Departamento_idDepartamento` ASC) VISIBLE,
  CONSTRAINT `fk_Usuario_Departamento1`
    FOREIGN KEY (`Departamento_idDepartamento`)
    REFERENCES `bd_actDocente`.`Departamento` (`idDepartamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_actDocente`.`Documento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_actDocente`.`Documento` (
  `idDocumento` INT NOT NULL AUTO_INCREMENT,
  `nombreDocumento` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`idDocumento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_actDocente`.`Pregunta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_actDocente`.`Pregunta` (
  `idPregunta` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NULL,
  PRIMARY KEY (`idPregunta`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_actDocente`.`Instructor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_actDocente`.`Instructor` (
  `idInstructor` INT NOT NULL AUTO_INCREMENT,
  `apellidoParterno` VARCHAR(45) NULL,
  `apellidoMaterno` VARCHAR(45) NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `RFC` VARCHAR(45) NOT NULL,
  `CURP` VARCHAR(45) NOT NULL,
  `fechaNacimiento` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(45) NOT NULL,
  `Correo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idInstructor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_actDocente`.`Curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_actDocente`.`Curso` (
  `idCurso` INT NOT NULL AUTO_INCREMENT,
  `Folio` VARCHAR(45) NULL,
  `ClaveRegistro` VARCHAR(45) NOT NULL,
  `nombreCurso` VARCHAR(45) NOT NULL,
  `periodo` VARCHAR(45) NOT NULL,
  `duracion` INT NOT NULL,
  `horaInicio` VARCHAR(45) NOT NULL,
  `horaFin` VARCHAR(45) NOT NULL,
  `fechaInicio` VARCHAR(45) NOT NULL,
  `fechaFin` VARCHAR(45) NOT NULL,
  `modalidad` VARCHAR(45) NOT NULL,
  `lugar` VARCHAR(250) NOT NULL,
  `destinatarios` VARCHAR(45) NOT NULL,
  `objetivo` VARCHAR(300) NOT NULL,
  `observaciones` VARCHAR(200) NULL,
  `validado` VARCHAR(45) NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `created_by` VARCHAR(200) NOT NULL,
  `Instructor_idInstructor` INT NOT NULL,
  `Departamento_idDepartamento` INT NOT NULL,
  PRIMARY KEY (`idCurso`, `Instructor_idInstructor`, `Departamento_idDepartamento`),
  INDEX `fk_Curso_Instructor1_idx` (`Instructor_idInstructor` ASC) VISIBLE,
  INDEX `fk_Curso_Departamento1_idx` (`Departamento_idDepartamento` ASC) VISIBLE,
  CONSTRAINT `fk_Curso_Instructor1`
    FOREIGN KEY (`Instructor_idInstructor`)
    REFERENCES `bd_actDocente`.`Instructor` (`idInstructor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Curso_Departamento1`
    FOREIGN KEY (`Departamento_idDepartamento`)
    REFERENCES `bd_actDocente`.`Departamento` (`idDepartamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_actDocente`.`Curso_has_Documento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_actDocente`.`Curso_has_Documento` (
  `Curso_idCurso` INT NOT NULL,
  `Documento_idDocumento` INT NOT NULL,
  `rutaArchivo` VARCHAR(200) NULL,
  `estadoVerificado` VARCHAR(45) NULL,
  `comentario` VARCHAR(300) NULL,
  PRIMARY KEY (`Curso_idCurso`, `Documento_idDocumento`),
  INDEX `fk_Curso_has_Documento_Documento1_idx` (`Documento_idDocumento` ASC) VISIBLE,
  INDEX `fk_Curso_has_Documento_Curso1_idx` (`Curso_idCurso` ASC) VISIBLE,
  CONSTRAINT `fk_Curso_has_Documento_Curso1`
    FOREIGN KEY (`Curso_idCurso`)
    REFERENCES `bd_actDocente`.`Curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Curso_has_Documento_Documento1`
    FOREIGN KEY (`Documento_idDocumento`)
    REFERENCES `bd_actDocente`.`Documento` (`idDocumento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_actDocente`.`Asistencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_actDocente`.`Asistencia` (
  `idAsistencia` INT NOT NULL AUTO_INCREMENT,
  `fecha` TIMESTAMP NOT NULL,
  `asistencia` TINYINT NOT NULL,
  `Usuario_idUsuario` INT NOT NULL,
  `Curso_idCurso` INT NOT NULL,
  PRIMARY KEY (`idAsistencia`, `Usuario_idUsuario`, `Curso_idCurso`),
  INDEX `fk_Asistencia_Usuario1_idx` (`Usuario_idUsuario` ASC) VISIBLE,
  INDEX `fk_Asistencia_Curso1_idx` (`Curso_idCurso` ASC) VISIBLE,
  CONSTRAINT `fk_Asistencia_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `bd_actDocente`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Asistencia_Curso1`
    FOREIGN KEY (`Curso_idCurso`)
    REFERENCES `bd_actDocente`.`Curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_actDocente`.`Usuario_has_Curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_actDocente`.`Usuario_has_Curso` (
  `Usuario_idUsuario` INT NOT NULL,
  `Curso_idCurso` INT NOT NULL,
  `estado` INT NOT NULL,
  PRIMARY KEY (`Usuario_idUsuario`, `Curso_idCurso`),
  INDEX `fk_Usuario_has_Curso_Curso1_idx` (`Curso_idCurso` ASC) VISIBLE,
  INDEX `fk_Usuario_has_Curso_Usuario1_idx` (`Usuario_idUsuario` ASC) VISIBLE,
  CONSTRAINT `fk_Usuario_has_Curso_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `bd_actDocente`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_has_Curso_Curso1`
    FOREIGN KEY (`Curso_idCurso`)
    REFERENCES `bd_actDocente`.`Curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_actDocente`.`Constancia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_actDocente`.`Constancia` (
  `idConstancia` INT NOT NULL AUTO_INCREMENT,
  `folio` VARCHAR(45) NOT NULL,
  `rutaConstancia` VARCHAR(250) NOT NULL,
  `Curso_idCurso` INT NOT NULL,
  `Usuario_idUsuario` INT NOT NULL,
  PRIMARY KEY (`idConstancia`, `Curso_idCurso`, `Usuario_idUsuario`),
  INDEX `fk_Constancia_Curso1_idx` (`Curso_idCurso` ASC) VISIBLE,
  INDEX `fk_Constancia_Usuario1_idx` (`Usuario_idUsuario` ASC) VISIBLE)
ENGINE = MEMORY;


-- -----------------------------------------------------
-- Table `bd_actDocente`.`Encuesta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_actDocente`.`Encuesta` (
  `idEncuesta` INT NOT NULL,
  `tipoEncuesta` INT NOT NULL,
  `nombreEncuesta` VARCHAR(70) NOT NULL,
  PRIMARY KEY (`idEncuesta`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_actDocente`.`Encuesta_has_Pregunta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_actDocente`.`Encuesta_has_Pregunta` (
  `Encuesta_idEncuesta` INT NOT NULL,
  `Pregunta_idPregunta` INT NOT NULL,
  PRIMARY KEY (`Encuesta_idEncuesta`, `Pregunta_idPregunta`),
  INDEX `fk_Encuesta_has_Pregunta_Pregunta1_idx` (`Pregunta_idPregunta` ASC) VISIBLE,
  INDEX `fk_Encuesta_has_Pregunta_Encuesta1_idx` (`Encuesta_idEncuesta` ASC) VISIBLE,
  CONSTRAINT `fk_Encuesta_has_Pregunta_Encuesta1`
    FOREIGN KEY (`Encuesta_idEncuesta`)
    REFERENCES `bd_actDocente`.`Encuesta` (`idEncuesta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Encuesta_has_Pregunta_Pregunta1`
    FOREIGN KEY (`Pregunta_idPregunta`)
    REFERENCES `bd_actDocente`.`Pregunta` (`idPregunta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_actDocente`.`Curso_has_Encuesta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_actDocente`.`Curso_has_Encuesta` (
  `Curso_idCurso` INT NOT NULL,
  `Curso_Instructor_idInstructor` INT NOT NULL,
  `Encuesta_idEncuesta` INT NOT NULL,
  PRIMARY KEY (`Curso_idCurso`, `Curso_Instructor_idInstructor`, `Encuesta_idEncuesta`),
  INDEX `fk_Curso_has_Encuesta_Encuesta1_idx` (`Encuesta_idEncuesta` ASC) VISIBLE,
  INDEX `fk_Curso_has_Encuesta_Curso1_idx` (`Curso_idCurso` ASC, `Curso_Instructor_idInstructor` ASC) VISIBLE,
  CONSTRAINT `fk_Curso_has_Encuesta_Curso1`
    FOREIGN KEY (`Curso_idCurso` , `Curso_Instructor_idInstructor`)
    REFERENCES `bd_actDocente`.`Curso` (`idCurso` , `Instructor_idInstructor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Curso_has_Encuesta_Encuesta1`
    FOREIGN KEY (`Encuesta_idEncuesta`)
    REFERENCES `bd_actDocente`.`Encuesta` (`idEncuesta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_actDocente`.`Usuario_responde_Encuesta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_actDocente`.`Usuario_responde_Encuesta` (
  `Usuario_idUsuario` INT NOT NULL,
  `Encuesta_idEncuesta` INT NOT NULL,
  `Pregunta_idPregunta` INT NOT NULL,
  `respuesta` INT NULL,
  `fecha` TIMESTAMP NOT NULL,
  PRIMARY KEY (`Usuario_idUsuario`, `Encuesta_idEncuesta`, `Pregunta_idPregunta`),
  INDEX `fk_Usuario_has_Encuesta_Encuesta1_idx` (`Encuesta_idEncuesta` ASC) VISIBLE,
  INDEX `fk_Usuario_has_Encuesta_Usuario1_idx` (`Usuario_idUsuario` ASC) VISIBLE,
  INDEX `fk_Usuario_responde_Encuesta_Pregunta1_idx` (`Pregunta_idPregunta` ASC) VISIBLE,
  CONSTRAINT `fk_Usuario_has_Encuesta_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `bd_actDocente`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_has_Encuesta_Encuesta1`
    FOREIGN KEY (`Encuesta_idEncuesta`)
    REFERENCES `bd_actDocente`.`Encuesta` (`idEncuesta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_responde_Encuesta_Pregunta1`
    FOREIGN KEY (`Pregunta_idPregunta`)
    REFERENCES `bd_actDocente`.`Pregunta` (`idPregunta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_actDocente`.`Sugerencias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_actDocente`.`Sugerencias` (
  `idSugerencias` INT NOT NULL,
  `comentario` VARCHAR(300) NOT NULL,
  `Curso_idCurso` INT NOT NULL,
  `Curso_Instructor_idInstructor` INT NOT NULL,
  `Curso_Departamento_idDepartamento` INT NOT NULL,
  `Usuario_idUsuario` INT NOT NULL,
  `Usuario_Departamento_idDepartamento` INT NOT NULL,
  PRIMARY KEY (`idSugerencias`, `Curso_idCurso`, `Curso_Instructor_idInstructor`, `Curso_Departamento_idDepartamento`, `Usuario_idUsuario`, `Usuario_Departamento_idDepartamento`),
  INDEX `fk_Sugerencias_Curso1_idx` (`Curso_idCurso` ASC, `Curso_Instructor_idInstructor` ASC, `Curso_Departamento_idDepartamento` ASC) VISIBLE,
  INDEX `fk_Sugerencias_Usuario1_idx` (`Usuario_idUsuario` ASC, `Usuario_Departamento_idDepartamento` ASC) VISIBLE,
  CONSTRAINT `fk_Sugerencias_Curso1`
    FOREIGN KEY (`Curso_idCurso` , `Curso_Instructor_idInstructor` , `Curso_Departamento_idDepartamento`)
    REFERENCES `bd_actDocente`.`Curso` (`idCurso` , `Instructor_idInstructor` , `Departamento_idDepartamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Sugerencias_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario` , `Usuario_Departamento_idDepartamento`)
    REFERENCES `bd_actDocente`.`Usuario` (`idUsuario` , `Departamento_idDepartamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;