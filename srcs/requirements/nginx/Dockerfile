FROM debian:bullseye

# temp var move to .env later
ARG SSL_PATH=/etc/nginx/ssl
ARG SSL_CERT=${SSL_PATH}/inception.crt
ARG SSL_KEY=${SSL_PATH}/inception.key
ARG	COUNTRY=DE
ARG	STATE=BE
ARG	LOCALITY=Berlin
ARG	ORGANIZATION=42
ARG	UNIT=42
ARG	COMMON_NAME=maahoff.42.fr

# update & install nginx and openssl (with no unnecessary packages) and clean apt cache
RUN apt update && apt install -y --no-install-recommends --no-install-suggests \
	nginx \
	openssl && \
	rm -rf /var/lib/apt/lists/*

# create keys and certificate in the ssl folder
# openssl req(start tool), -newkey rsa:4096(new key with type 4096), -x509(self signed)
# 		-sha256(signing algo), -days 365(valid time), -nodes(no extra password
# -subj(set certifacate infos)
RUN mkdir -p ${SSL_PATH} && \
	openssl req -newkey rsa:4096 -x509 -sha256 -days 365 -nodes \
	-out ${SSL_CERT} \
	-keyout ${SSL_KEY} \
	-subj "/C=${COUNTRY}/ST=${STATE}/L=${LOCALITY}/O=${ORGANIZATION}/OU=${UNIT}/CN=${COMMON_NAME}"

# copy conf files into the container
COPY	conf/nginx.conf		/etc/nginx/
COPY	conf/default.conf	/etc/nginx/conf.d/

# make sure /var/www/ already exits and than change owner to www-data (nignx-process)
RUN	mkdir -p /var/www/
RUN	chown -R www-data:www-data /var/www/

# listen to port 442
EXPOSE 443

# NGINX starten
CMD ["nginx", "-g", "daemon off;"]