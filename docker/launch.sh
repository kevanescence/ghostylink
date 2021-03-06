#!/bin/bash

scripts_dir="$(dirname "$0")"

source "$scripts_dir/db.sh"


sed -ri -e "s/^upload_max_filesize.*/upload_max_filesize = ${PHP_UPLOAD_MAX_FILESIZE}/" \
-e "s/^post_max_size.*/post_max_size = ${PHP_POST_MAX_SIZE}/" /etc/php5/apache2/php.ini

ghostylinkDir="/var/www/html/"

echo  "######################################################################"
echo  "##############     Ghostylink database initialization    #############"
echo  "######################################################################"

if ! db_volume_exist; then
    echo -e "\t=> An empty or uninitialized MySQL volume is detected in $VOLUME_HOME\n"
    echo -e "\t=> Installing MySQL ...\n"
    mysql_install_db > /dev/null 2>&1
    echo -e "\t=> Done!\n"    
    db_wait_until_ready
    db_create  "$ghostylinkDir"
    db_upgrade "$ghostylinkDir"
else
    db_wait_until_ready
    echo -e "\t=> Using an existing volume of MySQL"
    expectedVersion=$(db_get_expected_version "$ghostylinkDir")
    currentVersion=$(db_get_version "$ghostylinkDir")
    
    if db_version_is_before "$currentVersion" "$expectedVersion"; then
        echo -e "\t\t=> Upgrading from migration $currentVersion to $expectedVersion"
        db_upgrade "$ghostylinkDir"
    elif db_version_is_after "$currentVersion" "$expectedVersion"; then
        # TODO : ask confirmation before downgrading
        echo -e "\t\t=> Downgrading from migration $currentVersion to $expectedVersion"
        db_downgrade "$ghostylinkDir"
    fi
fi

mysqladmin -uroot shutdown

echo  "######################################################################"
echo  "##############   Ghostylink cron jobs initialization     #############"
echo  "######################################################################"
$ghostylinkDir/docker/init_crons.sh

exec supervisord -n
