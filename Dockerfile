################################################################################
# Install Composer Dependencies
################################################################################

FROM composer as composer

COPY . /app

WORKDIR /app

RUN composer install

################################################################################
# Install Node Dependencies
################################################################################

FROM node:16.15.1 as node

COPY --from=composer /app /app

WORKDIR /app

RUN npm install

RUN npm run build

################################################################################
# Build the Application Image
################################################################################

FROM alpine:3.17

################################################################################
# Install Dependencies
################################################################################

RUN apk add --no-cache git bash curl g++

################################################################################
# Install PHP 8.1
################################################################################

RUN apk add --no-cache                                                         \
    $(                                                                         \
        apk search -qe --no-cache 'php81*'                                     \
            | sed -e 's/[^ ]*dev[^ ]*//ig'                                     \
            | sed -e 's/[^ ]*psr[^ ]*//ig'                                     \
            | sed -e 's/[^ ]*xdebug[^ ]*//ig'                                  \
            | sed -e 's/[^ ]*couchbase[^ ]*//ig'                               \
            | cat                                                              \
    )

################################################################################
# Setup the Application
################################################################################

COPY --from=composer /app /var/www/html
COPY --from=node /app/public /var/www/html/public

RUN chmod -R 777 /var/www/html/storage
RUN chmod -R 777 /var/www/html/bootstrap/cache

RUN cp /var/www/html/.env.example /var/www/html/.env
RUN php81 /var/www/html/artisan key:generate

################################################################################
# Setup Cron
################################################################################

RUN echo "* * * * * php81 /var/www/html/artisan schedule:run >> \
    /var/www/html/storage/logs/cron.log 2>&1"                   \
    >> /var/spool/cron/crontabs/root

################################################################################
# Configure the Container
################################################################################

WORKDIR /var/www/html

EXPOSE 8000

################################################################################
# Start Web Server
################################################################################

CMD crond && php81 artisan octane:start --server=swoole --host=0.0.0.0
