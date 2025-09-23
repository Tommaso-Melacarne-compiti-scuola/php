#!/bin/bash

readonly LAST_NAME="Melacarne"

mkdir -p zip

for folder in assignments/*; do
  if [ -d "$folder" ]; then
    base=$(basename "$folder")
    cd "$folder" || exit
    zip -r "../../zip/$LAST_NAME-$base.zip" . -x "mariadb_data/*"
    cd ../..
  fi
done
