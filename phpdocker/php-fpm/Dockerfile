FROM php:8.1-fpm
WORKDIR "/app"
RUN docker-php-ext-enable opcache
RUN apt-get update \
  && apt-get install -y --no-install-recommends libpq-dev \
  && docker-php-ext-install mysqli pdo_mysql