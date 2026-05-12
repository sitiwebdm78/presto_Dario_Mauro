<?php

namespace App\Http\Responses\Fortify;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        session()->flash('success', 'Registrazione completata con successo! Benvenuto!');
        return redirect()->route('homepage');
    }
}