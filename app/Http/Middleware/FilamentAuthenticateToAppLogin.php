<?php

namespace App\Http\Middleware;

use Filament\Http\Middleware\Authenticate as FilamentAuthenticate;

class FilamentAuthenticateToAppLogin extends FilamentAuthenticate
{
    protected function redirectTo($request): ?string
    {
        return route('login');
    }
}
