SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `VS_DB_SRS1`.`country`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `VS_DB_SRS1`.`country` ;

CREATE TABLE IF NOT EXISTS `VS_DB_SRS1`.`country` (
  `id_Country` INT NOT NULL AUTO_INCREMENT,
  `country_code` VARCHAR(5) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `code` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_Country`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `VS_DB_SRS1`.`clients`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `VS_DB_SRS1`.`clients` ;

CREATE TABLE IF NOT EXISTS `VS_DB_SRS1`.`clients` (
  `id_Client` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `status` VARCHAR(20) NOT NULL,
  `id_Country` INT NOT NULL,
  PRIMARY KEY (`id_Client`),
  INDEX `fk_vsdb_client_vsdb_country1_idx` (`id_Country` ASC),
  CONSTRAINT `fk_vsdb_client_vsdb_country1`
    FOREIGN KEY (`id_Country`)
    REFERENCES `VS_DB_SRS1`.`country` (`id_Country`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `VS_DB_SRS1`.`organizations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `VS_DB_SRS1`.`organizations` ;

CREATE TABLE IF NOT EXISTS `VS_DB_SRS1`.`organizations` (
  `id_Organization` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `status` VARCHAR(20) NOT NULL,
  `id_Country` INT NOT NULL,
  PRIMARY KEY (`id_Organization`),
  INDEX `fk_vsdb_organization_vsdb_country1_idx` (`id_Country` ASC),
  CONSTRAINT `fk_vsdb_organization_vsdb_country1`
    FOREIGN KEY (`id_Country`)
    REFERENCES `VS_DB_SRS1`.`country` (`id_Country`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `VS_DB_SRS1`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `VS_DB_SRS1`.`users` ;

CREATE TABLE IF NOT EXISTS `VS_DB_SRS1`.`users` (
  `idUser` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(15) NOT NULL,
  `password` VARCHAR(40) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE INDEX `Login_UNIQUE` (`login` ASC),
  UNIQUE INDEX `Password_UNIQUE` (`password` ASC),
  UNIQUE INDEX `Email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `VS_DB_SRS1`.`attachments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `VS_DB_SRS1`.`attachments` ;

CREATE TABLE IF NOT EXISTS `VS_DB_SRS1`.`attachments` (
  `id_Attachment` INT NOT NULL,
  `attachment` LONGBLOB NOT NULL,
  `description` VARCHAR(45) NULL,
  PRIMARY KEY (`id_Attachment`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `VS_DB_SRS1`.`vetting`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `VS_DB_SRS1`.`vetting` ;

CREATE TABLE IF NOT EXISTS `VS_DB_SRS1`.`vetting` (
  `id_Vetting` INT NOT NULL AUTO_INCREMENT,
  `date` DATE NOT NULL,
  `comments` VARCHAR(300) NULL,
  `id_Client` INT NOT NULL,
  `id_User` INT NOT NULL,
  PRIMARY KEY (`id_Vetting`),
  INDEX `fk_vsdb_vetting_vsdb_client1_idx` (`id_Client` ASC),
  INDEX `fk_vsdb_vetting_vsdb_user1_idx` (`id_User` ASC),
  CONSTRAINT `fk_vsdb_vetting_vsdb_client1`
    FOREIGN KEY (`id_Client`)
    REFERENCES `VS_DB_SRS1`.`clients` (`id_Client`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vsdb_vetting_vsdb_user1`
    FOREIGN KEY (`id_User`)
    REFERENCES `VS_DB_SRS1`.`users` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `VS_DB_SRS1`.`clientsXorganization`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `VS_DB_SRS1`.`clientsXorganization` ;

CREATE TABLE IF NOT EXISTS `VS_DB_SRS1`.`clientsXorganization` (
  `id_Client` INT NOT NULL,
  `id_Organization` INT NOT NULL,
  PRIMARY KEY (`id_Client`, `id_Organization`),
  INDEX `fk_vsdb_client_has_vsdb_organization_vsdb_organization1_idx` (`id_Organization` ASC),
  INDEX `fk_vsdb_client_has_vsdb_organization_vsdb_client1_idx` (`id_Client` ASC),
  CONSTRAINT `fk_vsdb_client_has_vsdb_organization_vsdb_client1`
    FOREIGN KEY (`id_Client`)
    REFERENCES `VS_DB_SRS1`.`clients` (`id_Client`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vsdb_client_has_vsdb_organization_vsdb_organization1`
    FOREIGN KEY (`id_Organization`)
    REFERENCES `VS_DB_SRS1`.`organizations` (`id_Organization`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `VS_DB_SRS1`.`attachmentsXvetting`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `VS_DB_SRS1`.`attachmentsXvetting` ;

CREATE TABLE IF NOT EXISTS `VS_DB_SRS1`.`attachmentsXvetting` (
  `id_Vetting` INT NOT NULL,
  `id_Attachment` INT NOT NULL,
  PRIMARY KEY (`id_Vetting`, `id_Attachment`),
  INDEX `fk_vsdb_vetting_has_vsdb_attachment_vsdb_attachment1_idx` (`id_Attachment` ASC),
  INDEX `fk_vsdb_vetting_has_vsdb_attachment_vsdb_vetting1_idx` (`id_Vetting` ASC),
  CONSTRAINT `fk_vsdb_vetting_has_vsdb_attachment_vsdb_vetting1`
    FOREIGN KEY (`id_Vetting`)
    REFERENCES `VS_DB_SRS1`.`vetting` (`id_Vetting`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vsdb_vetting_has_vsdb_attachment_vsdb_attachment1`
    FOREIGN KEY (`id_Attachment`)
    REFERENCES `VS_DB_SRS1`.`attachments` (`id_Attachment`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `VS_DB_SRS1`.`Regions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `VS_DB_SRS1`.`Regions` ;

CREATE TABLE IF NOT EXISTS `VS_DB_SRS1`.`Regions` (
  `id_Region` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_Region`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `VS_DB_SRS1`.`countryXregions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `VS_DB_SRS1`.`countryXregions` ;

CREATE TABLE IF NOT EXISTS `VS_DB_SRS1`.`countryXregions` (
  `country_id_Country` INT NOT NULL,
  `Regions_id_Region` INT NOT NULL,
  PRIMARY KEY (`country_id_Country`, `Regions_id_Region`),
  INDEX `fk_country_has_Regions_Regions1_idx` (`Regions_id_Region` ASC),
  INDEX `fk_country_has_Regions_country1_idx` (`country_id_Country` ASC),
  CONSTRAINT `fk_country_has_Regions_country1`
    FOREIGN KEY (`country_id_Country`)
    REFERENCES `VS_DB_SRS1`.`country` (`id_Country`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_country_has_Regions_Regions1`
    FOREIGN KEY (`Regions_id_Region`)
    REFERENCES `VS_DB_SRS1`.`Regions` (`id_Region`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
