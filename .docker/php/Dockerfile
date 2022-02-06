FROM php:7.4-fpm-alpine

LABEL org.opencontainers.image.authors="Armando N. Junior <armandojrn@hotmail.com>"

WORKDIR /var/www

COPY . /var/www

RUN rm -rf /var/www/html

RUN ln -s public html

RUN apk add --no-cache shadow openssl vim bash mysql-client nodejs npm git $PHPIZE_DEPS
RUN docker-php-ext-install pdo pdo_mysql pcntl

RUN touch /home/www-data/.bashrc | echo "PS1='\w\$ '" >> /home/www-data/.bashrc

RUN pecl install -f xdebug \
&& echo "xdebug.mode=coverage, debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
&& docker-php-ext-enable xdebug

ENV DOCKERIZE_VERSION v0.6.1
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN usermod -u 1000 www-data

USER www-data

EXPOSE 9000 9003

#ENTRYPOINT ["php-fpm"]
