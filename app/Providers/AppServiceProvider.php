<?php

namespace App\Providers;

use App\Models\Activity;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\UnreadCommentsComposer;
use Laravel\Dusk\DuskServiceProvider;
use Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
    }


    public function boot()
    {
        View::composer('body.sidebar', UnreadCommentsComposer::class);

        Activity::saving(function (Activity $activity) {
            if (app()->runningInConsole()) {
                return; // skip if artisan command
            }
            $activity->ip_address = Request::ip();
        });
    }
}
