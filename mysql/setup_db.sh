#!/bin/bash

PASSWD=***************

mysql -u admin -p$PASSWD\
      --host sl-us-south-1-portal.4.dblayer.com\
      --port 18594 --ssl-mode=REQUIRED \
      --batch -e "source setup.sql"



