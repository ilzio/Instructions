#!/bin/bash 

/usr/bin/mysqldump --defaults-extra-file=/home/$USERNAME/.mysql_login.cnf  -u test --databases  test > /home/$USERNAME/Desktop/test_DB_backup_$(date +%d-%m-%Y_%H-%M-%S).sql
 
