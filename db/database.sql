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
    `creationDate` DATETIME NOT NULL,
    `removeDat` DATETIME NOT NULL,
    `lastSignIn` DATETIME NOT NULL,
    `active` TINYINT(1) NOT NULL,
    PRIMARY KEY (`idUser`)
);