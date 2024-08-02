<?php

namespace App\Exceptions;

use Exception;

class ErroTransferenciaException extends Exception
{
    protected $message = 'Erro na transferência, tente novamente.';

    public function render(){
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 400);

    }
}
