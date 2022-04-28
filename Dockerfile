FROM alpine:3.14
LABEL Maintainer="Hieu Tran" \
      Description="docker laravel"
# Install packages
RUN apk --no-cache add php7 php7-fpm php7-mysqli php7-json php7-openssl php7-curl php7-pdo_mysql php7-xmlwriter php7-xsl php7-zip php7-opcache php7-pecl-apcu php7-exif\
    php7-zlib php7-xml php7-phar php7-intl php7-dom php7-xmlreader php7-ctype php7-session php7-redis php7-simplexml php7-soap php7-fileinfo php7-sodium \
    php7-mbstring php7-gd php7-pear php7-dev php7-pecl-xdebug php7-bcmath php7-tokenizer nginx supervisor curl git composer busybox-suid php7-pecl-amqp php7-sockets patch bash busybox screen gettext
COPY docker/config/php.ini /etc/php7/conf.d/custom.ini
ENV WORKDIR=/laravel
RUN composer create-project laravel/laravel:^8 $WORKDIR
WORKDIR  $WORKDIR
# Configure nginx
COPY docker/config/nginx.conf.template /etc/nginx/nginx.conf.template

# Configure PHP-FPM
COPY docker/config/fpm-pool.conf /etc/php7/php-fpm.d/www.conf
COPY docker/config/php.ini /etc/php7/conf.d/zzz_custom.ini

# Configure supervisord
COPY docker/config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
ADD composer.json $WORKDIR/composer.json
COPY ./docker/config/update-data.sh /update-data.sh
COPY docker/environment /etc/
RUN cd $WORKDIR && composer update --no-ansi --optimize-autoloader --no-dev
RUN cd $WORKDIR && php artisan vendor:publish --provider="Encore\Admin\AdminServiceProvider"
RUN cd $WORKDIR && php artisan vendor:publish --tag=lfm_config
RUN cd $WORKDIR &&php artisan vendor:publish --tag=lfm_public
COPY ./database/  $WORKDIR/database
RUN \
      cd $WORKDIR && \
       . /etc/environment && \
      php artisan storage:link && \
      php artisan admin:install
COPY ./app/ $WORKDIR/app
COPY ./resources/  $WORKDIR/resources
COPY ./routes/  $WORKDIR/routes
COPY ./config/  $WORKDIR/config
EXPOSE 8080
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
# Configure a healthcheck to validate that everything is up&running
HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:8080/fpm-ping
