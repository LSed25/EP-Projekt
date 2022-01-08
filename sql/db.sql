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
  `Ime` VARCHAR(45) NOT NULL,
  `Priimek` VARCHAR(45) NOT NULL,
  `Enaslov` VARCHAR(45) NOT NULL,
  `Geslo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_admin`),
  UNIQUE INDEX `Enaslov_UNIQUE` (`Enaslov` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`Prodajalec`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`Prodajalec` (
  `id_prodajalec` INT NOT NULL AUTO_INCREMENT,
  `Ime` VARCHAR(45) NOT NULL,
  `Priimek` VARCHAR(45) NOT NULL,
  `Enaslov` VARCHAR(45) NOT NULL,
  `Geslo` VARCHAR(45) NOT NULL,
  `Aktiviran` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_prodajalec`),
  UNIQUE INDEX `Enaslov_UNIQUE` (`Enaslov` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`Stranka`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`Stranka` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Ime` VARCHAR(45) NOT NULL,
  `Priimek` VARCHAR(45) NOT NULL,
  `Enaslov` VARCHAR(45) NOT NULL,
  `Geslo` VARCHAR(45) NOT NULL,
  `Ulica` VARCHAR(45) NOT NULL,
  `Hisna_st` INT NOT NULL,
  `Posta` VARCHAR(45) NOT NULL,
  `Postna_st` INT NOT NULL,
  `Aktiviran` TINYINT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `Enaslov_UNIQUE` (`Enaslov` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`Naročilo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`Naročilo` (
  `id_naročilo` INT NOT NULL AUTO_INCREMENT,
  `Datum` DATETIME NOT NULL DEFAULT NOW(),
  `Status` VARCHAR(45) NULL,
  `Zaključeno` TINYINT NOT NULL DEFAULT 0,
  `id_stranka` INT NOT NULL,
  PRIMARY KEY (`id_naročilo`),
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
  `id_produkt` INT NOT NULL AUTO_INCREMENT,
  `Avtor` VARCHAR(45) NOT NULL,
  `Naslov` VARCHAR(45) NOT NULL,
  `Leto_izdaje` INT NOT NULL,
  `Cena` DECIMAL NOT NULL,
  `Aktiviran` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_produkt`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`Produkt_košarica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`Produkt_košarica` (
  `id_pk` INT NOT NULL AUTO_INCREMENT,
  `id_produkt` INT NOT NULL,
  `Količina` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_pk`),
  INDEX `id_produkt_idx` (`id_produkt` ASC) VISIBLE,
  CONSTRAINT `id_produkt`
    FOREIGN KEY (`id_produkt`)
    REFERENCES `bookstore`.`Produkt` (`id_produkt`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`Košarica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`Košarica` (
  `id_košarica` INT NOT NULL AUTO_INCREMENT,
  `id_artikel` INT NOT NULL,
  `id_strankakošarica` INT NULL,
  PRIMARY KEY (`id_košarica`),
  INDEX `id_artikel_idx` (`id_artikel` ASC) VISIBLE,
  INDEX `id_stranka_idx` (`id_strankakošarica` ASC) VISIBLE,
  CONSTRAINT `id_artikel`
    FOREIGN KEY (`id_artikel`)
    REFERENCES `bookstore`.`Produkt_košarica` (`id_pk`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_strankakošarica`
    FOREIGN KEY (`id_strankakošarica`)
    REFERENCES `bookstore`.`Stranka` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



/** DODAJANJE ZAČETNIH PRODUKTOV V BAZO **/
INSERT INTO `Produkt` (`id_produkt`, `Avtor`,`Naslov`,`Leto_izdaje`,`Cena`)
VALUES (1, 'Matt Haig', 'The Midnight Library', 2021, 9.5),
(2, 'Taylor Jenkins Reid', 'The Seven Husbands of Evelyn Hugo', 2021, 10.5),
(3, 'Sally Rooney', 'Normal People', 2020, 14),
(4, 'Madeline Miller', 'Circe', 2019, 11.3 ),
(5, 'Kiley Reid', 'Such a Fun Age', 2020, 10.5);