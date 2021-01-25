FROM php:7.4-fpm
LABEL maintainer="josh@osodevops.io"

# Download script to install PHP extensions and dependencies
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod uga+x /usr/local/bin/install-php-extensions && sync

RUN DEBIAN_FRONTEND=noninteractive apt-get update -q \
    && DEBIAN_FRONTEND=noninteractive apt-get install -qq -y \
      curl \
      git \
      zip unzip \
      nano \
    && install-php-extensions \
      bcmath \
      bz2 \
      calendar \
      exif \
      gd \
      intl \
      ldap \
      memcached \
      mysqli \
      opcache \
      pcntl \
      pdo_mysql \
      pdo_pgsql \
      pgsql \
      redis \
      soap \
      xsl \
      zip \
      sockets

# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# OPCACHE_ENABLE defaults
ENV OPCACHE_ENABLE="1"
ENV OPCACHE_MEMORY_CONSUMPTION="512"
ENV OPCACHE_INTERNED_STRINGS_BUFFER="64"
ENV OPCACHE_MAX_ACCELERATED_FILES="32531"
ENV OPCACHE_VALIDATE_TIMESTAMPS="0"
ENV OPCACHE_SAVE_COMMENTS="1"
ENV OPCACHE_FAST_SHUTDOWN="0"

# Override with custom opcache settings
COPY ./docker/app/php-base/7.4/configs/opcache.ini $PHP_INI_DIR/conf.d/
# Override with custom pedigree settings
COPY ./docker/app/php-base/7.4/configs/pedigree.ini $PHP_INI_DIR/conf.d/

# Install Composer (latest version).
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && ln -s $(composer config --global home) /root/composer
  
ENV PATH=$PATH:/root/composer/vendor/bin COMPOSER_ALLOW_SUPERUSER=1
