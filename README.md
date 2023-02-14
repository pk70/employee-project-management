# Homework assignment
## Requirements
1. [x] PHP 8.1 minimum.
2. [x] Composer.
4. [x] Enable cURL PHP extension
4. [x] Node.js v16.17.1

### Setup project in localhost
- Project url in github `https://github.com/pk70/employee-project-management.git`
- Download file from git or `git clone https://github.com/pk70/employee-project-management.git`
- Go to project folder and open terminal
- Run command `composer update`
- Make sure .env file is in root folder or rename the .env.example
- In .env file DB_DATABASE=`your db name` DB_USERNAME=`your db user name` DB_PASSWORD=`you db password`
- Run command `php artisan migrate` for generating db table
- Run command `php artisan key:generate` for generating encrypted key
- Run command `php artisan db:seed --class=AdminSeeder` for creating admin user with password(Default user:`admin@admin.com`,password:`admin@admin.com`)
- Run command `npm install && npm run dev`
- Run command `php artisan serve` you will see url `http://127.0.0.1:8000/`

### Live link
- https://devstation.discovernanosoft.com/

### How to operate the project/software
- Open url in browser (`http://127.0.0.1:8000/`)
- In first landing page their are login and registration link right side top
- Login is for all user `admin or employee` and registration is for employee only

### Technology used
- Laravel Framework 9.51.0
- MySql 8.0.25

