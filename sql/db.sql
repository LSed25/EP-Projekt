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

INSERT INTO `Stranka` (`id`, `Ime`, `Priimek`,`Enaslov`,`Geslo`, `Ulica`, `Hisna_st`,`Posta`,`Postna_st`)
VALUES (1, 'Ana', 'Novak', "stranka1@ep.si", "$2y$10$68F7.Wwf8F9n04apy6PaCev7jhEfAjs78cLEJX5GS8PKn21ubjC5a", "Slovenska ulica", 13, "Ljubljana", 1000),
(2, 'Peter', 'Kovač', "stranka2@ep.si", "$2y$10$wrcOZkPmQtNEdSMwzWkKFe26Iwt93vZEUDmihWQEt7U1FwZnbXuAS", "Gosposvetska cesta", 33, "Maribor", 2000),
(3, 'Luka', 'Prevc', "stranka3@ep.si", "$2y$10$808l1x1QF1agvJQ2O3wLBeMDgbFPkMVf/GJGW/yfE4gL8vX6Et7Py", "Pot v park", 32, "Ljubljana", 1000),
(4, 'Tina', 'Pahor', "stranka4@ep.si", "$2y$10$RLE9OhTzLMRw6jZWVWIYie902DctdX6Dmj7yQ1oxGiO9aabMxiU0m", "Sončna ulica", 77, "Celje", 3000),
(5, 'Janez', 'Kranjec', "stranka5@ep.si", "$2y$10$VVR/J9qQ3jFnW07li2qvL.oz4YDSPaXu8vvXOPCj1KqSV2MDgE/76", "Prekmurska cesta", 23, "Murska sobota", 9000);
/** gesla = stranka1, stranka2, stranka3, stranka4, stranka5 **/

INSERT INTO `Narocilo` (`id_narocilo`, `Datum`, `Status`,`Zakljuceno`,`id_stranka`)
VALUES (1, '2022-01-01 10:34:09', 'neobdelano', 0, 1),
(2, '2022-01-04 11:12:00', 'neobdelano', 0, 2),
(3, '2022-01-03 02:32:23', 'neobdelano', 0, 5),
(4, '2021-11-23 11:38:03', 'neobdelano', 1, 3),
(5, '2022-01-05 22:33:03', 'neobdelano', 1, 2),
(6, '2021-12-31 02:12:03', 'neobdelano', 1, 4),
(7, '2022-05-21 01:18:09', 'potrjeno', 1, 3),
(8, '2021-01-01 14:32:09', 'potrjeno', 1, 2),
(9, '2022-02-01 16:34:09', 'potrjeno', 1, 5),
(10, '2021-06-18 18:43:00', 'preklicano', 1, 4),
(11, '2022-01-01 19:52:12', 'preklicano', 1, 1),
(12, '2021-08-02 20:26:02', 'preklicano', 1, 1),
(13, '2022-01-01 21:26:09', 'stornirano', 1, 2),
(14, '2021-12-12 22:32:09', 'stornirano', 1, 3),
(15, '2021-12-11 04:34:09', 'stornirano', 1, 5);

INSERT INTO `Stranka` (`Ime`, `Priimek`, `Enaslov`, `Geslo`, `Ulica`, `Hisna_st`, `Posta`, `Postna_st`)
VALUES ('Janez', 'Novak', "janeznovak@gmail.com", "$2y$10$MynsesefCOi.PS.g3QsCp.XbnxW0hzwEsT6AR7.QIDlr/z3sQK3Ju", 'Test', 13, 'Ljubljana', 1000);
/** geslo = Test1234 **/
