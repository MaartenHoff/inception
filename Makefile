NAME	= inception
SRCS	= ./srcs
COMPOSE	= ./srcs/docker-compose.yml
HOST_URL= maahoff.42.fr

up:
	mkdir -p ~/data/db_files
	mkdir -p ~/data/wp_files
	sudo hostsed add 127.0.0.1 $(HOST_URL)
	docker compose -p $(NAME) -f $(COMPOSE) up --build -d

down:
	sudo hostsed rm 127.0.0.1 $(HOST_URL)
	docker compose -p $(NAME) down

clean:
	sudo rm -rf ~/data/db_files/*
	sudo rm -rf ~/data/wp_files/*

fclean: clean
	docker compose -p $(NAME) down --rmi all

all: up

.PHONY: up down
