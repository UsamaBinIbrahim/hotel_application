<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use App\Http\Responses\AuthRedirectResponse;
use Illuminate\Http\RedirectResponse;

class LoginResponse implements LoginResponseContract
{
    protected $redirectResponse;

    public function __construct(AuthRedirectResponse $response) {
        $this->redirectResponse = $response;
    }

    public function toResponse($request): RedirectResponse {
        return $this->redirectResponse->redirect();
    }
}