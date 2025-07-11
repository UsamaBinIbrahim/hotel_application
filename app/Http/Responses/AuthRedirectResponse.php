<?php

namespace App\Http\Responses;

use Illuminate\Http\RedirectResponse;

interface AuthRedirectResponse
{
    public function redirect(): RedirectResponse;
}