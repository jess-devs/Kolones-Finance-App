FROM dunglas/frankenphp:php8.4.18-bookworm

RUN install-php-extensions \
    pdo_mysql \
    mysqli

COPY . /app

RUN chmod +x /app/start.sh

CMD ["/app/start.sh"]