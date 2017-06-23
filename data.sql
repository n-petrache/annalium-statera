USE `annaliumStatera`;
CREATE TABLE `annaliumStatera_users` (
  `id` INT AUTO_INCREMENT
  , `login` VARCHAR(50)
  , `password` CHAR(60)
  ,PRIMARY KEY (`id`)
)
ENGINE=INNODB;
CREATE TABLE `annaliumStatera_characters` (
  `id` INT AUTO_INCREMENT
  ,`lastName` VARCHAR(50)
  ,`firstName` VARCHAR(50)
  ,`age` INT
  ,`birthDate` VARCHAR(50)
  ,`astroSign` VARCHAR(50)
  ,`religionId` INT
  ,`casteId` INT
  ,`pictureLink` VARCHAR(50)
  ,`description` VARCHAR(50)
  ,PRIMARY KEY (`id`)
)
ENGINE=INNODB;
CREATE TABLE `annaliumStatera_religions` (
  `id` INT AUTO_INCREMENT
  ,PRIMARY KEY (`id`)
)
ENGINE=INNODB;
CREATE TABLE `annaliumStatera_castes` (
  `id` INT AUTO_INCREMENT
  ,PRIMARY KEY (`id`)
)
ENGINE=INNODB;