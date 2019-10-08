install:
	composer install

lint:
	composer run-script phpcs --

lint-fix:
	composer run-script phpcbf --

test:
	phpunit

run:
	php artishan serve