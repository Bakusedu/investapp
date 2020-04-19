## How to run
cd into the project directory, run the following commands on the terminal 
* `composer install`
* `php artisan key:generate`
* `php artisan serve`

## Directory
* Front end view files are located in `resources\views` directory
* All authentication files are located in the `resources\views\auth` directory
* The landing page is in `welcome.blade.php` in the resources\views folder
* create css and js folders in the `public` directory where you add js and style sheets and include them in blade files as so `<link href="{{ asset('css/app.css') }}" rel="stylesheet">`
`<script src="{{ asset('js/app.js') }}" </script>`
