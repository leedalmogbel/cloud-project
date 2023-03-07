### INSTALL
- PHP 8
- MySQL 8
- yarn

### INSTALL
- Run `composer install`
- Run `cp .env.example .env`
- Run `php artisan key:generate`
- Edit `.env` file to set database
- Run `yarn install --modules-folder ./public/components` (optional)
- Run `php artisan migrate`
- Run `php artisan db:seed --class=UserSeeder && php artisan db:seed --class=RoleSeeder`
