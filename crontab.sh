#!/bin/bash

echo "0 1,13 * * * root python -c 'import random; import time; time.sleep(random.random() * 3600)' && certbot renew --no-self-upgrade" > /etc/cron.d/lets_encrypt

#reload cron
#systemctl reload crond
service crond reload

#prepare let's encrypt checks
sudo mkdir -p /var/www/html/arcane-steam.com/mydaya/.well-known/acme-challenge/
sudo echo 'Yes' > /var/www/html/arcane-steam.com/mydaya/.well-known/acme-challenge/test
