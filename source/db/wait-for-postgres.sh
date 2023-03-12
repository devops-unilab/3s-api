#!/bin/bash
# wait-for-postgres.sh

set -e

host="$1"
#wait postgres up
until psql -h "$host" -U "postgres" -c '\q'; do
  echo "Postgres is unavailable - sleeping"
  sleep 10s
done

#wait populate script
while ! psql -h "$host" -U "postgres" -t -c "select 1" | egrep .
do
  sleep 10s
done
/postgres-db.sh