## Exercise:
Create a single page application that uses the database provided (SQLite 3) to list and
categorize country phone numbers.
Phone numbers should be categorized by country, state (valid or not valid), country code and
number.
The page should render a list of all phone numbers available in the DB. It should be possible to
filter by country and state. Pagination is an extra.

## Topics to take in account:
- Try to show your OOP skills
- Code standards/clean code
- Do not use external libs like libphonenumber to validate the numbers.

# Installation

* Install <a href = "https://getcomposer.org/">composer </a>
* Pull the code
````
git clone git@github.com:MohamedFaesal/jumia-task.git
````
* Get inside the project
````
cd jumia-task
````
* Install dependencies
````
composer install
````
* prepare environment
````
cp .env.example .env
````
* Review task
````
php artisan serve
````