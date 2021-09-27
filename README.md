## SOET

## Local Development:
### Getting Started

-The Database Should be created through XAMPP Shell:
```diff
! Mysql -u root
! CREATE DATABASE Patient_Experience_Tracker;
```
### Running Server:
After Cloning the project from GitHub, cd to the folder and enter:
```diff
! composer update
! cp .env .example .env(copy .env.example .env for windows)
! php artisan migrate
! php artisan db:seed --class=DB_Seed
! composer dump-autoload
! php artisan serve
#### Keep the terminal open and go to local host at: 127.0.0.1

### Installing Composer:
    https://getcomposer.org/doc/00-intro.md
