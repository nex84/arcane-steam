#!/bin/bash

if [ -e /etc/httpd/conf.d/arcane-steam.com.conf ] ;then
    rm -rf /etc/httpd/conf.d/arcane-steam.com.conf
fi
if [ -e /var/www/html/arcane-steam.com ] ;then
    rm -rf /var/www/html/arcane-steam.com
fi

mkdir -p /var/www/html/arcane-steam.com/www/
chown -R apache: /var/www/html/arcane-steam.com/
chmod -R 755 /var/www/html/arcane-steam.com/www/