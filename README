Sample catalog
==============

### Requirements
- PHP 5.4 or higher
- composer
- MySQL Database
- php-memcached 2.1.0
- bower (http://bower.io/)

### Installation
Clone the repository

    git clone https://github.com/Ftornik/sample-catalog.git sample-catalog

Install dependencies

    composer install --optimize-autoloader
    bower install

Load database structure and test data

    php app/console doctrine:schema:update --force
    php app/console h4cc_alice_fixtures:load:sets

Dump assets

    php app/console assetic:dump --env=prod --no-debug

Run tests

    bin/phpunit -c app/

Configure your webserver virtual host root to the */web* directory of a project and open:

    http://your.site/catalog

Enjoy!

### Caching
For caching cart data, doctrine entities and query results we use Memcached (config in app/config/config.yml, lsw_memcache). Magic happens in **LswMemcacheBundle**
Sessions not stored in memcached for stability reasons.