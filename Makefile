test:
	composer run phpunit

setup: env-prepare install key

install:
	composer install
	npm install

lint:
	composer phpcs

lint-fix:
	composer phpcbf

run:
	php artisan serve

env-prepare:
	cp -n .env.example .env || true

key:
	php artisan key:generate
