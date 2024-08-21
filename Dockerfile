FROM php:8.3.6-fpm-alpine3.19

RUN apk --update add --no-cache \
    ${PHPIZE_DEPS} \
    php-phpdbg \
    busybox  \
    apk-tools  \
    bash  \
    nginx \
    supervisor \
    nano  \
    libzip-dev  \
    zip  \
    tar  \
    tzdata \
    icu-dev \
    gpg \
    gnupg \
    icu \
    unzip \
    unixodbc \
    unixodbc-dev \
    linux-headers \
    openssl \
    openssh \
    openssl-dev \
    gd \
    "libxml2-dev>=2.9.10-r5" \
    git \
    "freetype>=2.10.4.r0" \
    nodejs \
    npm \
    yarn \
    jpegoptim \
    optipng \
    pngquant \
    gifsicle \
    libavif-dev \
    && rm -rf /var/cache/apk/*

RUN apk update && \
    apk del oniguruma && \
    wget -c https://github.com/kkos/oniguruma/releases/download/v6.9.6_rc4/onig-6.9.6-rc4.tar.gz -O - | tar -xz && \
    (cd onig-6.9.6 && ./configure && make install) && \
    rm -rf ./onig-6.9.6 && \
    rm -rf /var/cache/apk/*

RUN docker-php-ext-install \
    mbstring \
    soap \
    xml \
    posix \
    ctype \
    pcntl \
    opcache \
    pdo \
    mysqli \
    pdo_mysql \
    intl \
    sockets \
    bcmath \
    exif

RUN apk add --virtual build-dependencies --no-cache autoconf \
    gcc \
    g++ \
    make \
    freetype-dev \
    zlib-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    libmcrypt-dev openssl ca-certificates libxml2-dev oniguruma-dev

RUN docker-php-ext-configure gd --enable-gd --with-freetype=/usr/include/freetype2/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd
RUN docker-php-ext-enable gd
    
RUN pecl install -f apcu redis zip
RUN docker-php-ext-enable apcu redis zip

RUN docker-php-ext-install exif \
&& docker-php-ext-enable exif

# # -------------------- Installing PHP Extension: xdebug --------------------
RUN pecl install xdebug \
&& docker-php-ext-enable xdebug

# COPY ./docker/config/usr/local/etc/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
    
# RUN if [ "$APP_STAGE" == "dev" ] ; then \
#         pecl install xdebug-${XDEBUG_VERSION} \
#         && docker-php-ext-enable xdebug ; \
#     fi


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN mkdir -p /src
RUN chown -R www-data:www-data /src

WORKDIR /src

COPY --chown=www-data:www-data src/ /src

COPY docker/config /

COPY docker/scripts/ /

RUN if [ -z "`getent group www-data`" ]; then \
      addgroup -g 1000 -S www-data ; \
    fi

RUN if [ -z "`getent passwd www-data`" ]; then \
      adduser -u 1000 -D -S -G www-data -h /app -g www-data www-data ; \
    fi

 RUN mkdir -p /var/lib/nginx/tmp /var/log/nginx \
    && chown -R www-data:www-data /var/lib/nginx /var/log/nginx \
    && chmod -R 755 /var/lib/nginx /var/log/nginx \
    && chown -R www-data:www-data /src \
    && chmod -R 755 /src

RUN if [ "$APP_STAGE" == "dev" ] ; then \
        cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini; \
    else \
        cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini; \
    fi
RUN cp /usr/local/etc/php/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN rm /usr/local/etc/php/php.ini-development \
    && rm /usr/local/etc/php/php.ini-production

RUN chmod +x /docker-entrypoint.sh \
    && chmod +x /php-command.sh

ENTRYPOINT ["/docker-entrypoint.sh"]
