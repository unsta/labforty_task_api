ROOT_FOLDERS=app/Http/Controllers app/Http/Services app/Http/Repositories app/Http/Requests app/Http/Exceptions

pipeline: fixer linter phpmd phpstan-clear-cache phpstan

fixer:
	./vendor/bin/phpcbf --standard=PSR12 $(ROOT_FOLDERS) || true

linter:
	./vendor/bin/phpcs --standard=PSR12 $(ROOT_FOLDERS)

phpmd:
	./vendor/bin/phpmd $(ROOT_FOLDERS) ansi phpmd-ruleset.xml

phpstan-clear-cache:
	./vendor/bin/phpstan clear-result-cache

phpstan:
	./vendor/bin/phpstan analyse --memory-limit=1G
