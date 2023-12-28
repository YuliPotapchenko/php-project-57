start:
	php artisan serve --host 0.0.0.0

start-frontend:
	npm run dev

setup:
	composer install
	cp -n .env.example .env
	php artisan key:gen --ansi
	touch database/database.sqlite
	php artisan migrate
	php artisan db:seed
	npm ci
	npm run build
	make ide-helper

watch:
	npm run watch

migrate:
	php artisan migrate

console:
	php artisan tinker

log:
	tail -f storage/logs/laravel.log

test:
	php artisan test

test-coverage:
	XDEBUG_MODE=coverage php artisan test --coverage-clover build/logs/clover.xml

deploy:
	git push heroku

lint:
	composer exec phpcs -- --standard=PSR12 app routes tests

lint-fix:
	composer exec phpcbf -- --standard=PSR12 app routes tests

ide-helper:
	php artisan ide-helper:eloquent
	php artisan ide-helper:gen
	php artisan ide-helper:meta
	php artisan ide-helper:mod -n

sail-migrate-refresh-seed:
	./vendor/bin/sail artisan migrate:refresh --seed

sail-migrate-drop-database-fresh-seed:
	./vendor/bin/sail artisan migrate:fresh --seed

route-list:
	php artisan route:list

sail-ide-helper:
	./vendor/bin/sail artisan ide-helper:eloquent
	./vendor/bin/sail artisan ide-helper:gen
	./vendor/bin/sail artisan ide-helper:meta
	./vendor/bin/sail artisan ide-helper:mod -n

docker-setup-start-detached:
	./vendor/bin/sail up -d
