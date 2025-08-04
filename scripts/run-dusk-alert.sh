#!/bin/bash

PHP_PATH=$1

# If not Windows, navigate to Laravel project root
if [[ "$OS" != "Windows_NT" ]]; then
    # Navigate to Laravel project root (one level up from this script's folder)
    cd "$(dirname "$0")/.." || exit
    echo "[`date`] Shell script started" >> storage/logs/dusk-output.log
fi


# Run Dusk with no TTY mode and log output
$PHP_PATH artisan dusk tests/Browser/WhatsAppBotTest.php >> storage/logs/dusk-output.log 2>&1
