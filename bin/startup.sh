#!/bin/bash

# Set the initial pid ID number
pid=0

# Handler for the term signal we are listening for
term_handler() {
  if [[ ${pid} -ne 0 ]]; then
    kill -SIGTERM ${pid}
    wait ${pid}
  fi
  exit 143; # 128 + 15 -- SIGTERM
}

# Trap is used to catch any signal that is sent to the process by docker stop
trap 'kill ${!}; term_handler' SIGTERM

BASE_DIR=/var/www/html

php ${BASE_DIR}/bin/console cache:warmup --env=prod --no-interaction

php ${BASE_DIR}/bin/console doctrine:migrations:migrate --env=prod --no-interaction

php ${BASE_DIR}/bin/console assets:install --env=prod --no-interaction

# run the original php CMD to put the foreground apache in the background
apache2-foreground &

# Set the last running pid to be the one we got from the last run process
pid="$!"

# Keep looking at the /dev/null path until the process ends (wait)
while true
do
  wait ${!}
done