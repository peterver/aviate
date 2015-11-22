# Installing

1. `git clone https://github.com/airline/aviate.git`
2. `cd aviate`
3. `composer install`
4. `php artisan serve`

# Editing

Once you install, your database config file will get overwritten. You can stop this clogging up Git when you're editing by running `git update-index --assume-unchanged app/config/database.php`.

*NOTE*: If you have a version of the Aviate/Dime repository older than November 2015, you'll need to reclone before pushing any changes. Sorry.