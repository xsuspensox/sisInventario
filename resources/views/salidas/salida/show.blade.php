@extends('layouts.admin')
@section('contenido')	
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="proveedor">Personal</label>
				<p>{{$salida->nombre}}</p>
			</div>
		</div>
	</div>
	<div class="row">	
		<div class="panel panel-primary">
			<div class="panel-body">				


				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
						<thead style="background-color: #A9D0F5">						
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Motivo</th>
						</thead>						
						<tbody>
							@foreach($detalles as $det)
								<tr>
									<td>{{$det->producto}}</td>
									<td>{{$det->cantidad}}</td>
									<td>{{$det->tipo_salida}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			</div>			
		</div>		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="guardar">
			<button class="btn btn-primary" type="submit">Guardar</button>
			<a href="{{url('/salidas/salida')}}"></a><button class="btn btn-danger" type="reset">Cancelar</button>
		</div>
	</div>


@endsection


