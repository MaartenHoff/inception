FROM nginx:alpine

# COPY not needed since its the index.html
# is copied via the volume in docker-compose.yml

#COPY index.html /usr/share/nginx/html/index.html
