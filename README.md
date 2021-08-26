# Codeception is a multi-featured PHP based testing framework. This boilerplate project allows us to create automated tests for web services (both REST and SOAP).

## Prerequisites
- PHP 5.6+
- CURL enabled
- Composer
- Visual Studio Code / PHPStorm (optional IDE)

## Installation
```html
composer install
```

## Run Tests via CLI (using Makefile)
```html
make test_local
```

## Run Tests on Windows
```html
vendor/bin/codecept.bat run --env local
```

### Run in Docker Container
```html
docker run -v ${PWD}:/project codeception/codeception run --html --env prod  
```

### HTML Report
```html
php vendor/bin/codecept run --html --env prod
```

### XML Report
```html
php vendor/bin/codecept run --xml --env local
```

### Execute specific test suite only
```html
php vendor/bin/codecept run tests/PostEmployeeCest.php --html --env local
```

### Execute specific test scenario - 'getSpecificEmployeeTest' is the test name
```html
php vendor/bin/codecept run tests:getSpecificEmployeeTest --html --env local
```