<?php

/**
 * Please take care of array order !
 */
$updates = array();
$updates[1] = "CREATE TABLE  `phonetmall`.`cart` (
                        `id` INT NOT NULL ,
                        `account_id` INT NOT NULL ,
                        `closed` TINYINT NOT NULL DEFAULT  '0'
                        ) ENGINE = INNODB;";
$updates[2] = "ALTER TABLE  `cart` ADD INDEX (  `id` )";
$updates[3] = "ALTER TABLE  `cart` CHANGE  `id`  `id` INT( 11 ) NOT NULL AUTO_INCREMENT";
$updates[4] = "CREATE TABLE  `phonetmall`.`cart_items` (
                    `id` INT NOT NULL AUTO_INCREMENT ,
                    `cart_id` INT NOT NULL ,
                    `item_id` INT NOT NULL ,
                    `quantity` INT NOT NULL ,
                    PRIMARY KEY (  `id` )
                    ) ENGINE = INNODB;
                    ";
$updates[5] = "ALTER TABLE  `categories` CHANGE  `main_category`  `main_category` INT( 11 ) NULL DEFAULT  '0'";
$updates[6] = "ALTER TABLE  `items` ADD  `shipping_fees` DECIMAL( 11, 2 ) NOT NULL DEFAULT  '0' AFTER  `price`";

$updates[7] = "DROP TABLE `orders`";
$updates[8] = "CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
$updates[7] = "ALTER TABLE  `orders` ADD  `paied` TINYINT NOT NULL DEFAULT  '0' AFTER  `address`";
$updates[7] = "CREATE TABLE  `phonetmall`.`order_itemes` (
`id` INT NOT NULL AUTO_INCREMENT ,
`order_id` INT NOT NULL ,
`item_id` INT NOT NULL ,
`quantity` INT NOT NULL ,
`price` DECIMAL( 11, 2 ) NOT NULL ,
PRIMARY KEY (  `id` )
) ENGINE = INNODB;";
$updates[7] = "ALTER TABLE  `drop_requests` ADD  `datetime1` VARCHAR( 35 ) NOT NULL";



$updates[7] = "ALTER TABLE  `accounts` DROP  `mobile_verified`";
$updates[7] = "ALTER TABLE  `accounts` ADD  `admin` TINYINT( 1 ) NOT NULL DEFAULT  '0'";





$updates[7] = "CREATE TABLE  `phonetmall`.`shipping_cost` (
                `id` INT NOT NULL ,
                `from_city` INT NOT NULL ,
                `to_city` INT NOT NULL ,
                `first_kilo` DECIMAL( 11, 2 ) NOT NULL ,
                `extra_kilo` DECIMAL( 11, 2 ) NOT NULL
                ) ENGINE = INNODB;";
$updates[7] = "ALTER TABLE  `shipping_cost` ADD INDEX (  `id` )";
$updates[7] = "ALTER TABLE  `shipping_cost` CHANGE  `id`  `id` INT( 11 ) NOT NULL AUTO_INCREMENT";

$updates[7] = "ALTER TABLE  `items` ADD  `weight` INT NOT NULL DEFAULT  '1' AFTER  `price` ,
ADD  `quantity` INT NOT NULL DEFAULT  '1' AFTER  `weight`";


//Latest Updates
$updates[7] = "ALTER TABLE  `orders` ADD  `country` VARCHAR( 3 ) NOT NULL AFTER  `to_id` ,
ADD  `city_id` INT NOT NULL AFTER  `country`";

$updates[8] = "ALTER TABLE  `order_itemes` ADD  `country` VARCHAR( 3 ) NOT NULL AFTER  `id` ,
ADD  `city_id` INT NOT NULL AFTER  `country`";

$updates[9] = "ALTER TABLE  `order_itemes` ADD  `shipping_price` DECIMAL( 11, 2 ) NOT NULL DEFAULT  '0'
";


//updates 16-10-2012
$updates[10] = "CREATE TABLE  `phonetmall`.`ads` (
`id` INT NOT NULL AUTO_INCREMENT ,
`img1` VARCHAR( 255 ) NOT NULL ,
`url1` VARCHAR( 255 ) NOT NULL ,
`img2` VARCHAR( 255 ) NOT NULL ,
`url2` VARCHAR( 255 ) NOT NULL ,
`img3` VARCHAR( 255 ) NOT NULL ,
`url3` VARCHAR( 255 ) NOT NULL ,
PRIMARY KEY (  `id` )
) ENGINE = INNODB;";

$updates[11] = "ALTER TABLE  `items` ADD  `promoted` TINYINT( 1 ) NOT NULL DEFAULT  '0'";

$updates[12] = "ALTER TABLE  `items` ADD  `records` INT NOT NULL DEFAULT  '0' AFTER  `quantity`";

$updates[13] = "CREATE TABLE  `phonetmall`.`items_records` (
`id` INT NOT NULL AUTO_INCREMENT ,
`item_id` INT NOT NULL ,
`rec1` VARCHAR( 255 ) NOT NULL ,
`rec2` VARCHAR( 255 ) NOT NULL ,
PRIMARY KEY (  `id` )
) ENGINE = INNODB;";

$updates[14] = "ALTER TABLE  `items_records` ADD  `account_id` INT NOT NULL DEFAULT  '0'";
$updates[15] = "ALTER TABLE  `items_records` ADD  `order_id` INT NOT NULL";
$updates[]= "ALTER TABLE  `stores` ADD  `store_name` VARCHAR( 100 ) NOT NULL AFTER  `account_id`";

$updates[] = "ALTER TABLE  `stores` ADD  `promoted` TINYINT( 1 ) NOT NULL DEFAULT  '0'";
?>
