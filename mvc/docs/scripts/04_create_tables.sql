use pmvc;
CREATE TABLE `pmvc`.`productos` (
  `codprd` BIGINT(18) NOT NULL AUTO_INCREMENT,
  `dscprd` VARCHAR(70) NOT NULL,
  `sdscprd` VARCHAR(255) NOT NULL,
  `ldscprd` TEXT NULL,
  `skuprd` VARCHAR(128) NOT NULL,
  `catprd` CHAR(3) NOT NULL,
  `prcprd` DECIMAL(12,2) NOT NULL,
  `urlprd` VARCHAR(255) NULL,
  `urlthbprd` VARCHAR(255) NULL,
  `estprd` CHAR(3) NOT NULL,
  PRIMARY KEY (`codprd`),
  UNIQUE INDEX `skuprd_UNIQUE`(`skuprd` ASC)); 

CREATE TABLE `pmvc`.`carretilla` (
  `usercod` BIGINT(10) NOT NULL,
  `codprd` BIGINT(18) NOT NULL,
  `crrctd` INT(5) NOT NULL,
  `crrprc` DECIMAL(12,2) NOT NULL,
  `crrfching` DATETIME NOT NULL,
  PRIMARY KEY (`usercod`, `codprd`),
  INDEX `codprd_idx` (`codprd` ASC),
  CONSTRAINT `carretilla_user_key`
    FOREIGN KEY (`usercod`)
    REFERENCES `pmvc`.`usuario` (`usercod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `carretilla_prd_key`
    FOREIGN KEY (`codprd`)
    REFERENCES `pmvc`.`productos` (`codprd`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE `pmvc`.`carretillaanon` (
  `anoncod` varchar(128) NOT NULL,
  `codprd` bigint(18) NOT NULL,
  `crrctd` int(5) NOT NULL,
  `crrprc` decimal(12,2) NOT NULL,
  `crrfching` datetime NOT NULL,
  PRIMARY KEY (`anoncod`,`codprd`),
  KEY `codprd_idx` (`codprd`),
  CONSTRAINT `carretillaanon_prd_key` FOREIGN KEY (`codprd`) REFERENCES `productos` (`codprd`) ON DELETE NO ACTION ON UPDATE NO ACTION
);


CREATE TABLE `factura` (
  `fctcod` bigint(18) NOT NULL AUTO_INCREMENT,
  `fctfch` datetime DEFAULT NULL,
  `userCode` bigint(18) unsigned DEFAULT NULL,
  `fctEst` char(3) DEFAULT NULL,
  `fctMonto` decimal(13,2) DEFAULT NULL,
  `fctShip` decimal(13,2) DEFAULT NULL,
  `fctTotal` decimal(13,2) DEFAULT NULL,
  `fctPayRef` varchar(255) DEFAULT NULL,
  `fctShpAddr` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`fctcod`)
) ENGINE=InnoDB;


CREATE TABLE `factura_detalle` (
  `fctcod` bigint(18) NOT NULL,
  `codprd` bigint(18) NOT NULL,
  `fctDsc` varchar(70) DEFAULT NULL,
  `fctCtd` int(5) DEFAULT NULL,
  `fctPrc` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`fctcod`,`codprd`)
) ENGINE=InnoDB;

CREATE TABLE `factura_forma_pago` (
  `fctcod` bigint(18) NOT NULL,
  `fctfrmpago` varchar(45) NOT NULL,
  `fctfrmdata` mediumtext,
  PRIMARY KEY (`fctcod`,`fctfrmpago`)
) ENGINE=InnoDB;

