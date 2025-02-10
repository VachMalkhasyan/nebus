#!/bin/bash

# Wait for PostgreSQL to be ready
echo "Waiting for database..."
until nc -z -v -w30 db 5432
do
  echo "Waiting for PostgreSQL database connection..."
  sleep 5
done

# Run migrations and seeders
php artisan migrate --force
php artisan db:seed --force

# Start the PHP-FPM server
exec "$@"
