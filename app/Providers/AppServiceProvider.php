<?php

namespace App\Providers;

use App\Events\NewDenonceEvent;
use Illuminate\Support\ServiceProvider;
use Illuminate\Events\Dispatcher;
use TCG\Voyager\Facades\Voyager;
use DB;
use Log;
use App\User;
use App\OptionRequests;
use App\Denonce;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        DB::listen(function($query) {
            Log::info(
                $query->sql,
                $query->bindings,
                $query->time
            );
        });

        Denonce::created(function ($item) {
            Event::fire(new NewDenonceEvent($item));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        Voyager::useModel('User', User::class);
        //Voyager::useModel('OptionRequests', OptionRequests::class);
    }
}
