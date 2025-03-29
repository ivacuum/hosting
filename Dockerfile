FROM php:8.4-fpm AS build

RUN <<EOF
apt update
apt install -y --no-install-recommends \
  graphicsmagick \
  tini
docker-php-ext-install -j$(nproc) exif intl opcache pcntl pdo_mysql
# Удаляем то, что нужно было только для сборки расширений
apt purge -y $PHPIZE_DEPS \
  libc6-dev
apt autoremove -y
rm -r /var/lib/apt/lists/*
rm -r /usr/src/*
EOF

FROM scratch

# Снижение размера образа в несколько раз
COPY --from=build / /

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

ENTRYPOINT ["/usr/bin/tini", "--"]

CMD ["php-fpm"]
