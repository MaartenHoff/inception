NAME	= inception
SRCS	= ./srcs
COMPOSE	= ./srcs/docker-compose.yml
HOST_URL= maahoff.42.fr

up:
	mkdir -p ~/inception_data/db_files
	mkdir -p ~/inception_data/wp_files
	sudo hostsed add 127.0.0.1 $(HOST_URL)
	docker compose -p $(NAME) -f $(COMPOSE) up --build -d

down:
	sudo hostsed rm 127.0.0.1 $(HOST_URL)
	docker compose -p $(NAME) down

.PHONY: up down