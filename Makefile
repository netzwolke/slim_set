PHP = php
COMPOSER = composer.phar
CODE = code
RUN = docker-compose run --rm php_cli

install:
	$(RUN) $(PHP) $(COMPOSER) install

stage:
	make install
	ln $(CODE)/staging.php code/env -f
prod:
	make install
	ln $(CODE)/production.php code/env -f