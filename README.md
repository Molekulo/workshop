# Short description of project
Laravel Application for auto repair workshop.

# Instruction for configuration
Required:

*HTTP server (Apache, Nginx or similar)
   
*PHP ^7.1.3

*MySQL or MariaDB

#Follow next steps for proper install
1. Install web server (Please check the official laravel installation guide for server requirements before you start [Official Documentation](https://laravel.com/docs/5.7/installation) )
2. Install Git
3. Clone the repository mechanic: `git clone http://git.quantox.tech/milos.vidanovic/mechanic.git`
4. Go to mechanic folder with command: `cd mechanic` 
5. Install Composer (run `composer install`)
6. Copy .env.example file and edit database configuration (.env.example file is included) with next command:
   `cp .env.example .env`
7. Generate a new application key (run `php artisan key:generate`)
8. Run the database migrations (Set the database connection in .env before migrating) - run `php artisan migrate --seed`
9. Start the local development server
`php artisan serve`

You can now access the server at http://localhost:8000

TL;DR command list

`git clone http://git.quantox.tech/milos.vidanovic/mechanic.git`

`cd mechanic`

`composer install`

`cp .env.example .env`

`php artisan key:generate`


Make sure you set the correct database connection information before running the migrations Environment variables

`php artisan migrate --seed`

`php artisan serve`


# Description of functionality
1. Application allow for admins to create user and cars in database.
2. Allow to schedule services for cars.
3. Registration and login system for registered users.
4. Administration panel for adding, changing and deleting services and clients cars.


