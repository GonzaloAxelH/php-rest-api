<?php

use App\Http\Controllers\BalanceController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ResetController;
use Illuminate\Support\Facades\Route;

//RUTA RESET
Route::post("/reset", [ResetController::class, "index"]);
//RUTA PARA OBTENER UNA BALANCE DE CUENTA EXISTENTE
Route::get("/balance", [BalanceController::class, "show"]);
//RUTAS PARA DEPOSITIOS HACIA OTRAS CUENTAS
Route::post("/event", [EventController::class, "store"]);
//RUTA PARA TRANFERENCIAS
