<?php

namespace App\Providers;

use App\Policies\GlobalPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // En Laravel 10 o inferior, descomenta la siguiente línea:
        // $this->registerPolicies();

        // Aquí conectamos tu GlobalPolicy con el sistema de permisos de Laravel.
        // Esto le dice a Laravel: "Antes de cualquier CRUD, pasa por mi GlobalPolicy"
        Gate::before([new GlobalPolicy, 'before']);
    }
}