# csp3-instant-messenger

My third capstone project (reoslack) at Zuitt (formerly Tuitt) Coding Bootcamp.

## Setup
- Install the dependencies.
```
$ composer install
```
- Generate a new application key.
```
$ php artisan key:generate
```
- Create a copy of `.env.example` file as `.env`.
```
$ cat .env.example > .env
```
- Update the following environment variables.
```
DB_DATABASE=reoslack_db
DB_USERNAME=root
```
- Execute the database migration.
```
$ php artisan migrate
```

---
Created by [Billy Arante](http://billyarante.com) of Mandaluyong City, Philippines  
Powered by [Zuitt (formerly Tuitt) Coding Bootcamp](https://zuitt.co/)
