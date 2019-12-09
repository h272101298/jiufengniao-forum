#!/usr/bin/env bash

step=5 #间隔的秒数

for (( i = 0; i < 60; i=(i+step) )); do
    /use/bin/php /home/www/forum/artisan schedule:run
    sleep $step
done

exit 0
