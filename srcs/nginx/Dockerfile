FROM alpine:3.18

# NGINX installieren
RUN apk update && apk add nginx

# Konfiguration kopieren
COPY nginx.conf /etc/nginx/http.d/default.conf

# NGINX Verzeichnis erstellen
RUN mkdir -p /var/www/html && \
    chown -R nginx:nginx /var/www/html

# Port freigeben
EXPOSE 80

# NGINX starten
CMD ["nginx", "-g", "daemon off;"]