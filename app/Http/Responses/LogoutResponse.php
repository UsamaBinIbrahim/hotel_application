<?php

namespace App\Http\Responses;

use Filament\Http\Responses\Auth\Contracts\LogoutResponse as FilamentLogoutResponseContract;
use Laravel\Fortify\Contracts\LogoutResponse as FortifyLogoutResponseContract;
use Illuminate\Http\RedirectResponse;

class LogoutResponse implements FilamentLogoutResponseContract, FortifyLogoutResponseContract
{
    public function toResponse($request): RedirectResponse {
        if ($request->is('admin/logout') || $request->routeIs('filament.*')) {
            return to_route('filament.admin.auth.login');
        }

        return to_route('homepage.index');
    }
}
