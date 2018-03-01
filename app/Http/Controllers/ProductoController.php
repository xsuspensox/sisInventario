<?php

namespace sisInventario\Http\Controllers;

use Illuminate\Http\Request;

use sisInventario\Producto;
use Illuminate\Support\Facades\Redirect;
use sisInventario\Http\Requests\ProductoFormRequest;
use DB;

class ProductoController extends Controller
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
    		$productos=DB::table('producto as p')
            ->join('categoria as c','p.idcategoria','=','c.idcategoria')
    		->select('p.idproducto','p.nombre','p.stock','c.nombre as categoria','p.unidad_medida','p.descripcion','p.estado')
    		->where('p.nombre','LIKE','%'.$query.'%')
            ->orderBy('idproducto','desc')
            ->paginate(7);
    		return view('almacen.producto.index',["productos"=>$productos,"searchText"=>$query]);
        }
    }
    public function create()
    {
    	$categorias=DB::table('categoria')->where('condicion','=','1')->get();
    	return view('almacen.producto.create',["categorias"=>$categorias]);
    }
    public function store(ProductoFormRequest $request)
    {
    	$producto=new Producto;
    	$producto->idcategoria=$request->get('idcategoria');	
    	$producto->nombre=$request->get('nombre');
    	$producto->stock=$request->get('stock');
        $producto->unidad_medida=$request->get('unidad_medida');
    	$producto->descripcion=$request->get('descripcion');
    	$producto->estado='Activo';	
    	$producto->save();
    	return Redirect::to('almacen/producto'); 
    }
    
    public function show($id)
    {
    	return view('almacen.producto.show',['producto'=>Producto::findOrFail($id)]);
    }
    public function edit($id)
    {
    	$producto=Producto::findOrFail($id);
    	$categorias=DB::table('categoria')->where('condicion','=','1')->get();
    	return view('almacen.producto.edit',["producto"=>$producto,"categorias"=>$categorias]);
    }
    public function update(ProductoFormRequest $request,$id)
    {
    	$producto=Producto::findOrFail($id);
    	$producto->idcategoria=$request->get('idcategoria');	
    	$producto->nombre=$request->get('nombre');
    	$producto->stock=$request->get('stock');
        $producto->unidad_medida=$request->get('unidad_medida');
    	$producto->descripcion=$request->get('descripcion');
    	$producto->estado='Activo';
      	$producto->update();
   		return Redirect::to('almacen/producto');
    
    }
    public function destroy($id)
    {
    	$producto=Producto::findOrFail($id);
    	$producto->estado='Inactivo';
    	$producto->update();
    	return Redirect::to('almacen/producto');
    }
}
