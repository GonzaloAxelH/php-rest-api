<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Account;

class BalanceController extends Controller
{

    public function index()
    {
        return "Hola desde BalanceController index";
    }
    public function show(Request $request)
    {
        //obteniendo informacionj del parametro GET
        $accoubntId = $request->input("account_id");
        //Buscar un account en el id  con el modelo Account importado
        $account = Account::findOrFail($accoubntId);
        //si no se encuentra se produce un fallo
        return $account->balance; //retornamos solo el balance de esta cuenta

    }
}
