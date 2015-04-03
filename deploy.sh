#!/bin/sh
# Предварительно в папке проекта должен быть
# размещен файл .env для выполнения миграций

DATE=$(date +"%Y%m%d-%H%M%S")
ROOT_DIR=$(pwd)
LIVE_DIR=$ROOT_DIR/live
STORAGE_DIR=$ROOT_DIR/storage
RELEASE_DIR=$ROOT_DIR/releases/$DATE

# Копия проекта
git clone --depth=1 -b master git@bitbucket.org:ivacuum/hosting.git $RELEASE_DIR

if [ $? -ne 0 ]; then
  echo "Cloning was not successful"
  exit 1
fi

rm -rf $RELEASE_DIR/.git

# Файл настроек
ln -s $ROOT_DIR/.env $RELEASE_DIR/.env

# Общее хранилище
if [ -d $STORAGE_DIR ]; then
  rm -rf $RELEASE_DIR/storage
else
  mv $RELEASE_DIR/storage $STORAGE_DIR
fi

ln -s $STORAGE_DIR $RELEASE_DIR/storage

# Установка зависимостей
cd $RELEASE_DIR
composer install --no-dev --no-interaction

if [ $? -ne 0 ]; then
  echo "Composer install run was not successful"
  exit 1
fi

# Миграция базы данных
php artisan migrate --force

if [ $? -ne 0 ]; then
  echo "Migration was not completed"
  exit 1
fi

php artisan route:cache

cd public
bower install --production

if [ $? -ne 0 ]; then
  echo "Bower install run was not successful"
  exit 1
fi

ln -hfs $RELEASE_DIR $LIVE_DIR

# На память остается всего 3 релиза
cd $ROOT_DIR/releases
rm -rf $(ls -t | tail -n +4)
