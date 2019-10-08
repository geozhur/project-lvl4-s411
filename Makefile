test:
	composer run phpunit

setup: env-prepare install key

install:
	composer install

analyse:
	php artisan code:analyse

lint:
	composer phpcs

fix-lint:
	composer phpcbf

run:
	php artisan serve

deploy:
	git push heroku master

env-prepare:
	cp -n .env.example .env || true

key:
	php artisan key:generate