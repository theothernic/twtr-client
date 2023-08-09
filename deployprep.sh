#! /bin/sh

composer install;
npm install;
npm run build;

if [ -d .git/ ]; then
  rm -rf .git/;
fi 

if [ -d node_modules/ ]; then
  rm -rf node_modules/;
fi

rm -f package.json
rm -f package-lock.json


