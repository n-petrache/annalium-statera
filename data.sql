CREATE DATABASE IF NOT EXISTS `annaliumStatera`;
USE `annaliumStatera`;

CREATE TABLE IF NOT EXISTS `annaliumStatera_users` (
  `id` INT AUTO_INCREMENT
  ,`login` VARCHAR(50)
  ,`password` CHAR(60)
  ,`groupId` INT
  ,PRIMARY KEY (`id`)
)
ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS `annaliumStatera_usersGroups` (
  `id` INT AUTO_INCREMENT
  ,`name` VARCHAR(50)
  ,PRIMARY KEY (`id`)
)
ENGINE=INNODB;


CREATE TABLE IF NOT EXISTS `annaliumStatera_characters` (
  `id` INT AUTO_INCREMENT
  ,`lastName` VARCHAR(50)
  ,`firstName` VARCHAR(50)
  ,`age` INT
  ,`birthday` VARCHAR(50)
  ,`astroSignId` INT
  ,`religionId` INT
  ,`casteId` INT
  ,`portraitFile` VARCHAR(150)
  ,`description` TEXT
  ,PRIMARY KEY (`id`)
)
ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS `annaliumStatera_astroSigns` (
  `id` INT AUTO_INCREMENT
  ,`name` VARCHAR(50)
  ,PRIMARY KEY (`id`)
)
ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS `annaliumStatera_religions` (
  `id` INT AUTO_INCREMENT
  ,`name` VARCHAR(50)
  ,`description` TEXT
  ,PRIMARY KEY (`id`)
)
ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS `annaliumStatera_castes` (
  `id` INT AUTO_INCREMENT
  ,`name` VARCHAR(50)
  ,`description` TEXT
  ,PRIMARY KEY (`id`)
)
ENGINE=INNODB;


CREATE TABLE IF NOT EXISTS `annaliumStatera_pictures` (
  `id` INT AUTO_INCREMENT
  ,`name` VARCHAR(50)
  ,`fileName` VARCHAR(150)
  ,`categoryId` INT
  ,`description` TEXT
  ,PRIMARY KEY (`id`)
)
ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS `annaliumStatera_categories` (
  `id` INT AUTO_INCREMENT
  ,`name` VARCHAR(50)
  ,PRIMARY KEY (`id`)
)
ENGINE=INNODB;