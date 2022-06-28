#no cache
#Header add Cache-Control "no-store, max-age=0"

# hide php errors
php_flag display_errors Off

# log php errors
php_flag log_errors On
php_value error_log /usr/www/alodiamarie/php_errors.log

# Send requests to /index.php
# RewriteEngine On
# RewriteCond %{REQUEST_FILENAME} !-d
# RewriteCond %{REQUEST_FILENAME} !-f
# RewriteRule ^(.*)$ index.php

# allow php access without extension
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME}\.php -f
RewriteRule ^(.*)$ $1.php [NC,L]

# remove php extension
# RewriteCond %{REQUEST_FILENAME} !-d
# RewriteCond %{REQUEST_FILENAME} -f

php_flag session.auto_start On
php_flag session.use_strict_mode 1
php_flag session.cookie_secure 1
