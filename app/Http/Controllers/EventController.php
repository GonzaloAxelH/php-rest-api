<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    //


    public function store(Request $request)
    {
        //Event si el tiopo ses de posito
        if ($request->input('type') === 'deposit') {
            return $this->deposit(
                $request->input('destination'),
                $request->input('amount')

            );
        }


        if ($request->input('type') === 'withdraw') {
            return $this->withdraw(
                $request->input('origin'),
                $request->input('amount')
            );
        }
        if ($request->input('type') === 'transfier') {

            return $this->transfier(
                $request->input('origin'),
                $request->input('destination'),
                $request->input('amount')
            );
        }
    }
    //funcion para depositar a una cuenta existenete de lo contrario devuelve cero
    private function deposit($destination, $amount)
    {
        //Buscamos la ceunta  destino si existe  
        //si no lo encuentra lo crea
        //firstOrCreate() encuentra la primera coincidencia  o cera un registro en la BD
        //fisrtOrNew enuentra lo mismo o devuelve un objeto nuevo
        //si no exste un destino creamos un acuenta en le balance inicial
        $search = ['id' => $destination];

        $account = Account::firstOrCreate($search);
        //aumentamos su balance
        $account->balance += $amount;
        //guardamos el balance
        $account->save();

        return response()->json([
            'destination' => [
                'id' => $account->id,
                'balance' => $account->balance
            ]
        ], 201);
    }
    //FUNCION para retirar un mionto de una cuenta existenet
    function withdraw($origin, $amount)
    {
        $account = Account::findOrFail($origin);
        $account->balance -= $amount;
        $account->save();
        return response()->json([
            'origin' => [
                'id' => $account->id,
                'balance' => $account->balance
            ]
        ], 201);
    }

    function transfier($origin, $destination, $amount)
    {

        $accountOrigin = Account::findOrFail($origin);
        $accountDestionation = Account::firstOrCreate(['id' => $destination]);

        //FORMA MANUAL (NO RECOMENDADO POR TEMAS DE ACTUAZLIACION erroenas) 

        //USANDO DB Transaccions (Si algo falla toda la transaccion se anula)
        DB::transaction(function ()  use ($accountOrigin, $accountDestionation, $amount) {

            $accountOrigin->balance -= $amount;
            $accountDestionation->balance += $amount;
            $accountOrigin->save();
            $accountDestionation->save();
        });

        return response()->json([
            'origin' => [
                'id' => $accountOrigin->id,
                'balance' => $accountOrigin->balance
            ],
            'destination' => [
                'id' => $accountDestionation->id,
                'balance' => $accountDestionation->balance
            ]
        ], 201);
    }

    //
}
