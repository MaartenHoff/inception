FROM debian:bullseye

# var for the path to php-fpm
ARG	PHPPATH=/etc/php/7.4/fpm

# update & install a lot (with no unnecessary packages) and clean apt cache
RUN	apt update && apt install -y --no-install-recommends --no-install-suggests \
	ca-certificates \
	php7.4-fpm \
	php7.4-mysql \
	wget \
	tar && \
	rm -rf /var/lib/apt/lists/*

# after installing php, its running -> stopping it to modify the file
RUN	service php7.4-fpm stop

# change settings in php (sed -i -> search and replace): 
# no guessing, only accept exact filenames, 
RUN	sed -i 's/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/g' ${PHPPATH}/php.ini

# install wp-cli (WordPress Command-Line Interface), give permissions, move and rename (wp)
RUN wget --no-check-certificate https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && \
	chmod +x wp-cli.phar && \
	mv wp-cli.phar /usr/local/bin/wp

RUN mkdir -p /run/php/ && \
	mkdir -p /var/run/php/ && \
	mkdir -p /var/www/inception/ 

# copy www.conf, wp-config.php and setup.sh into the container
COPY	conf/www.conf ${PHPPATH}/pool.d/
COPY	conf/wp-config.php /tmp/
COPY	tools/setup.sh /bin/

# make setup.sh executable
RUN		chmod +x /bin/setup.sh

EXPOSE 9000

# exec setup.sh and start php server
# ; if php-fpm daemonizes, PID 1 stops and setup.sh would stop -> daemonize = no
CMD	["setup.sh", "php-fpm7.4", "--nodaemonize"]
