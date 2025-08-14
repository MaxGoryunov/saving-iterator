FROM php:8.1-cli

RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev libicu-dev libxml2-dev wget \
    && docker-php-ext-install zip intl \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-interaction --prefer-dist

ENV XDEBUG_MODE=coverage

CMD ["bash"]
