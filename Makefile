COMPOSE_FILE := docker-compose.yml
PROFILE := empilements.incongru.org
RSYNC_PARAMETERS=--dry-run
COMPOSE_SERVICE=php

-include ./etc/$(PROFILE)/.env
export $(shell sed 's/=.*//' ./etc/$(PROFILE)/.env)

help: ## Affiche ce message d'aide
	@for MKFILE in $(MAKEFILE_LIST); do \
		grep -E '^[a-zA-Z0-9\._-]+:.*?## .*$$' $$MKFILE | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'; \
	done

attach: ## Connexion au container hébergeant les sources
	docker-compose -f $(COMPOSE_FILE) run --rm --entrypoint "fixuid /bin/sh" --user `id -u`:`id -g` --label traefik.enable=false $(COMPOSE_SERVICE)

build: ## Génération de l'image Docker
	docker-compose -f $(COMPOSE_FILE) build

clean: stop ## Suppression des containers de l'application
	docker-compose -f $(COMPOSE_FILE) rm -f

deploy: ## Configure et déploie l'application
	PROFILE=$(PROFILE) docker-compose -f $(COMPOSE_FILE) run --user `id -u`:`id -g` --rm --entrypoint fixuid php make configure
	rsync -avzm $(RSYNC_PARAMETERS) --exclude-from=./etc/$(PROFILE)/rsync/exclude --include-from=./etc/$(PROFILE)/rsync/include -e "ssh -p $$RSYNC_SSH_PORT" "$$RSYNC_LOCAL_PATH" "$$RSYNC_REMOTE_USER@$$RSYNC_REMOTE_HOST:$$RSYNC_REMOTE_PATH"

db-export:
	docker-compose -f $(COMPOSE_FILE) up -d db
	docker-compose -f $(COMPOSE_FILE) exec db mysqldump -proot empilements | grep -v 'Warning: Using a password on the command line interface can be insecure.' > ./etc/empilements.sql

start: build ## Démarrage de l'application
	docker-compose -f $(COMPOSE_FILE) up -d

stop: ## Arrêt de l'application
	docker-compose -f $(COMPOSE_FILE) stop

purge: clean
	sudo rm -rf var/db
