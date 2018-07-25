# lili

## Installation

### 1. Build LAMP Stack

Install Debian or Ubuntu Linux, Apache, MySQL, and PHP 7 on your server.

### 2. Download the application

Create and change into a directory where you are going to save your downloads. Download the application archive. For example:

```
mkdir ~/Downloads
cd ~/Downloads
wget https://github.com/jfleduc/lili/archive/master.zip
```

Unzip the compressed archive:

```
sudo apt-get install unzip
unzip master.zip
```

This creates a directory `lili-master`.

### 2. Edit the database scripts

The `install` directory contains MySQL scripts as follows:

|Script            |Function                                     |
|------------------|---------------------------------------------|
|`00-drop.sql`     |Drop database and user (for reinstall only)  |
|`01-database.sql` |Create the database                          |
|`02-table.sql`    |Create the table                             |
|`03-user.sql`     |Create the application MySQL user            |
|`04-grant.sql`    |Grant access to the application MySQL user   |
|`05-insert.sql`   |Insert initial rows                          |
|`06-ri.sql`       |Add foreign key for referential integrity    |

Make changes for your choice of database name, MySQL user name, and
MySQL user password.

### 3. Create the database

Create the database, the tables, the user, and the user privileges:

```
cd ~/Downloads/lili-master
mysql -u root -p
source install/01-database.sql
source install/02-table.sql
source install/03-user.sql
source install/04-grant.sql
```

Continuing in the MySQL shell, insert the initial rows into the database:

```
source install/05-insert.sql
```

Now that the initial row has been inserted, you can turn on referential integrity (RI) by adding the foreign key constraints:

```
source install/06-ri.sql 
exit
```

### 4. Configure application

Edit the application configuration constants:

```
sudo vi protected/config.php
```

Put the same database user name name and password in `protected/config.php` as you chose for the username and password in the install scripts.
 
### 5. Copy the application to your web server

Copy the application materials to your web root directory, 
and the protected materials above your web root.

```
sudo cp -rf html/* /var/www/html/
sudo cp -rf protected /var/www/
```
