FROM php:8.5-fpm AS build

RUN <<EOF
set -ex
apt update
apt install -y --no-install-recommends \
  graphicsmagick \
  libfreetype-dev \
  libicu-dev \
  libjpeg62-turbo-dev \
  libpng-dev \
  tini \
  zlib1g-dev
docker-php-ext-configure gd --with-freetype --with-jpeg
docker-php-ext-install -j$(nproc) exif gd intl pcntl pdo_mysql
# Удаляем то, что нужно было только для сборки расширений
# $PHPIZE_DEPS родом из базового образа php
apt purge -y $PHPIZE_DEPS
apt autoremove -y
# Кэш от использования apt update
rm -r /var/lib/apt/lists/*
# Исходники php больше не нужны
rm -r /usr/src/*
EOF

FROM scratch

# Снижение размера образа в несколько раз
COPY --from=build / /

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

ENTRYPOINT ["/usr/bin/tini", "--"]

CMD ["php-fpm"]
