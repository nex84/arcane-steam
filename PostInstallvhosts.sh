#!/bin/bash

sudo chmod 755 /var/log/httpd/
sudo chmod o+r /var/log/httpd/*

sudo service httpd restart
