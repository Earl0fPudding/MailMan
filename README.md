![MailMan](https://mailman.weidenauer.cc/images/MailMan_Logo.svg)

# MailMan
The simple and secure account managing application for your mailserver.

## Features
This web application can be used for mailservers running Postfix and Dovecot and a database with virtual mail users.

### Modes
You can run MailMan in two different modes:
1. Everyone can sign up and create a new mail account
            - Admins can create blacklists for usernames
2. Only people with an invite token/link can create an account
            - Admins can choose how long the invitation is valid
            - Admins can preset a username if wanted, otherwise the invitee can feel free to choose one themself

### User types
There are two types of users: the admin users and the mail users.

#### Admin features
  - Create, edit and delete users (both admins and mail users)
  - Create invite tokens/links
  - Create mail aliases
  - Create blacklists for usernames
  - Create muptiple mail domains

#### User features
  - Change own password
  - TODO See account details
  - TODO Configure aliases

## Requirements
  - Webserver (e.g. NGINX or Apache)
  - PHP (version 7.2 or above)
  - Database (e.g. MariaDB, MySQL or PostgreSQL)
  - Postfix
  - Dovecot

## Installation
### General
1. Clone this repository.
2. Set up a webserver with PHP7.2 or above and all the Laravel dependancies.
3. Configure the document root of the webserver to point to the ` public ` directory of this repository.
4. Install the Composer software and run ` composer update ` while being in the root directory of this repository.
5. Copy or rename the ` .env.example ` file to ` .env ` and edit the file to contain your correct database credentials, timezone and so on.
6. Run ` php artisan migrate:fresh ` to create the database structure.
7. Run ` php artisan db:seed ` to create a default admin user.

### Postfix
1. Copy the .cf files from the ` postfix ` directory from this repository into your local postfix configuration directory (e.g. `/etc/postfix/`)
2. Add the following lines to the `main.cf` file of your local Postfix config directory (assuming you are using MySQL or MariaDB):
```
virtual_mailbox_domains = mysql:/etc/postfix/mailman-domains.cf
virtual_mailbox_maps = mysql:/etc/postfix/mailman-users.cf
virtual_alias_maps = mysql:/etc/postfix/mailman-aliases.cf
```
3. Edit each of those three files so that they conatin the correct database credentials.
4. Restart or reload the Postfix service: e.g. ` postfix reload `

### Dovecot
Go to your Dovecot config directory on your system (e.g. ` /etc/dovecot/ `) and add the following lines to the ` dovecot-sql.conf.ext ` file:
```
driver = mysql
connect = host=127.0.0.1 dbname=dbname user=dbusername password=dbpassword
default_pass_scheme = SHA512-CRYPT
password_query = SELECT * FROM (SELECT CONCAT(u.username, '@', d.name) as user, password FROM users u JOIN domains d ON (u.domain_id=d.id)) x WHERE user='%u';
```
Don't forget to replace the placeholders in the line starting with ` connect ` with your correct database credentials.

## Default admin login credentials
Admin-login page: ` /admin `

Username: ` admin `

Password: ` admin `


Make sure to change the administrator password IMMEDEATELY after installation!


## License
This project is licensed under the GNU General Public License Version 3 - see the LICENSE file for details.
