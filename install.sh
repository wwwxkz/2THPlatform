#!/usr/bin/env bash

# Dependencies
# - Git, Mysql, PHP

# Get parameters when script is invoke
while [[ "$#" -gt 0 ]]; do
    case $1 in
        -d|--dir) dir="$2"; shift ;;
        -i|--install) option=1 ;;
	-u|--uninstall) option=2 ;;
	-r|--reinstall) option=3 ;;
	-h|--help) option=4 ;;
	-c|--create) option=5 ;;
	-p|--perish) option=6 ;;
	-a|--add-users) option=7 ;;
	-s|--drop-users) option=8 ;;
        *) echo "\n-> Unknown parameter passed: $1"; exit 1 ;;
    esac
    shift
done

# Functions
function _install {
	cd $1
	git clone https://github.com/wwwxkz/2THPlatform.git
	git clone https://github.com/wwwxkz/2THApi.git
	mkdir api
	mv 2THApi/* api/
	rm -rf 2THApi/
	rm api/README.md
	rm 2THPlatform/README.md
	echo -e '\n-> Success'
}

function _uninstall {
	rm -rf 2THPlatform/
	rm -rf 2THApi/
	rm -rf api/
}

function _help {
	echo -e '\n-> Help';
	echo -e '\n- Install: -i or --install';
	echo '- Uninstall: -u or --uninstall';
	echo '- Reinstall: -r or --reinstall';
	echo '- Install dir: -d or --dir';
	echo -e '\n-> Usage:';
	echo -e '\n- ./install.sh -i';
	echo '- ./install.sh -i -d /var/www/folder/';
	echo -e '\n->Notes:';
	echo -e '\n- If installed with -d, the remove and uninstall will not properly work';
}

function _create_db {
	sudo mysql -u root -Bse 'CREATE DATABASE company; USE company; CREATE TABLE users (id int NOT NULL AUTO_INCREMENT PRIMARY KEY,user varchar(16),theme varchar(8),type varchar(8),password varchar(64));CREATE TABLE reports (id int NOT NULL AUTO_INCREMENT PRIMARY KEY,mac varchar(12),name varchar(64),telephone varchar(32),tag varchar(32),locations json,relation varchar(32),model varchar(32),manufacturer varchar(32),downloaded int,uploaded int);'
	echo -e '\n-> Database created'
}

function _drop_db {
	sudo mysql -u root -Bse 'DROP DATABASE company;'
	echo -e '\n-> Database perished'
}

function _add_users {
	sudo mysql -u root -Bse "CREATE USER 'read'@'%' IDENTIFIED BY '123';GRANT SELECT ON company.* TO 'read'@'%';FLUSH PRIVILEGES;CREATEUSER 'login'@'%' IDENTIFIED BY '123';GRANT SELECT ON company.* TO 'login'@'%';FLUSH PRIVILEGES;CREATE USER 'connector'@'%' IDENTIFIED BY '123';GRANT SELECT ON company.* TO 'connector'@'%';FLUSH PRIVILEGES;"
	echo -e '\n-> Users added'
	echo -e '- Remember that this script is a shortcut, users have pratically total acess to your database'
}

function _drop_users {
	sudo mysql -u root -Bse "DROP USER 'read'; DROP USER 'connector'; DROP USER 'login';"
}


# Check if user has git
if ! command -v git &> /dev/null
then
	echo -e '\n-> Git is not installed'
else
	# Now check which function to execute
	case $option in
		# Use dir specified
		1) _install $dir;;
		2) _uninstall;;
		3) _uninstall; _install;;
		4) _help;;
		5) _create_db;;
		6) _drop_db;;
		7) _add_users;;
		8) _drop_users;;
	esac
fi
