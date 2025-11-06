FROM debian:bullseye

# update & install mariadb server (with no unnecessary packages) and clean apt cache
RUN	apt update && \
	apt install -y --no-install-recommends --no-install-suggests \
	mariadb-server && \
	rm -r -f /var/lib/apt/lists/*

# copy conf file into container
COPY conf/db.cnf /etc/mysql/mariadb.conf.d/

# copy setup script into container and give permission
COPY 	tools/setup.sh /bin/
RUN		chmod +x /bin/setup.sh

EXPOSE 3306

# execute script ("setup.sh") and start database server ("mysqld_safe")
CMD	["setup.sh", "mysqld_safe"]