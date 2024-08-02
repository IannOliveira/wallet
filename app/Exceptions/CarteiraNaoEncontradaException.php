<?php

namespace App\Exceptions;

use Exception;

class CarteiraNaoEncontradaException extends Exception
{
    protected $message = 'Carteira do destinatário não encontrada.';

    public function render(){
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 404);

    }
}
