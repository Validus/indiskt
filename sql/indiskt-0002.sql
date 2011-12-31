ALTER TABLE  `order` CHANGE  `person`  `person` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL;
ALTER TABLE  `order` CHANGE  `paid_to`  `paid_to` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_swedish_ci NULL DEFAULT NULL;
ALTER TABLE  `order` ADD  `paysonref` VARCHAR( 20 ) NULL DEFAULT NULL;

