To ensure running the project successful
After cloning repo

1. check .env file
if there is no .env file in the project folder, run this command => cp .env.example .env
2. npm insall
3. composer install 
4. php artisan key:generate
5. docker compose up -d --build
6. create a database called laravel in mysql
7. php artisan migrate

Once run the above command: 
1. run this command in terminal => npm run dev 
2. run this command in another terminal => php artisan serve 

THIS IS VERY IMPORTANT
*********************************
PLEASE address displayed in the backend terminal
*********************************

For windows: 
1. Once finish the 1-7 steps
2. Must run xampp and mysql 