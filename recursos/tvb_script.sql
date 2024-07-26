-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`usuario` (
  `usuario` VARCHAR(45) NOT NULL,
  `contraseña` VARCHAR(45) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `telefono` VARCHAR(15) NOT NULL,
  `identificacion` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`usuario`),
  UNIQUE INDEX `contraseña_UNIQUE` (`contraseña` ASC) VISIBLE,
  UNIQUE INDEX `usuario_UNIQUE` (`usuario` ASC) VISIBLE,
  UNIQUE INDEX `cedula_UNIQUE` (`identificacion` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`autor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`autor` (
  `idautor` INT NOT NULL,
  `nombre_autor` VARCHAR(60) NOT NULL,
  `biografia_autor` VARCHAR(200) NULL,
  PRIMARY KEY (`idautor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`editorial`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`editorial` (
  `ideditorial` INT NOT NULL,
  `nombre_editorial` VARCHAR(100) NOT NULL,
  `email_editorial` VARCHAR(100) NOT NULL,
  `telefono_editoral` VARCHAR(45) NULL,
  `idautor_fk` INT NOT NULL,
  PRIMARY KEY (`ideditorial`, `idautor_fk`),
  INDEX `fk_editorial_autor1_idx` (`idautor_fk` ASC) VISIBLE,
  CONSTRAINT `fk_editorial_autor1`
    FOREIGN KEY (`idautor_fk`)
    REFERENCES `mydb`.`autor` (`idautor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`libro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`libro` (
  `idlibro` INT NOT NULL,
  `titulo` VARCHAR(100) NOT NULL,
  `longitud` INT NOT NULL,
  `editorial` VARCHAR(45) NOT NULL,
  `ideditorial_fk` INT NOT NULL,
  `idautor_fk` INT NOT NULL,
  PRIMARY KEY (`idlibro`, `ideditorial_fk`, `idautor_fk`),
  INDEX `fk_libro_editorial1_idx` (`ideditorial_fk` ASC, `idautor_fk` ASC) VISIBLE,
  CONSTRAINT `fk_libro_editorial1`
    FOREIGN KEY (`ideditorial_fk` , `idautor_fk`)
    REFERENCES `mydb`.`editorial` (`ideditorial` , `idautor_fk`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`métodoDePago`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`métodoDePago` (
  `tarjeta` INT NOT NULL,
  `cvv` INT NOT NULL,
  `nombre_tarjeta` VARCHAR(100) NOT NULL,
  `fechaVec` DATE NOT NULL,
  PRIMARY KEY (`tarjeta`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`compra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`compra` (
  `transaccion` INT NOT NULL,
  `cantidad` INT NOT NULL,
  `descripcion` VARCHAR(45) NULL,
  `usuario_fk` VARCHAR(45) NOT NULL,
  `idlibro_fk` INT NOT NULL,
  `ideditorial_fk` INT NOT NULL,
  `idautor_fk` INT NOT NULL,
  `métodoDePago_tarjeta` INT NOT NULL,
  PRIMARY KEY (`transaccion`, `usuario_fk`, `idlibro_fk`, `ideditorial_fk`, `idautor_fk`, `métodoDePago_tarjeta`),
  INDEX `fk_compra_usuario1_idx` (`usuario_fk` ASC) VISIBLE,
  INDEX `fk_compra_libro1_idx` (`idlibro_fk` ASC, `ideditorial_fk` ASC, `idautor_fk` ASC) VISIBLE,
  INDEX `fk_compra_métodoDePago1_idx` (`métodoDePago_tarjeta` ASC) VISIBLE,
  CONSTRAINT `fk_compra_usuario1`
    FOREIGN KEY (`usuario_fk`)
    REFERENCES `mydb`.`usuario` (`usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_compra_libro1`
    FOREIGN KEY (`idlibro_fk` , `ideditorial_fk` , `idautor_fk`)
    REFERENCES `mydb`.`libro` (`idlibro` , `ideditorial_fk` , `idautor_fk`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_compra_métodoDePago1`
    FOREIGN KEY (`métodoDePago_tarjeta`)
    REFERENCES `mydb`.`métodoDePago` (`tarjeta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
