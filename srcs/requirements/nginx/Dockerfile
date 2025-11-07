FROM alpine:3.18

# NGINX installieren
RUN apk update && apk add nginx

# Zertifikate  und konfig ins Image kopieren
COPY ssl /etc/nginx/ssl
COPY conf/nginx.conf /etc/nginx/http.d/

# NGINX Verzeichnis erstellen
RUN mkdir -p /var/www/html && \
    chown -R nginx:nginx /var/www/html

# Rechte setzen (sonst 403-Fehler)
RUN chmod 600 /etc/nginx/ssl/localhost.key && \
    chmod 644 /etc/nginx/ssl/localhost.crt

# Port freigeben
EXPOSE 443 80

# NGINX starten
CMD ["nginx", "-g", "daemon off;"]

# FROM debian:bullseye

# # update & install nginx and openssl (with no unnecessary packages) and clean apt cache
# RUN apt update && apt install -y --no-install-recommends --no-install-suggests \
#     nginx \
#     openssl && \
#     rm -rf /var/lib/apt/lists/*

# # listen to port 442
# EXPOSE 443

# # NGINX starten
# CMD ["nginx", "-g", "daemon off;"]