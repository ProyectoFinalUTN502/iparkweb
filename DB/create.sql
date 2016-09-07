SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `central_dev` ;
CREATE SCHEMA IF NOT EXISTS `central_dev` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `central_dev` ;

-- -----------------------------------------------------
-- Table `central_dev`.`rol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `central_dev`.`rol` ;

CREATE TABLE IF NOT EXISTS `central_dev`.`rol` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `isActive` INT NOT NULL DEFAULT 1,
  `creationDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastUpdate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `central_dev`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `central_dev`.`user` ;

CREATE TABLE IF NOT EXISTS `central_dev`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `loginCount` INT NOT NULL DEFAULT 0,
  `name` VARCHAR(255) NOT NULL,
  `lastName` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `isActive` INT NOT NULL DEFAULT 1,
  `creationDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastUpdate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastLogin` DATETIME NULL,
  `lastIp` VARCHAR(255) NULL,
  `rol_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_user_rol_idx` (`rol_id` ASC),
  CONSTRAINT `fk_user_rol`
    FOREIGN KEY (`rol_id`)
    REFERENCES `central_dev`.`rol` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `central_dev`.`country`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `central_dev`.`country` ;

CREATE TABLE IF NOT EXISTS `central_dev`.`country` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `central_dev`.`province`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `central_dev`.`province` ;

CREATE TABLE IF NOT EXISTS `central_dev`.`province` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(255) NOT NULL,
  `country_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_province_country1_idx` (`country_id` ASC),
  CONSTRAINT `fk_province_country1`
    FOREIGN KEY (`country_id`)
    REFERENCES `central_dev`.`country` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `central_dev`.`state`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `central_dev`.`state` ;

CREATE TABLE IF NOT EXISTS `central_dev`.`state` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(255) NOT NULL,
  `province_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_state_province1_idx` (`province_id` ASC),
  CONSTRAINT `fk_state_province1`
    FOREIGN KEY (`province_id`)
    REFERENCES `central_dev`.`province` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `central_dev`.`city`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `central_dev`.`city` ;

CREATE TABLE IF NOT EXISTS `central_dev`.`city` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(255) NOT NULL,
  `state_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_city_state1_idx` (`state_id` ASC),
  CONSTRAINT `fk_city_state1`
    FOREIGN KEY (`state_id`)
    REFERENCES `central_dev`.`state` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `central_dev`.`parkinglot`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `central_dev`.`parkinglot` ;

CREATE TABLE IF NOT EXISTS `central_dev`.`parkinglot` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ssid` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `description` VARCHAR(255) NULL,
  `address` VARCHAR(255) NOT NULL,
  `isActive` INT NOT NULL DEFAULT 1,
  `isCovered` INT NOT NULL DEFAULT 0,
  `latMap` DOUBLE NOT NULL,
  `longMap` DOUBLE NOT NULL,
  `openTime` TIME NOT NULL,
  `closeTime` TIME NOT NULL,
  `creationDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastUpdate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` INT NOT NULL,
  `city_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_parkinglot_user1_idx` (`user_id` ASC),
  INDEX `fk_parkinglot_city1_idx` (`city_id` ASC),
  CONSTRAINT `fk_parkinglot_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `central_dev`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_parkinglot_city1`
    FOREIGN KEY (`city_id`)
    REFERENCES `central_dev`.`city` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `central_dev`.`layout`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `central_dev`.`layout` ;

CREATE TABLE IF NOT EXISTS `central_dev`.`layout` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `floor` INT NOT NULL,
  `maxRows` INT NOT NULL,
  `maxCols` INT NOT NULL,
  `parkinglot_id` INT NOT NULL,
  INDEX `fk_layout_parkinglot1_idx` (`parkinglot_id` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_layout_parkinglot1`
    FOREIGN KEY (`parkinglot_id`)
    REFERENCES `central_dev`.`parkinglot` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `central_dev`.`vehicle_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `central_dev`.`vehicle_type` ;

CREATE TABLE IF NOT EXISTS `central_dev`.`vehicle_type` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `color` VARCHAR(255) NOT NULL,
  `isActive` INT NOT NULL DEFAULT 1,
  `creationDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `central_dev`.`price`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `central_dev`.`price` ;

CREATE TABLE IF NOT EXISTS `central_dev`.`price` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `parkinglot_id` INT NOT NULL,
  `vehicle_type_id` INT NOT NULL,
  `price` DOUBLE NOT NULL,
  `isActive` INT NOT NULL DEFAULT 1,
  `creationDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX `fk_price_parkinglot1_idx` (`parkinglot_id` ASC),
  PRIMARY KEY (`id`),
  INDEX `fk_price_vehicle_type1_idx` (`vehicle_type_id` ASC),
  CONSTRAINT `fk_price_parkinglot1`
    FOREIGN KEY (`parkinglot_id`)
    REFERENCES `central_dev`.`parkinglot` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_price_vehicle_type1`
    FOREIGN KEY (`vehicle_type_id`)
    REFERENCES `central_dev`.`vehicle_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `central_dev`.`client`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `central_dev`.`client` ;

CREATE TABLE IF NOT EXISTS `central_dev`.`client` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `token` VARCHAR(255) NOT NULL,
  `macAddress` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `lastName` VARCHAR(255) NOT NULL,
  `isActive` INT NOT NULL DEFAULT 1,
  `creationDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastUpdate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `central_dev`.`param`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `central_dev`.`param` ;

CREATE TABLE IF NOT EXISTS `central_dev`.`param` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `keyParam` VARCHAR(255) NOT NULL,
  `valueParam` VARCHAR(255) NOT NULL,
  `keyText` VARCHAR(255) NOT NULL,
  `valueText` VARCHAR(255) NOT NULL,
  `creationDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `central_dev`.`layout_position`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `central_dev`.`layout_position` ;

CREATE TABLE IF NOT EXISTS `central_dev`.`layout_position` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `xPoint` INT NOT NULL,
  `yPoint` INT NOT NULL,
  `valid` INT NOT NULL DEFAULT 1,
  `circulationValue` INT NOT NULL DEFAULT 0,
  `state` VARCHAR(255) NOT NULL,
  `layout_id` INT NOT NULL,
  `vehicle_type_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_floor_layout_layout1_idx` (`layout_id` ASC),
  INDEX `fk_floor_layout_vehicle_type1_idx` (`vehicle_type_id` ASC),
  CONSTRAINT `fk_floor_layout_layout1`
    FOREIGN KEY (`layout_id`)
    REFERENCES `central_dev`.`layout` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_floor_layout_vehicle_type1`
    FOREIGN KEY (`vehicle_type_id`)
    REFERENCES `central_dev`.`vehicle_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `central_dev`.`vehicle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `central_dev`.`vehicle` ;

CREATE TABLE IF NOT EXISTS `central_dev`.`vehicle` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `currentVehicle` INT NOT NULL DEFAULT 0,
  `creationDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActive` INT NOT NULL DEFAULT 1,
  `client_id` INT NOT NULL,
  `vehicle_type_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_vehicle_client1_idx` (`client_id` ASC),
  INDEX `fk_vehicle_vehicle_type1_idx` (`vehicle_type_id` ASC),
  CONSTRAINT `fk_vehicle_client1`
    FOREIGN KEY (`client_id`)
    REFERENCES `central_dev`.`client` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vehicle_vehicle_type1`
    FOREIGN KEY (`vehicle_type_id`)
    REFERENCES `central_dev`.`vehicle_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `central_dev`.`vehicle_parking`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `central_dev`.`vehicle_parking` ;

CREATE TABLE IF NOT EXISTS `central_dev`.`vehicle_parking` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `creationDate` DATETIME NOT NULL,
  `vehicle_id` INT NOT NULL,
  `layout_position_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_client_parking_vehicle1_idx` (`vehicle_id` ASC),
  INDEX `fk_vehicle_parking_floor_layout1_idx` (`layout_position_id` ASC),
  CONSTRAINT `fk_client_parking_vehicle1`
    FOREIGN KEY (`vehicle_id`)
    REFERENCES `central_dev`.`vehicle` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vehicle_parking_floor_layout1`
    FOREIGN KEY (`layout_position_id`)
    REFERENCES `central_dev`.`layout_position` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `central_dev`.`client_profile`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `central_dev`.`client_profile` ;

CREATE TABLE IF NOT EXISTS `central_dev`.`client_profile` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `range` INT NULL,
  `maxPrice` DOUBLE NULL,
  `is24` INT NOT NULL DEFAULT 0,
  `isCovered` INT NOT NULL DEFAULT 0,
  `creationDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `client_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_client_profile_client1_idx` (`client_id` ASC),
  CONSTRAINT `fk_client_profile_client1`
    FOREIGN KEY (`client_id`)
    REFERENCES `central_dev`.`client` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `central_dev`.`bug_state`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `central_dev`.`bug_state` ;

CREATE TABLE IF NOT EXISTS `central_dev`.`bug_state` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `central_dev`.`bug`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `central_dev`.`bug` ;

CREATE TABLE IF NOT EXISTS `central_dev`.`bug` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` TEXT NOT NULL,
  `response` TEXT NULL,
  `creationDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` INT NULL,
  `bug_state_id` INT NOT NULL,
  `client_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_bug_user1_idx` (`user_id` ASC),
  INDEX `fk_bug_bug_state1_idx` (`bug_state_id` ASC),
  INDEX `fk_bug_client1_idx` (`client_id` ASC),
  CONSTRAINT `fk_bug_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `central_dev`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bug_bug_state1`
    FOREIGN KEY (`bug_state_id`)
    REFERENCES `central_dev`.`bug_state` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bug_client1`
    FOREIGN KEY (`client_id`)
    REFERENCES `central_dev`.`client` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `central_dev`.`group`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `central_dev`.`group` ;

CREATE TABLE IF NOT EXISTS `central_dev`.`group` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `text` VARCHAR(255) NULL,
  `description` VARCHAR(255) NULL,
  `style` VARCHAR(255) NULL,
  `ref` VARCHAR(255) NULL,
  `create` INT NOT NULL DEFAULT 1,
  `delete` INT NOT NULL DEFAULT 1,
  `update` INT NOT NULL DEFAULT 1,
  `list` INT NOT NULL DEFAULT 1,
  `search` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `central_dev`.`permission`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `central_dev`.`permission` ;

CREATE TABLE IF NOT EXISTS `central_dev`.`permission` (
  `rol_id` INT NOT NULL,
  `group_id` INT NOT NULL,
  INDEX `fk_rol_group_group1_idx` (`group_id` ASC),
  INDEX `fk_rol_group_rol1_idx` (`rol_id` ASC),
  PRIMARY KEY (`rol_id`, `group_id`),
  CONSTRAINT `fk_rol_group_rol1`
    FOREIGN KEY (`rol_id`)
    REFERENCES `central_dev`.`rol` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rol_group_group1`
    FOREIGN KEY (`group_id`)
    REFERENCES `central_dev`.`group` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `central_dev`.`real_time_position`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `central_dev`.`real_time_position` ;

CREATE TABLE IF NOT EXISTS `central_dev`.`real_time_position` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `xPoint` INT NOT NULL,
  `yPoint` INT NOT NULL,
  `client_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_real_time_position_client1_idx` (`client_id` ASC),
  CONSTRAINT `fk_real_time_position_client1`
    FOREIGN KEY (`client_id`)
    REFERENCES `central_dev`.`client` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
