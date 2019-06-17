Follow below steps to run the project:-

1) Clone the repository .

2) Run the command "composer update" .

3) Run the command "cp .env.example .env"

4) Run the command "php artisan key:generate"

5)Then an .env file will be created.then go to that env file and assign the following values:-
DB_DATABASE=assignment
DB_USERNAME=root
DB_PASSWORD=

6) Then run the command "php artisan migrate" to migrate the tables of database.

7) Start the apache and mysql server in xampp/lampp/etc.

8) Start your project in project's directory OR you can run command "php artisan serve" and this command will generate a local development start which you can access on browser to start the project.
