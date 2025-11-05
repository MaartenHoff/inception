FROM alpine:3.18

# NGINX installieren
RUN apk update && apk add nginx

# Zertifikate  und konfig ins Image kopieren
COPY ssl /etc/nginx/ssl
COPY nginx.conf /etc/nginx/http.d/

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