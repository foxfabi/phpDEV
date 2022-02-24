# start with the official Composer image and name it
FROM composer:1.9.3 AS composer
ENV COMPOSER_ALLOW_SUPERUSER 1

FROM php:7.4-fpm-buster AS base
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV LC_ALL C.UTF-8
#RUN pwd && ls -la
RUN apt-get update &&           \
    apt-get install -y          \
    ca-certificates             \
    libcurl4-openssl-dev        \
    libssl-dev                  \
    supervisor                  \
    unzip                       \
    zlib1g-dev                  \
    curl                        \
    git                         \
    dos2unix                    \
    wget                        \
    default-mysql-client        \
    libmcrypt-dev               \
    libicu-dev                  \
    libpq-dev                   \
    libjpeg62-turbo-dev         \
    libjpeg-dev                 \
    libpng-dev                  \
    zlib1g-dev                  \
    libonig-dev                 \
    libxml2-dev                 \
    libzip-dev                  \
    unzip                       \
    --no-install-recommends &&  \
    apt-get clean &&            \
    rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-configure gd --with-jpeg=/usr/include/
RUN docker-php-ext-install -j$(nproc)   \
    gd                                  \
    intl                                \
    mbstring                            \
    mysqli                              \
    zip                                 \
    curl                                \
    opcache                             \
    bcmath                              \
    sockets
RUN pecl install xdebug; docker-php-ext-enable gd mysqli curl xdebug
# copy the Composer PHAR from the Composer image into the PHP image
COPY --from=composer /usr/bin/composer /usr/bin/composer
WORKDIR /opt/code
COPY ./code/ .
# Smoke test
RUN echo "PHP Version:" "$(php -v)"
RUN echo "Composer Version:" "$(composer --version)"
EXPOSE 9000

FROM base as development
ADD https://squizlabs.github.io/PHP_CodeSniffer/phpcs.phar /usr/local/bin/phpcs
RUN chmod 755 /usr/local/bin/phpcs
ADD https://squizlabs.github.io/PHP_CodeSniffer/phpcbf.phar /usr/local/bin/phpcbf
RUN chmod 755 /usr/local/bin/phpcbf
RUN phpcs --config-set show_progress 1 && \
    phpcs --config-set colors 1  && \
    phpcs --config-set default_standard PSR12  && \
    phpcs --config-set severity 1  && \
    phpcs --config-set report_width 120
# PHPDocumentor
ADD http://www.phpdoc.org/phpDocumentor.phar /usr/local/bin/phpdoc
RUN chmod 755 /usr/local/bin/phpdoc
# PHPUnit
ADD https://phar.phpunit.de/phpunit-6.5.phar /usr/local/bin/phpunit
RUN chmod 755 /usr/local/bin/phpunit
# Install sendmail package
RUN apt-get update && apt-get install -y msmtp msmtp-mta mailutils
# PHP configuration
RUN docker-php-source extract && \
    cp '/usr/src/php/php.ini-development' $PHP_INI_DIR/php.ini && \
    echo "date.timezone=${TZ}" >> $PHP_INI_DIR/conf.d/timezone.ini && \
    # XDEBUG PHP Config
    echo "[xdebug]" >> $PHP_INI_DIR/conf.d/xdebug.ini && \
    echo "xdebug.mode=debug" >> $PHP_INI_DIR/conf.d/xdebug.ini && \
    echo "xdebug.start_with_request = yes" >> $PHP_INI_DIR/conf.d/xdebug.ini && \
    echo "xdebug.client_port = 9000" >> $PHP_INI_DIR/conf.d/xdebug.ini && \
    echo 'xdebug.idekey = "VSCODE"' >> $PHP_INI_DIR/conf.d/xdebug.ini && \
    echo 'xdebug.discover_client_host = 1' >> $PHP_INI_DIR/conf.d/xdebug.ini && \
    # Sendmail Config
    echo "[sendmail]" >> $PHP_INI_DIR/conf.d/sendmail.ini && \
    echo "smtp_server=${SMTP_SERVER}" >> $PHP_INI_DIR/conf.d/sendmail.ini && \
    echo "smtp_port=${SMTP_PORT}" >> $PHP_INI_DIR/conf.d/sendmail.ini && \
    #echo "sendmail_path=sendmail -i -t" >> $PHP_INI_DIR/conf.d/sendmail.ini && \
    echo "sendmail_path = \"/usr/bin/msmtp -C /etc/msmtprc -t\"" >> $PHP_INI_DIR/conf.d/sendmail.ini && \
    # Log Config
    echo "log_errors = On" >> $PHP_INI_DIR/conf.d/log.ini && \
    echo "error_log=/dev/stderr" >> $PHP_INI_DIR/conf.d/log.ini && \
    docker-php-source delete
CMD [ "/usr/local/bin/php", "-S", "0.0.0.0:8888", "-t", "/opt/code/"]
EXPOSE 8888
