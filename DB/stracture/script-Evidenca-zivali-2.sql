-- MySQL Script generated by MySQL Workbench
-- Tue Jun  9 17:20:25 2020
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema evidenca_zivali
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `evidenca_zivali` ;

-- -----------------------------------------------------
-- Schema evidenca_zivali
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `evidenca_zivali` DEFAULT CHARACTER SET utf8 ;
USE `evidenca_zivali` ;

-- -----------------------------------------------------
-- Table `evidenca_zivali`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `evidenca_zivali`.`users` ;

CREATE TABLE IF NOT EXISTS `evidenca_zivali`.`users` (
  `idusers` INT NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(75) NOT NULL,
  `lname` VARCHAR(90) NOT NULL,
  `username` VARCHAR(125) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` TINYTEXT NOT NULL,
  `date_add` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
  `date_modify` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `admin` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`idusers`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evidenca_zivali`.`animal_types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `evidenca_zivali`.`animal_types` ;

CREATE TABLE IF NOT EXISTS `evidenca_zivali`.`animal_types` (
  `idanimal_types` INT NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idanimal_types`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evidenca_zivali`.`breeds`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `evidenca_zivali`.`breeds` ;

CREATE TABLE IF NOT EXISTS `evidenca_zivali`.`breeds` (
  `idbreeds` INT NOT NULL AUTO_INCREMENT,
  `breed` VARCHAR(45) NOT NULL,
  `fk_idanimal_types` INT NOT NULL,
  PRIMARY KEY (`idbreeds`),
  INDEX `fk_breeds_animal_types1_idx` (`fk_idanimal_types` ASC),
  CONSTRAINT `fk_breeds_animal_types1`
    FOREIGN KEY (`fk_idanimal_types`)
    REFERENCES `evidenca_zivali`.`animal_types` (`idanimal_types`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evidenca_zivali`.`health`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `evidenca_zivali`.`health` ;

CREATE TABLE IF NOT EXISTS `evidenca_zivali`.`health` (
  `idhealth` INT NOT NULL AUTO_INCREMENT,
  `status` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idhealth`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evidenca_zivali`.`sex`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `evidenca_zivali`.`sex` ;

CREATE TABLE IF NOT EXISTS `evidenca_zivali`.`sex` (
  `idsex` INT NOT NULL AUTO_INCREMENT,
  `sex` VARCHAR(10) NOT NULL,
  `tag` CHAR(1) NOT NULL,
  PRIMARY KEY (`idsex`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evidenca_zivali`.`pregnancies`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `evidenca_zivali`.`pregnancies` ;

CREATE TABLE IF NOT EXISTS `evidenca_zivali`.`pregnancies` (
  `idpregnancies` INT NOT NULL AUTO_INCREMENT,
  `pregnancy` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idpregnancies`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evidenca_zivali`.`animals`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `evidenca_zivali`.`animals` ;

CREATE TABLE IF NOT EXISTS `evidenca_zivali`.`animals` (
  `idanimals` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `ear_tag` VARCHAR(10) NOT NULL,
  `birth` DATE NOT NULL,
  `date_add` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
  `date_modifiy` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fk_idbreeds` INT NOT NULL,
  `fk_idusers` INT NOT NULL,
  `fk_idhealth` INT NOT NULL,
  `fk_idsex` INT NOT NULL,
  `fk_idpregnancies` INT NULL,
  `idmother` INT NULL,
  `idfather` INT NULL,
  PRIMARY KEY (`idanimals`),
  UNIQUE INDEX `ear-tag_UNIQUE` (`ear_tag` ASC),
  INDEX `fk_animals_breeds_idx` (`fk_idbreeds` ASC),
  INDEX `fk_animals_users1_idx` (`fk_idusers` ASC),
  INDEX `fk_animals_health1_idx` (`fk_idhealth` ASC),
  INDEX `fk_animals_sex1_idx` (`fk_idsex` ASC),
  INDEX `fk_animals_pregnancies1_idx` (`fk_idpregnancies` ASC),
  INDEX `fk_animals_animals1_idx` (`idmother` ASC),
  INDEX `fk_animals_animals2_idx` (`idfather` ASC),
  CONSTRAINT `fk_animals_breeds`
    FOREIGN KEY (`fk_idbreeds`)
    REFERENCES `evidenca_zivali`.`breeds` (`idbreeds`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_animals_users1`
    FOREIGN KEY (`fk_idusers`)
    REFERENCES `evidenca_zivali`.`users` (`idusers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_animals_health1`
    FOREIGN KEY (`fk_idhealth`)
    REFERENCES `evidenca_zivali`.`health` (`idhealth`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_animals_sex1`
    FOREIGN KEY (`fk_idsex`)
    REFERENCES `evidenca_zivali`.`sex` (`idsex`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_animals_pregnancies1`
    FOREIGN KEY (`fk_idpregnancies`)
    REFERENCES `evidenca_zivali`.`pregnancies` (`idpregnancies`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_animals_animals1`
    FOREIGN KEY (`idmother`)
    REFERENCES `evidenca_zivali`.`animals` (`idanimals`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_animals_animals2`
    FOREIGN KEY (`idfather`)
    REFERENCES `evidenca_zivali`.`animals` (`idanimals`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evidenca_zivali`.`comments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `evidenca_zivali`.`comments` ;

CREATE TABLE IF NOT EXISTS `evidenca_zivali`.`comments` (
  `idcomments` INT NOT NULL AUTO_INCREMENT,
  `content` TEXT NOT NULL,
  `rating` INT NULL,
  `date_add` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
  `date_modify` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fk_idanimals` INT NOT NULL,
  `fk_idusers` INT NOT NULL,
  PRIMARY KEY (`idcomments`),
  INDEX `fk_comments_animals1_idx` (`fk_idanimals` ASC),
  INDEX `fk_comments_users1_idx` (`fk_idusers` ASC),
  CONSTRAINT `fk_comments_animals1`
    FOREIGN KEY (`fk_idanimals`)
    REFERENCES `evidenca_zivali`.`animals` (`idanimals`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_users1`
    FOREIGN KEY (`fk_idusers`)
    REFERENCES `evidenca_zivali`.`users` (`idusers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evidenca_zivali`.`photos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `evidenca_zivali`.`photos` ;

CREATE TABLE IF NOT EXISTS `evidenca_zivali`.`photos` (
  `idphotos` INT NOT NULL AUTO_INCREMENT,
  `url` TEXT NOT NULL,
  `caption` VARCHAR(90) NOT NULL,
  `fk_idanimals` INT NOT NULL,
  PRIMARY KEY (`idphotos`),
  INDEX `fk_photos_animals1_idx` (`fk_idanimals` ASC),
  UNIQUE INDEX `photo_UNIQUE` (`url` ASC),
  CONSTRAINT `fk_photos_animals1`
    FOREIGN KEY (`fk_idanimals`)
    REFERENCES `evidenca_zivali`.`animals` (`idanimals`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
