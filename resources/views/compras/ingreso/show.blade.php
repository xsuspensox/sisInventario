@extends('layouts.admin')
@section('contenido')	
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="proveedor">Proveedor</label>
				<p>{{$ingreso->nombre}}</p>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label>Tipo Comprobante</label>
					<p>{{$ingreso->tipo_comprobante}}</p>
			</div>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="serie_comprobante">Serie comprobante</label>
					<p>{{$ingreso->serie_comprobante}}</p>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="num_comprobante">Numero comprobante</label>
					<p>{{$ingreso->num_comprobante}}</p>
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
							<th>Precio compra</th>
							<th>Subtotal</th>
						</thead>
						<tfoot>
							<th>TOTAL</th>
							<th></th>
							<th></th>							
							<th><H4 id="total">{{$ingreso->total}}</H4></th>
						</tfoot>
						<tbody>
							@foreach($detalles as $det)
								<tr>
									<td>{{$det->producto}}</td>
									<td>{{$det->cantidad}}</td>
									<td>{{$det->precio_compra}}</td>
									<td>{{$det->cantidad*$det->precio_compra}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			</div>			
		</div>		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="guardar">
			<button class="btn btn-primary" type="submit">Guardar</button>
			<button class="btn btn-danger" type="reset">Cancelar</button>
		</div>
	</div>


@endsection


