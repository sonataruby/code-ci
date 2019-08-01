#!/bin/sh
curl -sS https://codeload.github.com/bcit-ci/CodeIgniter/zip/3.1-stable | tar -xf - -C ./ 
mv ./CodeIgniter-3.1-stable/* ./ 
rm -rf ./CodeIgniter-3.1-stable | rm -rf ./tests | rm -rf ./user_guide_src | rm -rf ./build-release.sh | rm -rf ./contributing.md | rm -rf ./license.txt | rm -rf ./readme.rst
composer install
npm install