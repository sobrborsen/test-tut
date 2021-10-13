USER := $$(id -u):$$(id -g)
IMAGE := test-tut

up:
	docker-compose up -d

down:
	docker-compose down --remove-orphans

image:
	docker-compose build

ps:
	docker-compose ps

logs:
	docker-compose logs -f

bash:
	docker-compose exec -u $(USER) $(IMAGE) bash

root-bash:
	docker-compose exec $(IMAGE) bash

test:
	docker-compose exec -u $(USER) $(IMAGE) vendor/bin/phpunit

coverage:
	docker-compose exec -u $(USER) $(IMAGE) vendor/bin/phpunit --coverage-text

coverage-report:
	docker-compose exec -u $(USER) $(IMAGE) vendor/bin/phpunit --coverage-html public/coverage

composer-install:
	docker-compose exec -u $(USER) $(IMAGE) composer install

npm-install:
	docker-compose exec -u $(USER) $(IMAGE) npm install

permissions:
	docker-compose exec -u $(USER) $(IMAGE) chmod -R 777 storage
