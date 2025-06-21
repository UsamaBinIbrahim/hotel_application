<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use App\Http\Responses\AuthRedirectResponse;
use Illuminate\Http\RedirectResponse;

class RegisterResponse implements RegisterResponseContract
{
    protected $redirectResponse;

    public function __construct(AuthRedirectResponse $response) {
        $this->redirectResponse = $response;
    }

    public function toResponse($request): RedirectResponse {
        return $this->redirectResponse->redirect();
    }
}