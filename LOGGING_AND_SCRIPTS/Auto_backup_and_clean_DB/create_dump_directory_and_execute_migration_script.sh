#!/bin/bash 

#if (( $EUID != 0 )); then
#    echo "Please run as root"
#    exit
#fi

echo "starting script"

if [ ! -d /home/$(whoami)/dumps ]
then 
  echo "creating dump folder"	  
mkdir -p /home/$(whoami)/dumps
else
  echo "dump folder exists"
fi

LOG_DIR=/home/$(whoami)/dumps

echo "dump folder is: " $LOG_DIR


mysqldump --defaults-extra-file=/home/$USERNAME/.mysql_login.cnf -u test --databases  test > $LOG_DIR/test_DB_backup_$(date +%d-%m-%Y:%H:%M:%S).sql 

RESULT=$?

if [ $RESULT -eq 0 ]
then 
echo executed with success
else 
echo operation failed
fi 

