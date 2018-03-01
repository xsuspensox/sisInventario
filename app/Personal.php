<?php

namespace sisInventario;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $table='personal';

    protected $primaryKey='idpersonal';

    public $timestamps=false;


    protected $fillable =[
        'tipo_persona',
        'nombre',
        'tipo_documento',
        'num_documento',
        'direccion',
        'telefono',
        'email'
    ];

    protected $guarded =[

    ];
}
