#!/bin/bash

sudo chmod 755 /var/log/httpd/
sudo chmod o+r /var/log/httpd/*

sudo service httpd restart

certbot --apache -d arcane-steam.com -d www.arcane-steam.com -m schwartzmann.a@gmail.com --no-eff-email --agree-tos --keep --expand --no-redirect --no-self-upgrade -n -q --logs-dir /var/log/letsencrypt/arcane-steam_com
