#!/bin/bash

# constants
last_name="Melacarne"

# command line args
exercise_number=$1
exercise_name=$2

exercise_dir_name="${exercise_number}_${exercise_name}_${last_name}"

# create directory
mkdir -p ./assignments/"$exercise_dir_name"/

# create new directory with template exercise
rsync -av --progress ./template/ ./assignments/"$exercise_dir_name"/ --exclude mariadb_data
