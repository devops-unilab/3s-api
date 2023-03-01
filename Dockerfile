# Dockerfile for 3S
#
# Maintainer: Erivando Sena <erivandoramos@unilab.edu.br>
#
# Description: Este Dockerfile cria uma imagem para 3s, um aplicativo da Web escrito em PHP.
#
# Build instructions:
#
#   docker buildx build --no-cache --build-arg 'COMMIT_SHA=$(git rev-parse --short HEAD)' -t dti-registro.unilab.edu.br/unilab/3s:latest .
#   docker push dti-registro.unilab.edu.br/unilab/3s:latest:latest
#
# Usage:
#
#   docker run -it --rm -d -p 8088:80 -v /tmp:/var/www/html/3s/public/uploads --name 3s dti-registro.unilab.edu.br/unilab/3s:latest
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

FROM php:7.4-apache-bullseye

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && apt-get install -y --no-install-recommends \
    ca-certificates \
    libfreetype6 \
    procps \
    p7zip-full \
    libpq-dev \
    libldap-common \
    postgresql-client \
    openssh-server \
    git \
    nfs-common \
    tini \
    apt-utils \
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
  && rm -rf /var/lib/apt/lists/*

# Install extensoes especificas for PHP
RUN docker-php-ext-install pdo pdo_pgsql 

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
ARG VERSION 1.0.0
ENV TZ America/Fortaleza
ENV LANG pt_BR.UTF-8 
ENV LC_CTYPE pt_BR.UTF-8 
ENV LC_ALL C
ENV LANGUAGE pt_BR:pt:en
RUN locale-gen pt_BR.UTF-8 
RUN dpkg-reconfigure locales tzdata -f noninteractive

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_RUN_DIR /var/www/html/3s/public

# 3s env -------------------
ENV DB_CONNECTION "pgsql"
ENV DB_HOST "127.0.0.1"
ENV DB_PORT "5432"
ENV DB_DATABASE "ocorrencias"
ENV DB_USERNAME "ocorrencias_user"
ENV DB_PASSWORD "9e5bc68ee2c10ee0c12ee1c4c46192fd"

ENV DB_CONNECTION_SIGAA "pgsql"
ENV DB_HOST_SIGAA "10.129.19.31"
ENV DB_PORT_SIGAA 5432
ENV DB_DATABASE_SIGAA "sistemas_comum"
ENV DB_USERNAME_SIGAA "3s"
ENV DB_PASSWORD_SIGAA "158e0852423940860b201aa6b7ad6ef3"

ENV MAIL_MAILER smtp
ENV MAIL_HOST "smtp.noreply.unilab.edu.br"
ENV MAIL_PORT "25"
ENV MAIL_USERNAME "null"
ENV MAIL_PASSWORD "null"
ENV MAIL_ENCRYPTION "null"
ENV MAIL_FROM_ADDRESS "3s@noreply.unilab.edu.br"
ENV MAIL_FROM_NAME "3S/DTI/UNILAB"
# 3s env -------------------

# get workspace legado da vm 3s
COPY . .

# Uncompress arquivo zip protected
RUN 7z x dados/3s/inifiles.zip -p$(echo Y3RpQHVuaWxhYjIwMTI= | base64 -d) -odados/3s \
  && rm dados/3s/*.zip

RUN mkdir -p 3s/public/uploads/ocorrencia/anexo \
  && mv -f dados/sites/pub/ocorrencias/* 3s/public/ \
  && mv -f dados/3s 3s \
  && rm -r dados \
  && chown -Rf www-data:www-data 3s/public/uploads

# Setup user
RUN useradd -m -s /bin/bash 3s
RUN usermod -aG sudo 3s && echo "3s ALL=(ALL) NOPASSWD: ALL" > /etc/sudoers.d/3s
RUN chmod 0440 /etc/sudoers.d/3s

# Setup ssh
RUN sed -i "s/#Port 22/Port 37389/g" /etc/ssh/sshd_config
RUN sed -i "s/#PasswordAuthentication yes/PasswordAuthentication no/g" /etc/ssh/sshd_config
RUN [ -f ~/.ssh/id_rsa ] || ssh-keygen -t rsa -b 4096 -C "3s@noreply.unilab.edu.br" -f ~/.ssh/id_rsa -q -N "" && chmod -R 600 ~/.ssh
RUN /etc/init.d/ssh start

# Setup Apache
RUN cp apache2/httpd-vhosts.conf /etc/apache2/
RUN cp -Rf apache2/000-default.conf /etc/apache2/sites-available/
RUN ln -s /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-enabled/default.conf
RUN rm -r apache2

WORKDIR /var/www/html/3s/public

VOLUME ["/var/www/html/3s/public/uploads"]

EXPOSE 80 37389

USER 3s

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

# Start Apache server
 CMD ["apache2-foreground"]++