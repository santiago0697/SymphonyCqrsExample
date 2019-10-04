#!/bin/bash
php /var/www/vendor/bin/ppm start --host=0.0.0.0 --port=8200 --workers=3 --bootstrap=symfony --bridge=HttpKernel --app-env=dev --debug=0 --logging=0
