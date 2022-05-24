#!/usr/bin/env bash

# Get parameters when script is invoke
while [[ "$#" -gt 0 ]]; do
    case $1 in
        -d|--dir) dir="$2"; shift ;;
        -i|--install) option=1 ;;
	-u|--uninstall) option=2 ;;
	-r|--reinstall) option=3 ;;
	-h|--help) option=4 ;;
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

function _uninstall() {
	rm -rf 2THPlatform/
	rm -rf 2THApi/
	rm -rf api/
}

function _help() {
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


# Check if user has git
if ! command -v git &> /dev/null
then
	echo -e '\n-> Git is not installed';
else
	# Now check which function to execute
	case $option in
		# Use dir specified
		1) _install $dir;;
		2) _uninstall;;
		3) _uninstall; _install;;
		4) _help;;
	esac
fi
