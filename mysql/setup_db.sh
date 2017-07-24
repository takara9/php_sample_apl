#!/bin/bash

USERNM=************
PASSWD=******
DBNAME=ibmx_**********

mysql -u $USERNM -p$PASSWD\
      --host us-cdbr-sl-dfw-01.cleardb.net\
      --port 3306 --ssl-mode=REQUIRED\
      --batch -e "source setup.sql"\
      $DBNAME





