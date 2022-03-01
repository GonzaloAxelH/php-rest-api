<?php

use Illuminate\Support\Facades\Route;

//RUTA RESET
Route::post("/reset", "ResetController@reset");
//CREAR UNA CUENTA CON BALANCE INICIAL

//RUTA PARA OBTENER UNA BALANCE DE CUENTA EXISTENTE
Route::get("/balance/{id}", "BalanceController@getBalance");
//RUTAS PARA TRANFERENCIAS
Route::post("/event", "EventController@createEvent");
