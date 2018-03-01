<?php

namespace sisInventario;

use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    protected $table='salida';

    protected $primaryKey='idsalida';

    public $timestamps=false;


    protected $fillable =[
        'idpersonal',
        'fecha_hora',
        'estado'
    ];

    protected $guarded =[

    ];
}
