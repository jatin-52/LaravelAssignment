<p align="center"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></p>

## Installation required to run the project
 - PHP version 7.3 or above
 - **[Composer](https://getcomposer.org/)**
 - Mysql

---
## Things done in the application
 - Functionality to add `score board users` in DB.
 - Functionality to add / subtract points of user in the DB.
 - Functionality to delete users in the DB.
 - Migration created so db can be generated quickly.
 - Functionality to generate random data.
 - Postman collection file added which can be imported in postman application and apis can be run.
 - Test cases created so testing of the app can be done easily.
---
## Instruction to run the project
 - Open the project in command line mode
 - Run `composer install`, this will install all the dependencies required by the project.
 - Copy `.env.example` file to `.env` file.
 - Run `php artisan key:generate`, this will generate key in `.env` file.
 - Set Database credentials in `.env` file.
 - Create database in mysql, using phpmyadmin or command line.
 - Run `php artisan migrate` to add tables in database created.
 - Add fake records in database using `php artisan db:seed --class=ScoreBoardUserSeeder`
 - Run `php artisan serve` and open the brower at `localhost:8000`

---

## Running the APIs
For convenience a **.postman_collection.json** file is added to project root.
Further is how you can access APIs:

### [GET] list of score board users
URL - localhost:8000/api/score-board-user
```
OUTPUT
[
    {
        "id": 9,
        "name": "Monique Nikolaus Jr.",
        "age": 20,
        "points": 0,
        "address": "test address",
        "created_at": "2021-05-30T03:05:57.000000Z",
        "updated_at": "2021-05-30T03:05:57.000000Z"
    },
    {
        "id": 10,
        "name": "Logan Rolfson",
        "age": 20,
        "points": 0,
        "address": "test address",
        "created_at": "2021-05-30T03:06:25.000000Z",
        "updated_at": "2021-05-30T03:06:25.000000Z"
    }
]
```

### [POST] add score board users
URL - localhost:8000/api/score-board-user/store
```
INPUT
{
    "name": "Monique Nikolaus Jr.",
    "age": 20,
    "address": "test address"
}
```

### [DELETE] score board users
URL - localhost:8000/api/score-board-user/destroy/3
```
OUTPUT
{
    "output":"User deleted"
}
```

### [PUT] Add/subtract points of users
URL - localhost:8000/api/score-board-user/updateUserPoint
```
INPUT - to add point
{
    'id': 4,
    'isPlus': 1
}

INPUT - to subtract point
{
    'id': 4,
    'isPlus': 0
}
```

---
## Run test cases
 - Run command `vendor/bin/phpunit tests/Feature/ScoreBoardUserTest.php`, to run all the test cases for this application.
 - Run command `vendor/bin/phpunit --filter testAddScoreBoardUserValidations tests/Feature/ScoreBoardUserTest.php` to test specific function in the test case class.

---
## Test cases covered
 - Test if score board user 'points' are adding / subtracting for the last record which is in the database.
 - When score board user is inserting, check for required validations.
 - Check when user api is run, is the same user getting added to the database. Check name, point and address. This is done dynamically using faker(fake data generator).
 - Check if user is getting deleted.