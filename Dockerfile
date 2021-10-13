FROM 908259003521.dkr.ecr.eu-west-1.amazonaws.com/services-base-image:ubuntu20.04-latest AS base-image

COPY ./resources/laravel /var/www/service/
COPY ./resources/apache/000-default.conf /etc/apache2/sites-enabled/000-default.conf

RUN apt -y update && apt -y install php-xdebug nodejs npm

USER root
