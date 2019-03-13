#!/bin/bash

BASE_DIR=/var/www/html

php ${BASE_DIR}/bin/console doctrine:migrations:migrate --env=prod --no-interaction

php ${BASE_DIR}/bin/console assets:install --env=prod --no-interaction

php ${BASE_DIR}/bin/console cache:warmup --env=prod --no-interaction

apache2-foreground