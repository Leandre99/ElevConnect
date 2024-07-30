<?php

namespace App\Providers;

use App\Models\Ferme;
use App\Policies\FermePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
