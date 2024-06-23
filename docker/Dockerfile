# Estágio 1: Construção do aplicativo
FROM php:8.3-cli AS builder

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    libpq-dev \
    && docker-php-ext-install zip pdo_pgsql

COPY --from=composer/composer:latest-bin /composer /usr/bin/composer


COPY ./src/ /var/www

RUN if [ -f composer.json ]; then composer install --no-dev --optimize-autoloader; fi

# Estágio 2: Imagem final
FROM php:8.3-fpm-alpine

WORKDIR /var/www

# Instalar extensões necessárias
RUN apk add --no-cache postgresql-dev \
    && docker-php-ext-install pdo_pgsql

# Copiar arquivos do projeto do estágio de construção
COPY --from=builder /var/www /var/www

COPY --from=composer/composer:latest-bin /composer /usr/bin/composer
COPY ./docker/entrypoint.sh /entrypoint.sh


RUN if [ ! -d /var/www/storage ]; then mkdir -p /var/www/storage; fi \
    && chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage \
    && chmod +x /entrypoint.sh
# Expor a porta 9000
EXPOSE 9000

RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
CMD ["php-fpm"]
