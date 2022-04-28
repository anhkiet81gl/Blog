#!/bin/bash
set -euo pipefail
echo 'create network'

docker network rm canawanbuild || true
docker network create -d bridge --subnet 192.168.12.0/24 --gateway 192.168.12.1 canawanbuild || true

echo 'start mariadb, import database dump'
docker stop mariadb || true
docker container rm mariadb || true

docker pull mariadb:10.2

docker run --name=mariadb -d \
  --network canawanbuild   \
  --health-cmd='mysqladmin ping --silent' \
  -e MYSQL_ALLOW_EMPTY_PASSWORD=yes \
  -e MYSQL_USER=admin \
  -e MYSQL_PASSWORD=8mGib4vFCRoqnaVZYX \
  -e MYSQL_DATABASE=laravel \
  mariadb:10.2
sleep 1

until [ "`docker inspect -f '{{.State.Health.Status}}' mariadb`" == "healthy" ];
do
  echo "waiting for mariadb container..."
  sleep 1
done

echo 'build docker images'
export DOCKER_BUILDKIT=0
docker build . -t $CI_REGISTRY_IMAGE -f Dockerfile --network=canawanbuild --tag $CI_REGISTRY_IMAGE:$BRANCH_NAME --no-cache
echo 'cleanup'

docker stop mariadb
docker container rm mariadb
docker network rm canawanbuild
