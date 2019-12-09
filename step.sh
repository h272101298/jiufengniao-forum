#!/usr/bin/env bash

while true; do
  SCRIPT   /use/bin/php /home/www/forum/artisan schedule:run
  sleep 5
done
