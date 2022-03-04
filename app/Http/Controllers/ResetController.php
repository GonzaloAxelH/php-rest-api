<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ResetController extends Controller
{
    //
    public function index()
    {
        Artisan::call("migrate:refresh");
        return "ok";
    }
}
