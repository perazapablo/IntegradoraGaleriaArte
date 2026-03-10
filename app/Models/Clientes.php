<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $fillable = [
        'nombre',
        'email',
        'idedad',
        'idusuario',
        'idgenero',
        'idocupacion'
    ];
    protected $table = "cliente";
    public $timestamps = false;
}
