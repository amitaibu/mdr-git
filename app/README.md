# Medical records, with Git backend.

## Start Server

    php -S localhost:8080 -t public -c custom-php.ini

Or on a device, as in production

    APP_ENV=prod APP_DEBUG=0 php -S localhost:8080 -t public -c custom-php.ini

Navigate to http://localhost:8000

## Install for Local Dev

    composer install
    yarn install

## Install on Termux

First install [Termux](https://termux.com/), start it and enter the following commands:

    # Install Git & PHP
    pkg install git
    pkg install

    # Clone repo
    git@github.com:amitaibu/mdr-git.git
    cd mdr-git/app

    # Download composer, as per instructions from https://getcomposer.org/download/
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'baf1608c33254d00611ac1705c1d9958c817a1a33bce370c0595974b342601bd80b92a3f46067da89e3b06bff421f182') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"

    # Install packages
    php composer.phar install    
        

## Console Commands

Example to show using Console commands.

    php bin/console app:get-group-meeting-list

## Development of Assets

Execute the following while developing CSS & JS

    yarn encore dev --watch
    
When ready to publish, minify assets, and commit built files

    yarn encore production

