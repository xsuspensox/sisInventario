<?php

namespace sisInventario\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use sisInventario\Http\Requests\IngresoFormRequest;
use sisInventario\Ingreso;
use sisInventario\DetalleIngreso;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class IngresoController extends Controller
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
    		$ingresos=DB::table('ingreso as i')
    		->join('personal as p','i.idproveedor','=','p.idpersonal')
    		->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    		->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    		->where('i.num_comprobante','LIKE','%'.$query.'%')
            ->orwhere('p.nombre','LIKE','%'.$query.'%')
    		->orderBy('i.idingreso','desc')
    		->groupBy('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.estado')
    		->paginate(7);
    		return view('compras.ingreso.index',["ingresos"=>$ingresos,"searchText"=>$query]);
        }
    }
    public function create()
    {
    	$personas=DB::table('personal')
        ->where('tipo_persona','=','Proveedor')->get();
        $productos=DB::table('producto as pro')
        ->select(DB::raw('CONCAT(pro.idproducto," ",pro.nombre) AS producto'),'pro.idproducto')
        ->where('estado','=','Activo')
        ->get();
        return view('compras.ingreso.create',["personas"=>$personas,"productos"=>$productos]);
    }
    public function store(IngresoFormRequest $request)
    {
        $ingreso=new Ingreso;
        $ingreso->idproveedor=$request->get('idproveedor');
        $ingreso->tipo_comprobante=$request->get('tipo_comprobante');
        $ingreso->serie_comprobante=$request->get('serie_comprobante');
        $ingreso->num_comprobante=$request->get('num_comprobante');

        $mytime=Carbon::now('America/Lima');
        $ingreso->fecha_hora=$mytime->toDateTimeString();        
        $ingreso->estado='A';
        $ingreso->save();
        $idproducto=$request->get('idproducto');
        $cantidad=$request->get('cantidad');
        $precio_compra=$request->get('precio_compra');

        $cont=0;
        while ($cont<count($idproducto)) {
            $detalle=new DetalleIngreso();
            $detalle->idingreso=$ingreso->idingreso;
            $detalle->idproducto=$idproducto[$cont];
            $detalle->cantidad=$cantidad[$cont];
            $detalle->precio_compra=$precio_compra[$cont];
            $detalle->save();
            $cont=$cont+1;
        }           
        return Redirect::to('compras/ingreso');
    }
    public function show($id)
    {
    	$ingreso=DB::table('ingreso as i')
        ->join('personal as p','i.idproveedor','=','p.idpersonal')
        ->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
        ->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','num_comprobante','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
         ->groupBy('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.estado')
         ->where('i.idingreso','=', $id)
         ->first();
        $detalles=DB::table('detalle_ingreso as di')
        ->join('producto as pro','di.idproducto','=','pro.idproducto')
        ->select('pro.nombre as producto','di.cantidad','di.precio_compra')
        ->where('di.idingreso','=',$id)
        ->get();
        return view('compras.ingreso.show',["ingreso"=>$ingreso,"detalles"=>$detalles]);
    }
    public function destroy($id)
    {
    	$ingreso=Ingreso::findOrFail($id);
        $ingreso->estado='C';
        $ingreso->update();
        return Redirect::to('compras/ingreso');
    }
}
