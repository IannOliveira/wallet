<?php

namespace App\Exceptions;

use Exception;

class AutenticacaoInvalidaException extends Exception
{
    protected $message = 'As credenciais nao correspondem.';

    public function render(){
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ]);

    }
}
