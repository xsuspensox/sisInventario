<?php

namespace sisInventario;

use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    protected $table='producto';

    protected $primaryKey='idproducto';

    public $timestamps=false;


    protected $fillable =[
        'idcategoria',
        'nombre',
        'stock',
        'unidad_medida',
        'descripcion',
        'estado'
    ];

    protected $guarded =[

    ];
}
