<?php
namespace Ridwan\Customer;

use Illuminate\Support\ServiceProvider;



class CustomerServiceProvider extends ServiceProvider
{
    public function boot(){
        //$this->map();
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views', 'customer');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->mergeConfigFrom(__DIR__.'/config/customer.php', 'customer');

        $this->publishes([
            __DIR__.'/config/customer.php' => config_path('customer.php'),
        ]);


    }

    public function register(){
        
    }

}

?>