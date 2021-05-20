<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // //get data from SESSION
        // $sessionAll = Session::all();
        // dd($sessionAll);
        // $cartNumber = empty($sessionAll['carts']) ? 0 : sizeof($sessionAll['carts']);
        // // dd($cartNumber);

        // view()->composer('*', function ($view) use ($cartNumber) {
        //     // dd($cartNumber);
        //     $view->with('cartNumber', $cartNumber);
        // });
    }
}