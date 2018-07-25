/**
 * This script creates the tables.
 * 
 * Change the database name to your choice of name
 * before running this script.
 */

CREATE TABLE IF NOT EXISTS `lilidb`.`link` (
 `id`                       int          NOT NULL AUTO_INCREMENT, 
 `status`                   tinyint(1)   NOT NULL,
 `category`                 int          NOT NULL,
 `url`                      varchar(255) NOT NULL,
 `description`              varchar(255) NOT NULL,
  PRIMARY KEY              `pk_link`     (`id`),
  INDEX                    `ix_link_sta` (`status`),
  INDEX                    `ix_link_cat` (`category`),
  INDEX                    `ix_link_url` (`url`));

CREATE TABLE IF NOT EXISTS `lilidb`.`category` (
 `id`                       int          NOT NULL AUTO_INCREMENT, 
 `description`              varchar(255) NOT NULL,
  PRIMARY KEY              `pk_category` (`id`));

CREATE TABLE IF NOT EXISTS `lilidb`.`status` (
 `id`                       tinyint(1)   NOT NULL, 
 `description`              varchar(255) NOT NULL,
  PRIMARY KEY              `pk_status`   (`id`));
