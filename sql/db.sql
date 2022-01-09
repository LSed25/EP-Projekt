DROP DATABASE IF EXISTS `bookstore`;
CREATE SCHEMA IF NOT EXISTS `bookstore` DEFAULT CHARACTER SET utf8 COLLATE utf8_slovenian_ci ;
USE `bookstore` ;
 
-- phpMyAdmin SQL Dump
-- version 4.4.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 12, 2015 at 01:01 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


-- -----------------------------------------------------
-- Table `bookstore`.`Administrator`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`Administrator` (
  `id_admin` INT NOT NULL AUTO_INCREMENT,
  `Ime` VARCHAR(255) NOT NULL,
  `Priimek` VARCHAR(255) NOT NULL,
  `Enaslov` VARCHAR(255) NOT NULL,
  `Geslo` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_admin`),
  UNIQUE INDEX `Enaslov_UNIQUE` (`Enaslov` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`Prodajalec`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`Prodajalec` (
  `id_prodajalec` INT NOT NULL AUTO_INCREMENT,
  `Ime` VARCHAR(255) NOT NULL,
  `Priimek` VARCHAR(255) NOT NULL,
  `Enaslov` VARCHAR(255) NOT NULL,
  `Geslo` VARCHAR(255) NOT NULL,
  `Aktiviran` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_prodajalec`),
  UNIQUE INDEX `Enaslov_UNIQUE` (`Enaslov` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`Stranka`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`Stranka` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Ime` VARCHAR(255) NOT NULL,
  `Priimek` VARCHAR(255) NOT NULL,
  `Enaslov` VARCHAR(255) NOT NULL,
  `Geslo` VARCHAR(255) NOT NULL,
  `Ulica` VARCHAR(255) NOT NULL,
  `Hisna_st` INT NOT NULL,
  `Posta` VARCHAR(255) NOT NULL,
  `Postna_st` INT NOT NULL,
  `Aktiviran` TINYINT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `Enaslov_UNIQUE` (`Enaslov` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`Naročilo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`Narocilo` (
  `id_narocilo` INT NOT NULL AUTO_INCREMENT,
  `Datum` DATETIME NOT NULL DEFAULT NOW(),
  `Status` VARCHAR(255) NULL,
  `Zakljuceno` TINYINT NOT NULL DEFAULT 0,
  `Cena` DECIMAL NOT NULL,
  `id_stranka` INT NOT NULL,
  PRIMARY KEY (`id_narocilo`),
  INDEX `id_stranka_idx` (`id_stranka` ASC) VISIBLE,
  CONSTRAINT `id_stranka`
    FOREIGN KEY (`id_stranka`)
    REFERENCES `bookstore`.`Stranka` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`Produkt`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`Produkt` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Avtor` VARCHAR(255) NOT NULL,
  `Naslov` VARCHAR(255) NOT NULL,
  `Leto_izdaje` INT NOT NULL,
  `Cena` DECIMAL NOT NULL,
  `Aktiviran` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`Produkt_košarica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`Produkt_kosarica` (
  `id_pk` INT NOT NULL AUTO_INCREMENT,
  `id_produkt` INT NOT NULL,
  `Kolicina` INT NOT NULL DEFAULT 1,
  `Cena` DECIMAL NOT NULL,    
  PRIMARY KEY (`id_pk`),
  INDEX `id_produkt_idx` (`id_produkt` ASC) VISIBLE,
  CONSTRAINT `id_produkt`
    FOREIGN KEY (`id_produkt`)
    REFERENCES `bookstore`.`Produkt` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`Košarica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`Kosarica` (
  `id_kosarica` INT NOT NULL AUTO_INCREMENT,
  `id_artikel` INT NOT NULL,
  `id_strankakosarica` INT NULL,
  `Cena` DECIMAL NOT NULL,
  PRIMARY KEY (`id_kosarica`),
  INDEX `id_artikel_idx` (`id_artikel` ASC) VISIBLE,
  INDEX `id_stranka_idx` (`id_strankakosarica` ASC) VISIBLE,
  CONSTRAINT `id_artikel`
    FOREIGN KEY (`id_artikel`)
    REFERENCES `bookstore`.`Produkt_kosarica` (`id_pk`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_strankakosarica`
    FOREIGN KEY (`id_strankakosarica`)
    REFERENCES `bookstore`.`Stranka` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



/** DODAJANJE ZAČETNIH PRODUKTOV V BAZO **/
INSERT INTO `Produkt` (`id`, `Avtor`,`Naslov`,`Leto_izdaje`,`Cena`)
VALUES (1, 'Matt Haig', 'The Midnight Library', 2021, 9.5),
(2, 'Taylor Jenkins Reid', 'The Seven Husbands of Evelyn Hugo', 2021, 10.5),
(3, 'Sally Rooney', 'Normal People', 2020, 14),
(4, 'Madeline Miller', 'Circe', 2019, 11.3 ),
(5, 'Kiley Reid', 'Such a Fun Age', 2020, 10.5);

INSERT INTO `Administrator` (`Ime`, `Priimek`,`Enaslov`,`Geslo`)
VALUES ('admin', 'admin', "admin@ep.si", "$2y$10$ssuzhFFAOyEGYjHTvvI8K.WGlPqdVSDnlJiq2sLpVXgGpDdkcF82W");
/** geslo = admin **/

INSERT INTO `Prodajalec` (`Ime`, `Priimek`,`Enaslov`,`Geslo`)
VALUES ('prvi', 'prodajalec', "prodaja@ep.si", "$2y$10$LUs.ueIi/l5FodEMBKNfce/wY783xzaJdrSgZEUOVYyDfG6X93s9O");
/** geslo = prodaja **/

INSERT INTO `Stranka` (`Ime`, `Priimek`, `Enaslov`, `Geslo`, `Ulica`, `Hisna_st`, `Posta`, `Postna_st`)
VALUES ('Janez', 'Novak', "janeznovak@gmail.com", "$2y$10$MynsesefCOi.PS.g3QsCp.XbnxW0hzwEsT6AR7.QIDlr/z3sQK3Ju", 'Test', 13, 'Ljubljana', 1000);
/** geslo = Test1234 **/