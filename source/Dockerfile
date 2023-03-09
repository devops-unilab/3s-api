# Dockerfile for 3S
#
# Maintainer: Erivando Sena <erivandoramos@unilab.edu.br>
#
# Description: Este Dockerfile cria uma imagem para 3s, um aplicativo da Web escrito em PHP.
#
# Build instructions:
#   cd source/
#   docker build -t dti-registro.unilab.edu.br/unilab/app-3s:latest --build-arg 'VERSION=1.0.0 COMMIT_SHA=$(git rev-parse --short HEAD)' .
#   docker push dti-registro.unilab.edu.br/unilab/app-3s:latest
#
# Usage:
#
#   docker run -it --rm -d -p 8088:80 -v /tmp:/var/www/public/uploads --name 3s dti-registro.unilab.edu.br/unilab/app-3s:latest
#   docker logs -f --tail --until=2s 3s
#   docker exec -it 3s bash
#
# Dependencies: php:7.4-apache-bullseye
#
# Environment variables:
#
#   COMMIT_SHA: o hash SHA-1 de um determinado commit do Git.
#   VERSION: usado na tag de imagem ou como parte dos metadados da mesma.
#
# Notes:
#
# - Este Dockerfile assume que o código do aplicativo está localizado no diretório atual
# - O aplicativo pode ser acessado em um navegador da Web em https://3s.unilab.edu.br/
#
# Version: 1.0

FROM composer:2.4 as build
COPY . /app/
RUN composer install --prefer-dist --no-dev --optimize-autoloader --no-interaction

# FROM php:8.1-apache-buster as dev
FROM php:8.1-apache-bullseye as dev

ENV APP_ENV=dev
ENV APP_DEBUG=true
ENV COMPOSER_ALLOW_SUPERUSER=1

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && apt-get install -y --no-install-recommends \
    ca-certificates \
    apt-transport-https \
    software-properties-common \
    libfreetype6 \
    procps \
    p7zip-full \
    libpq-dev \
    libldap-common \
    postgresql-client \
    openssh-client \
    openssh-server \
    git \
    nfs-common \
    tini \
    apt-utils \
    nano \
    curl \
    gnupg \
    sudo \
    gpg \
    wget \
    coreutils \
    make \
    telnet \
    iproute2 \
    net-tools \
    iputils-ping \
    lsb-release \
    locales \
    rsync \
    stress \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    jpegoptim \
    optipng \
    pngquant \
    gifsicle \
    zip \
    libzip-dev \
    unzip \
    libonig-dev \
  && rm -rf /var/lib/apt/lists/*

RUN apt-get dist-upgrade -y && \
  apt-get upgrade -y && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
  apt-get autoremove -y

RUN rm -f /lib/systemd/system/multi-user.target.wants/* \
  /etc/systemd/system/*.wants/* \
  /lib/systemd/system/local-fs.target.wants/* \
  /lib/systemd/system/sockets.target.wants/*udev* \
  /lib/systemd/system/sockets.target.wants/*initctl* \
  /lib/systemd/system/sysinit.target.wants/systemd-tmpfiles-setup* \
  /lib/systemd/system/systemd-update-utmp*

ARG COMMIT_SHA
ARG VERSION
ENV TZ America/Fortaleza
ENV LANG pt_BR.UTF-8 
ENV LC_CTYPE pt_BR.UTF-8 
ENV LC_ALL C
ENV LANGUAGE pt_BR:pt:en
RUN locale-gen pt_BR.UTF-8 
RUN dpkg-reconfigure locales tzdata -f noninteractive

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
# ENV APACHE_LOG_DIR /var/log/apache2
# ENV APACHE_RUN_DIR /var/www

# Setup user
RUN useradd -m -s /bin/bash 3s
RUN usermod -aG sudo 3s && echo "3s ALL=(ALL) NOPASSWD: ALL" > /etc/sudoers.d/3s
RUN echo "3s ALL=(ALL) NOPASSWD:ALL" >> /etc/sudoers

# Setup ssh
RUN sed -i "s/#Port 22/Port 37389/g" /etc/ssh/sshd_config
RUN sed -i "s/#PasswordAuthentication yes/PasswordAuthentication no/g" /etc/ssh/sshd_config
RUN [ -f ~/.ssh/id_rsa ] || ssh-keygen -t rsa -b 4096 -C "3s@noreply.unilab.edu.br" -f ~/.ssh/id_rsa -q -N "" && chmod -R 600 ~/.ssh
RUN /etc/init.d/ssh start

RUN mkdir -p /var/www/html/public/uploads/ocorrencia/anexo

RUN apt-get update && apt-get install -y zip libpq-dev

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

COPY . /var/www/html/
COPY --from=build /usr/bin/composer /usr/bin/composer
RUN composer install --prefer-dist --no-interaction

COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY .env.dev /var/www/html/.env

RUN php artisan config:cache && \
    php artisan route:cache && \
    chmod 777 -R /var/www/html/storage/ && \
    chown -R www-data:www-data /var/www/ && \
    a2enmod rewrite

# FROM php:8.1-apache-bullseye as production
FROM dev as production

ENV APP_ENV=production
ENV APP_DEBUG=false

RUN apt-get update && apt-get install -y libpq-dev
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-configure opcache --enable-opcache && \
    docker-php-ext-install pdo pdo_pgsql

COPY docker/php/conf.d/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

COPY --from=build /app /var/www/html
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN ln -s /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-enabled/default.conf
RUN apachectl configtest
COPY .env.prod /var/www/html/.env

RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan config:clear && \
    php artisan cache:clear && \
    # php artisan view:clear && \
    # php artisan optimize && \
    # php artisan db:seed --class=CustomSeeder --no-interaction && \
    # php artisan db:seed --class=CustomSeeder --force && \
    php artisan key:generate && \
    chmod 777 -R /var/www/html/storage/ && \
    chown -R www-data:www-data /var/www/ && \
    a2enmod rewrite

# WORKDIR /var/www/html

VOLUME ["/var/www/html/public/uploads"]

EXPOSE 80 37389

LABEL \
    org.opencontainers.image.vendor="UNILAB" \
    org.opencontainers.image.title="Official 3S Docker image" \
    org.opencontainers.image.description="3S (Sistema de Solicitação de Servicos) " \
    org.opencontainers.image.version="${VERSION}" \
    org.opencontainers.image.url="https://3s.unilab.edu.br/" \
    org.opencontainers.image.source="http://dti-gitlab.unilab.edu.br/disir/piloto-ci-cd-stack-devops-disir-dti.git" \
    org.opencontainers.image.revision="${COMMIT_SHA}" \
    org.opencontainers.image.licenses="N/D" \
    org.opencontainers.image.author="Jeff Ponte" \
    org.opencontainers.image.company="Universidade da Integracao Internacional da Lusofonia Afro-Brasileira (UNILAB)" \
    org.opencontainers.image.maintainer="DTI/Unilab"