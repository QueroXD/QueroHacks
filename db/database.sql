DROP DATABASE IF EXISTS `querohacks`;
CREATE DATABASE IF NOT EXISTS `querohacks`;
USE `querohacks`;

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users`(
    `idUser` INT NOT NULL AUTO_INCREMENT,
    `mail` VARCHAR(40) NOT NULL UNIQUE,
    `username` VARCHAR(16) NOT NULL UNIQUE,
    `passHash`  Varchar(60) NOT NULL,
    `userFirstName` VARCHAR(60) NOT NULL,
    `userLastName` VARCHAR(120) NOT NULL,
    `creationDate` DATETIME NULL,
    `removeDat` DATETIME NULL,
    `lastSignIn` DATETIME NULL,
    `active` TINYINT(1) NULL,
    `activationDate` DATETIME NULL,
    `activationCode` CHAR(64) NULL,
    `resetPassExpiry` DATETIME NULL,
    `resetPassCode` CHAR (64) NULL,
    PRIMARY KEY (`idUser`)
);

