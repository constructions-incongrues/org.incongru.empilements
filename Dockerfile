# Base images
FROM composer:1 as composer
FROM php:7.3-cli-alpine

# Set working directory
WORKDIR /usr/local/src

# Install Composer
COPY --from=composer /usr/bin/composer /usr/local/bin/composer

# Installation et configuration de fixuid
# https://github.com/boxboat/fixuid
RUN addgroup --gid 1000 empilements && \
    adduser --uid 1000 --ingroup empilements --home /home/empilements --shell /bin/sh --disabled-password --gecos "" empilements && \
    curl -SsL https://github.com/boxboat/fixuid/releases/download/v0.4/fixuid-0.4-linux-amd64.tar.gz | tar -C /usr/local/bin -xzf - && \
    chown root:root /usr/local/bin/fixuid && \
    chmod 4755 /usr/local/bin/fixuid && \
    mkdir -p /etc/fixuid && \
    printf "user: empilements\ngroup: empilements\n" > /etc/fixuid/config.yml

# Install additional packages and PHP extensions
RUN apk --update --no-cache add bash curl gettext git libpng-dev make zip && \
    docker-php-ext-install -j$(nproc) gd opcache pdo_mysql

# Copy application sources to container
COPY --chown=empilements:empilements ./src /usr/local/src

RUN composer install

USER empilements:empilements
