# Project Setup Instructions

## Prerequisites

- PHP 8.2 or higher
- Composer
- Laravel 11

First, clone the repository to your local machine:
git clone <repository-url>
cd <project-directory>

Install Dependencies
Install the project dependencies using Composer:
composer install

Set Up Environment File
Copy the .env.example file to create your .env file:

Generate the Laravel application key:
php artisan key:generate

Set Up the Database
Configure your database connection in the .env file:

To set up the project with some demo seed data, run the following command:
php artisan initialize:project

Clear Cache and Optimize
To optimize the application and clear the cache, run the following commands:
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

Start the Development Server
Start the Laravel development server:
php artisan serve