FROM php:7.4-fpm
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        librabbitmq-dev \
        libssh-dev \
#        supervisor \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo_mysql opcache bcmath sockets \
    && pecl install amqp \
    && docker-php-ext-enable amqp

#CMD [ "supervisorctl", "reread" ]
#CMD [ "supervisorctl", "update" ]
#CMD [ "supervisorctl", "start messenger-consume:*" ]