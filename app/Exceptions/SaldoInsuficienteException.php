<?php

namespace App\Exceptions;

use Exception;

class SaldoInsuficienteException extends Exception
{
    protected $message = 'Saldo insuficiente.';

    public function render(){
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 400);

    }
}
