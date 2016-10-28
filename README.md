This is an app for hosting [ideological turing tests](https://en.wikipedia.org/wiki/Ideological_Turing_Test), as [proposed by Bryan Caplan](http://econlog.econlib.org/archives/2011/06/the_ideological.html).

## Installation

* `cp .env.development.example .env`
* set up a mysql database and fill in the rest of .env

* `composer install`
* `vendor/bin/phinx migrate`
* `php -S localhost:8000`
* open [http://localhost:8000](http://localhost:8000)
