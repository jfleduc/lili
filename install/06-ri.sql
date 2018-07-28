/**
 * This script applies referential integrity (RI) to the database
 * by creating the foreign key.
 * 
 * Change the database name to your choice of name
 * before running this script.
 */

SET AUTOCOMMIT=0;
START TRANSACTION;

ALTER TABLE `lilidb`.`link` 
  ADD CONSTRAINT fk_link_category
      FOREIGN KEY                       (`category`) 
      REFERENCES    `lilidb`.`category` (`id`);

COMMIT;
