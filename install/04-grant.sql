/**
 * This script grants limited privileges to the application's database user.
 * 
 * Change the user name and the database name to your choice of names
 * before running this script.
 */

GRANT SELECT ON `lilidb`.* TO 'liliuser'@'localhost';
