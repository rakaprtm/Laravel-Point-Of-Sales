<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use App\Helpers\RoleHelper;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::if('role', fn($role)   => Auth::check() && RoleHelper::is($role));
        Blade::if('anyrole', fn($roles) => Auth::check() && RoleHelper::isAny((array)$roles));
    }
}
