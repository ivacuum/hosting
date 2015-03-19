#!/bin/sh

ROOT_DIR=$(pwd)
DATE=$(ls -t $ROOT_DIR/releases | head -n +2 | tail -n +2)
LIVE_DIR=$ROOT_DIR/live
RELEASE_DIR=$ROOT_DIR/releases/$DATE

# Откат базы данных
php artisan migrate:rollback --force

if [ $? -ne 0 ]; then
  echo "Migration rollback was not completed"
  exit 1
fi

ln -hfs $RELEASE_DIR $LIVE_DIR
