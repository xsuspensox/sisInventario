<?php

namespace sisInventario;

use Illuminate\Database\Eloquent\Model;

class DetalleSalida extends Model
{
    protected $table='detalle_salida';

    protected $primaryKey='iddetalle_salida';

    public $timestamps=false;


    protected $fillable =[
        'idsalida',
        'idproducto',
        'cantidad',
        'tipo_salida'
    ];

    protected $guarded =[

    ];
}
