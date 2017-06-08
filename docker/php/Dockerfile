FROM php:7.1-apache

# install software
RUN apt-get update && apt-get install -yq git vim zip libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql && \
    pecl install xdebug ds && \
    docker-php-ext-enable xdebug && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -o composer-setup.php https://getcomposer.org/installer && \
    curl -o composer-setup.sig https://composer.github.io/installer.sig && \
    php -r "if (hash('SHA384', file_get_contents('composer-setup.php')) !== trim(file_get_contents('composer-setup.sig'))) { unlink('composer-setup.php'); echo 'Invalid installer' . PHP_EOL; exit(1); }" && \
    php composer-setup.php --install-dir=/usr/bin/ --filename=composer && \
    php -r "unlink('composer-setup.php');" && \
    php -r "unlink('composer-setup.sig');"

COPY local.ini /usr/local/etc/php/conf.d/

WORKDIR /var/www/html
VOLUME /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]
