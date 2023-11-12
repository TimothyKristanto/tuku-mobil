# tuku-mobil
Certification Application

Installing laravel projects from github steps:

## 1. Go inside the project directory
<sub>cd aplikasi-ujian-sertifikasi<sub/>

## 2. Install composer using one from the two commands below
<sub>composer install/update or composer install/update --ignore-platform-reqs<sub/>

## 3. Install npm
<sub>npm install<sub/>

## 4. Create a copy of .env file
<sub>cp .env.example .env<sub/>

## 5. Setup your .env file

## 6. Generate app key
<sub>php artisan key:generate<sub/>

## 7. Migrate database
<sub>php artisan migrate<sub/>

## 8. Link storage folder to public
<sub>php artisan storage:link<sub/>

## 9. Add command below to your .env file
<sub>FILESYSTEM_DISK=public<sub/>
