#!/bin/sh

# LAGOON_ENVIRONMENT_TYPE="TEST"

if [ -f "/app/config/horizon.php" ]; then
  /usr/local/bin/php artisan horizon
else
  echo "Horizon is not installed";
  sleep 10
fi
