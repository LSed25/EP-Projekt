drop database if exists bookstore;
create database bookstore;
use bookstore;
 
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


CREATE TABLE `Administrator` (
	`id_admin` INT NOT NULL AUTO_INCREMENT,
	`Ime` VARCHAR(255) NOT NULL,
	`Priimek` VARCHAR(255) NOT NULL,
	`Enaslov` VARCHAR(255) NOT NULL UNIQUE,
	`Geslo` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id_admin`)
);

CREATE TABLE `Prodajalec` (
	`id_prodajalec` INT NOT NULL AUTO_INCREMENT,
	`Ime` VARCHAR(255) NOT NULL,
	`Priimek` VARCHAR(255) NOT NULL,
	`Enaslov` VARCHAR(255) NOT NULL UNIQUE,
	`Geslo` VARCHAR(255) NOT NULL,
	`Aktiviran` BOOLEAN NOT NULL DEFAULT true, /** false - deaktiviran s strani administratorja, ne more se prijavit **/
	PRIMARY KEY (`id_prodajalec`)
);

CREATE TABLE `Stranka` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`Ime` VARCHAR(255) COLLATE utf8_slovenian_ci NOT NULL,
	`Priimek` VARCHAR(255) COLLATE utf8_slovenian_ci NOT NULL,
    `Enaslov` VARCHAR(255) NOT NULL UNIQUE,
	`Geslo` VARCHAR(255) NOT NULL,
	`Ulica` VARCHAR(255) COLLATE utf8_slovenian_ci NOT NULL,
	`Hisna_st` INT NOT NULL,
	`Posta` VARCHAR(255) COLLATE utf8_slovenian_ci NOT NULL,
	`Postna_st` INT NOT NULL,
	`Aktiviran` BOOLEAN NOT NULL DEFAULT true, /** false - deaktiviran s strani administratorja, ne more se prijavit **/
	PRIMARY KEY (`id`)
);

CREATE TABLE `Naročilo` (
	`id_naročilo` INT NOT NULL AUTO_INCREMENT,
	`Datum` DATETIME NOT NULL DEFAULT NOW(),
	`id_stranka` INT NOT NULL,
	`Status` varchar(255),
/**
         Status:
               - "n" neobdelano
               - "p" potrjeno
               - "x" preklicano
               - "s" stornirano
**/
	`Zaključeno` BOOLEAN NOT NULL DEFAULT false, /** se prestavi true ko stranka odda naročilo **/
	PRIMARY KEY (`id_naročilo`)
);

CREATE TABLE `Produkt` ( /** izdelki v trgovini **/
	`id` INT NOT NULL AUTO_INCREMENT,
	`Avtor` VARCHAR(255) NOT NULL,
	`Naslov` VARCHAR(255) NOT NULL,
	`Leto_izdaje` INT NOT NULL,
	`Cena` DECIMAL NOT NULL,
	`Aktiviran` BOOLEAN NOT NULL DEFAULT true, /** false - deaktiviran s strani administratorja, ne more se prijavit **/
	PRIMARY KEY (`id`)
);

CREATE TABLE `Produkt_košarica` (  /** izdelki v košarici **/
	`id_pk` INT NOT NULL AUTO_INCREMENT,
	`id` INT,
	`Količina` INT NOT NULL DEFAULT '1',
	PRIMARY KEY (`id_pk`)
);

CREATE TABLE `Košarica` (
	`id_košarica` INT NOT NULL AUTO_INCREMENT,
	`id_artikel` INT,
	`id_stranka` INT NOT NULL,
	PRIMARY KEY (`id_košarica`)
);

ALTER TABLE `Naročilo` ADD CONSTRAINT `Naročilo_fk0` FOREIGN KEY (`id_stranka`) REFERENCES `Stranka`(`id`);

ALTER TABLE `Produkt_košarica` ADD CONSTRAINT `Produkt_košarica_fk0` FOREIGN KEY (`id_pk`) REFERENCES `Produkt`(`id`);

ALTER TABLE `Košarica` ADD CONSTRAINT `Košarica_fk0` FOREIGN KEY (`id_artikel`) REFERENCES `Produkt_košarica`(`id_pk`);

ALTER TABLE `Košarica` ADD CONSTRAINT `Košarica_fk1` FOREIGN KEY (`id_stranka`) REFERENCES `Stranka`(`id`);



/** DODAJANJE ZAČETNIH PRODUKTOV V BAZO **/
INSERT INTO `Produkt` (`id`, `Avtor`,`Naslov`,`Leto_izdaje`,`Cena`)
VALUES (1, 'Matt Haig', 'The Midnight Library', 2021, 9.5),
(2, 'Taylor Jenkins Reid', 'The Seven Husbands of Evelyn Hugo', 2021, 10.5),
(3, 'Sally Rooney', 'Normal People', 2020, 14),
(4, 'Madeline Miller', 'Circe', 2019, 11.3 ),
(5, 'Kiley Reid', 'Such a Fun Age', 2020, 10.5);



