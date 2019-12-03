#!/usr/bin/env bash
step=10 #间隔的秒时间

for (( i = 0; i < 60; i=(i + step )); do
    /use/local/php/bin/php home/www/forum/artisan schedule:run

    sleep $setp
done

exit 0
