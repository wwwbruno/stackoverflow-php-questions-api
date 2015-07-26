[![Build Status](https://magnum.travis-ci.com/wwwbruno/stackoverflow-php-questions-api.svg?token=hWqTK96oxQsRZHHLmWQU&branch=master)](https://magnum.travis-ci.com/wwwbruno/stackoverflow-php-questions-api)

# StackOverflow PHP Questions API
API for search PHP related questions in StackOverflow

## Installing

### Clone the repository
`git clone git@github.com:wwwbruno/stackoverflow-php-questions-api.git`

### Install composer dependencies
`composer install`

### Create database and tables
Create your database and config in the `app/config/parameters.yml` file, than run:
`php app/console doctrine:schema:update --force`

## Running tests
`phpunit -c app/`

## Running server
`php app/console server:run`
And access your [http://localhost:8000](http://localhost:8000) to see the application working

## See the online Demo
Deployed in [Heroku](http://still-peak-1129.herokuapp.com/) to see the application working

