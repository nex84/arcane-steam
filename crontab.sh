#!/bin/bash

echo "0 1,13 * * * root python -c 'import random; import time; time.sleep(random.random() * 3600)' && certbot renew --no-self-upgrade" > /etc/cron.d/lets_encrypt
echo "0 2,14 * * * root if [ -e /etc/letsencrypt/live/arcane-steam.com/fullchain.pem ] ; then aws s3 cp /etc/letsencrypt/live/arcane-steam.com/fullchain.pem s3://nex84-admin-s3/pki/arcane-steam.com.crt"  > /etc/cron.d/arcane-steam_pki_backup
echo "0 2,14 * * * root if [ -e /etc/letsencrypt/live/arcane-steam.com/fullchain.pem ] ; then aws s3 cp /etc/letsencrypt/live/arcane-steam.com/privkey.pem s3://nex84-admin-s3/pki/arcane-steam.com.key" >> /etc/cron.d/arcane-steam_pki_backup

#reload cron
#systemctl reload crond
service crond reload

#prepare let's encrypt checks
sudo mkdir -p /var/www/html/arcane-steam.com/mydaya/.well-known/acme-challenge/
sudo echo 'Yes' > /var/www/html/arcane-steam.com/mydaya/.well-known/acme-challenge/test
