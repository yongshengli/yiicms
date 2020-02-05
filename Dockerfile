FROM php:7.2-fpm-alpine

COPY . /var/www/yiicms
COPY ./nginx.conf /etc/nginx/conf.d/yiicms.conf

RUN MAIN_VERSION=$(cat /etc/alpine-release | cut -d '.' -f 0-2) \
    && mv /etc/apk/repositories /etc/apk/repositories-bak \
    && { \
        echo "https://mirrors.aliyun.com/alpine/v${MAIN_VERSION}/main"; \
        echo "https://mirrors.aliyun.com/alpine/v${MAIN_VERSION}/community"; \
    } >> /etc/apk/repositories && \
    apk add --no-cache nginx && \
    # apk add --no-cache mysql && \
    apk add --no-cache mysql-client && \
    mkdir -p /run/nginx && \
    rm -f /etc/nginx/conf.d/default.conf && \
    cp -f /var/www/yiicms/config/db.php.default /var/www/yiicms/config/db.php && \
    sed -i -e "s/'password' => '123456',/'password' => '',/g" /var/www/yiicms/config/db.php && \
    chmod -Rf 777 /var/www/yiicms/runtime && \
    chmod -Rf 777 /var/www/yiicms/web/uploads && \
    chmod -Rf 777 /var/www/yiicms/web/assets && \
    mkdir -p /var/www/sh && \
    echo -e "#!/bin/sh\n/usr/sbin/nginx\n/usr/local/sbin/php-fpm\n" >> /var/www/sh/start.sh
    
ENTRYPOINT [ "/bin/sh", "/var/www/sh/start.sh" ]