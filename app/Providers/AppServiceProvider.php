<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        Schema::defaultStringLength(171);
        UserResource::withoutWrapping();
        Carbon::setWeekStartsAt(Carbon::SATURDAY);
    }
}
