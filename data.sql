CREATE DATABASE IF NOT EXISTS `annaliumStatera`;
USE `annaliumStatera`;

CREATE TABLE IF NOT EXISTS `annaliumStatera_users` (
  `id` INT AUTO_INCREMENT
  , `login` VARCHAR(50)
  , `password` CHAR(60)
  ,PRIMARY KEY (`id`)
)
ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS `annaliumStatera_characters` (
  `id` INT AUTO_INCREMENT
  ,`lastName` VARCHAR(50)
  ,`firstName` VARCHAR(50)
  ,`age` INT
  ,`birthDate` VARCHAR(50)
  ,`astroSignId` INT
  ,`religionId` INT
  ,`casteId` INT
  ,`portraitLink` VARCHAR(150)
  ,`description` TEXT
  ,PRIMARY KEY (`id`)
)
ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS `annaliumStatera_astroSigns` (
  `id` INT AUTO_INCREMENT
  ,`astroSignName` VARCHAR(50)
  ,PRIMARY KEY (`id`)
)
ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS `annaliumStatera_religions` (
  `id` INT AUTO_INCREMENT
  ,`religionName` VARCHAR(50)
  ,`description` TEXT
  ,PRIMARY KEY (`id`)
)
ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS `annaliumStatera_castes` (
  `id` INT AUTO_INCREMENT
  ,`casteName` VARCHAR(50)
  ,`description` TEXT
  ,PRIMARY KEY (`id`)
)
ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS `annaliumStatera_pictures` (
  `id` INT AUTO_INCREMENT
  ,`pictureName` VARCHAR(50)
  ,`pictureLink` VARCHAR(150)
  ,`categoryId` INT
  ,`description` TEXT
  ,PRIMARY KEY (`id`)
)
ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS `annaliumStatera_categories` (
  `id` INT AUTO_INCREMENT
  ,`categoryName` VARCHAR(50)
  ,PRIMARY KEY (`id`)
)
ENGINE=INNODB;