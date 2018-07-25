/**
 * This script drops the database and the user from a previous install.
 * 
 * Only run this script for a reinstall.
 *
 * Change the database name and the user name to your choice of names
 * before running this script.
 */

DROP DATABASE IF EXISTS `lilidb`;
DROP USER               'liliuser'@'localhost';
