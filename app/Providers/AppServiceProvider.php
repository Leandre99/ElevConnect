<?php

namespace App\Providers;

use App\Models\Animal;
use App\Observers\AnimalObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Animal::observe(AnimalObserver::class);
    }
}
