/**
 * This script inserts the required initial rows into the tables.
 * 
 * Run this script once only.
 *
 * Change the database name to your choice of name
 * before running this script.
 */

SET AUTOCOMMIT=0;
START TRANSACTION;

INSERT INTO `lilidb`.`category`           (`description`)
                                   VALUES ('Unclassified');

INSERT INTO `lilidb`.`status`             (`id`, `description`)
                                   VALUES (  1,  'Default');

COMMIT;
