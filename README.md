# Crud-laravel-vue-js
Crud laravel + vue js with api and vuetify component

# Demo

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Alternative installation is possible without local dependencies relying on [Docker](#docker). 

Clone the repository

    git clone https://github.com/itdyaingenieria/crudpruebanimals.git

Switch to the repo folder

    cd crudpruebanimals

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git https://github.com/itdyaingenieria/crudpruebanimals.git
    cd crudpruebanimals
    composer install
    cp .env.example .env
    php artisan key:generate
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## credit
- [volar template](https://getstisla.com/)
- [framework laravel](https://laravel.com/)
- [vue.js](https://vuejs.org/v2/guide/)
- [vuetify](https://vuetifyjs.com/en/)
- [bootstrap](https://getbootstrap.com/docs/4.6/getting-started/introduction/)
- [SweetAlert](https://sweetalert2.github.io/)
- [vue notify](https://github.com/BinarCode/vue-notifyjs?ref=madewithvuejs.com)





