<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistroController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CarteiraController;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:sanctum')->get('/me', [\App\Http\Controllers\Me\MeController::class, 'show']);

Route::post('transfer', [CarteiraController::class, 'transfer']);
Route::post('login', LoginController::class);
Route::post('logout', LogoutController::class);
Route::post('registro', RegistroController::class);


/*Route::get('/test-email', function () {
    Mail::raw('Este é um email de teste.', function ($message) {
        $message->to('iannjogo@gmail.com')
            ->subject('Teste de Email');
    });

    return 'Email enviado!';
});*/
