<?php

namespace App\Providers;

use App\Models\Channel;
use Illuminate\Support\ServiceProvider;
use View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function (\Illuminate\View\View $view) {
            $view->with('channels', Channel::all());
        });
    }
}
