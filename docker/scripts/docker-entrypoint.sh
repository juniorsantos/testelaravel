#!/bin/sh
set -e

if [ -z ${1+x} ]; then
  export PROGRAM="app"
else
  export PROGRAM=$1
fi

# Para Projeto novo
# cd /src
# composer create-project laravel/laravel testelaravel

mkdir -p /src/testelaravel/storage/logs

touch /src/testelaravel/storage/logs/laravel.log && echo "." >> /src/testelaravel/storage/logs/laravel.log

chown -Rf www-data:www-data /src && chown -Rf www-data:www-data /var/lib/nginx

if [ "$APP_STAGE" == "dev" ] ; then
    cd /src/testelaravel
    composer clearcache
    composer install --no-interaction --optimize-autoloader ;
else
    cd /src/testelaravel
    composer install --no-dev --no-interaction --optimize-autoloader ;
fi

exec supervisord -c /etc/supervisord/supervisord.conf -e error
