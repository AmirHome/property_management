#!/bin/bash

# How to use:
# sh /Users/amirhoss/Data/Codes/vhosts/Amir/quickadmin_amir_hosseinzadeh_econtech_com_tr.sh -copy

# Set the download folder path (modify if needed)
download_folder="$HOME/Downloads"
archive_file="dev-admin-e9f11f11d86ec53e"
quickadmin_folder="$HOME/Data/Codes/vhosts/Amir/quickadmin_amir_hosseinzadeh_econtech_com_tr"
main_project_folder="$HOME/Data/Codes/vhosts/Amir/property_management"

clear

# Check for the -copy
if [ "$1" == "-copy" ]; then
  (cd $quickadmin_folder && git status)
  echo "database/seeders/PermissionsTableSeeder.php resources/lang resources/views/layouts/frontend.blade.php tests"
  echo "\nUpdate these resources/views/partials/menu.blade.php routes/api.php routes/web.php"

  read -p "Enter source file paths (space-separated): " -a src_paths

  for src in "${src_paths[@]}"; do
    src="${src%/}"
    if [ -d "$quickadmin_folder/$src" ]; then
      mkdir -p "$main_project_folder/$src"
      cp -fr "$quickadmin_folder/$src/" "$main_project_folder/$src" && echo "Copied '$quickadmin_folder/$src/ $main_project_folder/$src'"
    else
      mkdir -p "$main_project_folder/$(dirname "$src")"
      cp -fr "$quickadmin_folder/$src" "$main_project_folder/$src" && echo "Copied '$quickadmin_folder/$src/ $main_project_folder/$src'"
    fi
  done

else
  # Check if archive exists
  if [ ! -f "$download_folder/$archive_file.zip" ]; then
    echo "Info: Archive '$archive_file.zip' not found in '$download_folder'"
    exit 1
  fi

  # clean files
  find $quickadmin_folder ! -path "$quickadmin_folder/.env" ! -path "$quickadmin_folder/.git" ! -path "$quickadmin_folder/.git/*" -delete

  # Extract the archive to the root directory
  unzip -q "$download_folder/$archive_file.zip" -d $quickadmin_folder
  echo "Extracted '$quickadmin_folder' to root directory."

  # install laravel
  # cp $main_project_folder/.env.quickadmin $quickadmin_folder/.env

fi

(cd $quickadmin_folder && git status)
echo "(cd $HOME/Data/Codes/vhosts/Amir/quickadmin_amir_hosseinzadeh_econtech_com_tr && composer install && php artisan migrate:fresh --seed && php artisan key:generate && php artisan storage:link && git status && php artisan serve)"

