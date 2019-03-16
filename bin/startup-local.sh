#!/bin/bash

BASE_DIR=/var/www/html

php ${BASE_DIR}/bin/console --env=dev cache:warmup --no-interaction

php ${BASE_DIR}/bin/console --env=dev doctrine:migrations:migrate --no-interaction

php ${BASE_DIR}/bin/console --env=dev assets:install --symlink --no-interaction

apache2-foreground