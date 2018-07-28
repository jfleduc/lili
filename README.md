# lili

## Installation

### 1. Build LAMP Stack

Install Debian "Stretch" Linux 9, Apache 2, MySQL 8, and PHP 7 on your server.

Open firewall for HTTP input on port 80:

```
sudo iptables -A INPUT -p tcp --dport 80 -j ACCEPT
sudo dpkg-reconfigure iptables-persistent
```

Install Apache version 2.4:

```
sudo apt-get install apache2
```

Note that MySQL is no longer included with Debian 9. You can install MySQL 8.0 from the MySQL APT repositories as follows:

```
mkdir ~/Downloads
cd ~/Downloads
wget https://dev.mysql.com/get/mysql-apt-config_0.8.10-1_all.deb
sudo dpkg -i mysql-apt-config_0.8.10-1_all.deb
sudo apt-get update
sudo apt-get install mysql-server mysql-client
```

During the install, you are prompted to enter a root password twice.

For safety, select the legacy authentication method (compatible with MySQL 5.0 and up).

Then secure your MySQL installation:

```
sudo mysql_secure_installation
```

For further documentation on installing MySQL from the MySQL APT repositories, see
[https://dev.mysql.com/downloads/repo/apt/](https://dev.mysql.com/downloads/repo/apt/).

Install PHP 7.0:

```
sudo apt-get install php7.0 libapache2-mod-php7.0 php7.0-mysql
```

Add `index.php` as a valid directory index name in `etc/apache2/apache2.conf`:

```
DirectoryIndex index.php index.html
```
 
Restart Apache:

```
sudo systemctl restart apache2
```

### 2. Download the application

Get the application archive from Github:

```
wget https://github.com/jfleduc/lili/archive/master.zip
```

If you do not already have the `unzip` package on your serveri, install it now:

```
sudo apt-get install unzip
```

Unzip the compressed archive:

```
unzip master.zip
```

This creates a directory `lili-master`.

### 3. Edit the database scripts

The `lili-master/install` directory contains MySQL scripts as follows:

|Script            |Function                                     |
|------------------|---------------------------------------------|
|`00-drop.sql`     |Drop database and user (for reinstall only)  |
|`01-database.sql` |Create the database                          |
|`02-table.sql`    |Create the table                             |
|`03-user.sql`     |Create the application MySQL user            |
|`04-grant.sql`    |Grant access to the application MySQL user   |
|`05-insert.sql`   |Insert initial rows                          |
|`06-ri.sql`       |Add foreign key for referential integrity    |

Edit these files for your choice of database name, MySQL user name, and
MySQL user password.

### 4. Create the database, tables, and database user

Start a MySQL shell:

```
cd ~/Downloads/lili-master
mysql -u root -p
```

Only if you are doing a reinstall, drop the database and user you created during the previous run:

```
source install/00-drop.sql
```

Create the database, the tables, the user, and the user privileges:

```
source install/01-database.sql
source install/02-table.sql
source install/03-user.sql
source install/04-grant.sql
```

Continuing in the MySQL shell, insert the initial rows into the database:

```
source install/05-insert.sql
```

Turn on referential integrity (RI) by adding the foreign key constraints:

```
source install/06-ri.sql 
exit
```

### 5. Copy the application to your web server

Remove any existing files from the web root:

```
sudo rm -rf /var/www/html/*.*
```

Copy the application materials to your web root directory:

```
sudo cp -rf html/* /var/www/html/
```

Copy the protected materials above your web root, where they cannot be directly accessed by the website visitor:

```
sudo cp -rf protected /var/www/
```

### 6. Configure application

Edit the application configuration constants:

```
vi protected/config.php
```

Put the same database name, database user name, and database user password in `/var/www/protected/config.php` as you chose for the user name and password in the install scripts.

### 7. Varnish (Optional)

Install and configure Varnish in front of Apache:

1. Configure Apache to listen on localhost (`127.0.0.1`) port `8080` by editing `/etc/apache2/ports.conf` and `/etc/apache2/sites-enabled/000-default.conf`
2. Restart Apache with `sudo systemctl restart apache2`
3. Install Varnish with `sudo apt-get install varnish`
4. Configure Varnish to listen on port `80` instead of the default `6081` by editing `/lib/systemd/system/varnish.service`. You can also change the default memory allocation (`malloc`) in this file.
5. Make sure that Varnish is configured to use Apache as `backend default` on host `127.0.0.1` port `8080` in the configuration file `/etc/varnish/default.vcl`. The default time to live (TTL) in the cache is `2m` (two minutes). You can change this with, e.g., `sub vcl_backend_response {set beresp.ttl = 5m;}`.
6. Restart Varnish with `sudo systemctl daemon-reload` and `sudo systemctl restart varnish`
7. Get statistics of cache hits vs. misses with, for example, `sudo varnishstat -1 | grep cache`.

## Adding Categories

You can add categories manually via MySQL. For example:

```
INSERT INTO `lilidb`.`category` (`description`) VALUES ('Technology');
```


## Adding Links

You can add links manually via MySQL. For example:

```
INSERT INTO `lilidb`.`link` (`category`, `url`, `description`) VALUES (2, 'http://msydqstlz2kzerdg.onion', 'Ahmia searches hidden services on the Tor network.');
```
