<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    //la creacion de este campo es para admitir valores asignados sobre el campo id
    protected $fillable = ['id'];
}
