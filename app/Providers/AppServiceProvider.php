<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap(); //Setting the boostrap pagination view as default instead of tailwind Css
        
        //Setting up a moneyformat blade directive
        Blade::directive('moneyformat', function ($number) {
            return "<?php echo '&dollar;'.number_format($number, 2); ?>";
        });

        //Setting up an isAdmin blade directive
        Blade::if('isAdmin', function ($role_id) {
            return $role_id == 1;
        });
    }
}
