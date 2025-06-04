#!/bin/bash

# Set these paths to match your setup
WORKSPACE="/var/www/html/wp-content/themes/storefront-child/workspace"
CHILD_THEME="/var/www/html/wp-content/themes/storefront-child"

# Copy all files and folders from workspace to child theme (overwrite)
cp -r "$WORKSPACE/"* "$CHILD_THEME/"

echo "All files from workspace have been copied to the child theme directory."
