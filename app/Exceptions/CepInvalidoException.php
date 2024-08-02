<?php

namespace App\Exceptions;

use Exception;

class CepInvalidoException extends Exception
{
    protected $message = 'CEP Inválido!';

    public function render(){
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 422);

    }
}
