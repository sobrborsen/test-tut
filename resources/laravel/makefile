
.env:
	cp .env.example .env
	php artisan key:generate

test: .env
	vendor/bin/phpunit

coverage: .env
	vendor/bin/phpunit --coverage-text

coverage-html: .env
	vendor/bin/phpunit --coverage-html build

serve: .env
	php artisan serve

testui: .env
	php -S localhost:8000 -t tests/ui

ui-coverage:
	tests/ui/bin/test.sh


