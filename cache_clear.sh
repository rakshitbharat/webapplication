#!/usr/bin/env bash

echo "Clearing caches"
chmod -R 777 public/
chmod -R 777 storage/
composer dump-autoload
./artisan doctrine:clear:metadata:cache
./artisan doctrine:clear:query:cache
./artisan doctrine:clear:result:cache
./artisan auth:clear-resets
./artisan config:clear
./artisan route:clear
./artisan view:clear
./artisan clear-compiled
