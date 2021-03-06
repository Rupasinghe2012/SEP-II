<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Auth;

class ViewComposerServiceProvider extends ServiceProvider
{
    private $userData;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('includes.sidebar',function($view){

        if(Auth::User()) {
            $this->userData = Auth::User()->type;
        }
        $view->with(['userData' => $this->userData]);

    });
        view()->composer('admin.admin_home',function($view){

            if(Auth::User()) {
                $this->userData = Auth::User()->type;
            }
            $view->with(['userData' => $this->userData]);

        });
        view()->composer('includes.header',function($view){

            if(Auth::User()) {
                $this->userData = Auth::User()->type;
            }
            $view->with(['userData' => $this->userData]);

        });
        view()->composer('store.one',function($view){

            if(Auth::User()) {
                $this->userData = Auth::User()->type;
            }
            $view->with(['userData' => $this->userData]);

        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
