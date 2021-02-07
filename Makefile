PHP = php
COMPOSER = composer.phar
RUN = docker-compose run --rm php_cli

install:
	$(RUN) $(PHP) $(COMPOSER) install

stage:
	make install
	ln code/staging.php code/env -f
prod:
	make install
	ln code/production.php code/env -f