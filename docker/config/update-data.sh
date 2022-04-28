#!/bin/sh
set -eo pipefail

if [ $IS_CRON_SERVER == 1 ]
then
    until nc -z -v -w30 $MYSQL_HOST $MYSQL_PORT_NUMBER
    do
      echo "Waiting for database connection..."
      sleep 5
    done
    php -dmemory_limit=-1 $WORKDIR/artisan migrate
    crond -f -l 8
fi
