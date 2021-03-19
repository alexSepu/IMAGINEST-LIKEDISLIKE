-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema imaginest
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema imaginest
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `imaginest` DEFAULT CHARACTER SET utf8mb4 ;
USE `imaginest` ;

-- -----------------------------------------------------
-- Table `imaginest`.`hashtag`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `imaginest`.`hashtag` (
  `idHashtag` INT(11) NOT NULL AUTO_INCREMENT,
  `nameHashtag` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`idHashtag`))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `imaginest`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `imaginest`.`users` (
  `iduser` INT(11) NOT NULL AUTO_INCREMENT,
  `mail` VARCHAR(40) NULL DEFAULT NULL,
  `username` VARCHAR(16) NULL DEFAULT NULL,
  `passHash` VARCHAR(60) NULL DEFAULT NULL,
  `userFirstName` VARCHAR(60) NULL DEFAULT NULL,
  `userLastName` VARCHAR(120) NULL DEFAULT NULL,
  `creationDate` DATETIME NULL DEFAULT NULL,
  `lastSignIn` DATETIME NULL DEFAULT NULL,
  `removeDate` DATETIME NULL DEFAULT NULL,
  `active` TINYINT(1) NULL DEFAULT NULL,
  `activationDate` DATETIME NULL DEFAULT NULL,
  `activationCode` CHAR(64) NULL DEFAULT NULL,
  `resetPass` TINYINT(1) NULL DEFAULT NULL,
  `resetPassExpiry` DATETIME NULL DEFAULT NULL,
  `resetPassCode` CHAR(64) NULL DEFAULT NULL,
  PRIMARY KEY (`iduser`),
  UNIQUE INDEX `mail` (`mail` ASC) VISIBLE,
  UNIQUE INDEX `username` (`username` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `imaginest`.`post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `imaginest`.`post` (
  `idPost` INT(11) NOT NULL AUTO_INCREMENT,
  `namePhoto` VARCHAR(100) NULL DEFAULT NULL,
  `dislikes` INT(11) NULL DEFAULT NULL,
  `likes` INT(11) NULL DEFAULT NULL,
  `datePost` DATETIME NULL DEFAULT NULL,
  `description` VARCHAR(150) NULL DEFAULT NULL,
  `sepia` TINYINT(1) NULL DEFAULT NULL,
  `gray` TINYINT(1) NULL DEFAULT NULL,
  `invert` TINYINT(1) NULL DEFAULT NULL,
  `idUser` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idPost`),
  INDEX `fk_post_user` (`idUser` ASC) VISIBLE,
  CONSTRAINT `fk_post_user`
    FOREIGN KEY (`idUser`)
    REFERENCES `imaginest`.`users` (`iduser`))
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `imaginest`.`contain`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `imaginest`.`contain` (
  `idHashtag` INT(11) NOT NULL,
  `idPost` INT(11) NOT NULL,
  PRIMARY KEY (`idHashtag`, `idPost`),
  INDEX `fk_contain_post` (`idPost` ASC) VISIBLE,
  CONSTRAINT `fk_contain_hastag`
    FOREIGN KEY (`idHashtag`)
    REFERENCES `imaginest`.`hashtag` (`idHashtag`),
  CONSTRAINT `fk_contain_post`
    FOREIGN KEY (`idPost`)
    REFERENCES `imaginest`.`post` (`idPost`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `imaginest`.`topost`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `imaginest`.`topost` (
  `idUser` INT(11) NOT NULL,
  `idPost` INT(11) NOT NULL,
  `likeDislike` TINYINT(1) NULL DEFAULT NULL,
  PRIMARY KEY (`idUser`, `idPost`),
  INDEX `fk_topost_post` (`idPost` ASC) VISIBLE,
  CONSTRAINT `fk_topost_post`
    FOREIGN KEY (`idPost`)
    REFERENCES `imaginest`.`post` (`idPost`),
  CONSTRAINT `fk_topost_user`
    FOREIGN KEY (`idUser`)
    REFERENCES `imaginest`.`users` (`iduser`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
