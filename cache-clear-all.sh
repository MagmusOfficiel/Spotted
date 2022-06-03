# !/bin/bash

php bin/console cache:clear --env=prod
php bin/console cache:clear --env=dev
rm -R ./var/cache
rm -R ./var/log
php bin/console doctrine:cache:clear-metadata
php bin/console doctrine:cache:clear-query 
php bin/console doctrine:cache:clear-result       
