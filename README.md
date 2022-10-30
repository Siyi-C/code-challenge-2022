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

Once run the above command, please run the both command below at the same time
1. run this command in terminal => npm run dev 
2. run this command in another terminal => php artisan serve

THIS IS VERY IMPORTANT (image shows below)
*********************************
PLEASE address displayed in the backend terminal
*********************************

<img width="664" alt="WeChat6866408f4499072f9e1bcda00d6d4e71" src="https://user-images.githubusercontent.com/116324663/198906626-f5b3fc80-1c2b-447e-96b0-94cf2534b0fa.png">

For windows: 
1. Once finish the 1-7 steps
2. Must run xampp and mysql 

![667241667145319_ pic](https://user-images.githubusercontent.com/116324663/198906647-9339964d-f034-431a-a3bb-8c51cf22a9bc.jpg)


