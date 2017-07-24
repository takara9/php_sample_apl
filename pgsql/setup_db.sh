#!/bin/bash

# パスワードは環境変数から与える
export PGPASSWORD=****************

# 方法１
#psql -h sl-us-south-1-portal.5.dblayer.com\
#     -p 18591\
#     -U admin\
#     -d compose\
#     -c '\i setup.sql;\q'

# 方法２
 psql "host=sl-us-south-1-portal.5.dblayer.com user=admin dbname=compose port=18591 sslmode=verify-ca sslrootcert=SSL_Certificates/cert.pem" -c '\i setup.sql;\q'


