#!/bin/sh

# LAGOON_ENVIRONMENT_TYPE="TEST"

if [ -f "/app/artisan" ]; then
  /usr/local/bin/php artisan schedule:work
else
  echo "Laravel is not installed";
  sleep 10
fi
