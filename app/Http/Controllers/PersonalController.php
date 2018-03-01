<?php

namespace sisInventario\Http\Controllers;

use Illuminate\Http\Request;

use sisInventario\Personal;
use Illuminate\Support\Facades\Redirect;

use sisInventario\Http\Requests\PersonalFormRequest;
use DB;

class PersonalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $personas=DB::table('personal')
            ->where('nombre','LIKE','%'.$query.'%')
            ->where ('tipo_persona','=','Personal')
            ->orwhere('num_documento','LIKE','%'.$query.'%')
            ->where ('tipo_persona','=','Personal')
            ->orderBy('idpersonal','desc')
            ->paginate(7);
            return view('salidas.personal.index',["personas"=>$personas,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view('salidas.personal.create');
    }
    public function store(PersonalFormRequest $request)
    {
        $persona=new Personal;
        $persona->tipo_persona='Personal';
        $persona->nombre=$request->get('nombre');
        $persona->tipo_documento=$request->get('tipo_documento');
        $persona->num_documento=$request->get('num_documento');
        $persona->direccion=$request->get('direccion');
        $persona->telefono=$request->get('telefono');
        $persona->email=$request->get('email');
        $persona->save();
        return Redirect::to('salidas/personal'); 
    }
    public function show($id)
    {
        return view("salidas.personal.show",['persona'=>Personal::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("salidas.personal.edit",["persona"=>Personal::findOrFail($id)]);
    }
    public function update(PersonalFormRequest $request,$id)
    {
    $persona=Personal::findOrFail($id);
    $persona->nombre=$request->get('nombre');
    $persona->tipo_documento=$request->get('tipo_documento');
    $persona->num_documento=$request->get('num_documento');
    $persona->direccion=$request->get('direccion');
    $persona->telefono=$request->get('telefono');
    $persona->email=$request->get('email');
    $persona->update();
    return Redirect::to('salidas/personal');    
    }
    public function destroy($id)
    {
        $persona=Personal::findOrFail($id);
        $persona->tipo_persona='Inactivo';
        $persona->update();
        return Redirect::to('salidas/personal');
    }
}
