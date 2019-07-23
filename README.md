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
  - TODO Create, edit and delete users (both admins and mail users)
  - TODO Create invite tokens/links
  - TODO Create mail aliases
  - TODO Create blacklists for usernames
  - TODO Create muptiple mail domains

#### User features
  - TODO Change own password
  - TODO See account details
  - TODO Configure aliases

## Requirements
  - Webserver (e.g. NGINX or Apache)
  - PHP (version 7.2 or above)
  - Database (e.g. MariaDB, MySQL or PostgreSQL)
  - Postfix
  - Dovecot

## License
This project is licensed under the GNU General Public License Version 3 - see the LICENSE file for details.
