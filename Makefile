install:
	composer install

lint:
	composer run-script phpcs --

lint-fix:
	composer run-script phpcbf --

test:
	vendor/bin/phpunit

run:
	php -S localhost:8000 -t public

logs:
	tail -f storage/logs/lumen.log