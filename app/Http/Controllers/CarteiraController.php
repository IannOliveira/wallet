<?php

namespace App\Http\Controllers;

use App\Exceptions\CarteiraNaoEncontradaException;
use App\Exceptions\ErroTransferenciaException;
use App\Exceptions\SaldoInsuficienteException;
use App\Http\Requests\CarteiraRequest;
use App\Models\Carteira;
use App\Models\Transacao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CarteiraController extends Controller
{

    public function __construct(){
        $this->middleware('auth:sanctum');
    }

    public function transfer(CarteiraRequest $request){

        $input = $request->validated();

        $senderWallet = Auth::user()->wallet;

        $receiverWallet = Carteira::where('user_id', $input['receiver_id'])->first();

        if (!$receiverWallet) {
            throw new CarteiraNaoEncontradaException();
        }

        if ($senderWallet->balance < $request->amount) {
            throw new SaldoInsuficienteException();
        }

        DB::beginTransaction();

        try {
            $senderWallet->balance -= $input['amount'];
            $senderWallet->save();

            $receiverWallet->balance += $input['amount'];
            $receiverWallet->save();

            Transacao::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $input['receiver_id'],
                'amount' => $input['amount']
            ]);

            DB::commit();

            return response()->json(['message' => 'Transferencia realizada com sucesso.']);
        } catch (\Exception $e){
            Log::error('Erro na transferência: ' . $e->getMessage());

            DB::rollBack();
            throw new ErroTransferenciaException();
        }

    }

}
