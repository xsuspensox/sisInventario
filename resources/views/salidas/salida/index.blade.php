@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Salidas  <a href="salida/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('salidas.salida.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Fecha</th>
					<th>Personal</th>					
					<th>Opciones</th>
				</thead>
				@foreach ($salidas as $sal)
				<tr>
					<td>{{$sal->idsalida}}</td>
					<td>{{$sal->fecha_hora}}</td>
					<td>{{$sal->nombre}}</td>					
					<td>
						<a href="{{URL::action('SalidaController@show',$sal->idsalida)}}"><button class="btn btn-info">Detalle</button></a>
						<a href="" data-target="#modal-delete-{{$sal->idsalida}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
					</td>
				</tr>
				@include('salidas.salida.modal')
				@endforeach
			</table>
		</div>
		{{$salidas->render()}}
	</div>
</div>
@endsection