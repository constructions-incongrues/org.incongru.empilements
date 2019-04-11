PROFILE := empilements.incongru.org
RSYNC_PARAMETERS=--dry-run

-include ./etc/$(PROFILE)/.env
export $(shell sed 's/=.*//' ./etc/$(PROFILE)/.env)

help: ## Affiche ce message d'aide
	@for MKFILE in $(MAKEFILE_LIST); do \
		grep -E '^[a-zA-Z0-9\._-]+:.*?## .*$$' $$MKFILE | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'; \
	done

attach: ## Connexion au container hébergeant les sources
	docker-compose run --rm --entrypoint fixuid --label traefik.enable=false php /bin/bash

build: ## Génération de l'image Docker
	git submodule update --init --recursive
	docker-compose build

clean: stop ## Suppression des containers de l'application
	docker-compose rm -f

deploy: ## Configure et déploie l'application
	PROFILE=$(PROFILE) docker-compose run --rm --entrypoint fixuid php make configure
	rsync -avzm $(RSYNC_PARAMETERS) --exclude-from=./etc/$(PROFILE)/rsync/exclude --include-from=./etc/$(PROFILE)/rsync/include -e "ssh -p $$RSYNC_SSH_PORT" "$$RSYNC_LOCAL_PATH" "$$RSYNC_REMOTE_USER@$$RSYNC_REMOTE_HOST:$$RSYNC_REMOTE_PATH"

db-export:
	docker-compose up -d db
	docker-compose exec db mysqldump -proot empilements | grep -v 'Warning: Using a password on the command line interface can be insecure.' > ./etc/empilements.sql

start: build ## Démarrage de l'application
	docker-compose up -d

stop: ## Arrêt de l'application
	docker-compose stop

purge: clean
	sudo rm -rf var/db