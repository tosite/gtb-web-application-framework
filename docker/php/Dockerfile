FROM php:7.3-fpm
COPY php.ini /usr/local/etc/php/

RUN apt-get update \
  && apt-get install -y zlib1g-dev mariadb-client libzip-dev procps \
  && docker-php-ext-install zip pdo_mysql

# Composer install
COPY --from=composer /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1

ENV COMPOSER_HOME /composer

ENV PATH $PATH:/composer/vendor/bin

# install tbls
RUN apt-get install -y wget \
	&& wget -P /tmp https://github.com/k1LoW/tbls/releases/download/v1.46.0/tbls_v1.46.0_linux_amd64.tar.gz \
	&& tar zxvf /tmp/tbls_v1.46.0_linux_amd64.tar.gz -C /tmp \
	&& mv /tmp/tbls /usr/local/bin/tbls

# locale jp
RUN apt-get update \
    && apt-get install -y locales \
    && locale-gen ja_JP.UTF-8
ENV LANG ja_JP.UTF-8
ENV LANGUAGE ja_JP:ja
ENV LC_ALL=ja_JP.UTF-8
RUN localedef -f UTF-8 -i ja_JP ja_JP.utf8

WORKDIR /var/www

