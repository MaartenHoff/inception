#!/bin/bash

# change Owner for the folder and all below
chown -R www-data:www-data /var/www/inception/

# move wp-config.php, if not already present (! -f)
if [ ! -f /var/www/inception/wp-config.php ]; then
	mv /tmp/wp-config.php /var/www/inception/
fi

# buffer, wait for mariaDB container (sql) until port 3306 is open
sleep 10

# with wp (WP-CLI) as root user inside the created inception folder,
# download the core of wordpress -> official php-files and folders
# if crash, just act like you didnt crash (|| true)
wp --allow-root --path="/var/www/inception/" core download || true

# after download -> installing. So if not installed, install (set tables in mariaDB)
if ! wp --allow-root --path="/var/www/inception/" core is-installed; then
	wp	--allow-root --path="/var/www/inception/" core install \
		--url=$WP_URL \
		--title=$WP_TITLE \
		--admin_user=$WP_ADMIN_USER \
		--admin_password=$WP_ADMIN_PASSWORD \
		--admin_email=$WP_ADMIN_EMAIL
fi

# check if user exists, if not create user
if ! wp --allow-root --path="/var/www/inception/" user get $WP_USER; then
	wp	--allow-root --path="/var/www/inception/" user create \
		$WP_USER \
		$WP_EMAIL \
		--user_pass=$WP_PASSWORD \
		--role=$WP_ROLE
fi

chown -R www-data:www-data /var/www/inception/*

# start php server (foreground)
exec $@