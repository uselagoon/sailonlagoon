#!/bin/sh

if [ -f "/app/config/horizon.php" ]; then
  COUNT=`ps ax | grep horizon:work | grep -v grep | wc -l`

  if [ $COUNT -gt 0 ]; then
	echo Horizon is running
  else
	echo Horizon is not running
  fi
else
  echo "[Status] - Horizon is not installed";
  sleep 10
fi
