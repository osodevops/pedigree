FROM  109716644331.dkr.ecr.eu-west-2.amazonaws.com/pedigree/php-base:7.4
LABEL maintainer="josh@osodevops.io"

ARG BUILD_DATE

LABEL org.label-schema.build-date=$BUILD_DATE

# PHP-FPM defaults
ENV PHP_FPM_PM="ondemand"
ENV PHP_FPM_MAX_CHILDREN="10"
ENV PHP_FPM_START_SERVERS="1"
ENV PHP_FPM_MIN_SPARE_SERVERS="1"
ENV PHP_FPM_MAX_SPARE_SERVERS="10"
ENV PHP_FPM_MAX_REQUESTS="500"

# Copy existing application directory contents
COPY --chown=www-data . /var/www/html
# Switch to www-data
USER www-data

# Create Storage Link (php artisan storage:link)
RUN rm -rf /var/www/html/public/storage
RUN ln -s /var/www/html/storage/app/public /var/www/html/public/storage

# Copy the PHP-FPM configuration file
COPY ./docker/app/php/staging/configs/www.conf /usr/local/etc/php-fpm.d/www.conf

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
