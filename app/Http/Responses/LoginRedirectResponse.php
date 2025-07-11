<?php

namespace App\Http\Responses;

use Illuminate\Http\RedirectResponse;

class LoginRedirectResponse implements AuthRedirectResponse
{
    public function redirect(): RedirectResponse {
        return redirect()->intended(route('homepage.index'));
    }
}