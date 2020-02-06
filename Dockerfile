FROM php:7.1-fpm-alpine

COPY . /var/www/yiicms
COPY ./nginx.conf /etc/nginx/conf.d/yiicms.conf

RUN MAIN_VERSION=$(cat /etc/alpine-release | cut -d '.' -f 0-2) \
    && mv /etc/apk/repositories /etc/apk/repositories-bak \
    && { \
        echo "https://mirrors.aliyun.com/alpine/v${MAIN_VERSION}/main"; \
        echo "https://mirrors.aliyun.com/alpine/v${MAIN_VERSION}/community"; \
    } >> /etc/apk/repositories && \
    apk add --no-cache nginx && \
    mkdir -p /run/nginx && \
    rm -f /etc/nginx/conf.d/default.conf && \
    #php mysql-pdo gd2
    docker-php-ext-install pdo_mysql && \
    apk add freetype freetype-dev libpng-dev libjpeg-turbo libjpeg-turbo-dev && \
    docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-install -j$(nproc) gd && \
    apk del freetype-dev libpng-dev libjpeg-turbo-dev && \
    rm -f /var/cache/apk/* && \
    cp -f "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini" && \
    cp -f /var/www/yiicms/config/db.php.default /var/www/yiicms/config/db.php && \
    sed -i -e "s/'dsn' => 'mysql:host=localhost;dbname=yiicms',/'dsn' => 'mysql:host=mysql;dbname=yiicms',/g" /var/www/yiicms/config/db.php && \
    sed -i -e "s/'username' => 'root',/'username' => 'yiicms',/g" /var/www/yiicms/config/db.php && \
    chmod -Rf 777 /var/www/yiicms/runtime && \
    chmod -Rf 777 /var/www/yiicms/web/uploads && \
    chmod -Rf 777 /var/www/yiicms/web/assets && \
    mkdir -p /var/www/sh && \
    echo -e "#!/bin/sh\n/usr/sbin/nginx\n/usr/local/sbin/php-fpm\n" >> /var/www/sh/start.sh
    
ENTRYPOINT [ "/bin/sh", "/var/www/sh/start.sh" ]