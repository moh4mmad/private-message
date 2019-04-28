<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Front;
use App\Social;
use Config;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		if (Config()->get('app.env') == 'production')
		{
        $front = Front::first();
		$socials = Social::all();		
		view()->share('front', $front);
		view()->share('socials', $socials);
		}
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
