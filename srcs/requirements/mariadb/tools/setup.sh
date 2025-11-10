#!/bin/bash

# FIX: Change ownership of the data directory and socket folder to the mysql user 
chown -R mysql:mysql /var/lib/mysql
mkdir -p /run/mysqld
chown -R mysql:mysql /run/mysqld

echo "ownership given"

if [ ! -d /var/lib/mysql/mysql ]; then
    echo "Database not found. Initializing..."
    
    # 'mariadb-install-db' erstellt die Basis-Datenbankstruktur
    mariadb-install-db --user=mysql --datadir=/var/lib/mysql
    
    echo "Database initialized."
else
    echo "Database already exists. Skipping initialization."
fi

service mariadb start

sleep 3

echo "Executing SQL commands..."

# creates the database with users and their passwords + permissions
# -v (verbose, share more info), -u root (start in root) = start shell
# '@'% (@ everyone), '$DB_USER'@'%' User that can connect to any host
# IDENTIFIED BY (set password for user)
mariadb -v -u root << EOF
CREATE DATABASE IF NOT EXISTS $DB_NAME;
CREATE USER IF NOT EXISTS '$DB_USER'@'%' IDENTIFIED BY '$DB_PASSWORD';
GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER'@'%' IDENTIFIED BY '$DB_PASSWORD';
GRANT ALL PRIVILEGES ON $DB_NAME.* TO 'root'@'%' IDENTIFIED BY '$DB_PASS_ROOT';
SET PASSWORD FOR 'root'@'localhost' = PASSWORD('$DB_PASS_ROOT');
EOF

# stop the server (sleep to prevent errors right before stopping the server, 
# 		since script might be faster then running the commands)
sleep 1
service mariadb stop
echo "Setup complete. Starting server in foreground."

# restart the server
exec $@