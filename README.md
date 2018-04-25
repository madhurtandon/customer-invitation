# customer-invitation
Generate list of customers within 100km of GPS coordinates

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

## Setup Instructions

1. Install composer within the example directory. You can find instructions on how to install composer [on composer's site](https://getcomposer.org/download/).

2. Run composer:

  ```sh
  php composer.phar install
  ```

  Or if you installed composer globally:

  ```sh
  composer install
  ```

3. Run composer dump-autoload -o, this will enable auto-loading

4. Start the internal PHP server on port 3000:

  ```sh
  php -S 0.0.0.0:3000 -t .
  ```
  
## Running the tests

1. composer require --dev phpunit/phpunit
2. vendor/bin/phpunit --bootstrap vendor/autoload.php tests --debug. This will run the test cases which are in the tests directory
  
  