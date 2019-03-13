<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Observers\ReporterObserver;
use App\Observers\NotulenObserver;
use App\Reporter;
use App\Notulen;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        config(['app.locale' => 'id']);
        setLocale(LC_TIME, $this->app->getLocale());
        date_default_timezone_set("Asia/Bangkok");
        
        Reporter::observe(ReporterObserver::class);
        Notulen::observe(NotulenObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }
}
