#!/bin/sh
echo "{\"comando\":\"Inicio do script\"}"
set -e
echo "{\"comando\":\"Antes do Seed\"}"
export COMMAND="true"
echo "{\"comando\":\"Comando antes do export COMMAND\"}"
php -i > /dev/null
sleep 1;
chown -Rf www-data:www-data /testelaravel && chown -Rf www-data /var/lib/nginx/
echo "{\"comando\":\"${@}\"}"
$@
wait
sleep 60
