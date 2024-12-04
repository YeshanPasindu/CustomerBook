
READMEEEEEEEEEEEEEE
# Customer Address Book

This project is a customer address book system developed with a Laravel backend and a Vue.js frontend.
Features-:

Signup to the system.
Login to the system.
Add Customer with their details(Name ,NIC, Address,Mobile Number).
Delete Customers.
Update Customers.
Search Customers.

First clone this.

## Installation

### Backend (Laravel)

1. Navigate to the backend folder:
cd customerbook

2.Install dependencies:

composer install

3.Configure the .env file with your database credentials:

cp .env.example .env

php artisan key:generate

4.Run database migrations and seeders:

php artisan migrate --seed

5.Install laravel passport

php artisan passport:install

5.Start the development server:

php artisan serve


### FrontEnd (Vue)

1.Navigate to the frontend folder:

cd ../customerBook-frontend

2.Install dependencies:

npm install

3.Run the development server:

npm run dev

## Next

You have to signup to the system first. 
After signup login to the system.
Then you can access the other features.



