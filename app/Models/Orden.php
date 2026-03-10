<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = "orden";
    public $timestamps = false;

    protected $fillable = [
        'idcliente',
        'idvendedor',
        'idstatus',
        'idcanal',
        'canal',
        'idforma_pago',
        'fecha',
        'total',
        'subtotal',
        'numero_productos',
    ];
}
