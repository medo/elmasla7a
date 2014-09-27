### Installation
- ```cd app```
- ```curl -sS https://getcomposer.org/installer | php```
- ```php composer.phar install```
- Setup an empty database and put its credentials in ```config/database.php```
- Import the schema to your database
- ```php -S localhost:8080 router.php```
- Access it from the browser at ```localhost:8080```
