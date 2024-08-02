<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\CepInvalidoException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistroRequest;
use App\Http\Resources\User\UserResource;
use App\Models\Carteira;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RegistroController extends Controller
{
    public function __invoke(RegistroRequest $request)
    {
        $input = $request->validated();

        $url = "https://viacep.com.br/ws/11111111/json/";

        try {
            $response = Http::timeout(30)->retry(3, 1000)->get($url);

            if($response->failed() || isset($response->json()['error'])){
                throw new CepInvalidoException();
            }

            $input['password'] = bcrypt($input['password']);
            $user = User::query()->create($input);

            Carteira::create([
                'user_id' => $user->id,
                'balance' => 0.00,
            ]);

            return new UserResource($user);

        } catch (\Exception $e) {
            Log::error('Erro CEP: ' . $e->getMessage());

            return response()->json(['message' => 'Erro ao validar o CEP'] . $e->getMessage(), 500);
        }

    }
}
