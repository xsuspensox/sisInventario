@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Proveedor : {{$persona->nombre}}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>
						{{$error}}
					</li>
					@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>
			{!!Form::model($persona,['method'=>'PATCH','route'=>['proveedor.update',$persona->idpersona]])!!}
			{{Form::token()}}
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" required value="{{$persona->nombre}}" name="nombre" class="form-control" placeholder="Nombre...">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="direccion">Direccion</label>
				<input type="text" value="{{$persona->direccion}}" name="direccion" class="form-control" placeholder="Direccion...">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label>Documento</label>
				<select name="tipo_documento" class="form-control">
					@if ($persona->tipo_documento=='DNI')
					<option value="DNI" selected>DNI</option>
					<option value="RUC">RUC</option>
					<option value="PAS">PAS</option>
					@elseif ($persona->tipo_documento=='RUC')
					<option value="DNI">DNI</option>
					<option value="RUC" selected>RUC</option>
					<option value="PAS">PAS</option>
					@else
					<option value="DNI">DNI</option>
					<option value="RUC">RUC</option>
					<option value="PAS" selected>PAS</option>
					@endif
				</select>
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="num_documento">Numero de Documento</label>
				<input type="text" value="{{$persona->num_documento}}" name="num_documento" class="form-control" placeholder="numero de documento...">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="telefono">Telefono</label>
				<input type="text" value="{{$persona->telefono}}" name="telefono" class="form-control" placeholder="Telefono...">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="email">E-mail</label>
				<input type="email" value="{{$persona->email}}" name="email" class="form-control" placeholder="Email...">
			</div>
		</div>
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<button class="btn btn-primary" type="submit">Guardar</button>
			<button class="btn btn-danger" type="reset">Cancelar</button>
		</div>
	</div>
			{!!Form::close()!!}

@endsection