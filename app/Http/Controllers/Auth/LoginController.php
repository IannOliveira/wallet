<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\AutenticacaoInvalidaException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request){

        $input = $request->validated();

        if(!Auth::attempt($input)) {
            throw new AutenticacaoInvalidaException();
        }

        $request->session()->regenerate();

        return new UserResource(auth()->user());
    }

}
