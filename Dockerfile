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

# Stage 1 - Dev
FROM php:8.1-apache-bullseye as dev

ENV APP_ENV=dev
ENV APP_DEBUG=true
ENV COMPOSER_ALLOW_SUPERUSER=1

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && apt-get install -y --no-install-recommends \
  openssh-server \
  locales \
  rsync \
  nano \
  git \
  unzip \
  libpq-dev \
  postgresql-client \
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

RUN docker-php-ext-install pdo pdo_pgsql pgsql 
RUN docker-php-ext-configure opcache --enable-opcache

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

RUN cd /opt \
  && curl -sS https://getcomposer.org/installer -o composer-setup.php \
  && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
  && composer 

# # Get vendor
# RUN cd /opt && composer create-project laravel/laravel --prefer-dist proj-laravel
# RUN rsync --progress --recursive -arvPo /opt/roj-laravel/vendor /var/www/html/vendor
# RUN rm -r /opt/roj-laravel

# Proj NOVO
# RUN cd /opt && composer create-project laravel/laravel --prefer-dist proj-laravel
# RUN rsync --progress --recursive -arvPo /opt/roj-laravel/ /var/www/html/
# RUN rm -r /opt/roj-laravel

# Proj EXISTENTE
COPY . /var/www/html
RUN mkdir -p /var/www/html/public/uploads/ocorrencia/anexo
 
RUN cd /var/www/html \
  # && rm composer.lock \
  # && composer update \
  && composer install --ignore-platform-reqs --no-interaction --no-progress --no-scripts --optimize-autoloader \
  && php artisan -V

RUN sed -i "s/'default' => env('DB_CONNECTION', 'mysql'),/'default' => env('DB_CONNECTION', 'pgsql'),/g" config/database.php
RUN sed -i "s/        \/\//        '*',/g" app/Http/Middleware/VerifyCsrfToken.php
RUN cp docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf \
  && apachectl configtest

# Setup user and ssh
RUN adduser --no-create-home --disabled-password --shell /bin/bash --gecos "" --force-badname 3s \
  && echo "3s ALL=(ALL) NOPASSWD:ALL" >> /etc/sudoers
RUN sed -i "s/#Port 22/Port 22/g" /etc/ssh/sshd_config
RUN sed -i "s/#PermitRootLogin prohibit-password/PermitRootLogin no/g" /etc/ssh/sshd_config
RUN sed -i "s/#PasswordAuthentication yes/PasswordAuthentication no/g" /etc/ssh/sshd_config
RUN [ -f ~/.ssh/id_rsa ] || ssh-keygen -t rsa -b 4096 -C "3s@3s.unilab.edu.br" -f ~/.ssh/id_rsa -q -N "" && chmod -R 600 ~/.ssh
RUN update-rc.d ssh enable

RUN php artisan config:clear && \
  php artisan config:cache && \
  php artisan route:cache && \
  chmod 777 -R /var/www/html/storage/ && \
  chown -Rf www-data:www-data /var/www/ && \
  a2enmod rewrite

# Stage 2 - Prod
FROM dev as production

ENV APP_ENV=production
ENV APP_DEBUG=false

# COPY docker/php/conf.d/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
RUN cp docker/php/conf.d/opcache.ini /usr/local/etc/php/conf.d/opcache.ini \
  && ln -s /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-enabled/default.conf

COPY --from=dev /var/www/html /var/www/html
RUN composer install --prefer-dist --no-interaction --no-dev

RUN php artisan config:cache && \
  php artisan route:cache && \
  # php artisan db:seed --class=DatabaseSeeder --force && \
  php artisan key:generate && \
  chmod 777 -R /var/www/html/storage/ && \
  chown -Rf www-data:www-data /var/www/ && \
  a2enmod rewrite

VOLUME ["/var/www/html/public/uploads"]

EXPOSE 80 22

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