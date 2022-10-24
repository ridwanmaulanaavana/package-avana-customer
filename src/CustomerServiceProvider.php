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

        // $this->mergeConfigFrom(
        //     __DIR__.'/../config/courier.php', 'courier'
        // );

        // $this->publishes([
        //     __DIR__.'/../config/courier.php' => config_path('courier.php'),
        // ]);


    }

    public function register(){
        
    }

}

?>