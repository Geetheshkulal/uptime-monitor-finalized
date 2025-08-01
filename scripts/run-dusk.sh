#!/bin/bash

# Navigate to Laravel project root (one level up from this script's folder)
cd /var/www/vhosts/drishtipulse.in/httpdocs || exit

echo "[`date`] Shell script started" >> storage/logs/dusk-output.log

# Run Dusk with no TTY mode and log output
/var/www/vhosts/drishtipulse.in/.phpenv/shims/php artisan dusk tests/Browser/WhatsAppLoginTest.php >> storage/logs/dusk-output.log 2>&1
